<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class News extends Controller
{
    public function index(Request $request)
    {
		$module_name = config('news.name');
		$pages_count = config('news.items_per_page');
		
		$filter = -1;
		if(isset($_GET['type'])){
			$filter = $_GET['type'];
		}

		$expired = 0;
		if(isset($_GET['expired'])){
			$expired = 1;
		}
		
		if(!is_numeric($filter) && !is_numeric($expired) && !is_numeric($page)){
			return false;
		}
		if(($filter > 2) || ($filter < -1)){
			return false;
		}
		if(($expired < 0) || ($expired > 1)){
			return false;
		}

		if($filter == -1){ // vsetky
			if($expired){
				$res = DB::table('news')->orderBy('date_expiration', 'desc')->paginate($pages_count);
			}else{
				$res = DB::table('news')->where('date_expiration', '>=', time()-86400)->orderBy('date_expiration', 'desc')->paginate($pages_count);
			}
		}else{ // podla typu
			if($expired){
				$res = DB::table('news')->where('type', $filter)->orderBy('date_expiration', 'desc')->paginate($pages_count);
			}else{
				$res = DB::table('news')->where('date_expiration', '>', time())->where('type', $filter)->orderBy('date_expiration', 'desc')->paginate($pages_count);
			}
		}
		
		if($res){
			foreach($res as $r){
				$r->date_expiration = format_time($r->date_expiration);
			}
		}

		$data = [
			'news' => $res,
			'title' => $module_name,
			'type' => $filter,
			'expired' => $expired
		];

		//debug($data);
        return view('news::news', $data);
    }

	public function show_content_news($id = 0){
		if( !is_numeric($id) ){
			return false;
		}

		$content = DB::table('news')->where('id', $id)->first();
		$added_files = DB::table('news_dl_files')->where('n_id', $content->id)->get();
		$added_files = (!$added_files) ? [] : $added_files;

		$data = [
			'title' => $content->title_sk,
			'content' => $content,
			'added_files' => $added_files
		];
		//debug($data, true);
		return view('news::show_content_news', $data);
	}
	
	public function optin( Request $request ){
		$email = $request->input('mail');
		$lang = $request->input('lang');
		$sub = $request->input('sub');
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		if(!is_numeric($sub)){
			return false;
		}
		if(($sub < 0) || ($sub > 1)){
			return false;
		}
		
		$data = [
			'email' => $email,
			'lang' => $lang
		];
		
		if($sub){
			$insert = DB::table('newsletter')->insertGetId($data);
			if($insert > 0){
				return json_encode($insert);
			}
			else{
				return json_encode($insert);
			}
		}else{
			DB::table('newsletter')->where('email', $email)->delete();		
			return json_encode(true);
		}
		return json_encode(false);
	}
    
}
