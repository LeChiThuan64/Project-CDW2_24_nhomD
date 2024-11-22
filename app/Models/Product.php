<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Tên bảng
    protected $primaryKey = 'product_id';


    protected $fillable = [
        'name',
        'description',
        'category_id',
        'created_at',
        'updated_at'
    ];


    public $timestamps = false;

    protected $guarded = [];

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
        return $this->belongsToMany(Size::class, 'product_size_color', 'product_id')
            ->withPivot('color_id', 'size_id', 'quantity', 'price')
            ->withTimestamps();
    }
    public function productSizeColors()
    {
        return $this->hasMany(ProductSizeColor::class, 'product_id');
    }

    public function getProductDetailData()
    {
        $colors = [];
        $sizes = [];
        $totalQuantity = 0;
        $images = $this->images->pluck('image_url')->map(function ($url) {
            return asset('assets/img/products/' . $url);
        })->toArray();

        foreach ($this->productSizeColors as $sizeColor) {
            $colors[] = $sizeColor->color->name ?? 'N/A';
            $sizes[] = $sizeColor->size->name ?? 'N/A';
            $totalQuantity += $sizeColor->quantity;
            $price = $sizeColor->price;
        }

        $totalSold = OrderItem::where('product_id', $this->product_id)->sum('quantity');

        return [
            'product_id' => $this->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'category_name' => $this->category->category_name,
            'colors' => implode(', ', array_unique($colors)),
            'sizes' => implode(', ', array_unique($sizes)),
            'total_quantity' => $totalQuantity,
            'sizesAndColors' => $this->productSizeColors,
            'images' => $images,
            'price' => $price,
            'total_sold' => $totalSold,
        ];
    }

}