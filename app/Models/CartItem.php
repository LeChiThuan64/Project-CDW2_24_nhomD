<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'cart_items';

    // Khóa chính của bảng
    protected $primaryKey = 'cart_item_id';

    // Các trường có thể được gán đại diện
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Mối quan hệ với bảng Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    // Mối quan hệ với bảng Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
