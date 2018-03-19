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

    public function videos_all(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $locale = session()->get('locale');
        if($locale == 'sk'){
            $videos = DB::table('video_gallery')->select('v_id', 'title_SK as title', 'type_sk as type')->get();
        }else{
            $videos = DB::table('video_gallery')->select('v_id', 'title_EN as title', 'type_en as type')->get();
        }

        $videos = (!$videos) ? [] : $videos;

        $data = [
            'videos' => $videos,
            'title' => $this->module_name
        ];

        return view('intranet::videos/videos_all', $data);
    }

    public function videos_add(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $types = config('videos_admin.types');
        
        $data = [
            'title' => $this->module_name,
            'types' => $types
        ];

        return view('intranet::videos/videos_add', $data);
    }

    public function videos_add_action( Request $request ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');
        $url = $request->input('url');
        $type = $request->input('type');

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 256 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 256 characters!']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 256 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 256 characters!']);
        }

        if(!is_string($url) || strlen($url) < 1 || strlen($url) > 512 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 512 characters!']);
        }

        if(!is_string($type) || strlen($type) < 1 || strlen($type) > 64 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 64 characters!']);
        }

        $type_en = config('videos_admin.types_en');
        $type_en = $type_en[$type];

        if(!is_string($type_en) || strlen($type_en) < 1 || strlen($type_en) > 64 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 64 characters!']);
        }

        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://'.ltrim($url, '/');
        }

        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'url' => $url,
            'type_sk' => $type,
            'type_en' => $type_en,
        ];
        
        $res = (bool)DB::table('video_gallery')->insert($data);
        if($res){
            return redirect('/videos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record added successfuly!']);
        }
        return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
    }

    public function videos_edit($v_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($v_id)){
            return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $locale = session()->get('locale');
        if($locale == 'sk') {
            $video = DB::table('video_gallery')->select('v_id', 'title_SK', 'title_EN', 'url', 'type_sk as type')->where('v_id', $v_id)->first();
        } else {
            $video = DB::table('video_gallery')->select('v_id', 'title_SK', 'title_EN', 'url', 'type_en as type')->where('v_id', $v_id)->first();
        }

        if(!$video){;
            return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
        }
        $types = config('videos_admin.types');

        $data = [
            'title' => $this->module_name,
            'video' => $video,
            'types' => $types
        ];

        return view('intranet::videos/videos_edit', $data);
    }

    public function videos_edit_action( $v_id = 0, Request $request ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($v_id)){
            return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');
        $url = $request->input('url');
        $type = $request->input('type');

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 256 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 256 characters!']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 256 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 256 characters!']);
        }

        if(!is_string($url) || strlen($url) < 1 || strlen($url) > 512 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 512 characters!']);
        }

        if(!is_string($type) || strlen($type) < 1 || strlen($type) > 64 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 64 characters!']);
        }

        $type_en = config('videos_admin.types_en');
        $type_en = $type_en[$type];

        if(!is_string($type_en) || strlen($type_en) < 1 || strlen($type_en) > 64 ){
            return redirect('/videos-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 64 characters!']);
        }

        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://'.ltrim($url, '/');
        }

        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'url' => $url,
            'type_sk' => $type,
            'type_en' => $type_en,
        ];

        $res = (bool)DB::table('video_gallery')->where('v_id', $v_id)->insert($data);
        if($res){
            return redirect('/videos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record updated successfuly!']);
        }
        return redirect('/videos-admin')->with('err_code', ['type' => 'Warning', 'msg' => 'Any data has been changed!']);
    }

    public function videos_delete_action($v_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        
        if(!is_numeric($v_id)){
            return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $res = (bool) DB::table('video_gallery')->where('v_id', $v_id)->delete();

        if($res){
            return redirect('/videos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record deleted successfuly!']);
        }
        return redirect('/videos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB delete error!']);
    }
}
