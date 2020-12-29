<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_code' => Str::random(6),
            'product_name' => $this->faker->name,
            'producer' => $this->faker->company,
            'product_type' => Str::random(6),
            'size' => '30*30',
            'material' => 'ceramic',
            'color' => $this->faker->colorName,
            'surface' => 'min',
            'uses_for' => 'lat',
            'quantity_in_one_box' => $this->faker->randomDigit,
            'quantity' =>  $this->faker->numberBetween($min = 1, $max = 1000),
            // 'inventory' =>  $this->faker->numberBetween($min = 1, $max = 1000),
            'import_price' => $this->faker->numberBetween($min = 50000, $max = 10000000),
            'sale_price' => $this->faker->numberBetween($min = 50000, $max = 10000000),
            'count_view' => $this->faker->numberBetween($min = 50, $max = 100),
            'count_buy' => $this->faker->numberBetween($min = 10, $max = 250),
            'number_error' => 1,
            'status' => 'trading',
        ];
    }
}
