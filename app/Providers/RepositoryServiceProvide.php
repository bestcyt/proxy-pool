<?php

namespace App\Providers;

use App\Repositories\Interfaces\ProxySpiderAbleIpRepositoryInterface;
use App\Repositories\Interfaces\ProxySpiderIpRepositoryInterface;
use App\Repositories\Interfaces\ProxyUrlRepositoryInterface;
use App\Repositories\ProxySpiderAbleIpRepository;
use App\Repositories\ProxySpiderIpRepository;
use App\Repositories\ProxyUrlRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvide extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProxyUrlRepositoryInterface::class, ProxyUrlRepository::class);
        $this->app->bind(ProxySpiderIpRepositoryInterface::class, ProxySpiderIpRepository::class);
        $this->app->bind(ProxySpiderAbleIpRepositoryInterface::class, ProxySpiderAbleIpRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
