<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list_category = [
            [
                'nama' => 'makanan'
            ],
            [
                'nama' => 'minuman'
            ],
            [
                'nama' => 'belanja'
            ],
            [
                'nama' => 'transaksi'
            ],
            [
                'nama' => 'gaji'
            ]

        ];
        DB::table('categories')->insert($list_category);
    }
}
