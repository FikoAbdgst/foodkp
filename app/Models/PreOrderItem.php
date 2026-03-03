<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreOrderItem extends Model
{
    protected $fillable = [
        'pre_order_id',
        'food_id',
        'quantity',
        'price'
    ];
}
