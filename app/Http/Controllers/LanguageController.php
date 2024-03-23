<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change($lang)
    {
        Session::put('lang',$lang);
        return back();
    }


}
