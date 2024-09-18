<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Src\Customer\Domain\CustomerRepositoryInterface;
use Src\Customer\Infrastructure\Repositories\CustomerRepository;
use Src\Order\Domain\OrderRepositoryInterface;
use Src\Order\Infrastructure\Repositories\OrderRepository;
use Src\Product\Domain\ProductRepository;
use Src\Product\Infrastructure\Repositories\EloquentProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
