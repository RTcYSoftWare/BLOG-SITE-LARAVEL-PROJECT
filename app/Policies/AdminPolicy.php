<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin) // kontrol için admin yolladık.
    {
        //
        // return $admin->email === "deneme@okulbul.com"; // eğer gelen admin'in maili bu maile eşitse true döner.
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Admin $admin_gelen) // ilk değişken genenl admin kullanıcı kontrolü için fakat ikinci değişken tam olarak ne için bilmiyorum. Onur'a sor ?
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Admin $admin_gelen)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Admin $admin_gelen) // delete kısmını route' dan middlleware kullanarak kapatık.
    {
        //
        return $admin->email === "deneme@okulbul.com";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Admin $admin_gelen)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Admin $admin_gelen) // ilk admin değişkenini sabit alıyor. Onura sor ?
    {
        //
    }
}

// return $admin->email === "deneme@okulbul.com"; şeklinde koşullar sağlayıp bize (true-false) geri döndürme yapar.
// oluşturduğumuz bu policy'i farklı yerlerde kullanıyoruz.
// birincisi controller içerisinde # $this->authorize("viewAny",Admin::class) şeklinde kullanılır.
// ikincisi route içerisinde # ->middleware("can:viewAny,admin") şeklinde kullanılır.
// üçüncüsü index.blade içersinde # @can("viewAny")  @endcan()
