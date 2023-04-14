<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list_user = [
            [
                'username' => 'Budi',
                'password' => Hash::make('123'),
                'saldo' => 0,
                'role' => 'bapak'
            ],
            [
                'username' => 'Siti',
                'password' => Hash::make('123'),
                'saldo' => 0,
                'role' => 'anak'
            ]
        ];
        DB::table('users')->insert($list_user);
    }
}
