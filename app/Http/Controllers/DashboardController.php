<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function gotodashboard()
    {
        $transactions = DB::table('transactions')->get();
        $category = DB::table('categories')->get();
        $startDate = Carbon::now()->subYear(1);
        $endDate = Carbon::now();
        return view('pages.dashboardPage', compact('transactions', 'category', 'startDate', 'endDate'));
    }

    function editData(Request $request)
    {
        $tanggal_transaksi = $request->txttanggaltransaksi;
        $kategori = $request->optkategori;
        $nominal = $request->txtnominal;
        $keterangan = $request->txtketerangan;
        $jenis_transaksi = $request->optjenistransaksi;

        $request->validate([
            "txttanggaltransaksi" => 'required',
            "optkategori" => 'required',
            "txtnominal" => 'required',
            "optjenistransaksi" => 'required'
        ]);

        if ($keterangan == "") {
            $keterangan = null;
        }

        $transaction = DB::table('transactions')->where('id', $request->id)->update([
            'tanggal_transaksi' => $tanggal_transaksi,
            'kategori_id' => $kategori,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
            'jenis_transaksi' => $jenis_transaksi
        ]);
        return redirect('/dashboard');
    }
    function gotoedittransaction(Request $request)
    {
        $category = DB::table('categories')->get();
        $result = DB::table('transactions')->where('id', $request->id)->first();
        return view('pages.editTransactionPage', compact('result', 'category'));
    }
    function deleteData(Request $request)
    {
        DB::table('transactions')->where('id', $request->id)->delete();
        return redirect()->back()->with('message', "Sukses delete user!");
    }

    function konfirmasiTransaksi(Request $request)
    {
        $transaksi = DB::table('transactions')->where('id', $request->id)->first();
        if ($transaksi->jenis_transaksi == "pemasukan") {
            DB::table('users')->where('id', 1)->update([
                "saldo" => DB::table('users')->where('id', 1)->first()->saldo + $transaksi->nominal
            ]);
        } else {
            DB::table('users')->where('id', 1)->update([
                "saldo" => DB::table('users')->where('id', 1)->first()->saldo - $transaksi->nominal
            ]);
        }
        DB::table('transactions')->where('id', $request->id)->update([
            "status" => 'approved'
        ]);
        return redirect()->back()->with('message', "Sukses konfirmasi!");
    }
}
