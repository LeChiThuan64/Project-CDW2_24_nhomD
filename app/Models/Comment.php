<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['blog_id', 'name', 'email', 'comment'];

    // Liên kết với blog
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
