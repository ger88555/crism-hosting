<?php

namespace App\Repositories\Contracts;

use App\Models\Domain;

abstract class DomainRepository implements RepositoryContract
{
    /**
     * The domain data to act on
     *
     * @var Domain
     */
    protected $domain;

    public function __construct(Domain $domain = null)
    {
        if ($domain) $this->setDomain($domain);
    }

    public function setDomain(Domain $domain)
    {
        $this->domain = $domain;
    }
}
