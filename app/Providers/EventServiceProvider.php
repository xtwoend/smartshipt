<?php

namespace App\Providers;

use App\Events\EngineUpdated;
use Illuminate\Support\Facades\Event;
use App\Events\DieselGeneratorUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\OilUploadProcessed::class => [
            \App\Listeners\OilUploadProcessedListener::class,
        ],
        EngineUpdated::class => [
            \App\Listeners\EngineUpdatedListener::class 
        ],
        DieselGeneratorUpdated::class => [
            \App\Listeners\DGListener::class 
        ]
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

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
