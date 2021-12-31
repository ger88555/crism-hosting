<?php

namespace App\Repositories;

use App\Repositories\Contracts\DomainRepository;
use Illuminate\Support\Facades\Storage;

class ApacheDomainRepository extends DomainRepository
{
    const CONFIG_CLOSING_TAG = "</IfModule>";

    public function create()
    {
        $this->createVirtualHost();

        $this->includeVirtualHost();
    }

    /**
     * Create the domain's Virtual Host conf file.
     *
     * @return void
     */
    protected function createVirtualHost()
    {
        $vhost = $this->generateConfig('apache.vhost');

        Storage::disk('apache')->put("conf/{$this->domain->name}.conf", $vhost);
    }

    /**
     * Include the domain's Virtual Host conf in the Apache conf
     *
     * @return void
     */
    protected function includeVirtualHost()
    {
        $include = $this->generateConfig('apache.httpd');
        $config = Storage::disk('apache')->get(config('services.apache.conf.httpd'));

        $segments = explode(static::CONFIG_CLOSING_TAG, $config);

        $segments[0] .= PHP_EOL . $include . PHP_EOL;

        Storage::disk('apache')->append(config('services.apache.conf.httpd'), implode(static::CONFIG_CLOSING_TAG, $segments));
    }

    protected function generateConfig($stub) : string
    {
        return view($stub, ['domain' => $this->domain->name ])->render();
    }

    public function destroy()
    {
        //
    }
}
