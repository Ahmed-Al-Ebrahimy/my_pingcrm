<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Address;
use App\Models\Occupation;
use App\Models\Educationlevel;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->unique()->name,
            'birth_date'        => $this->faker->date,
            'gender'            => $this->faker->numberBetween(1, 2),
            'marital'           => $this->faker->numberBetween(1, 4),
            'smoking'           => $this->faker->numberBetween(1, 3),
            'fh_of_dm'          => $this->faker->numberBetween(1, 2),
            'address_id'        => Address::factory(),
            'occupation_id'     => Occupation::factory(),
            'educationlevel_id' => Educationlevel::factory(),
            'type_id'           => Type::factory(),
            'user_id'           => User::factory(),
        ];
    }
}
