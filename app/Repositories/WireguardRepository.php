<?php

namespace App\Repositories;

use App\Repositories\Contracts\WireguardContract;
use App\Services\SystemCommandService;

class WireguardRepository extends WireguardContract{

    function generateKeyPairs(){
        $private_key = app(SystemCommandService::class)->run("wg genkey");
        $public_key = app(SystemCommandService::class)->run("wg genkey ${$privkey}");
        return [
            $privkey => $private_key,
            $pubkey => $public_key
        ];
    }
    
    function generate_qr($text): string{
        return "data:image/png;base64,".
            app(SystemCommandService::class)->run("qrencode ${$text} -o - | base64");
    }
    
    function generateConfig($privatekey): string {
        return view('tunnel', [$privkey => $privatekey, $ip => $this->wireguard->ip])->render();
    }

    function registerPeer(){
        app(SystemCommandService::class)->run("wg set wg0 peer ${$this->wireguard->pubkey} allowed-ips ${$this->wireguard->ip}");
    }

}
