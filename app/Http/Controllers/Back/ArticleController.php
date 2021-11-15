<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use File;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize("viewAny", Admin::class); // bizim oluşturduğumuz Policy'e gider kontrolü yapar. Eğer true ise devam eder. Değilse 403 sayfasına yönelendirir.


        // CACHE İŞLEMLERİ
        // ****
        // cache'den veri çekme şu anki kullandığımız file ile cache. Database madcache ve redis gibi bir çok farklı cache metodu var. kodda kullanımları arasında pek bir fark yok hepsi aynı şekilde kullanılıyor.
        // cache'in driver'ını da env. dosyasından değiştiriyoruz.
        // farklı driver'lar kullanırsak gerkli ayarlamaları cache.php dosyasından da aypmamız gerekiyor.
        // databse kullanılırsa php artisan cache:table yaparak vt. tablosu için migration oluşturulur.
        // ardından php artisan migrate ile tablo oluşturulur. Bu tabloya bütün veri tek satıra basar ve gider o satırdan okur. çok sağlıklı bir işlem değil.
//        if(Cache::has("articles")){
//            $articles = Cache::get("articles");
//            return view("back.articles.index", compact("articles"));
//        }
        // Cache::put("articles", $articles, now()->addMinutes(10)); // cache 'e veri koyma
        // MemCached kısmı; env. dosyasında cache bölümüne memcached yazıyoruz.
        // composer require ext-memcached
        // ****


        // $articles = Article::with("category")->orderBy("created_at", "ASC")->get();

        $articles = Article::with("category")->orderBy("created_at", "ASC")->get();
        return view("back.articles.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("back.articles.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $articleRequest = new ArticleRequest();
//        $articleRequest->rules();

        $request->validate([
            "title" => "min:3",
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048"
        ]);

        $category = new Category();
        $category->articleAdd()->create($request->get());

//        $article = new Article();
//        $article->title = $request->title;
//        $article->category_id = $request->category;
//        $article->content = $request->content;
//        $article->slug = str_slug($request->title);
//        if ($request->hasFile("image")) { # resmin gelip gelmediğini kontrol ettik.
//            $imageName = str_slug($request->title) . "." . $request->image->getClientOriginalExtension(); # resmin uzantısını aldık.
//            $request->image->move(public_path("uploads"), $imageName); # uploads klasörüne isimle kaydettik resmimizi.
//            $article->image = "uploads/" . $imageName;
//        }
//
//        $article->save();
        toastr()->success("Başarılı", "Makale başarıyla oluşturuldu");
        return redirect()->route("admin.makaleler.index");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id); # bizi var yok if kontrolünden kurtarır. yoksa 404 e yönlendirir.

        return view("back.articles.update", compact("categories", "article"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "min:3",
            "image" => "image|mimes:jpeg,png,jpg|max:2048"

        ]);

        $update_article = Article::findOrFail($id);
        $update_article->title = $request->title;
        $update_article->category_id = $request->category;
        $update_article->content = $request->content;
        $update_article->slug = str_slug($request->title);


        if ($request->hasFile("image")) {
            $image_name = str_slug($request->title) . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path("uploads"), $image_name);
            $update_article->image = "uploads/" . $image_name;
        }
        $update_article->save();
        toastr()->success("Başarılı", "Makale başarıyla güncellendi");
        return redirect()->route("admin.makaleler.index");
    }

    public function switch(Request $request)
    {

        $artcile = Article::findOrFail($request->id);
        $artcile->status = $request->statu == "true" ? 1 : 0; # php yeni versiyon if else kontrolünün kısaltılmış hali
        $artcile->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
//        $this->authorize("delete",Admin::class);
        Article::findOrFail($id)->delete();
        toastr()->success("Makale Silinen Makalelere Taşındı");
        return redirect()->route("admin.makaleler.index");
    }

    public function destroy($id) # resource controller in otomatik oluşturduğu silme metodu. kullanmak için her silme butonuna bir form eklemek gerekir. o da bizi yorar.
    {
        return $id;
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy("deleted_at", "desc")->get(); # silinen verileri aldı.
        return view("back.articles.trashed", compact("articles"));
    }

    public function recover($id)
    {
        Article::onlyTrashed()->findOrFail($id)->restore(); # ilgili verinin silinmekten kurtarılması
        toastr()->success("Makale Geri Alındı");
        return redirect()->route("admin.trashed.article");
    }

    public function hardDelete($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        if (File::exists($article->image)) { # resimi direct kökten sildik. eğer makaleden kurtuluyorsak resme de gerek yok.
            File::delete(public_path($article->image));
        }
        die;
        $article->forceDelete(); # ilglili veriyi gerçekten sildik (yok ettik)
        toastr()->success("Makale Başarıyla Silindi");
        return redirect()->route("admin.trashed.index");
    }


}

# soft delete ekledik vt. tablosuna
# php artisan make:controller Back\ArticleController --resource demeke bu hazır yapıyı bize getirdi.
# destroy metodu oto geldi ve o metodun çalışması için bizim html sayfasında silme butonu ve form tanımlamamız gerekir. çok da kullanışlı değil
