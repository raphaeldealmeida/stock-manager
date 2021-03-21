<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->realText($this->faker->numberBetween(10,10)),
            'code' => $this->faker->bothify('####????'),
            'price' => $this->faker->randomFloat(2, 1.00, 1000.00),
            'current_quantity' => $this->faker->numberBetween(0, 100)
        ];
    }
}
