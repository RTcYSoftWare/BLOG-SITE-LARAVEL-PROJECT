<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlogAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, $enrollmentData, $gonderimTuru)
    {
        $this->admin = $admin;
        $this->enrollmentData = $enrollmentData;
        $this->gonderimTuru = $gonderimTuru;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

// php artisan make:event BlogAddedEvent event oluşturma.
// php artisan make:listenner sendBlogAddedMail --event=BlogAddedEvent listener oluşturup evetn'ımıza bağladık.
// event ile listener ilişkilendirimesi gerekiyor.
// bu ilişkilendirmeyi de Providers klasörü içinde EventServiceProvider içinde yapıyoruz.
//         BlogAddedEvent::class => [
//            sendBlogAddedMail::class,
//        ],
// şeklinde ekleme yapılır.
