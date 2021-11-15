<?php

namespace App\Providers;

use App\Events\AdminCrudEvent;
use App\Events\BlogAddedEvent;
use App\Listeners\AdminCreateListener;
use App\Listeners\AdminUpdateListener;
use App\Listeners\sendBlogAddedMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use function Illuminate\Events\queueable;

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
        BlogAddedEvent::class => [
            sendBlogAddedMail::class,
        ],
        AdminCrudEvent::class => [
            AdminCreateListener::class,
            AdminUpdateListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

    }
}
