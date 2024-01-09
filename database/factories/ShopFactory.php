<?php

namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'shop_name' => $this->faker->company,
            'shop_address' => $this->faker->address,
            'shop_region' => $this->faker->state,
            'shop_city' => $this->faker->city,
            'shop_district' => $this->faker->citySuffix,
            'shop_subdistrict' => $this->faker->streetName,
            'shop_uuid' => Str::uuid()->toString(),
        ];
    }
}
