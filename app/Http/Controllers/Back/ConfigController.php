<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class ConfigController extends Controller
{
    public function index(){
        $config = Setting::find(1);
        return view("back.config.index", compact("config"));
    }



    public function pageUpdate(Request $request)
    {
        $config = Setting::find(1);

        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedin = $request->linkedin;
        $config->youtube = $request->youtube;
        $config->github = $request->github;
        $config->instagram = $request->instagram;

        if ($request->hasFile("logo")) { # eğer logo geldiyse kaydet.
            $logo = str_slug($request->title) . "-logo" . "." . $request->logo->getClientOriginalExtension(); # mesela bunu ezberden yazmak zorundayım. request'in oto tamamlaması yok mu.
            $request->logo->move(public_path("uploads"), $logo);
            $config->logo = "uploads/" . $logo;
        }

        if ($request->hasFile("fav_icon")) { # eğer logo geldiyse kaydet.
            $fav_icon = str_slug($request->fav_icon) . "-favicon" . "." . $request->fav_icon->getClientOriginalExtension(); # mesela bunu ezberden yazmak zorundayım. request'in oto tamamlaması yok mu.
            $request->fav_icon->move(public_path("uploads"), $fav_icon);
            $config->favicon = "uploads/" . $fav_icon;
        }
        $config->save();

        toastr()->success("Ayarlar Barıyla Güncellendi", "Başarılı");
        return redirect()->back();
    }
}
