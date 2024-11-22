<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'error_type',
        'error_description',
    ];
}