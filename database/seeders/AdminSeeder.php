<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("admins")->insert([
            "name"=>"Rıza Turancan YILMAZ",
            "email"=>"tyilmaz@okulbul.com",
            "password"=>bcrypt(123456),
        ]);
    }
}
