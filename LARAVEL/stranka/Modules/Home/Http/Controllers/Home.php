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
		$locale = session()->get('locale');
		$date = DB::table('events')->select('date')->distinct()->orderBy('date')->get();
		
		$events = [];
		if($date){
			foreach($date as $d){
				if($locale == 'sk'){
					$events[$d->date] = DB::table('events')->select( 'name_sk as name', 'text_sk as text', 'url', 'place', 'time' ,'date')->where('date', $d->date)->get();
				}else{
					$events[$d->date] = DB::table('events')->select( 'name_en as name', 'text_en as text', 'url', 'place', 'time' ,'date')->where('date', $d->date)->get();
				}
			}
		}

		$data = [
			'title' => $module_name,
			'date' => $date,
			'events' => $events
		];
		
		return view('home::home', $data);
    }

}
