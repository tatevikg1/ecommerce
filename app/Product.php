<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Product extends Model
{
    protected $guarded = [];

    public function formatedPrice()
    {
        return money_format('$%i', $this->price / 100);
    }

    public static function randomFour()
    {
        return Product::inRandomOrder()->take(4);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
