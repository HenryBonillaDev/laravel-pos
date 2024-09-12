<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Customer\Domain\CustomerRepository;
use Src\Customer\Infrastructure\Repositories\EloquentCustomerRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, EloquentCustomerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
