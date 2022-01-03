<?php

namespace App\Repositories;

use App\Repositories\Contracts\DomainRepository;
use App\Services\SystemCommandService;
use Illuminate\Support\Facades\Storage;

class ApacheDomainRepository extends DomainRepository
{
    const CONFIG_CLOSING_TAG = "</IfModule>";

    public function create()
    {
        $this->createSite();

        // $this->includeVirtualHost();

        $this->enableSite();

        $this->reloadApache();
    }

    /**
     * Create the domain's Virtual Host conf file.
     *
     * @return void
     */
    protected function createSite()
    {
        $vhost = $this->generateConfig('apache.vhost');

        Storage::disk('apache')->put("{$this->domain->name}.conf", $vhost);
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

    /**
     * Tell Apache to enable the site's configuration.
     *
     * @return void
     */
    protected function enableSite()
    {
        app(SystemCommandService::class)->run("a2ensite {$this->domain->name}");
    }

    /**
     * Reload the Apache sites configuration without restarting Apache.
     *
     * @return void
     */
    protected function reloadApache()
    {
        app(SystemCommandService::class)->run("apachectl -k graceful");
    }

    public function destroy()
    {
        //
    }
}
