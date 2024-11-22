<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnsOrder extends Model
{
    use HasFactory;
    protected $table = 'returns_order';

    protected $fillable = [
        'orders_id',
        'product_id',
        'status_product',
        'return_reason',
        'detailed_description',
        'image_1',
        'image_2',
        'banking_id',
        'phone',
        'status',
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'banking_id');
    }
}