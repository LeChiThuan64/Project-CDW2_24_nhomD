<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Voucher;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

<<<<<<< HEAD
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
=======
    protected $primaryKey = 'id'; // Khóa chính trong cơ sở dữ liệu là 'id'

    // Cho phép các trường này có thể được ghi vào cơ sở dữ liệu
    // protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'gender', 'dob', 'profile_image'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'gender',
        'dob',
        'is_active',
        'profile_image'
    ];
    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date', // Chuyển đổi trường 'dob' thành kiểu ngày
    ];
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

>>>>>>> main
}
