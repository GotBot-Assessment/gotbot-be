<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Meal::class;

    public function definition(): array {
        return [
            'name'        => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price'       => $this->faker->randomNumber(3),
            'category'    => $this->faker->word,
            'area'        => $this->faker->word,
        ];
    }
}
