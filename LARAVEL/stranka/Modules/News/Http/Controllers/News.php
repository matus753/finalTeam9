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
			'title' => $module_name,
			'news' => $news_db
		];
		debug($data);
        return view('news::news', $data);
    }

    
}
