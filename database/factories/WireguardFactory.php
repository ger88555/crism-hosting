<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Repositories\WireguardRepository;

class WireguardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $keys = WireguardRepository()->genKeyPair();
        return [
            'ip' => "10.0.0.1".$this->faker->randomNumber(2, true),
            'pubkey' => $keys['pubkey'],
            'privkey' => $keys['privkey']
        ];
    }
}


/**$faker->unique()-
 * $faker->ipv4();
 */
