<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // public function formatPrice()
    // {
    //     return money_format('$%i', $this->price);
    // }
}
