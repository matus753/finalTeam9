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
		if($request->input('type')){
			$filter = $_GET['type'];
		}

		$expired = 0;
		if($request->input('expired')){
			$expired = 1;
		}
		
		if(!is_numeric($filter) || !is_numeric($expired) /*|| !is_numeric($page)*/){
			return redirect('/news')->with('err_code', ['type' => 'warning', 'msg' => 'Filter parameters wrong format!']);
		}
		if(($filter > 2) || ($filter < -1)){
			return redirect('/news')->with('err_code', ['type' => 'warning', 'msg' => 'Filter parameters wrong format!']);
		}
		if(($expired < 0) || ($expired > 1)){
			return redirect('/news')->with('err_code', ['type' => 'warning', 'msg' => 'Filter parameters wrong format!']);
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

		$today = date('d.m.Y');

		$data = [
			'news' => $res,
			'title' => $module_name,
			'type' => $filter,
			'expired' => $expired,
            'today' => $today
		];
		
        return view('news::news', $data);
    }

	public function show_content_news($n_id = 0){
		if( !is_numeric($n_id) ){
			return redirect('/news')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
		}

        $locale = session()->get('locale');
		$content = DB::table('news')->where('n_id', $n_id)->first();

		$added_files = [];
		if($content){
			$added_files = DB::table('news_dl_files')->where('hash_id', $content->hash_id)->get();
			$added_files = (!$added_files) ? [] : $added_files;
		}else{
			return redirect('/news')->with('err_code', ['type' => 'warning', 'msg' => 'Item does not exists!']);
		}

        if($locale == 'sk'){
            $data = [
                'title' => $content->title_sk,
                'content' => $content->editor_content_sk,
                'added_files' => $added_files
            ];
        } else {
            $data = [
                'title' => $content->title_en,
                'content' => $content->editor_content_en,
                'added_files' => $added_files
            ];
        }
		
		return view('news::show_content_news', $data);
	}
	
	public function optin( Request $request ){
		
		$email = $request->input('mail');
		$lang = $request->input('lang');
		$sub = $request->input('toggle');
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return json_encode('Bad email');
		}
		
		if(!is_numeric($sub) && ($sub != 1 || $sub != 0)){
			return json_encode('Internal error');
		}
		

		$data = [
			'email' => $email,
			'lang' => $lang
		];
		
		if($sub){
			if(DB::table('newsletter')->where('email', $email)->first()){
				DB::table('newsletter')->where('email', $email)->update($data);
				return json_encode('You are already subscriber. Data updated.');
			}else{
				if(DB::table('newsletter')->insert($data)){
					return json_encode('Subscribed');
				}
				else{
					return json_encode('Internal DB error');
				}
			}
		}else{
			DB::table('newsletter')->where('email', $email)->delete();		
			return json_encode('Unsubscribed');
		}
		return json_encode('Internal error');
	}
}
