<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Đặt tên bảng (nếu cần)
    protected $table = 'blogs';
    
    // Khai báo khóa chính là blog_id
    protected $primaryKey = 'blog_id';
    
    public function comments()
{
    return $this->hasMany(Comment::class, 'blog_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
