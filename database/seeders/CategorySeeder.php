<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //0
        Category::factory()->create([
            'name' => 'Baju Keren',
            'description' => 'Baju Keren',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //1
        Category::factory()->create([
            'name' => 'Celana Panjang',
            'description' => 'Celana Panjang',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //2
        Category::factory()->create([
            'name' => 'Sepatu Kets',
            'description' => 'Tas Ransel',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //3
        Category::factory()->create([
            'name' => 'Sendal Pria',
            'description' => 'Tas Ransel',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //4
        Category::factory()->create([
            'name' => 'Tas Ransel',
            'description' => 'Tas Ransel',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //5
        Category::factory()->create([
            'name' => 'Tas Wanita',
            'description' => 'Tas Wanita',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //6
        Category::factory()->create([
            'name' => 'Jam Tangan',
            'description' => 'Tas Ransel',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        //7
        Category::factory()->create([
            'name' => 'Jaket Pria',
            'description' => 'Jaket Pria',
            'image' => fake()->imageUrl(),
            'active' => 'ACTIVE',
        ]);
        // Category::factory(4)->create();

    }
}
