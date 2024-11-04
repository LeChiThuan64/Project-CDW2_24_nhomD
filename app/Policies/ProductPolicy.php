<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Product $product)
    {
        return $user->role === '0'; // Chỉ cho phép xóa khi người dùng có quyền admin
    }
}
