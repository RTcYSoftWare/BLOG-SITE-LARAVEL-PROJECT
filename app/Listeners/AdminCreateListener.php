<?php

namespace App\Listeners;

use App\Events\AdminCrudEvent;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;

class AdminCreateListener
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
//        dd("update den geldi");
//        $yeniAdmin = new Admin();
//        $yeniAdmin->name = $event->request->name;
//        $yeniAdmin->email = $event->request->mail;
//        $yeniAdmin->password = $event->request->password;
//        $yeniAdmin->syncRoles($event->request->role);
//        $yeniAdmin->save();
//        if($event->request->role == 3){
//            $role = Role::where("id", 3)->first();
//            $role->givePermissionTo(1);
//            $role->givePermissionTo(2);
//            $role->givePermissionTo(3);
//            $role->givePermissionTo(4);
//        }
    }
}
// event ile listener ilişkilendirilmediği sürece listenner çalışmaz.
// event serviceprovider içinde ilişkilendiriyoruz.
