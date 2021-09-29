<?php

namespace App\Console\Commands;

use App\Events\BlogAddedEvent;
use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReportSendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reportsend'; # nasıl çağrılacağı

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Z Raporunu Gonderir'; # command'in ne işe yaradığını anlatan kısım.

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() # yapmak istediğimiz işlemler yazılır.
    {
        Log::info("Z Raporu Gönderildi");
        // asdfasfdasfd
        //asdfasdfasd
    }
}
