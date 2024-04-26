<?php

namespace Database\Seeders;

use App\Models\RoCity;
use App\Models\RoProvince;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $province = RoProvince::get();

        foreach($province as $p) {

            $response = Http::retry(5, 3000, throw: false)->withHeaders([
                'key' => 'a9da3c4359fafde97f03ee2be60147b2',
                'accept' => 'application/json'
            ])->get('https://pro.rajaongkir.com/api/city?province='.$p->id)->body();

            $res = json_decode($response);

            foreach($res->rajaongkir->results as $c) {

                if (RoCity::find($c->city_id) == null) {

                    RoCity::factory()->create([
                        'id' => $c->city_id,
                        'city' => $c->city_name,
                        'type' => $c->type,
                        'postal_code' => $c->postal_code
                    ]);

                }

            }

        }

    }
}
