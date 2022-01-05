<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
   
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'username'      => $this->faker->word . $this->faker->numerify('####') ,
            'password'      => $this->faker->numerify('########')
        ];
    }
}
