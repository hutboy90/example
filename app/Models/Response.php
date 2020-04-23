<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'success', 'status', 'message', 'data', 'code'
    ];
}
