<?php

namespace App\Http\Controllers\RestAPIController;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class RestAPIController extends Controller
{
    public function getAllArticles(Request $request){

        $articles = Article::query();

        if($request->id == 1){
            $articles = Article::with('category')->get();
        }
        else {
            $articles = Article::with('category')->get();
        }

        return response()->json(['articles' => $articles]);
    }
}

// REST API KULLANMAK İÇİN YAPILAN DENEME CONTROLLER POSTMAN ARACILIĞI İLE VERİLERİ ÇEKMEYE ÇALIŞIYORUZ.

