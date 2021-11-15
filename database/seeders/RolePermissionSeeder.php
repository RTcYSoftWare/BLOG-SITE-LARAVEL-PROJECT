<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(["name" => "Admin"]); // role oluşturduk
        Role::create(["name" => "SupperAdmin"]); // roll oluşturduk
        Role::create(["name" => "Editor"]);
        Permission::create(["name" => "view articles"]);
        Permission::create(["name" => "edit articles"]);
        Permission::create(["name" => "create articles"]);
        Permission::create(["name" => "delete articles"]);
        //
    }
}
// role ve permission oluşturmak için kullanıyoruz.
// Spatie kütüphanesi sayesinde oluşturudğumuz vt. modllerine seed ile veri ekliyoruz.
// Spatie kütüphanesi kullanımı => https://www.youtube.com/watch?v=TeK5hQYPIgw&ab_channel=Yaz%C4%B1l%C4%B1mE%C4%9Fitim, https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage
