<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beli = [
            [
                'nama' => 'Andi',
                'alamat' => 'Jl. Merdeka No.1',
                'produk' => 'Produk A',
                'catatan' => 'Cepat dikirim',
                'total' => 50000
            ],
            [
                'nama' => 'Budi',
                'alamat' => 'Jl. Sudirman No.2',
                'produk' => 'Produk B',
                'catatan' => 'Packing rapi',
                'total' => 75000
            ],
        ];
        DB::table('beli')->insert($beli);
    }
}
