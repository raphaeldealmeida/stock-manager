<?php

namespace Database\Factories;

use App\Models\Historic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Historic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(0, 5000),
            "quantity_at" => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
