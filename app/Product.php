<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FormatedPrice;

class Product extends Model
{
    use FormatedPrice;

    protected $guarded = [];

    public static function randomFour()
    {
        return Product::inRandomOrder()->take(4);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
