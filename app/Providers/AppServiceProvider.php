<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Services\AdminServiceInterface::class,
            \App\Services\AdminService::class,
        );

        $this->app->singleton(
            \App\Services\UserServiceInterface::class,
            \App\Services\UserService::class,
        );

        $this->app->singleton(
            \App\Services\ProductServiceInterface::class,
            \App\Services\ProductService::class,
        );

        $this->app->singleton(
            \App\Services\InvoiceServiceInterface::class,
            \App\Services\InvoiceService::class,
        );

        $this->app->singleton(
            \App\Services\ImportInvoiceServiceInterface::class,
            \App\Services\ImportInvoiceService::class,
        );

        $this->app->singleton(
            \App\Services\OrderServiceInterface::class,
            \App\Services\OrderService::class,
        );

        $this->app->singleton(
            \App\Services\ClientPageServiceInterface::class,
            \App\Services\ClientPageService::class,
        );

        $this->app->singleton(
            \App\Services\AjaxServiceInterface::class,
            \App\Services\AjaxService::class,
        );

        $this->app->singleton(
            \App\Services\HomeServiceInterface::class,
            \App\Services\HomeService::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
