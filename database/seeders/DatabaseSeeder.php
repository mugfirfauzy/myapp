<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // CALL OWN SEEDER
        $this->call([
            // UserSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
            // ProvinceSeeder::class,
            // CitySeeder::class,
            DistrictSeeder::class,
            // AddressSeeder::class,

        ]);
    }
}
