<?php

namespace Modules\Activity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Activity extends Controller
{
    public function photos_previews()
    {
		// TO DO MULTILANG
		$module_name = config('activity.name');
		
		$photos_db_previews = [];
		$photos_cats = DB::table('photo_gallery')->select('folder', 'title_SK', 'title_EN')->groupBy('folder')->orderBy('date', 'desc')->get();

		foreach($photos_cats as $p){
			$tmp = DB::table('photo_gallery')->where('folder', $p->folder)->get();
			$photos_db_previews[] = [ $p->folder => $tmp ];
		}
		
		$data = [
			'title' => $module_name,
			'categories' => $photos_cats,
			'previews' => $photos_db_previews
		];

        //debug($data);
        return view('activity::photos_previews', $data);
    }
	
	public function photos_event($event = ''){
		if($event == ''){
			return false;
		}
		// TO DO MULTILANG
		//to do remove bad string
		$module_name = config('activity.name');
		$photos = DB::table('photo_gallery')->where('folder', $event)->get();
		$data = [
			'title' => $module_name,
			'photos' => $photos
		];
		
		//debug($data);
        return view('activity::photos', $data);
	}
	
    public function videos()
    {
		// TO DO MULTILANG
		$module_name = config('activity.name');
		$videos_db_cats = DB::table('video_gallery')->select('type')->groupBy('type')->get();
		
		$data = [
			'title' => $module_name,
			'videos_cats' => $videos_db_cats
		];
        return view('activity::videos', $data);
    }

	public function ajax_get_videos_by_type( Request $request ){
		$filter = $request->input('category');
		
		$videos_db = null;
		
		if($filter == 'all'){
			$videos_db = DB::table('video_gallery')->get();
		}else{
			$videos_db = DB::table('video_gallery')->where('type', $filter)->get();
		}
		return json_encode($videos_db);
	}
	
    public function media()
    {
		// TO DO MULTILANG
		$module_name = config('activity.name');
		
		$media_db = DB::table('media')->get();
		
		$data = [
			'title' => $module_name,
			'media' => $media_db
		];
		//debug($data);
        return view('activity::media', $data);
    }

    
}
