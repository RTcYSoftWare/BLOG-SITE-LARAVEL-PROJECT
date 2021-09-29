<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use File;
class PageController extends Controller
{
    public function index(){
        $pages = Page::orderBy("order")->get();
        return view("back.pages.index",compact("pages"));
    }

    public function switch(Request $request)
    {
        $pages = Page::findOrFail($request->id);
        $pages->status = $request->statu == "true" ? 1 : 0; # php yeni versiyon if else kontrolünün kısaltılmış hali
        $pages->save();
    }

    public function create(){
        return view("back.pages.create");
    }

    public function createPage(Request $request){
        $request->validate([
            "title" => "min:3",
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048"
        ]);

        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->contents;
        $page->slug = str_slug($request->title);
        $last_page = Page::orderByDesc("order")->first(); // orderby kullanarak son sıradaki veriyi order için aldık.
        $page->order = $last_page->order + 1;
        if ($request->hasFile("image")) { # resmin gelip gelmediğini kontrol ettik.
            $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension(); # resmin uzantısını aldık.
            $request->image->move(public_path("uploads"), $imageName); # uploads klasörüne isimle kaydettik resmimizi.
            $page->image = "uploads/".$imageName;
        }
        $page->save();
        toastr()->success("Sayfa başarıyla oluşturuldu","Başarılı");
        return redirect()->route("admin.page.index");
    }

    public function update($id){
        $page = Page::findOrFail($id);
        return view("back.pages.update", compact( "page"));
    }

    public function updatePage(Request $request, $id){
        $request->validate([
            "title" => "min:3",
            "image" => "image|mimes:jpeg,png,jpg|max:2048"

        ]);

        $update_page = Page::findOrFail($id);
        $update_page->title = $request->title;
        $update_page->content = $request->contents;
        $update_page->slug = str_slug($request->title);

        if ($request->hasFile("image")) {
            $image_name = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path("uploads"), $image_name);
            $update_page->image = "uploads/".$image_name;
        }
        $update_page->save();
        toastr()->success("Makale başarıyla güncellendi","Başarılı");
        return redirect()->route("admin.page.index");
    }

    public function deletePage($id){
        $page = Page::findOrFail($id);
        if (File::exists($page->image)) { # resimi direct kökten sildik. eğer makaleden kurtuluyorsak resme de gerek yok.
            File::delete(public_path($page->image));
        }
        $page->forceDelete(); # ilglili veriyi gerçekten sildik (yok ettik)
        toastr()->success("","Sayfa Başarıyla Silindi");
        return redirect()->route("admin.page.index");
    }

    public function ordersPage(Request $request){
        foreach ($request->get("page") as $key => $order) {
            Page::where("id",$order)->update(["order"=>$key]);
        }
    }

}
