<?php

namespace App\Providers;

use App\Repositories\VSFTPRepository;
use App\Repositories\ApacheDomainRepository;
use App\Repositories\ApacheHostingRepository;
use App\Repositories\Contracts\DomainRepository;
use App\Repositories\Contracts\HostingRepository;
use App\Repositories\Contracts\FTPRepository;
use App\Repositories\Contracts\MailAccountRepository;
use App\Repositories\PostfixMailAccountRepository;
use App\Services\SystemCommandService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        DomainRepository::class     => ApacheDomainRepository::class,
        HostingRepository::class    => ApacheHostingRepository::class,
        FTPRepository::class        => VSFTPRepository::class,
        MailAccountRepository::class  => PostfixMailAccountRepository::class,
    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        SystemCommandService::class => SystemCommandService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
