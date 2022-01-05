<?php

namespace App\Repositories;

use App\Repositories\Contracts\FTPRepository;
use App\Services\SystemCommandService;
use Illuminate\Support\Facades\Storage;

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

            $this->createHome();
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
        app(SystemCommandService::class)->run( "useradd {$this->hosting->username} -p `openssl passwd -6 {$this->hosting->password}`");
    }

    /**
     * Create the home directory for this hosting's Unix user.
     *
     * @return void
     */
    protected function createHome()
    {
        $mounted = "/var/ftp/{$this->hosting->domain->name}";
        app(SystemCommandService::class)->run("mkdir $mounted");

        $site = Storage::disk('hosting')->path($this->hosting->domain->name);
        app(SystemCommandService::class)->run("mount --bind $site $mounted/");

        app(SystemCommandService::class)->run("usermod -d $mounted {$this->hosting->username}");
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
