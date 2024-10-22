<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'image_id';

    protected $fillable = ['product_id', 'image_url', 'created_at'];

    public $timestamps = false;

    // ProductImage thuộc về một Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}