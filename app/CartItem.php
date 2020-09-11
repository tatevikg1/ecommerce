<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Product;

class CartItem extends Model
{
    protected $guarded = [];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
