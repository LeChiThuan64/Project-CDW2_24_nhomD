<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'created_at',
        'updated_at'
    ];
    

    public $timestamps = false;

    // Product thuộc về một Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Product có nhiều ProductImage
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // Product có nhiều Review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function sizesAndColors()
{
    return $this->belongsToMany(Size::class, 'product_size_color')
                ->withPivot('color_id', 'size_id', 'quantity')
                ->withTimestamps();
}

}
