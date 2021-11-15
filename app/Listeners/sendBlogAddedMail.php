<?php

namespace App\Listeners;

use App\Events\BlogAddedEvent;
use App\Notifications\Deneme;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class sendBlogAddedMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BlogAddedEvent  $event
     * @return void
     */
    public function handle(BlogAddedEvent $event)
    {
        Notification::send($event->admin, new  Deneme($event->enrollmentData,"asdf",$event->gonderimTuru));
        //\Log::info("Burası Tetiklendi ve ".$event->admin->email." Adresine Mail Gönderildi.");
    }
}

// php artisan make:listener sendBlogAddedMail --event=BlogAddedEvent listener oluşturup event'a bağlamak.
