<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class Languages extends Controller
{
    public function switchLanguage($lang)
    {
		
        if(array_key_exists($lang, config('languages'))) {
            session()->put('locale', $lang);	
        }
		
        return redirect()->back();
    }
}
