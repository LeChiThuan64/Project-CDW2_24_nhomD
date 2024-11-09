<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['blog_id', 'name', 'email', 'comment', 'parent_id'];

    // Liên kết với blog
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
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
