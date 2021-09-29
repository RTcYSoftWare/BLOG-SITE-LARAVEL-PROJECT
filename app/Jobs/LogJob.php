<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    //public $tries = 1; // hata alınırsa kaç kez denensin diye tanımlanan değişken.

    public function __construct($email)
    {
        $this->email = $email; # email aldık.
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($this->email); // emaile log atıcak.
    }
}
// env. dosyasındaki alanı konfigüre etmezsek direkt log klasörüne logları atar.
// env. dosyasında "QUEUE_CONNECTION=sync" alanını sync yerine database yazdık. # farklı bir yöntem kullanıyorsak onu yazmalıyız.
// handle loga e mail basar.
// php artisan queue:work --queue=emails belli bir kuyruğu çalıştırmak.
// veritabanındaki jobs' tablosuna işlemler eklenir, queue çalıştırıldığında veritabanı tablosu boşaltılır.
