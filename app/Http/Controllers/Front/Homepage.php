<?php

namespace App\Http\Controllers\Front;

use App\Events\BlogAddedEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Setting;
use App\Notifications\Deneme; # Bizim oluşturduğumuz Notification Class'ını dahil ettik.
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Mail; # mail kütüphanesini dahil ettik.
use Illuminate\Support\Facades\Notification; # Notification Trait kütüphanesini dahil ettik.

class Homepage extends Controller
{
    public function __construct(){
        if(Setting::findOrFail(1)->active == 0){
            return redirect()->to("aktif-degil")->send();
        }
        else{
            view()->share("kategoriler",Category::where("status","1")->inRandomOrder()->get());
            view()->share("pages",Page::where("status","1")->orderBy("order","ASC")->get()); // bu bütün sayfalarda çalışan metod. bütün sayfalara bu veriyi yollar. bu controller içineki.!
        }
    }



    public function index(){
        #$data["kategoriler"] = Category::inRandomOrder()->get(); // kategorileri random sırayla modelimiz sayesinde vt.den çektik.
        $data["articles"] = Article::with(["getCategory"])->orderBy("created_at","DESC")->whereHas("getCategory", function($query){
            $query->where("status",1);
        })->where("status","1")->paginate(10); // get(); # paginate komutu istediğimiz kadar veriyi gösteriri.  Sayfalandırma yapar.
        # with komutu ile view'de otomatik çağırdığımızı controller'da çağırdık.
        $data["articles"]->withPath(url("/sayfa")); // bizim paginate için yazdığımız yol.
        return view("front.homepage",$data); // view a yolladık.
    }



    public function Single($category,$slug){
        $category_kontrol = Category::whereSlug($category)->first() ?? abort(403,"Böyle Bir Kategori Yok");
        #$data["kategoriler"] = Category::inRandomOrder()->get(); // kategorileri random sırayla modelimiz sayesinde vt.den çektik.

        $article = Article::whereSlug($slug)->whereCategoryId($category_kontrol->id)->first() ?? abort(403,"Böyle Bir Yazı Bulunamadı !!!"); // veri varsa ? yoksa
        $article->increment("hit"); // değeri bir arttırdık. basit bir şekilde.

        $data["article"] = $article;

        // dd($article); güzel bir değişik çıktı veriyor.

        return view("front.single",$data);

    }



    public function Category($slug){
        $category_kontrol = Category::whereSlug($slug)->first() ?? abort(403,"Böyle Bir Kategori Yok");
        $data["category"] = $category_kontrol;
        $data["articles"] = Article::where("category_id",$category_kontrol->id)->where("status","1")->orderBy("created_at","DESC")->get();
        #$data["kategoriler"] = Category::inRandomOrder()->get(); // kategorileri random sırayla modelimiz sayesinde vt.den çektik.

        return view("front.category",$data);
    }



    public function page($slug){
        $page = Page::whereSlug($slug)->first() ?? abort(403,"Böyle Bir Sayfa Bulunamadı");
        $data["page"] = $page;
        return view("front.page",$data);
    }



    public function contact(){
        return view("front.contact");
    }



    public function contactPost(Request $request){
        $rules = [
            "name" => "required|min:5",
            "email" => "required|email",
            "topic" => "required",
            "message" => "required|min:10"
        ];

        $validate = Validator::make($request->post(),$rules);

        if($validate->fails()){
            print_r($validate->errors()->first("message"));
            return redirect()->route("contact")->withErrors($validate)->withInput();
        }

        # bu view kullanmadığımız sürece mail göndermemizi sağlar. text olarak yollar raw html taglarını algılamaz
        # send gönderir. ilk array view adı, ikinci array kime gideceği.
//        Mail::send([],[], function ($message) use ($request){
//            $message->from("iletisim@blogsitesi.com","Blog Sitesi");
//            $message->to("tyilmaz@teklifbilisim.com");
//            $message->setBody(" Mesajı gönderen : ".$request->name."<br>
//                        Mesajı Gönderen Mail :".$request->email."<br>
//                        Mesaj Konusu : ".$request->topic."<br>
//                        Mesaj : ".$request->message."<br><br>
//                        Mesaj Gönderilme Tarihi : ".now()."","text/html");
//            $message->subject($request->name." iletişimden mesaj gönderdi");
//        });

        $enrollmentData = [
            "body" => $request->message,
            "enrollmentText" => $request->name,
            "url" => url("/"),
            "thankyou" => "Teşekkür ederiz."
        ];



        # Notification Kullanılarak Mail Gönderme

//        Notification::send($admin, new Deneme($enrollmentData,"asdf","database"));
        $admin = Admin::firstOrFail();
        // Event Ve Notification Birleşimi
        event(new BlogAddedEvent($admin,$enrollmentData,"mail"));


//        # veri tabanına kaydetmeyi mail yollama denemesi için kapattık.
//        $contact = new Contact();
//        $contact->name = $request->name;
//        $contact->email = $request->email;
//        $contact->topic = $request->topic;
//        $contact->message = $request->message;
//        $contact->save();


        return redirect()->route("contact")->with("success","Mail'iniz Bize Ulaştı. En Kısa Zamanda Size Geri Dönüş Saplanacaktır.");
    }

}
