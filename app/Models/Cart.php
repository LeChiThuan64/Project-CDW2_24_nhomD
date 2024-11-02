<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'shopping_cart';

    // Khóa chính của bảng
    protected $primaryKey = 'cart_id';

    // Các trường có thể được gán đại diện
    protected $fillable = ['user_id'];

    // Mối quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Tùy chỉnh nếu cần
    }

    // Mối quan hệ với bảng CartItem
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id'); // Mối quan hệ với CartItem
    }
}
