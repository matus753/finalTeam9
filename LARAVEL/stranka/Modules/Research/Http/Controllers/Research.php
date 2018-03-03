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
		$activation = config('projects_admin.activation');
	
		$projects_db = DB::table('project')->get();
		// pre medzinarodne pouzivat International type
		if($activation){
			$projects_db_international = DB::table('project')->where('projectType', config('research.db_international') )->where('activated', 1)->get();
			$projects_db_kega = DB::table('project')->where('projectType', config('research.db_kega') )->where('activated', 1)->get();
			$projects_db_vega = DB::table('project')->where('projectType', config('research.db_vega') )->where('activated', 1)->get();
			$projects_db_apvv = DB::table('project')->where('projectType', config('research.db_apvv') )->where('activated', 1)->get();
			$projects_db_other = DB::table('project')->where('projectType',config('research.db_other') )->where('activated', 1)->get();
		}else{
			$projects_db_international = DB::table('project')->where('projectType', config('research.db_international') )->get();
			$projects_db_kega = DB::table('project')->where('projectType', config('research.db_kega') )->get();
			$projects_db_vega = DB::table('project')->where('projectType', config('research.db_vega') )->get();
			$projects_db_apvv = DB::table('project')->where('projectType', config('research.db_apvv') )->get();
			$projects_db_other = DB::table('project')->where('projectType',config('research.db_other') )->get();
		}

		$data = [
			'title' => $module_name,
			'international' => $projects_db_international,
			'kega' => $projects_db_kega,
			'vega' => $projects_db_vega,
			'apvv' => $projects_db_apvv,
			'other' => $projects_db_other
		];
        return view('research::projects', $data);
    }

    public function show($pr_id = 0){
        if(!is_numeric($pr_id) || $pr_id == 0){
            return false;
		}
		
        $project = DB::table('project')->where('pr_id',$pr_id )->first();

        return json_encode($project);

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
