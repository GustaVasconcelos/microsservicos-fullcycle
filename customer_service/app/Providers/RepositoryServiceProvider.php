<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Interfaces\CustomerInterface;
use App\Repositories\CustomerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
    }

    public function boot()
    {}
}
