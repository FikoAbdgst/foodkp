<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            [
                'nama_makanan' => 'Nasi Goreng Spesial',
                'image' => 'foods/default.jpg', // Pastikan Anda memiliki gambar default atau sesuaikan path-nya
                'harga' => 25000,
                'stok' => 50,
                'terjual' => 10,
                'masa_tahan_hari' => 1, // Tahan 1 hari
                // 'is_expired' => false, // Abaikan ini jika Anda menggunakan Opsi 1 (Dinamis Model)
            ],
            [
                'nama_makanan' => 'Mie Bakso Urat',
                'image' => 'foods/default.jpg',
                'harga' => 20000,
                'stok' => 30,
                'terjual' => 5,
                'masa_tahan_hari' => 2, // Tahan 2 hari
            ],
            [
                'nama_makanan' => 'Kerupuk Udang',
                'image' => 'foods/default.jpg',
                'harga' => 5000,
                'stok' => 100,
                'terjual' => 25,
                'masa_tahan_hari' => null, // Tidak bisa basi / tahan lama
            ],
            [
                'nama_makanan' => 'Ayam Bakar Madu',
                'image' => 'foods/default.jpg',
                'harga' => 30000,
                'stok' => 20,
                'terjual' => 15,
                'masa_tahan_hari' => 1, // Tahan 1 hari
            ],
            [
                'nama_makanan' => 'Minuman Es Teh Manis',
                'image' => 'foods/default.jpg',
                'harga' => 5000,
                'stok' => 100,
                'terjual' => 40,
                'masa_tahan_hari' => 1, // Tahan 1 hari
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
