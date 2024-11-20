<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size_color')
                    ->withPivot('color_id', 'quantity',  'price')
                    ->withTimestamps();
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'size_id');
    }
}
