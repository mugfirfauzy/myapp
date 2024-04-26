<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'province_id' => $this->faker->numberBetween(1,34),
            'city_id' => 23,
            'district_id' => 3301,
            'postal_code' => $this->faker->numerify('#####'),
            'user_id' => $this->faker->numberBetween(1,5),
            'is_default' => false,
        ];
    }
}
