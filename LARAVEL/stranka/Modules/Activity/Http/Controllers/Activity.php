<?php

namespace Modules\Activity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Activity extends Controller
{
    public function photos()
    {
		$module_name = config('activity.name');
		
		$photos_db = DB::table('photo_gallery')->orderBy('date', 'desc')->get();
		$photos_cats = DB::table('photo_gallery')->groupBy('folder')->get();
		
		
		$data = [
			'title' => $module_name,
			'categories' => $photos_cats,
			'photos' => $photos_db
		];
		debug($data);
        return view('activity::photos', $data);
    }
	
    public function videos()
    {
		$module_name = config('activity.name');
		
		$videos_db = DB::table('video_gallery')->get();
		
		$data = [
			'title' => $module_name,
			'videos' => $videos_db
		];
		debug($data);
        return view('activity::videos', $data);
    }

    public function media()
    {
		$module_name = config('activity.name');
		
		$media_db = DB::table('media')->get();
		
		$data = [
			'title' => $module_name,
			'media' => $media_db
		];
		debug($data);
        return view('activity::media', $data);
    }

    
}
