<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'nama_makanan',
        'image',
        'harga',
        'stok',
        'terjual',
        'masa_tahan_hari', // Field baru
        'is_expired',      // Field baru
    ];

    // Fungsi pembantu untuk memunculkan catatan info
    public function getCatatanExpiredAttribute()
    {
        if ($this->masa_tahan_hari) {
            return "Catatan: Makanan ini hanya tahan " . $this->masa_tahan_hari . " hari sejak diinput.";
        }
        return "Tahan lama (Tidak ada catatan kedaluwarsa)";
    }
}
