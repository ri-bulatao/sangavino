<?php

namespace App\Providers;

use App\Models\Blotter;
use App\Models\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
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
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            if (Auth::user()) {

                $view->with('pending_blotters', Blotter::where('is_solved', false)->count());
                $view->with('pending_requests', Request::where('status', Request::PENDING)->count());
                $view->with('new_requests', Activity::where('subject_type', 'App\Models\Request')
                ->where('causer_id', '!=', 1)
                ->latest()
                ->take(5)
                ->get());
            } 
        });
    }
}
