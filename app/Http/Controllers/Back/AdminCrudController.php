<?php

namespace App\Http\Controllers\Back;

use App\Events\AdminCrudEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminCrudController extends Controller
{
    public function Adminler()
    {
        $adminler = Admin::with("roles")->get();
        return view("back.adminscrud.Adminler", compact("adminler"));
    }

    public function YeniAdmin()
    {
        $roller = Role::all();
        return view("back.adminscrud.YeniAdmin", compact("roller"));
    }

    public function YeniAdminKaydet(Request $request)
    {
        $yeniAdmin = new Admin();
        $yeniAdmin->name = $request->name;
        $yeniAdmin->email = $request->mail;
        $yeniAdmin->password = $request->password;
        $yeniAdmin->syncRoles($request->role);
        $yeniAdmin->save();

        // event(new AdminCrudEvent($admin, $request));

        toastr()->success("Başarılı bir şekilde admin oluşturuldu", "Başarılı");
        return redirect()->route("admin.adminler.yeni-admin");
    }

    public function editAdmin($id){
        $admin = Admin::with("roles")->findOrFail($id);
        $roller = Role::all();
        return view("back.adminscrud.edit-admin",compact("admin","roller"));
    }

    public function updateAdmin(Request $request){

        $adminGuncelle = Admin::findOrFail($request->id);
        $adminGuncelle->name = $request->name;
        $adminGuncelle->email = $request->email;
        $adminGuncelle->syncRoles($request->role);
        $adminGuncelle->save();

        //event(new AdminCrudEvent($admin,$request));

        toastr()->success("Admin Başarılı Bir Şekilde Güncellendi","Başarılı!!!");
    }

    public function deleteAdmin($id){
        $deleteAdmin = Admin::firstOrFail($id);
        $deleteAdmin->deleteOrFail();
        toastr()->success("İstenilen Admin Kullanıcısı Başarılı Bir Şekilde Silindi", "Silme Başarılı!");
        return back();
    }

}
// ROLE İŞLEMLERİ
// view içindeki kontrolü bu  şekilde yapabiliyoruz. super admin'se buraları görebilir değilse göremez. fakat rote vaya controller engeli yapmaz.
// sadece vize üzerinde kıstılama yapar.  role("SuperAdmin | Admin") yaparsak diper admin kullanıcısı da görebilir.
//                                    @role("SuperAdmin | Admin")
//                                    <a href="{{route("admin.makaleler.edit",$item->id)}}" title="Düzenle" class="btn btn-sm btn-primary">
//                                        <i class="fa fa-pen"></i>
//                                    </a>
//                                    @endrole
// route için Spatie'nin otomatik oluşturduğu middleware'i kernel içinde tanımlıyoruz.
// arından route'umuza ->middleware("role:SuperAdmin") şeklinde ekliyerek  route üzerinden de kısıtlama yapıyoruz.

