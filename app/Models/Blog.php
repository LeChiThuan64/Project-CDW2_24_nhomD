<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Nếu bảng trong cơ sở dữ liệu có tên khác, bạn cần chỉ định như sau:
    protected $table = 'blogs';
}
