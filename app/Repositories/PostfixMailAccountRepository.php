<?php

namespace App\Repositories;

use App\Repositories\Contracts\MailAccountRepository;
use Illuminate\Support\Facades\Storage;
use App\Services\SystemCommandService;

class PostfixMailAccountRepository extends MailAccountRepository
{
    public function create(){
        $this->email->load('customer');

        app(SystemCommandService::class)->run("echo useradd {$this->email->customer->username} -m -p $(openssl passwd -6 {$this->email->password}) -g mail");

    }

    public function destroy()
    {
        //
    }

}

/**
 * useradd juanito -m -p $(openssl passwd -6 contraseña) -g mail
 */