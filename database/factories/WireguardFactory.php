<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Repositories\WireguardRepository;
use App\Models\Wireguard;
use App\Services\SystemCommandService;

class WireguardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /* $wg = Wireguard(); */
        /* $keys = WireguardRepository($wg)->generateKeyPairs(); */
        
        $private_key = app(SystemCommandService::class)->run("wg genkey");
        $public_key = app(SystemCommandService::class)->run("wg genkey ${$private_key}");
        return [
            'ip' => "10.0.0.".rand(30,200),
            'pubkey' => $private_key,
            'privkey' => $public_key
        ];
    }
}


/**$faker->unique()-
 * $faker->ipv4();
 */
