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
        $keys = WireguardRepository()->genKeyPairs();
        return [
            'ip' => "10.0.0.".rand(30,200),
            'pubkey' => $keys['pubkey'],
            'privkey' => $keys['privkey']
        ];
    }
}


/**$faker->unique()-
 * $faker->ipv4();
 */
