<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ["Hakkımızda","Kariyer","Vizyon","Misyon"];

        $count = 0;

        foreach ($pages as $item) {
            $count++;
            DB::table("pages")->insert([
                "title"=>$item,
                "image"=>"https://www.businessenglishpod.com/wordpress/wp-content/uploads/Business-English-Pod-Learn-Business-English-1200x780.jpg",
                "content"=>"lorem impsum dolor sit amet",
                "slug"=>str_slug($item),
                "order"=>$count,
                "created_at"=>now(),
                "updated_at"=>now()
            ]);
        }
    }
}
