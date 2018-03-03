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
		$activation = config('photos_admin.activation');

		$locale = session()->get('locale');
		if($locale == 'sk'){
			if($activation){
				$photos_cats = DB::table('photo_gallery')->select('pg_id', 'folder', 'title_SK as title', 'date')->where('activated', 1)->groupBy('folder')->orderBy('date', 'desc')->get();
			}else{
				$photos_cats = DB::table('photo_gallery')->select('pg_id', 'folder', 'title_SK as title', 'date')->groupBy('folder')->orderBy('date', 'desc')->get();

			}
		}else{
			if($activation){
				$photos_cats = DB::table('photo_gallery')->select('pg_id', 'folder', 'title_EN as title', 'date')->where('activated', 1)->groupBy('folder')->orderBy('date', 'desc')->get();
			}else{
				$photos_cats = DB::table('photo_gallery')->select('pg_id', 'folder', 'title_EN as title', 'date')->groupBy('folder')->orderBy('date', 'desc')->get();
			}
		}

		foreach($photos_cats as $p){
			$tmp = DB::table('photos')->where('pg_id', $p->pg_id)->get();
			$photos[] = [ $p->pg_id => $tmp ];
		}
		
		$data = [
			'title' => $module_name,
			'categories' => $photos_cats,
			'photos' => $photos
		];
		//debug($data, true);
        return view('activity::photos', $data);
    }
	
    public function videos()
    {
        $locale = session()->get('locale');
		$module_name = config('activity.name');

        if($locale == 'sk') {
            $videos_db_cats = DB::table('video_gallery')->select('type_sk as type')->groupBy('type_sk')->get();
        } else {
            $videos_db_cats = DB::table('video_gallery')->select('type_en as type')->groupBy('type_en')->get();
        }


		$data = [
			'title' => $module_name,
			'videos_cats' => $videos_db_cats
		];
        return view('activity::videos', $data);
    }

	public function ajax_get_videos_by_type( Request $request ){
		$filter = $request->input('category');
		
		$videos_db = null;
		$locale = session()->get('locale');
		
		if($filter == 'all'){
			if($locale == 'sk'){
				$videos_db = DB::table('video_gallery')->select('title_SK as title', 'url', 'type_sk as type')->get();
			}else{
				$videos_db = DB::table('video_gallery')->select('title_EN as title', 'url', 'type_en as type')->get();
			}
		}else{
			if($locale == 'sk'){
				$videos_db = DB::table('video_gallery')->select('title_SK as title', 'url', 'type_sk as type')->where('type_sk', $filter)->get();
			}else{
				$videos_db = DB::table('video_gallery')->select('title_EN as title', 'url', 'type_en as type')->where('type_en', $filter)->get();
			}
		}
		return json_encode($videos_db);
	}
	
    public function media()
    {
		// TO DO MULTILANG
		$module_name = config('activity.name');
		
		$media_db = DB::table('media')->get();

		foreach($media_db as $m){
			$files = DB::table('media_files')->where('m_id', $m->m_id)->get();
			$files = (!$files) ? [] : $files;
			$m->files['files'] = $files;
		}

		$data = [
			'title' => $module_name,
			'media' => $media_db
		];
		//debug($data['media'][0]->files,true);
        return view('activity::media', $data);
    }

    
}
