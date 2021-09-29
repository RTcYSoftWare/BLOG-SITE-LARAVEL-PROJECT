<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id"); // ilişkisel tablolarda ilişki kurulacak tablonun tipi unsigned girilmeli (laravel istiyor);
            $table->string("title");
            $table->string("image");
            $table->longText("content");
            $table->integer("hit")->default(0);
            $table->integer("status")->default(0)->comment("0: pasif, 1: aktif");
            $table->string("slug");
            $table->softDeletes(); # geçici silme
            $table->timestamps();

            $table->foreign("category_id") // ilişki kuracak stün adı
                ->references("id") // ilişki kurulacak stün adı
                ->on("categories"); // ilişki kurulacak tablo.

            // şart değil fakat kullanmak iyi olur

        });
    }

    // onra sor == birden fazla satırı hangi kısayol ile seçebiliriz.

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

# php artisan migrate:fresh --seed bu tablolarda değişiklik yaptığımızda yeniden düzenlememizi sağlıyor.
