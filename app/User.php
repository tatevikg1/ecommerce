<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Cart;
use App\CartItem;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // creates a cart for registered user
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($user) {
            $user->cart()->create([
                'user_id' => $user->id,
            ]);
        });
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

}
