<?php

namespace Modules\About\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class About extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function index()
//    {
//        $module_name = config('about.name');
//
//        return view('about::about')->with('title', $module_name);
//    }

    public function history(){
        $module_name = config('about.name');

        return view('about::history')->with('title', $module_name);
    }

    public function management(){
        $module_name = config('about.name');

        return view('about::management')->with('title', $module_name);
    }

    public function institutes(){
        $module_name = config('about.name');

        return view('about::institutes')->with('title', $module_name);
    }
}
