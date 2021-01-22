<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * with admin user (id=1)
     * @return void
     */
    public function run()
    {

        $now  = Carbon\Carbon::now()->toDateTimeString();

        $user = App\User::create([
            'name' => "Admin",  //$faker->name,
            'email' => "admin@gmail.com",  //$faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        App\Cart::create([
            'user_id' => $user->id,
        ]);

        App\Category::insert([
            ['name' => 'Laptops',   'slug' => 'laptops',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Desktops',  'slug' => 'desktops',   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tablets',   'slug' => 'tablets',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TVs',       'slug' => 'tvs',        'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cameras',   'slug' => 'cameras',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Headphones','slug' => 'headphones', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

}
