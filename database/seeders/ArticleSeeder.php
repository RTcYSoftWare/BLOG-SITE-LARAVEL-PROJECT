<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 4; $i++){

            $title = $faker->sentence(6);

            for ($i=0;$i<1000;$i++){
                DB::table("articles")->insert([
                    "category_id" => rand(1,7),
                    "title" => $title,
                    "image" => $faker->imageUrl(640, 480, "tech", true),
                    "content" => $faker->paragraph(6),
                    "slug" => str_slug($title),
                    "created_at" => $faker->dateTime("now"),
                    "updated_at" => now()
                ]);
            }
        }
    }
}
