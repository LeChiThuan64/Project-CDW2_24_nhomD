<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'user_id', 'first_name', 'last_name', 'street_address', 'city', 'zipcode', 'phone', 'email', 'country',
        'voucher_discount', 'subtotal', 'shipping_price', 'total', 'payment_method', 'status', 'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}