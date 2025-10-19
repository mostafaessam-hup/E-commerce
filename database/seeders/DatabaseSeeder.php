<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'الكترونيات', 'image_path' => 'asset'],
            ['id' => 2, 'name' => 'ماكولات', 'image_path' => 'asset'],
            ['id' => 3, 'name' => 'ساعاات', 'image_path' => 'asset'],
            ['id' => 4, 'name' => 'نضارات', 'image_path' => 'asset'],
            ['id' => 5, 'name' => 'شنط', 'image_path' => 'asset'],
        ];
        DB::table('categories')->insertOrIgnore($categories);

        for ($i = 1; $i <= 25; $i++) {
            Product::create([
                'name' => 'product' . $i,
                'quantity' => rand(1, 50),
                'price' => rand(10, 100),
                'category_id' => rand(1, 5),
                'image_path' =>'images/'. Str::random(5).'.jpg',
            ]);
        }



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
