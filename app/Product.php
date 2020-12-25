<?php

namespace App;
use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function formatedPrice()
    {
        $fmt_price = new NumberFormatter();
        $fmt_price->formatCurrency($this->price, "EUR");
        return $fmt_price;
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
