<?php

namespace App;
use NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function formatedPrice()
    {
        $fmt_price = new NumberFormatter('en', NumberFormatter::CURRENCY);
        
        return $fmt_price->formatCurrency($this->price, "EUR");
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
