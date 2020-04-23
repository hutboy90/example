<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'amount'
    ];

    protected $casts = [
        'product_id' => 'integer',
        'amount' => 'integer',
    ];
}
