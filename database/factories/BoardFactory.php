<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BoardFactory extends Factory
{
    
    protected $model = Board::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name' => $this->faker->unique()->word(),
                'description' => $this->faker->unique()->word(),
                'madeby_id' => $this->faker->numberBetween(2, 15),
        ];
    }
}
