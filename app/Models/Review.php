<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment', 'reply', 'created_at', 'updated_at'];

    public $timestamps = false;

    // Review thuộc về một User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Review thuộc về một Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }
}
