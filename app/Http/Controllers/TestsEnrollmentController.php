<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\Deneme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestsEnrollmentController extends Controller
{
    public function sendTestNotification(){

        $admin = Admin::first(); // bildirim yollayacağımız user'ı aldık.

        $enrollmentData = [
            "body" => "Notification deneme yapıyoruz",
            "enrollmentText" => "Bu da mesajın içeriği galiba",
            "url" => url("/"),
            "thankyou" => "Teşekkür ederiz bir şey için"
        ];

        $senDatabaseNot = $admin->name;


        // iki farklı yol var yollamanın biri bu
        //$admin->notify(new Deneme($enrollmentData)); # bu şekilde basit bir mail yolladık. dikkat env. dosyasında gönderici mail adresini yazmak gerekiyor.

        // diğer yol
        //Notification::send($admin, new Deneme($enrollmentData));

        Notification::send($admin, new Deneme($enrollmentData,$senDatabaseNot));

    }
}
