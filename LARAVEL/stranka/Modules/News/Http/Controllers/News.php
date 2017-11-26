<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class News extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$module_name = config('news.name');
		
		$news_db = DB::table('news')->get();
		
		$data = [
			'title' => $module_name
		];
        return view('news::news', $data);
    }

	public function concrete_news( $id = 0 ){
		if(!is_numeric($id)){
			return false;
		}
		$module_name = config('news.name');
		
		$news_concrete_db = DB::table('news')->where('id', $id)->get();
		
		$data = [
			'title' => $module_name,
			'news' => $news_concrete_db
		];
		debug($data);
        return view('news::concrete_news', $data);
    }
	
	public function ajax_news_filter( Request $request ){
		$filter = $request->input('type');
		$expired = $request->input('exp');
		
		if(!is_numeric($filter) && !is_numeric($expired)){
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
				$res = DB::table('news')->get();
			}else{
				$res = DB::table('news')->whereDate('date_expiration', '>=', date('Y-m-d'))->get();
			}
		}else{ // podla typu
			if($expired){
				$res = DB::table('news')->where('type', $filter)->get();
			}else{
				$res = DB::table('news')->whereDate('date_expiration', '>=', date('Y-m-d'))->where('type', $filter)->get();
			}
		}

		return json_encode($res);
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
