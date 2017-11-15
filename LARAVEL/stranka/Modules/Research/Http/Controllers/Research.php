<?php

namespace Modules\Research\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Research extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function projects()
    {
		$module_name = config('research.name');
		$projects_db = DB::table('project')->get();
		
		
		/*
		// change type of project in db INTERNATIONAL ????
		$projects_db_kega = DB::table('project')->where('projectType','KEGA')->get();
		$projects_db_vega = DB::table('project')->where('projectType','VEGA')->get();
		$projects_db_apvv = DB::table('project')->where('projectType','APVV')->get();
		*/
		
		$data = [
			'title' => $module_name,
			'allProjects' => $projects_db
		];
		debug($data);
        return view('research::projects', $data);
    }
	
	public function ekart()
    {
		$module_name = config('research.name');
		
		$data = [
			'title' => $module_name,
		];

        return view('research::ekart', $data);
    }
	
	public function autonom_vehicle()
    {
		$module_name = config('research.name');
		
		$data = [
			'title' => $module_name,
		];

        return view('research::autonom_vehicle', $data);
    }
	
	public function led_cube()
    {
		$module_name = config('research.name');
		
		$data = [
			'title' => $module_name,
		];

        return view('research::led_cube', $data);
    }
	
	public function biomechatronic()
    {
		$module_name = config('research.name');
		
		$data = [
			'title' => $module_name,
		];

        return view('research::biomechatronic', $data);
    }

    
}
