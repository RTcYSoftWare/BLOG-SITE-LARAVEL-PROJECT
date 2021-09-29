<?php

namespace App\Console;

use App\Console\Commands\ReportSendMailCommand;
use App\Jobs\LogJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [ # burası da oluşturduğumuz command'i çalıştırıken nerede arayacağını yazıyoruz.
        ReportSendMailCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command("command:reportsend")->everyMinute(); // burada da diğer yöntem. oluşturduğumuz command dosyasını her dakika çalıştırmasını istedik.

        $schedule->job(new LogJob("tyilmaz@teklifbilisim.com"))->everyMinute();
//        // zaman ayarlı görev (task scheduling) birinci yöntemi. ÇALIŞMADIII ONURA SOR ? ÇALIŞTI php artisan schedule:run BU İLE FAKAT YİNEDE SOR. bu komutu yazmadığımız sürece çalıştırmıyor
//        $schedule->call(function (){  // call() metodu ile işlemi tanımlıyoruz.
//           \Log::info("Rapor Gönderildi");
//        })->everyMinute(); // her dakika veya farklı bir zamanda (ne zaman) çalışacağınız belirtiyoruz.
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

// Schedule oluşturmanın 2 farklı yolu var
// php artisan make:command ReportSendMailCommand bize task scheduling için command oluşturu bu command 'i burada çağırırsak otomatik oluşur.
// php artisan schedule:run komutu da schedule ları çalıştırır.
