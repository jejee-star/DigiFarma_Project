<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama_obat' => 'Paracetamol',
            'harga' => '12000',
        ]);
        Produk::create([
            'nama_obat' => 'Amoxillin',
            'harga' => '17000',
        ]);
    }
}
