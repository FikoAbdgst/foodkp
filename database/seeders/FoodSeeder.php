<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            // 1. Makanan baru diinput hari ini, masa tahan 1 hari (BELUM KEDALUWARSA)
            [
                'nama_makanan' => 'Nasi Goreng Spesial',
                'image' => 'foods/default.jpg', // Pastikan Anda memiliki gambar default atau sesuaikan path-nya
                'harga' => 25000,
                'stok' => 50,
                'terjual' => 10,
                'masa_tahan_hari' => 1,
                'is_expired' => false,
                'created_at' => now(), // Dibuat saat seeder dijalankan
            ],
            // 2. Makanan diinput 3 hari yang lalu, masa tahan 2 hari (SUDAH KEDALUWARSA)
            [
                'nama_makanan' => 'Mie Bakso Urat',
                'image' => 'foods/default.jpg',
                'harga' => 20000,
                'stok' => 30,
                'terjual' => 5,
                'masa_tahan_hari' => 2,
                'is_expired' => true, // Diset true karena umurnya 3 hari, padahal tahannya cuma 2 hari
                'created_at' => now()->subDays(3), // Dibuat 3 hari yang lalu secara dinamis
            ],
            // 3. Makanan tidak bisa basi, diinput 30 hari yang lalu (TAHAN LAMA)
            [
                'nama_makanan' => 'Kerupuk Udang',
                'image' => 'foods/default.jpg',
                'harga' => 5000,
                'stok' => 100,
                'terjual' => 25,
                'masa_tahan_hari' => null, // Tidak bisa basi
                'is_expired' => false,
                'created_at' => now()->subDays(30), // Dibuat sebulan yang lalu
            ],
            // 4. Makanan diinput 2 hari yang lalu, masa tahan 1 hari (SUDAH KEDALUWARSA)
            [
                'nama_makanan' => 'Ayam Bakar Madu',
                'image' => 'foods/default.jpg',
                'harga' => 30000,
                'stok' => 20,
                'terjual' => 15,
                'masa_tahan_hari' => 1,
                'is_expired' => true,
                'created_at' => now()->subDays(2),
            ],
            // 5. Makanan diinput 2 hari yang lalu, masa tahan 4 hari (BELUM KEDALUWARSA - Sisa 2 hari lagi)
            [
                'nama_makanan' => 'Minuman Es Teh Manis',
                'image' => 'foods/default.jpg',
                'harga' => 5000,
                'stok' => 100,
                'terjual' => 40,
                'masa_tahan_hari' => 4,
                'is_expired' => false,
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($foods as $food) {
            // Agar field updated_at juga menyesuaikan dengan created_at
            $food['updated_at'] = $food['created_at'];

            Food::create($food);
        }
    }
}
