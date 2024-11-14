<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['blog_id', 'user_id', 'name', 'email', 'comment', 'parent_id'];

    // Quan hệ với blog
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    // Quan hệ với người dùng (user) đã bình luận 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với bình luận cha (nếu có)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Quan hệ với các bình luận con (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
