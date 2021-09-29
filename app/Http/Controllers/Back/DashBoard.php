<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;

class DashBoard extends Controller
{
    public function index(){
        $admin = Admin::findOrFail(1);

        //$admin_firs_not = $admin->readNotifications()->count(); // okunmuş olanları alma

        //$admin_firs_not = $admin->unreadNotifications()->first(); // okunmamış not ları almak.
        //$admin_firs_not->markAsRead(); // okundu yapmak

        $article = Article::all()->count();
        $hit = Article::sum("hit");
        $category = Category::all()->count();
        $page = Page::all()->count();

        return view("back.dashboard", compact("admin","article","hit","category","page"));
    }
}
