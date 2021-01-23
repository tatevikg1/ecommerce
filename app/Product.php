<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Price;

class Product extends Model
{
    use Price;

    protected $guarded = [];

    public static function randomFour()
    {
        return Product::inRandomOrder()->take(4);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function productImage()
    {
        $imagePath = ($this->image) ? $this->image : 'uploads/no-image-available.png';

        return '/storage/' . $imagePath;
    }
    
}
