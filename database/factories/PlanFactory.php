<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
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
            'name'          => $this->faker->bs,
            'description'   => $this->faker->randomHtml,
            'email'         => rand(0, 1),
            'vpn'           => rand(0, 1),
            'domain'        => rand(0, 1),
            'hosting'       => rand(0, 1),
            'hosting_space' => rand(1, 10) * self::GB
        ];
    }
}
