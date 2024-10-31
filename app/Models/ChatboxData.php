<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatboxData extends Model
{
    use HasFactory;

    protected $table = 'chatbox_data';

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'support_issue',
        'status',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) random_int(1000, 9999);
        });
    }

}