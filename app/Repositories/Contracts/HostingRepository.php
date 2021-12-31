<?php

namespace App\Repositories\Contracts;

use App\Models\Hosting;

abstract class HostingRepository implements RepositoryContract
{
    /**
     * The hosting data to act on
     *
     * @var Hosting
     */
    protected $hosting;

    public function __construct(Hosting $hosting = null)
    {
        if ($hosting) $this->setHosting($hosting);
    }

    public function setHosting(Hosting $hosting)
    {
        $this->hosting = $hosting;
    }
}
