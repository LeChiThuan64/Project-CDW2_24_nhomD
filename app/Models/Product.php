<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    // Nếu bạn không sử dụng timestamps, hãy thêm dòng này
    public $timestamps = false;

    // Nếu bạn muốn bảo vệ các cột khác, hãy thêm dòng này
    protected $guarded = [];

    use HasFactory;

        public function images()
        {
            return $this->hasMany(ProductImage::class, 'product_id', 'id');
        }

}