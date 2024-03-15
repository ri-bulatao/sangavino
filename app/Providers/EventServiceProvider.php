<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $observers = [
        \App\Models\Announcement::class => [
            \App\Observers\AnnouncementObserver::class
        ],
        \App\Models\Blotter::class => [
            \App\Observers\BlotterObserver::class
        ],
        \App\Models\Category::class => [
            \App\Observers\CategoryObserver::class
        ],
        \App\Models\Official::class => [
            \App\Observers\OfficialObserver::class
        ],
        \App\Models\Position::class => [
            \App\Observers\PositionObserver::class
        ],
        \App\Models\Product::class => [
            \App\Observers\ProductObserver::class
        ],
        \App\Models\Purok::class => [
            \App\Observers\PurokObserver::class
        ],
        \App\Models\Resident::class => [
            \App\Observers\ResidentObserver::class
        ],
        \App\Models\Service::class => [
            \App\Observers\ServiceObserver::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}