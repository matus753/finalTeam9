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
        $all_media = DB::table('media')->get();

        $data = [ 
                'title' => $this->module_name, 
                'media' => $all_media
            ];

        return view('intranet::media/media_all', $data);
    }

    public function media_add(){    
        $types = config('media_admin.types');

        $data = [
            'title' => $this->module_name,
            'types' => $types
        ];
        return view('intranet::media/media_add', $data);
    }

    public function media_add_action( Request $request ){
        // TODO remove bad string
        $titleSK = $request->input('title_sk');
        $titleEN = $request->input('title_en');
        $media = $request->input('media');
        $date = $request->input('date');
        $type = $request->input('type');
        
        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();

        $link = null;
        $files = null;
        $allowed_types = explode(',', config('media_admin.media_allowed_types'));
        if($type == 'link'){
            $url = $request->input('link');
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
            if( isset($url) && !empty($url) ){
                $link = $url;
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
            }
        }elseif($type == 'server'){
            $files = $request->file('files');
            
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
            $url = $request->input('link');
            if( isset($url) && !empty($url) ){
                $link = $url;
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
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
        if(!is_numeric($id)){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $media = DB::table('media')->where('m_id', $id)->first();
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

    public function media_edit_action( $m_id = 0 ){
        if(!is_numeric($id)){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $titleSK = $request->input('title_sk');
        $titleEN = $request->input('title_en');
        $media = $request->input('media');
        $date = $request->input('date');
        $type = $request->input('type');
        
        $date = (isset($date) && !empty($date)) ? strtotime($date) : time();

        $link = null;
        $files = null;
        $allowed_types = explode(',', config('media_admin.media_allowed_types'));
        if($type == 'link'){
            $url = $request->input('link');
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
            if( isset($url) && !empty($url) ){
                $link = $url;
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
            }
        }elseif($type == 'server'){
            $files = $request->file('files');
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
            $url = $request->input('link');
            if( isset($url) && !empty($url) ){
                $link = $url;
            }else{
                return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'URL not defined!']);
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

        $files_to_delete = DB::table('media_files')->where('m_id', $id)->get();
        $path = base_path('storage/app/public/media/');
        foreach($files_to_delete as $f){
            unlink($path.$f->hash_name);
        }
        
        DB::table('media_files')->where('m_id', $m_id)->delete();

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

    public function media_delete_action( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        $path = base_path('storage/app/public/media/');
        
        $res = (bool) DB::table('media')->where('m_id', $id)->delete();
        $files_to_delete = DB::table('media_files')->where('m_id', $id)->get();
        $delete = (bool) DB::table('media_files')->where('m_id', $id)->delete();

        foreach($files_to_delete as $f){
            unlink($path.$f->hash_name);
        }

        if($res && $delete){
            return redirect('/media-admin')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly deleted!']);
        }

        return redirect('/media-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB query error!']);
    }
}
