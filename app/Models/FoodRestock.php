<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRestock extends Model
{
    use HasFactory;

    protected $fillable = ['food_id', 'quantity', 'expired_at'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
