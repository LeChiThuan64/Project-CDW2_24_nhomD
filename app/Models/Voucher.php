<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vocher'; // Nếu bạn muốn giữ tên bảng là 'vocher'

    protected $fillable = [
        'user_id', 'is_global', 'name', 'description', 'discount', 'start_date', 'end_date'
    ];

    // Quan hệ với model User
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
