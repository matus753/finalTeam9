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
        $all_events = DB::table('events')->get();

        $data = [ 
                'title' => $this->module_name, 
                'events' => $all_events
            ];

        return view('intranet::events/events_all', $data);
    }

    public function events_add(){    

        $data = [
            'title' => $this->module_name,
        ];
        return view('intranet::events/events_add', $data);
    }

    public function events_add_action( Request $request ){
        $name_sk = $request->input('title_sk');
        $name_en = $request->input('title_en');
        $text_sk = $request->input('sk_text');
        $text_en = $request->input('en_text');
        $place = $request->input('place');
        $time = $request->input('time');
        $date = $request->input('date');
        $type = $request->input('type');
        $url = $request->input('link');

        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();
        $link = null;

        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://'.ltrim($url, '/');
        }
        if( isset($url) && !empty($url) ){
            $link = $url;
        }else{
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
        }
        //debug($link, true);
        /*if($file) {
            $allowed_types = explode(',', config('events_admin.events_allowed_types'));

            $valid = false;
            foreach($allowed_types as $a){
                if($a == explode('.', $file->hashName())[1]){
                    $valid = true;
                }
            }
            
            if($valid == false){
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad file type!']);
            }  
            $file->store('/public/events/');
            $file_name = $file->hashName();
        }else{
            $file_name = null;
        }*/
            
        $data = [
            'name_sk' => $name_sk,
            'name_en' => $name_en,
            'text_sk' => $text_sk,
            'text_en' => $text_en,
            'place' => $place,
            'time' => $time,
            'date' => $date,
            'url' => $link
        ];
    
        
        $event_id = DB::table('events')->insertGetId($data);
        if($event_id){
            return redirect('/events-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly added!']);
        }
        return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
    }

    public function events_edit( $e_id = 0 ){
        if(!is_numeric($e_id)){
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $events = DB::table('events')->where('e_id', $e_id)->first();

        $data = [
            'events' => $events,
            'title' => $this->module_name,
        ];

        return view('intranet::events/events_edit', $data);
    }

    public function events_edit_action( $e_id = 0, Request $request){
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
        $type = $request->input('type');
        $url = $request->input('link');
        $file = $request->file('file');

        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();
        
        $data = [
            'name_sk' => $name_sk,
            'name_en' => $name_en,
            'text_sk' => $text_sk,
            'text_en' => $text_en,
            'place' => $place,
            'time' => $time,
            'date' => $date,
        ];

        
        $link = null;

        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://'.ltrim($url, '/');
        }
        if( isset($url) && !empty($url) ){
            $link = $url;
            $data['url'] = $link ;
        }else{
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
        }
       
        if($file){
            $allowed_types = explode(',', config('events_admin.events_allowed_types'));

            $valid = false;
            foreach($allowed_types as $a){
                if($a == explode('.', $file->hashName())[1]){
                    $valid = true;
                }
            }

            if($valid){
                $data['image'] = $file->hashName();
            }
        }
       
        if($file){
            $file_to_delete = DB::table('events')->where('e_id', $e_id)->first();
            $path = base_path('storage/app/public/events/');
            unlink($path.$file_to_delete->hash_name);
            

        }

        $event_id = DB::table('events')->where('e_id', $e_id )->update($data);
        
        if($event_id){
            return redirect('/events-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly added!']);
        }
        return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);

    }

    public function events_delete_action( $e_id = 0 ){
        if(!is_numeric($e_id)){
            return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        $path = base_path('storage/app/public/events/');
        
        $res = DB::table('events')->where('e_id', $e_id)->first();
    
        $res = (bool) DB::table('events')->where('e_id', $e_id)->delete();

        if($res){
            return redirect('/events-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly deleted!']);
        }

        return redirect('/events-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB query error!']);
    }


}
