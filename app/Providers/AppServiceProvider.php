<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('admin.layout', function ($view) {
            $pendingBookingCount = \App\Models\Booking::where('status', 'pending')->count();
            $view->with('pendingBookingCount', $pendingBookingCount);
        });
    }
}
