<?php

namespace App\Repositories;

use App\Repositories\Contracts\FTPRepository;
use App\Services\SystemCommandService;

/**
 * VSFTPD FTP Repository
 */
class VSFTPRepository extends FTPRepository
{
    public function create()
    {
        $this->hosting->load('domain');

        if (false === $this->userExists()) {
            $this->createUser();

            $this->setPassword();
        }

        $this->allowUser();

        $this->restartDaemon();
    }

    /**
     * Wether the Unix user for this hosting exists.
     *
     * @return boolean
     */
    protected function userExists()
    {
        return intval( app(SystemCommandService::class)->run("id -u \"{$this->hosting->username}\" >/dev/null 2>&1;") ) > 0;
    }

    /**
     * Create a Unix user for this hosting.
     *
     * @return void
     */
    protected function createUser()
    {
        app(SystemCommandService::class)->run("adduser {$this->hosting->username}");
    }

    /**
     * Create a Unix user for this hosting.
     *
     * @return void
     */
    protected function setPassword()
    {
        app(SystemCommandService::class)->run("echo -e \"{$this->hosting->password}\\n{$this->hosting->password}\" | passwd {$this->hosting->username}");
    }

    /**
     * Allow the Unix user in VSFTPD.
     *
     * @return void
     */
    protected function allowUser()
    {
        app(SystemCommandService::class)->run("echo \"{$this->hosting->username}\" | sudo tee -a /etc/vsftpd.userlist");
    }

    /**
     * Restart the VSFTP daemon.
     *
     * @return void
     */
    protected function restartDaemon()
    {
        app(SystemCommandService::class)->run("systemctl restart vsftpd");
    }

    public function destroy()
    {
        //
    }
}
