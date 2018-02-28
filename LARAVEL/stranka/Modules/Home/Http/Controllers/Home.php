<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
	
	/** Example: Passing data to view (' Martin Trocha ')
	 *	
	 *	Pass just few things ( name or ID or ...)
	 *		return view('home::home')->with('title','UAMT');
	 *
	 *	Pass more data ( whole array )
	 *		return view('home::home', $data);
	*/
	
    public function index()
    {	
		$module_name = config('home.name');
	
		$data = [
			'title' => $module_name,

		];
		return view('home::home', $data);
    }
}
