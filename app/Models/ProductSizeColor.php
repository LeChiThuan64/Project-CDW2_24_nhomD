<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeColor extends Model
{
    use HasFactory;

    protected $table = 'product_size_color';
    
    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'quantity',
        'price'
    ];

    // Nếu bạn muốn định nghĩa các mối quan hệ
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
