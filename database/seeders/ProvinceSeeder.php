<?php

namespace Database\Seeders;

use App\Models\RoProvince;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::retry(3, 3000, throw: false)->withHeaders([
            'key' => 'a9da3c4359fafde97f03ee2be60147b2',
            'accept' => 'application/json'
        ])->get('https://pro.rajaongkir.com/api/province')->body();

        $res = json_decode($response);

        foreach($res->rajaongkir->results as $r) {
            if (RoProvince::find($r->province_id) == null){

                RoProvince::factory()->create([
                    'id' => $r->province_id,
                    'province' => $r->province
                ]);
            }
        }
    }
}
