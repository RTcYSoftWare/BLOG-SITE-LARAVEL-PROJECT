<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\ArticleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/blog-event",function (){
   $admin = \App\Models\Admin::firstOrFail();

   event(new \App\Events\BlogAddedEvent($admin));

});

/*
|--------------------------------------------------------------------------
| Job Routes
|--------------------------------------------------------------------------
*/
Route::get("/queue",function (){
//    \App\Jobs\LogJob::dispatch("tyilmaz@teklifbilisim.com")->onQueue("emails"); # yönlendirme (buraya buraya yap) kuyruk oluştumak için LogJob sınıfına veri yollar
//    \App\Jobs\LogJob::dispatch("ahmet@teklifbilisim.com")->onQueue("emails"); # yollayacağımız kuyruğu yazdık
//    \App\Jobs\LogJob::dispatch("mehmet@teklifbilisim.com")->onQueue("high"); #
//    \App\Jobs\LogJob::dispatch("mehmet@teklifbilisim.com")->onQueue("high"); #
//    \App\Jobs\LogJob::dispatch("mehmet@teklifbilisim.com")->onQueue("medium"); #

    $admin = \App\Models\Admin::firstOrFail(); // queue ile mail yollama yapmak için admin bulduk.
    \App\Jobs\MailSendJob::dispatch($admin)->delay(now()->addSeconds(5)); // delay'lı mail yollamak.
    dd("Tamamlandı");
});



/*
|--------------------------------------------------------------------------
| Notification Routes
|--------------------------------------------------------------------------
*/
Route::get("/send-testenrollment",[\App\Http\Controllers\TestsEnrollmentController::class,"sendTestNotification"]);



/*
|--------------------------------------------------------------------------
| Front Disable Routes
|--------------------------------------------------------------------------
*/
Route::get("aktif-degil",function (){
    return view("front.offline");
});



/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::prefix("admin")->name("admin.")->middleware("isLogin")->group(function (){
    Route::get("giris",[\App\Http\Controllers\Back\Auth::class,"login"])->name("login");
    Route::post("giris",[\App\Http\Controllers\Back\Auth::class,"loginPost"])->name("login.post");
});

