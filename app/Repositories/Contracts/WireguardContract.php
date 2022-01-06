<?php

namespace App\Repositories\Contracts;

use App\Models\Wireguard;

abstract class WireguardContract implements RepositoryContract
{
    /**
     * The hosting data to act on
     *
     * @var Wireguard
     */
    protected $wireguard;

    public function __construct(Wireguard $wireguard = null)
    {
        if ($wireguard) $this->setWireguard($wireguard);
    }

    public function setWireguard(Wireguard $wireguard)
    {
        $this->wireguard = $wireguard;
    }
}