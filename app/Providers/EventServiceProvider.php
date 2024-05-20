<?php

namespace App\Providers;

use App\Events\BookingCanceled;
use App\Events\BookingCreated;
use App\Listeners\BookingCanceledMail;
use App\Listeners\BookingCreatedMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BookingCreated::class => [
            BookingCreatedMail::class,
        ],
        BookingCanceled::class => [
            BookingCanceledMail::class,
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
}
