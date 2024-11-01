<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id'; // Khóa chính trong cơ sở dữ liệu là 'id'

    // Cho phép các trường này có thể được ghi vào cơ sở dữ liệu
    // protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'gender', 'dob', 'profile_image'];
protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'gender', 'dob', 'is_active', 'profile_image'
    ];
    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date', // Chuyển đổi trường 'dob' thành kiểu ngày
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
