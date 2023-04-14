<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list_transaction = [
            [
                'tanggal_transaksi' => '2023-04-14',
                'kategori_id' => 1,
                'nominal' => 30000,
                'keterangan' => 'Beli Kentang Goreng',
                'jenis_transaksi' => 'pengeluaran',
                'status'=>'approved'
            ],
            [
                'tanggal_transaksi' => '2023-04-13',
                'kategori_id' => 5,
                'nominal' => 5000000,
                'keterangan' => 'Dapat Gaji Bulanan',
                'jenis_transaksi' => 'pemasukan',
                'status' => 'approved'
            ],
            [
                'tanggal_transaksi' => '2023-04-13',
                'kategori_id' => 2,
                'nominal' => 15000,
                'keterangan' => 'Beli Es Teh Manis',
                'jenis_transaksi' => 'pengeluaran',
                'status' => 'rejected'
            ]
        ];
        DB::table('transactions')->insert($list_transaction);
    }
}
