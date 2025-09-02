<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory; // ✅ now Laravel will find it

    // An order belongs to one user
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    // An order belongs to one product
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
