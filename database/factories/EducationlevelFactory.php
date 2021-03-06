<?php

namespace Database\Factories;

use App\Models\Educationlevel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationlevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Educationlevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'user_id' => User::factory(),
        ];
    }
}
