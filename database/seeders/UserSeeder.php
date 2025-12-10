<?php

namespace Database\Seeders;

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
        $user_tabel = [
            [
                'nama_user' => 'Andi',
                'email'     => 'andi2@example.com',
                'password'  => Hash::make('password123'), // bcrypt password
            ],
            [
                'nama_user' => 'Budi',
                'email'     => 'budi5@example.com',
                'password'  => Hash::make('password123'),
            ],
            [
                'nama_user' => 'Citra',
                'email'     => 'citra90@example.com',
                'password'  => Hash::make('password123'),
            ],
        ];

        DB::table('user_tabel')->insert($user_tabel);
    }
}