<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_media extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('media_admin.name_media');
    }

    public function media_all(){
        if(!has_permission('hr')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $all_media = DB::table('media')->get();
        $all_media = (!$all_media) ? [] : $all_media;

        $data = [ 
                'title' => $this->module_name, 
                'media' => $all_media
            ];

        return view('intranet::media/media_all', $data);
    }

    public function media_add(){    
        if(!has_permission('hr')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $types = config('media_admin.types');

        $data = [
            'title' => $this->module_name,
            'types' => $types
        ];
        return view('intranet::media/media_add', $data);
    }

    public function media_add_action( Request $request ){
        if(!has_permission('hr')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $titleSK = $request->input('title_sk');
        $titleEN = $request->input('title_en');
        $media = $request->input('media');
        $date = $request->input('date');
        $type = $request->input('type');

        if(!is_string($titleSK) || strlen($titleSK) < 1 || strlen($titleSK) > 256){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 256 characters!']);
        }
        if(!is_string($titleEN) || strlen($titleEN) < 1 || strlen($titleEN) > 256){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Anglický nadpis has bad format - max 256 characters!']);
        }
        if(!is_string($media) || strlen($media) < 1 || strlen($media) > 256){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Media has bad format - max 128 characters!']);
        }
        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();

        $link = null;
        $files = null;
        $allowed_types = explode(',', config('media_admin.media_allowed_types'));
        if($type == 'link'){
            $url = $request->input('link');
            if( isset($url) && !empty($url) && is_string($url))  {
                $link = $url;
                $parsed = parse_url($url);
                if (empty($parsed['scheme'])) {
                    $link = 'http://'.ltrim($url, '/');
                }
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
            }
        }elseif($type == 'server'){
            $files = $request->file('files');
            $files = (!$files) ? [] : $files;
            foreach($files as $f){
                $valid = false;
                foreach($allowed_types as $a){
                    if($a == explode('.', $f->hashName())[1]){
                        $valid = true;
                    }
                }
            }
            if($valid == false){
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad file type!']);
            }  
        }elseif($type == 'both'){
            $files = $request->file('files');
            $files = (!$files) ? [] : $files;
            $url = $request->input('link');

            if( isset($url) && !empty($url) ){
                $link = $url;
                $parsed = parse_url($url);
                if (empty($parsed['scheme'])) {
                    $link = 'http://'.ltrim($url, '/');
                }
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
            }

            foreach($files as $f){
                $valid = false;
                foreach($allowed_types as $a){
                    if($a == explode('.', $f->hashName())[1]){
                        $valid = true;
                    }
                }
            }
            if($valid == false){
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad file type!']);
            }  
        }else{
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Type error!']);
        }
        
        $data = [
            'date' => $date,
            'title' => $titleSK,
            'media' => $media,
            'type' => $type,
            'url' => $link,
            'title_EN' => $titleEN
        ];

        $media_id = DB::table('media')->insertGetId($data);
        if($media_id){
            if($files && is_array($files)){
                foreach($files as $f){
                    $file_name = $f->getClientOriginalName();
                    $hash_name = $f->hashName();
                    $size = $f->getClientSize();

                    $data_files = [
                        'm_id' => $media_id,
                        'file_name' => $file_name,
                        'hash_name' => $hash_name,
                    ];
                    
                    $files_insert = (bool)DB::table('media_files')->insert($data_files);
                    if($files_insert){
                        if( isset($file_name) && !empty($file_name) && isset($hash_name) && !empty($hash_name) && isset($size) && $size > 0){
                            $f->store('/public/media/');
                        }else{
                            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'File store error!']);
                        } 
                    }else{
                        return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert file error! '.$file_name]);
                    }
                } 
            }
            return redirect('/media-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly added!']);
        }
        return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
    }

    public function media_edit( $id = 0 ){
        if(!has_permission('hr')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($id)){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $media = DB::table('media')->where('m_id', $id)->first();
        if(!$media){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $files = DB::table('media_files')->where('m_id', $id)->get();
        $files = (!$files) ? [] : $files;
    
        $types = config('media_admin.types');

        $data = [
            'media' => $media,
            'files' => $files,
            'title' => $this->module_name,
            'types' => $types
        ];

        return view('intranet::media/media_edit', $data);
    }

    public function media_edit_action( Request $request, $m_id = 0 ){
        if(!has_permission('hr')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($m_id)){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $titleSK = $request->input('title_sk');
        $titleEN = $request->input('title_en');
        $media = $request->input('media');
        $date = $request->input('date');
        $type = $request->input('type');
        $has_files = $request->input('has_files');

        if(!is_string($titleSK) || strlen($titleSK) < 1 || strlen($titleSK) > 256){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Slovenský nadpis has bad format - max 256 characters!']);
        }
        if(!is_string($titleEN) || strlen($titleEN) < 1 || strlen($titleEN) > 256){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Anglický nadpis has bad format - max 256 characters!']);
        }
        if(!is_string($media) || strlen($media) < 1 || strlen($media) > 256){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Param Media has bad format - max 128 characters!']);
        }
        if(!is_numeric($has_files)){
            return redirect('/media-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Error somewhere!']);
        }
        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();


        $link = null;
        $files = null;
        $allowed_types = explode(',', config('media_admin.media_allowed_types'));
        if($type == 'link'){
            $url = $request->input('link');
            if( isset($url) && !empty($url) && is_string($url))  {
                $link = $url;
                $parsed = parse_url($url);
                if (empty($parsed['scheme'])) {
                    $link = 'http://'.ltrim($url, '/');
                }
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
            }
        }elseif($type == 'server'){
            $files = $request->file('files');
            $files = (!$files) ? [] : $files;
            if(count($files) > 0){
                $valid = false;
                foreach($files as $f){
                    $valid = false;
                    foreach($allowed_types as $a){
                        if($a == explode('.', $f->hashName())[1]){
                            $valid = true;
                        }
                    }
                }
                if($valid == false){
                    return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad file type!']);
                }  
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'No files added!']);
            }
            
        }elseif($type == 'both'){
            $files = $request->file('files');
            $files = (!$files) ? [] : $files;
            $url = $request->input('link');

            if( isset($url) && !empty($url) ){
                $link = $url;
                $parsed = parse_url($url);
                if (empty($parsed['scheme'])) {
                    $link = 'http://'.ltrim($url, '/');
                }
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
            }

            foreach($files as $f){
                $valid = false;
                foreach($allowed_types as $a){
                    if($a == explode('.', $f->hashName())[1]){
                        $valid = true;
                    }
                }
            }
            if($valid == false){
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad file type!']);
            }  
        }else{
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Type error!']);
        }
        
        $data = [
            'date' => $date,
            'title' => $titleSK,
            'media' => $media,
            'type' => $type,
            'url' => $link,
            'title_EN' => $titleEN
        ];

        $media_id = DB::table('media')->where('m_id', $m_id )->update($data);

        $files_to_delete = DB::table('media_files')->where('m_id', $m_id)->get();
        
        $path = base_path('storage/app/public/media/');
        foreach($files_to_delete as $f){
            if(is_file($path.$f->hash_name)){
                unlink($path.$f->hash_name);
            }
        }
        
        DB::table('media_files')->where('m_id', $m_id)->delete();

        if($files){
            if($files && is_array($files)){
                foreach($files as $f){
                    $file_name = $f->getClientOriginalName();
                    $hash_name = $f->hashName();
                    $size = $f->getClientSize();

                    $data_files = [
                        'm_id' => $m_id,
                        'file_name' => $file_name,
                        'hash_name' => $hash_name,
                    ];
                    
                    $files_insert = (bool)DB::table('media_files')->insert($data_files);
                    if($files_insert){
                        if( isset($file_name) && !empty($file_name) && isset($hash_name) && !empty($hash_name) && isset($size) && $size > 0){
                            $f->store('/public/media/');
                        }else{
                            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'File store error!']);
                        } 
                    }else{
                        return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert file error! '.$file_name]);
                    }
                } 
            }
            
        }

        return redirect('/media-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly changed!']);
    }

    public function media_delete_action( $id = 0 ){
        if(!has_permission('hr')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        
        if(!is_numeric($id)){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        
        
        $res = (bool) DB::table('media')->where('m_id', $id)->delete();
        $files_to_delete = DB::table('media_files')->where('m_id', $id)->get();
        $delete = (bool) DB::table('media_files')->where('m_id', $id)->delete();

        $path = base_path('storage/app/public/media/');
        foreach($files_to_delete as $f){
            if(is_file($path.$f->hash_name)){
                unlink($path.$f->hash_name);
            }
        }

        if($delete){
            return redirect('/media-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly deleted!']);
        }

        return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB query error!']);
    }
}
