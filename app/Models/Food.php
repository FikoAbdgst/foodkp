<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk menegaskan nama tabel di database
    protected $table = 'foods';

    protected $fillable = [
        'nama_makanan',
        'image',
        'harga',
        'stok',
        'terjual',
    ];
}
