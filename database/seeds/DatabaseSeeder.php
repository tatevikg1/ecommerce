<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CategoriesTableSeeder::class);

        // factory(App\User::class, 1)->create();
        App\User::create([
            'name' => "User Useryan",  //$faker->name,
            'email' => "user@gmail.com",  //$faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        // factory(App\Product::class, 20)->create();
        // factory(App\Category::class, 5)->create();
        $now  = Carbon\Carbon::now()->toDateTimeString();

        App\Category::insert([
            ['name' => 'Laptops',   'slug' => 'laptops',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Desktops',  'slug' => 'desktops',   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mobile Phones',  'slug' => 'mobile-phones',     'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tablets',   'slug' => 'tablets',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TVs',       'slug' => 'tvs',        'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cameras',   'slug' => 'cameras',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Headphones','slug' => 'headphones', 'created_at' => $now, 'updated_at' => $now],
        ]);

    }

}
