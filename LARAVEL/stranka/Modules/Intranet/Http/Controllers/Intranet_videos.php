<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Config\Repository;

class Intranet_videos extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               VIDEOS              /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    public function videos_all(){
       

        $locale = session()->get('locale');
        if($locale == 'sk'){
            $videos = DB::table('video_gallery')->select('v_id', 'title_SK as title', 'type')->get();
        }else{
            $videos = DB::table('video_gallery')->select('v_id', 'title_EN as title', 'type')->get();
        }

        $data = [
            'videos' => $videos,
            'title' => $this->module_name
        ];
        //debug($data, true);
        return view('intranet::videos/videos_all', $data);
    }

    public function videos_add(){

        $types = config('videos_admin.types');
        
        $data = [
            'title' => $this->module_name,
            'types' => $types
        ];
       // debug($data, true);
        return view('intranet::videos/videos_add', $data);
    }

    public function videos_add_action( Request $request ){

        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');
        $url = $request->input('url');
        $type = $request->input('type');

        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://'.ltrim($url, '/');
        }

        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'url' => $url,
            'type' => $type,
        ];
        
        $res = (bool)DB::table('video_gallery')->insert($data);
        if($res){
            return redirect('/videos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record added successfuly!']);
        }
        return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
    }

    public function videos_edit($v_id = 0){
        if(!is_numeric($v_id)){
            return back();
        }

        $video = DB::table('video_gallery')->where('v_id', $v_id)->first();
        $types = config('videos_admin.types');

        $data = [
            'title' => $this->module_name,
            'video' => $video,
            'types' => $types
        ];

        return view('intranet::videos/videos_edit', $data);
    }

    public function videos_edit_action( $v_id = 0, Request $request ){
        if(!is_numeric($v_id)){
            return back();
        }
        
        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');
        $url = $request->input('url');
        $type = $request->input('type');

        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://'.ltrim($url, '/');
        }

        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'url' => $url,
            'type' => $type,
        ];

        $res = (bool)DB::table('video_gallery')->where('v_id', $v_id)->insert($data);
        if($res){
            return redirect('/videos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record updated successfuly!']);
        }
        return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB update error!']);
    }

    public function videos_delete_action($v_id = 0){
        // to do error msg
        if(!is_numeric($v_id)){
            return back();
        }

        $res = (bool) DB::table('video_gallery')->where('v_id', $v_id)->delete();

        if($res){
            return redirect('/videos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record deleted successfuly!']);
        }
        return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB delete error!']);
    }
}
