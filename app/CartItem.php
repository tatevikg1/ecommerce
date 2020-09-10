<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;

class CartItem extends Model
{
    protected $guarded = [];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
