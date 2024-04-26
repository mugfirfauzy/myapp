<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'category_id' => 4,
            'name' => 'Aerotrax - Tas Ransel Backpack Pria',
            'description' => 'Aerotrax - Tas Ransel Backpack Pria',
            'price' => 800000,
            'stock' => 10,
        ]);
        Product::factory()->create([
            'category_id' => 3,
            'name' => 'Dejavu Sandal Pria Sandal Slop Pria Sendal Pria Kekinian Slop Pria sendal HSN146',
            'description' => 'Aerotrax - Tas Ransel Backpack Pria',
            'price' => 150000,
            'stock' => 25,
        ]);
        Product::factory()->create([
            'category_id' => 6,
            'name' => 'Jam Tangan Rolex Original BNIB',
            'description' => 'Jam Tangan Rolex Original BNIB Bergaransi 5 resmi tahun',
            'price' => 25000000,
            'stock' => 20,
        ]);
        Product::factory()->create([
            'category_id' => 4,
            'name' => 'Luminox Tas Ransel Kasual EFH - Tas Ransel Pria Tas Ransel Wanita Tas Ransel Unisex - Backpack Daypack Up To 14 Inch',
            'description' => 'Luminox Tas Ransel Kasual EFH - Tas Ransel Pria Tas Ransel Wanita Tas Ransel Unisex - Backpack Daypack Up To 14 Inch',
            'price' => 350000,
            'stock' => 25,
        ]);
        Product::factory()->create([
            'category_id' => 3,
            'name' => 'Sandal Jepit Pria S 60 NEW Original 100 persen Brand Lokal',
            'description' => 'Sandal Jepit Pria S 60 NEW Original 100 persent Brand Lokal',
            'price' => 100000,
            'stock' => 25,
        ]);
        Product::factory()->create([
            'category_id' => 3,
            'name' => 'Sendal Kickers Terbaru',
            'description' => 'Sendal Kickers Terbaru',
            'price' => 50000,
            'stock' => 10,
        ]);
        Product::factory()->create([
            'category_id' => 6,
            'name' => 'TAG HEUER AQUARACER PROFESSIONAL 300 DATE',
            'description' => 'TAG HEUER AQUARACER PROFESSIONAL 300 DATE',
            'price' => 62000000,
            'stock' => 10,
        ]);
        Product::factory()->create([
            'category_id' => 6,
            'name' => 'TAG HEUER CARRERA',
            'description' => 'TAG HEUER CARRERA',
            'price' => 65000000,
            'stock' => 10,
        ]);
        Product::factory()->create([
            'category_id' => 6,
            'name' => 'TAG HEUER CONNECTED CALIBRE E4',
            'description' => 'TAG HEUER CONNECTED CALIBRE E4',
            'price' => 27000000,
            'stock' => 10,
        ]);
        Product::factory()->create([
            'category_id' => 4,
            'name' => 'Tas Ransel Pria Tas Sekolah Anak SMA Tas Punggung Pria SMU Tas Ransel',
            'description' => 'Tas Ransel Pria Tas Sekolah Anak SMA Tas Punggung Pria SMU Tas Ransel',
            'price' => 75000,
            'stock' => 25,
        ]);
        // Product::factory(10)->create();
    }
}
