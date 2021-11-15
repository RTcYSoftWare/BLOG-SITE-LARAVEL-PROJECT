<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCrudController extends Controller
{
    public function index(){
        $roller = Role::with("permissions")->get();
        return view("back.rolecrud.role-index",compact("roller"));
    }

    public function editRole($id){
        $role = Role::with("permissions")->findOrFail($id);
        $permissions = Permission::all();
        return view("back.rolecrud.role-edit",compact("role","permissions"));
    }

    public function addPermissionToRole(Request $request){
        $role = Role::findById($request->role_id);
        $permission = Permission::findById($request->id);
        if($request->durum == "true"){
            $role->givePermissionTo($permission);
        }
        else if ($request->durum == "false"){
            $role->revokePermissionTo($permission);
        }
        toastr()->success("Role Güncellemesi Başarılı Bir Şekilde Gerçekleşti","İşlem Başarılı");
    }

}
