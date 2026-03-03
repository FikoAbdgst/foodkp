<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    // Sesuaikan dengan field yang tersisa setelah stok & expired dipindah
    protected $fillable = [
        'nama_makanan',
        'image',
        'harga',
    ];

    // Relasi ke tabel restock
    public function restocks()
    {
        return $this->hasMany(FoodRestock::class);
    }

    // Accessor untuk mendapatkan total stok makanan saat ini
    public function getStokAttribute()
    {
        return $this->restocks()->sum('quantity');
    }
}
