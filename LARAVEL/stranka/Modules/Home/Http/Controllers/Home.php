<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
		$date = DB::table('events')->select('date')->distinct()->orderBy('date')->get();
		//$events = DB::table('events')->orderBy('date')->groupBy('date')->get();
		$events_data = [];
		foreach($date as $d){
			$events[$d->date] = DB::table('events')->where('date', $d->date)->get();
		}

		$data = [
			'title' => $module_name,
			'date' => $date,
			'events' => $events
		];
		//debug($data);
		return view('home::home', $data);
    }

}
