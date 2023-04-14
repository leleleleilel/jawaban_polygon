<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function gototransaction()
    {
        $category = DB::table('categories')->get();
        return view('pages.transactionPage', compact('category'));
    }

    function insertTransaction(Request $request)
    {
        $tanggal_transaksi = $request->txttanggaltransaksi;
        $kategori = $request->optkategori;
        $nominal = $request->txtnominal;
        $keterangan = $request->txtketerangan;
        $jenis_transaksi = $request->optjenistransaksi;
        $status = 'pending';

        $request->validate([
            "txttanggaltransaksi" => 'required',
            "optkategori" => 'required',
            "txtnominal" => 'required',
            "optjenistransaksi" => 'required'
        ]);

        if ($keterangan == "") {
            $keterangan = null;
        }

        $transaction = new Transaction();
        $transaction->tanggal_transaksi = $tanggal_transaksi;
        $transaction->kategori_id = $kategori; //diambil value e aja
        $transaction->nominal = $nominal;
        $transaction->keterangan = $keterangan;
        $transaction->jenis_transaksi = $jenis_transaksi;
        $transaction->status = $status;
        $transaction->save();
        return redirect()->back()->with('message', 'Sukses Insert Transaction!');
    }
}
