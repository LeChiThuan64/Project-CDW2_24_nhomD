<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturnResult extends Model
{
    use HasFactory;
    // Các trường có thể được gán giá trị hàng loạt
    protected $table = 'order_return_results';
    protected $fillable = [
        'returns_order_id',
        'order_id',
        'product_id',
        'return_status',
        'reason',
        'created_at',
    ];
    // Nếu cần, bạn có thể định nghĩa mối quan hệ với các model khác
    public function returnsOrder()
    {
        return $this->belongsTo(ReturnsOrder::class, 'returns_order_id');
    }
}
