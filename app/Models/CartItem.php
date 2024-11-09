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
    protected $fillable = ['cart_id', 'product_id', 'size_id', 'color_id', 'quantity'];

    // Mối quan hệ với bảng Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Đảm bảo tham chiếu đúng cột
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function getPrice()
    {
        return ProductSizeColor::where('product_id', $this->product_id)
            ->where('size_id', $this->size_id)
            ->where('color_id', $this->color_id)
            ->value('price');
    }

    // Phương thức tính tổng tiền cho giỏ hàng
    public function getTotalPrice()
    {
        return $this->getPrice() * $this->quantity;
    }
    
}
