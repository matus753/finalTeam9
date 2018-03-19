<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_events extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('events_admin.name');
    }

    public function events_all(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $all_events = DB::table('events')->get();
        $all_events = (!$all_events) ? [] : $all_events;

        $data = [ 
                'title' => $this->module_name, 
                'events' => $all_events
            ];

        return view('intranet::events/events_all', $data);
    }

    public function events_add(){    
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $data = [
            'title' => $this->module_name,
        ];
        return view('intranet::events/events_add', $data);
    }

    public function events_add_action( Request $request ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $name_sk = $request->input('title_sk');
        $name_en = $request->input('title_en');
        $text_sk = $request->input('sk_text');
        $text_en = $request->input('en_text');
        $place = $request->input('place');
        $time = $request->input('time');
        $date = $request->input('date');
        $url = $request->input('link');

        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();
        
        if(!is_string($name_sk) || strlen($name_sk) < 1 || strlen($name_sk) > 128){
            return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 128 characters!']);
        }

        if(!is_string($name_en) || strlen($name_en) < 1 || strlen($name_en) > 128){
            return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 128 characters!']);
        }

        if($request->filled('sk_text')){
            if(!is_string($text_sk) || strlen($text_sk) < 1 || strlen($text_sk) > 65535){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Text SK max 65535 characters!']);
            }
        }else{
            $text_sk = null;
        }
        
        if($request->filled('en_text')){
            if(!is_string($text_en) || strlen($text_en) < 1 || strlen($text_en) > 65535){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Text EN max 65535 characters!']);
            }
        }else{
            $text_en = null;
        }

        if($request->filled('place')){
            if(!is_string($place) || strlen($place) < 1 || strlen($place) > 64){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Place max 64 characters!']);
            }
        }else{
            $place = null;
        }

        if($request->filled('time')){
            if(!is_string($time) || strlen($time) < 1 || strlen($time) > 16){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Place max 16 characters!']);
            }
        }else{
            $time = null;
        }

        if($request->filled('url')){
            if(!is_string($url) || strlen($url) < 1 || strlen($url) > 512){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Place max 16 characters!']);
            }
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
        }else{
            $url = null;
        }

        $data = [
            'name_sk' => $name_sk,
            'name_en' => $name_en,
            'text_sk' => $text_sk,
            'text_en' => $text_en,
            'place' => $place,
            'time' => $time,
            'date' => $date,
            'url' => $url
        ];
    
        
        $event_id = DB::table('events')->insertGetId($data);
        if($event_id){
            return redirect('/events-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly added!']);
        }
        return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
    }

    public function events_edit( $e_id = 0 ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($e_id)){
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $events = DB::table('events')->where('e_id', $e_id)->first();
        if(!$events){
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $data = [
            'events' => $events,
            'title' => $this->module_name,
        ];

        return view('intranet::events/events_edit', $data);
    }

    public function events_edit_action( $e_id = 0, Request $request){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($e_id)){
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $name_sk = $request->input('title_sk');
        $name_en = $request->input('title_en');
        $text_sk = $request->input('sk_text');
        $text_en = $request->input('en_text');
        $place = $request->input('place');
        $time = $request->input('time');
        $date = $request->input('date');
        $url = $request->input('link');

        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();
        
        if(!is_string($name_sk) || strlen($name_sk) < 1 || strlen($name_sk) > 128){
            return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 128 characters!']);
        }

        if(!is_string($name_en) || strlen($name_en) < 1 || strlen($name_en) > 128){
            return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 128 characters!']);
        }

        if($request->filled('sk_text')){
            if(!is_string($text_sk) || strlen($text_sk) < 1 || strlen($text_sk) > 65535){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Text SK max 65535 characters!']);
            }
        }else{
            $text_sk = null;
        }

        if($request->filled('en_text')){
            if(!is_string($text_en) || strlen($text_en) < 1 || strlen($text_en) > 65535){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Text EN max 65535 characters!']);
            }
        }else{
            $text_en = null;
        }

        if($request->filled('place')){
            if(!is_string($place) || strlen($place) < 1 || strlen($place) > 64){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Place max 64 characters!']);
            }
        }else{
            $place = null;
        }

        if($request->filled('time')){
            if(!is_string($time) || strlen($time) < 1 || strlen($time) > 16){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Place max 16 characters!']);
            }
        }else{
            $time = null;
        }

        if($request->filled('url')){
            if(!is_string($url) || strlen($url) < 1 || strlen($url) > 512){
                return redirect('/events-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Place max 16 characters!']);
            }
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
        }else{
            $url = null;
        }
        
        $data = [
            'name_sk' => $name_sk,
            'name_en' => $name_en,
            'text_sk' => $text_sk,
            'text_en' => $text_en,
            'place' => $place,
            'time' => $time,
            'date' => $date,
        ];


        $event_id = DB::table('events')->where('e_id', $e_id )->update($data);
        if($event_id){
            return redirect('/events-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly added!']);
        }
        return redirect('/events-admin')->with('err_code', ['type' => 'Warning', 'msg' => 'Any data has been changed!']);

    }

    public function events_delete_action( $e_id = 0 ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($e_id)){
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        $res = (bool) DB::table('events')->where('e_id', $e_id)->delete();

        if($res){
            return redirect('/events-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly deleted!']);
        }

        return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB query error!']);
    }


}
