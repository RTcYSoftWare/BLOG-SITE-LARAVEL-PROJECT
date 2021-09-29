<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Deneme extends Notification
{
    use Queueable;
    private $enrollmentData;
    private $databaseData;
    private $gonderimTuru;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($enrollmentData, $databaseData,$gonderimTuru)
    {
        $this->enrollmentData = $enrollmentData; # controller'dan yolladığımız name değerini almak için burayı düzenledik.
        $this->databaseData = $databaseData;
        $this->gonderimTuru = $gonderimTuru;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [$this->gonderimTuru]; # database yerinde mail yazıyordu. değiştirdik. notification ı database için kullanıcaz o yüzden değiştirdik. hnagi kanalı kullanacaksak ona göre ayar yaparız.
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) # mail gönderme metodu bunun içinde statik veri yerine dinamik veri göndermek dahamantıklı olacağından bu şekilde bir tanımlama yaptık.
    {
        return (new MailMessage)
                    ->line($this->enrollmentData["body"])
                    ->action($this->enrollmentData["enrollmentText"], $this->enrollmentData["url"])
                    ->line($this->enrollmentData["thankyou"]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "name" => $this->databaseData
        ];
    }
}

// php artisan make:notification Deneme notification sınıfını oluşturmamızı sağlar.
// bunları kullanmak için database yazmamız gerek
// php artisan notification:table ile notification migration'u oluşturduk.
