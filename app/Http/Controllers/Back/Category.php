<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use App\Models\Article as ArcicleModel;

class Category extends Controller
{
    // KATEGORİLER SAYFASINI LİSTELEME
    public function index()
    {
        $categories = CategoryModel::all(); # bütün verileri çeker.
        return view("back.categories.index", compact("categories"));
    }



    // KATEGORİ STATÜSÜNÜ GÜNCELLEYEN METOD
    public function statusChanged(Request $request)
    {
        $category = CategoryModel::findOrFail($request->id);
        $category->status = $request->statu == "true" ? 1 : 0; # if ayarı statu true ise 1 değilse sıfır
        $category->save();
    }



    // KATEGORİ OLUŞTURAN METOD
    public function categoryCreate(Request $request)
    {
        $isExists = CategoryModel::whereSlug(str_slug($request->category))->first(); # aynı isimde kategori var mı

        if ($isExists) {
            toastr()->error($request->category . " Adında Bir Kategori Zaten Mevcut!");
            return redirect()->back();
        }

        $add_category = new CategoryModel();
        $add_category->name = $request->category;
        $add_category->slug = str_slug($request->category);
        $add_category->save();
        toastr()->success("Başarılı", "Kategori Başarılı Bir Şekilde Eklendi");
        return redirect()->back();
    }



    // KATEGORİ GÜNCELLEMEDE MODEL İÇİN JSON VERİ DÖNDÜREN METOD
    public function categoryGetData(Request $request)
    {
        $category = CategoryModel::findOrFail($request->id);
        return response()->json($category); # .Net JsonResult bu şekilde
    }



    // KATEGORİ GÜNCELLEYEN METOD
    public function categoryUpdate(Request $request)
    {
        $isSlug = CategoryModel::whereSlug(str_slug($request->slug))->whereNotIn("id", [$request->id])->first(); # güncellenecek id dışındaki diğer verilerde var mı yok mu
        $isName = CategoryModel::whereName($request->name)->whereNotIn("id", [$request->id])->first(); # güncellenecek id dışındaki diğer verilerde var mı yok mu

        if ($isSlug or $isName) { # güncellenecek id dışındaki diğer verilerde varsa güncellemedik
            toastr()->error($request->category . " Adında Bir Kategori Zaten Mevcut!");
            return redirect()->back();
        }

        $add_category = CategoryModel::findOrFail($request->id); # .Net gibi güncelledik.
        $add_category->name = $request->category;
        $add_category->slug = str_slug($request->slug);
        $add_category->save();
        toastr()->success("Başarılı", "Kategori Başarılı Bir Şekilde Güncellendi");
        return redirect()->back();
    }



    // KATEGORİ SİLEN METOD
    public function categoryDelete(Request $request)
    {
        $category = CategoryModel::findOrFail($request->id);
        $makale_sayisi = $category->Article_Count(); # kategoriye ait makale sayısını adldık
        $message = ""; # kullanıcıya göstereceğimiz mesaj
        $category_article_count = $category->Article_Count();

        if($category->id == 1){
            toastr()->error("","Bu Kategori Silinemez");
            return redirect()->back();
        }

        else{
            if($category->Article_Count() > 0){
                $category->Articles()->update(["category_id"=>1]); # modelde yazdığım article almayı deniycez. # ilişki kurarak çok kolay bir şekilde kategoriye ait makaleleri aldık. ve düzenledik.
                $default_category = CategoryModel::findOrFail(1);
                $message = "Bu Kategoriye Ait ".$category_article_count." Makale ".$default_category->name." Kategorisine Taşındı";
            }
            $category->delete();
            toastr()->success($message,"Kategori Başarı İle Silindi");
            return redirect()->back();
        }
    }

}

# RIZA TURANCAN YILMAZ
