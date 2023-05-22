<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => "Alex",
            'email' => "alex@dekanat.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        foreach (["Ford", "Toyota", "Mercedes", "BWM", "Porsche", "Audi"] as $item) {
            Brand::create(['name' => $item]);
        }

        $brands = Brand::all();

        $brands->each(function ($brand) {
            $brand->cars()->saveMany(Car::factory(10)->make());
        });
    }
}
