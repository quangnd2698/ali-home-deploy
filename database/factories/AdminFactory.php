<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'password' => bcrypt(Str::random(10)),
            'phone' => rand(1000000000, 99999999999),
            'address' => $this->faker->address,
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'permission' => 2,
            'deleted_at' => null,
            'basic_salary' => $this->faker->numberBetween($min = 4000000, $max = 10000000),
        ];
    }
}
