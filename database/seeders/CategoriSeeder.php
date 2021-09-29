<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoriler = ["Genel","Eğlence","Bilişim","Gezi","Teknoloji","Sağlık","Spor","Günlük Yaşam"];

        foreach ($kategoriler as $item) {
            DB::table("categories")->insert([
                "name"=>$item,
                "slug"=>str_slug($item),
                "created_at"=>now(),
                "updated_at"=>now()
            ]);
        }
    }
}

// veri tabanına verileri yazmak için kullandığımız seed.
// çalıştırma php artisan db:seed.
// DatabaseSeeder dosyasında çağırdık öncelikle.
