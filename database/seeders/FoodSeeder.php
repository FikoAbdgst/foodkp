<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel foods terlebih dahulu jika diperlukan
        // \Illuminate\Support\Facades\DB::table('foods')->truncate();

        $foods = [
            [
                'nama_makanan' => 'Donat Salju',
                'harga' => 3000,
                'stok' => 50,
                'terjual' => 15,
                'masa_tahan_hari' => 2,
                'is_expired' => false,
                'image' => 'foods/default.jpg', // Pastikan Anda memiliki gambar default ini atau update via admin nanti
            ],
            [
                'nama_makanan' => 'Risol',
                'harga' => 2000,
                'stok' => 40,
                'terjual' => 20,
                'masa_tahan_hari' => 1, // Gorengan biasanya enak dimakan di hari yang sama
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Kue Putu',
                'harga' => 1500,
                'stok' => 30,
                'terjual' => 10,
                'masa_tahan_hari' => 1,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Bugis',
                'harga' => 2000,
                'stok' => 35,
                'terjual' => 12,
                'masa_tahan_hari' => 2,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Dadar Gulung',
                'harga' => 1500,
                'stok' => 45,
                'terjual' => 25,
                'masa_tahan_hari' => 1,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Kue Lapis',
                'harga' => 1500,
                'stok' => 50,
                'terjual' => 30,
                'masa_tahan_hari' => 2,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Kue Putu Ayu',
                'harga' => 2000,
                'stok' => 40,
                'terjual' => 18,
                'masa_tahan_hari' => 2,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Nagasari',
                'harga' => 2000,
                'stok' => 30,
                'terjual' => 8,
                'masa_tahan_hari' => 2,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Ongol - Ongol',
                'harga' => 2000,
                'stok' => 25,
                'terjual' => 5,
                'masa_tahan_hari' => 1,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Kue Kukus',
                'harga' => 2000,
                'stok' => 40,
                'terjual' => 22,
                'masa_tahan_hari' => 3,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
            [
                'nama_makanan' => 'Lontong Isi',
                'harga' => 4000,
                'stok' => 60,
                'terjual' => 45,
                'masa_tahan_hari' => 2,
                'is_expired' => false,
                'image' => 'foods/default.jpg',
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
