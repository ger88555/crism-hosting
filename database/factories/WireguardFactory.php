<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WireguardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => $this->faker->ipv4()->startingValue('10.0.0.30')
        ];
    }
}


/**$faker->unique()-
 * $faker->ipv4();
 */
