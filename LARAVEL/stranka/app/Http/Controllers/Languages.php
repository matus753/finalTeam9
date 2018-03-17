<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class Languages extends Controller
{
    public function switchLanguage($lang)
    {
		if(!is_string($lang) || is_numeric($lang)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Language change error!']);
        }

        if(array_key_exists($lang, config('languages'))) {
            session()->put('locale', $lang);	
        }else{
            return redirect('/')->with('err_code', ['type' => 'warning', 'msg' => 'Language translation does not exists!']);
        }
		
        return redirect()->back();
    }
}
