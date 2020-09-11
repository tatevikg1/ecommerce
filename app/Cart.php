<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CartItem;

class Cart extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function updateTotalPrice($add, int $price,int $quanity)
    {
        $sum = $price * $quanity;
        $before = $this->total_price;

        if($add){
            $after = $before + $sum;
        }
        else{
            $after = $before - $sum;
        }

        return $this->update(['total_price' => $after ]);

    }

    public static function Current()
    {
        return Cart::where('user_id', auth()->id())->first();
    }

}