Route::prefix("admin")->name("admin.")->middleware("isAdmin")->group(function (){ # route grupladık. ve middleware imizi ekledik.
    Route::get("panel",[\App\Http\Controllers\Back\DashBoard::class,"index"])->name("dashboard");
    Route::get("makaleler/silinenler",[ArticleController::class,"trashed"])->name("trashed.article");

    // MAKALE ROUTES
    Route::resource("makaleler",ArticleController::class)->middleware("role:Editor|SupperAdmin");
    Route::get("/switch",[ArticleController::class,"switch"])->name("switch")->middleware("permission:edit articles");
    Route::get("/deletearticle/{id}",[ArticleController::class,"delete"])->name("delete.article")->middleware("can:viewAny,admin")->middleware("permission:delete articles"); // yazdığımız policy'i kullanarak burada delete'kısmını kapattık.
    Route::get("/harddeletearticle/{id}",[ArticleController::class,"hardDelete"])->name("hard.delete.article")->middleware("permission:delete articles");
    Route::get("/recoverarticle/{id}",[ArticleController::class,"recover"])->name("recover.article")->middleware("permission:edit articles");

    // KATEGORİ ROUTES
    Route::get("/kategoriler",[\App\Http\Controllers\Back\Category::class,"index"])->name("category.index");
    Route::get("/kategori/status",[\App\Http\Controllers\Back\Category::class,"statusChanged"])->name("category.switch");
    Route::post("/kategoriler/create",[\App\Http\Controllers\Back\Category::class,"categoryCreate"])->name("category.create");
    Route::get("/kategoriler/getData",[\App\Http\Controllers\Back\Category::class,"categoryGetData"])->name("category.getdata");
    Route::post("/kategoriler/update",[\App\Http\Controllers\Back\Category::class,"categoryUpdate"])->name("category.update");
    Route::post("/kategoriler/delete",[\App\Http\Controllers\Back\Category::class,"categoryDelete"])->name("category.delete");

    // PAGE'S ROUTES
    Route::prefix("/sayfalar")->name("page.")->middleware("role:Admin|SupperAdmin")->group(function (){
        Route::get("/",[\App\Http\Controllers\Back\PageController::class,"index"])->name("index");
        Route::get("/switch",[\App\Http\Controllers\Back\PageController::class,"switch"])->name("switch");
        Route::get("/create",[\App\Http\Controllers\Back\PageController::class,"create"])->name("create");
        Route::post("/create",[\App\Http\Controllers\Back\PageController::class,"createPage"])->name("create.post");
        Route::get("/update/{id}",[\App\Http\Controllers\Back\PageController::class,"update"])->name("update");
        Route::post("/update/{id}",[\App\Http\Controllers\Back\PageController::class,"updatePage"])->name("update.post");
        Route::get("/delete/{id}",[\App\Http\Controllers\Back\PageController::class,"deletePage"])->name("delete");
        Route::get("/order",[\App\Http\Controllers\Back\PageController::class,"ordersPage"])->name("orders");
    });


    // CONFIG'S ROUTES
    Route::post("/ayarlar/update",[\App\Http\Controllers\Back\ConfigController::class,"pageUpdate"])->name("config.update")->middleware("role:SupperAdmin");
    Route::get("/ayarlar",[\App\Http\Controllers\Back\ConfigController::class,"index"])->name("config.index")->middleware("role:SupperAdmin");

    // ADMIN'S ROUTES
    Route::prefix("/adminler")->name("adminler.")->middleware("role:SupperAdmin")->group(function (){
        Route::get("/",[\App\Http\Controllers\Back\AdminCrudController::class,"Adminler"])->name("index");
        Route::get("/yeni-admin",[\App\Http\Controllers\Back\AdminCrudController::class,"YeniAdmin"])->name("yeni-admin");
        Route::post("/yeni-admin",[\App\Http\Controllers\Back\AdminCrudController::class,"YeniAdminKaydet"])->name("yeni-admin-post");
        Route::get("/edit-admin/{id}",[\App\Http\Controllers\Back\AdminCrudController::class,"editAdmin"])->name("edit-admin");
        Route::post("/edit-admin",[\App\Http\Controllers\Back\AdminCrudController::class,"updateAdmin"])->name("edit-admin-post");
        Route::get("/delete-admin/{id}",[\App\Http\Controllers\Back\AdminCrudController::class,"deleteAdmin"])->name("delete-admin");
    });

    Route::prefix("/roller")->name("roller.")->group(function (){
        Route::get("/",[\App\Http\Controllers\Back\RoleCrudController::class,"index"])->name("index");
        Route::get("/edit-role/{id}",[\App\Http\Controllers\Back\RoleCrudController::class,"editRole"])->name("edit-role");
        Route::get("/give-to-permission",[\App\Http\Controllers\Back\RoleCrudController::class,"addPermissionToRole"])->name("give-to-permission");
    });


    Route::get("cikis",[\App\Http\Controllers\Back\Auth::class,"logout"])->name("logout");
});



/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/
Route::get("/",[\App\Http\Controllers\Front\Homepage::class,"index"])->name("homepage");
Route::get("/kategori/{category}",[\App\Http\Controllers\Front\Homepage::class,"Category"])->name("category");
Route::get("/sayfa",[\App\Http\Controllers\Front\Homepage::class,"index"]);
Route::get("/iletisim",[\App\Http\Controllers\Front\Homepage::class,"contact"])->name("contact");
Route::post("/iletisim",[\App\Http\Controllers\Front\Homepage::class,"contactPost"])->name("contact.post");

Route::get("/{category}/{slug}",[\App\Http\Controllers\Front\Homepage::class,"Single"])->name("single");
Route::get("/{sayfa}",[\App\Http\Controllers\Front\Homepage::class,"page"])->name("page");






