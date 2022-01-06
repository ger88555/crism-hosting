<?php

namespace App\Repositories;

use App\Repositories\Contracts\HostingRepository;
use Illuminate\Support\Facades\Storage;

class ApacheHostingRepository extends HostingRepository
{
    public function create()
    {
        $this->hosting->load('domain', 'customer');

        $this->createDirectory();

        $this->createHtaccess();

        $this->createIndex();
    }

    /**
     * Create the hosting directory structure.
     *
     * @return void
     */
    protected function createDirectory()
    {
        Storage::disk('hosting')->makeDirectory(
            $this->hosting->domain->name . '/public'
        );
    }

    /**
     * Create an .htaccess file inside the hosting directory.
     *
     * @return void
     */
    protected function createHtaccess()
    {
        Storage::disk('hosting')->put(
            $this->hosting->domain->name . '/.htaccess',
            view('apache.htaccess', ['domain' => $this->hosting->domain->name])->render()
        );
    }

    /**
     * Create an index.php file inside the hosting directory.
     *
     * @return void
     */
    protected function createIndex()
    {
        Storage::disk('hosting')->put(
            $this->hosting->domain->name . '/public/index.php',
            view('apache.customer-index')->render()
        );
    }

    public function destroy()
    {
        //
    }
}
