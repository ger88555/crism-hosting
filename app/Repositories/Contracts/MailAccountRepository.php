<?php

namespace App\Repositories\Contracts;

use App\Models\Email;

abstract class MailAccountRepository implements RepositoryContract
{
    protected $email;
    public function __construct(Email $email)
    {
        if($email) $this->setEmail($email);
    }

    public function setEmail(Email $email)
    {
        $this->email = $email;
    }
}
