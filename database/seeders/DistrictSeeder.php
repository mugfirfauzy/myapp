<?php

namespace Database\Seeders;

use App\Models\RoProvince;
use App\Models\RoCity;
use App\Models\RoDistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $province = RoProvince::get();
        foreach ($province as $p) {
            $response = Http::retry(3, 3000, throw: false)->withHeaders([
                'key' => 'a9da3c4359fafde97f03ee2be60147b2',
                'accept' => 'application/json'
            ])->get('https://pro.rajaongkir.com/api/city?province='.$p->id)->body();

            $city = json_decode($response);
            foreach($city->rajaongkir->results as $c) {
                $responses = Http::retry(10, 10000, throw: false)->withHeaders([
                    'key' => 'a9da3c4359fafde97f03ee2be60147b2',
                    'accept' => 'application/json'
                ])->get('https://pro.rajaongkir.com/api/subdistrict?city='.$c->city_id)->body();

                $subdistrict = json_decode($responses);
                foreach($subdistrict->rajaongkir->results as $sd) {
                    if (RoDistrict::find($sd->subdistrict_id) == null) {
                        RoDistrict::factory()->create([
                            'id' => $sd->subdistrict_id,
                            'district' => $sd->subdistrict_name,
                        ]);
                    }
                }
                sleep(3);
            }
            sleep(3);
        }
    }


}
