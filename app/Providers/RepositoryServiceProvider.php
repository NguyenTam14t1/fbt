<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\TourInterface',
            'App\Repositories\Eloquents\EloquentTourRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\UserInterface',
            'App\Repositories\Eloquents\EloquentUserRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\BookingInterface',
            'App\Repositories\Eloquents\EloquentBookingRepository'
        );
           
        $this->app->bind(
            'App\Repositories\Contracts\CategoryInterface',
            'App\Repositories\Eloquents\EloquentCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\NewsInterface',
            'App\Repositories\Eloquents\EloquentNewsRepository'
        );
    }
}
