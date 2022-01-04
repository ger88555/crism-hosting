<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HostingFactory extends Factory
{
    const GB = 1000;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username'      => $this->faker->word . $this->faker->numerify('####'),
            'password'      => $this->faker->numerify('########'),
            'space'         => rand(1, 10) * self::GB
        ];
    }
}