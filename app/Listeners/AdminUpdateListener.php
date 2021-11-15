<?php

namespace App\Listeners;

use App\Events\AdminCrudEvent;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminUpdateListener
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
     * @param  AdminCrudEvent  $event
     * @return void
     */
    public function handle(AdminCrudEvent $event)
    {
//        dd($event->request);
//        die();
//        $adminGuncelle = Admin::findOrFail($event->request->id);
//        $adminGuncelle->name = $event->request->name;
//        $adminGuncelle->email = $event->request->email;
//        $adminGuncelle->syncRoles($event->request->role);
//        $adminGuncelle->save();

    }
}
// listener larda db işlemleri yapmak pek mantıklı değil. onun yerine service işelemleri veya mail yollama işlemi gibi işlemler yapılmalı.
