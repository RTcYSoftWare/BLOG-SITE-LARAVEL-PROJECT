<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("settings")->insert([
            "title" => "RTcY SoftWare Blog Site",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
