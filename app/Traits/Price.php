<?php 

namespace App\Traits;
use NumberFormatter;

trait Price
{
    public function formatedPrice()
    {
        // if I format price of a product in cart, use product->price,
        // if I format  total amount of cart, use cart->total_price
        $amount = $this->price ? $this->price : $this->total_price;
        $fmt_price = new NumberFormatter('en', NumberFormatter::CURRENCY);
        
        return $fmt_price->formatCurrency($amount, "EUR");
    }

    public function originalPrice()
    {
        $originalPrice = ($this->price * 100) / (100 - $this->discount);

        $fmt_price = new NumberFormatter('en', NumberFormatter::CURRENCY);
        
        return $fmt_price->formatCurrency($originalPrice, "EUR");
    }
}
