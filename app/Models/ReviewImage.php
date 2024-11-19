<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    protected $table = 'review_images';
    protected $primaryKey = 'id';

    protected $fillable = ['review_id', 'image_url', 'created_at', 'updated_at'];

    public $timestamps = false;

    // ProductImage thuộc về một Product
    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }
    
}
