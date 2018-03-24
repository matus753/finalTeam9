<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_photos extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function photos_all(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $locale = session()->get('locale');
        if($locale == 'sk'){
            $photos = DB::table('photo_gallery')->select('pg_id', 'title_SK as title', 'date', 'activated')->groupBy('folder')->get();
        }else{
            $photos = DB::table('photo_gallery')->select('pg_id', 'title_EN as title', 'date', 'activated')->groupBy('folder')->get();
        }

        $data = [
            'photos' => $photos,
            'title' => $this->module_name,
            'activation' => config('photos_admin.activation')
        ];
        
        return view('intranet::photos/photos_all', $data);
    }

    public function photos_add(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $data = [
            'title' => $this->module_name,
        ];

        return view('intranet::photos/photos_add', $data);
    }

    public function photos_add_action( Request $request ){
        if(!has_permission('reporter')){
            return redirect('')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 128){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Title SK bad format - empty string or max 128 characters']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 128){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Title SK bad format - empty string or max 128 characters']);
        }

        $hash_name = md5(uniqid());

        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'folder' => $hash_name,
            'date' => time(),
        ]; 
        
        $res = DB::table('photo_gallery')->insertGetId($data);
        if($res > 0){
            if(photo_gallery_create_folder($hash_name)){
                $data_back = [
                    'title' => $this->module_name,
                    'title_SK' => $title_sk,
                    'title_EN' => $title_en,
                    'hash_name' => $hash_name
                ];
                return redirect('/photos-admin-upload/'.$res)->with('err_code', ['type' => 'success', 'msg' => 'Record inserted successfuly!']);
            }else{
                return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Folder can not be created!']);
            }
        }
        return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB insert error!']);
    }

    public function photos_upload($pg_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($pg_id) || $pg_id == 0){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $gallery = DB::table('photo_gallery')->where('pg_id', $pg_id)->first();

        if($gallery){
            $data = [
                'title' => $this->module_name,
                'gallery' => $gallery
            ];
    
            return view('intranet::photos/photos_upload', $data);
        }else{
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB internal error!']);
        }
        return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB internal error!']);
    }

    public function photos_upload_action(Request $request){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $files = $request->file('file');
        $hash_check = $request->input('hash_check');
        if(!is_string($hash_check) || strlen($hash_check) < 1 || strlen($hash_check) > 64){
            return response()->json(['error' => 'Internal Error'], 400);
        }

        $pg_id = $request->input('id');
        if(!gallery_folder_exists($hash_check)){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'UPLOAD : Internal Server Error!']);
        }

        if(!is_numeric($pg_id) || $pg_id == 0){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'UPLOAD : Internal Server Error!']);
        }

        $allowed_types = explode(',', config('photos_admin.allowed_types'));
        
        if(!empty($files)){
            foreach($files as $f){
                $valid = false;
                
                foreach($allowed_types as $at){
                    $extension = explode('.', $f->hashName());
                    $extension = $extension[count($extension)-1];
                    if($at == $extension){
                        $valid = true;
                    }
                }

                if($valid == false){
                    return response()->json(['error' => 'Bad file type'], 400);
                }
                
                $file_name = $f->getClientOriginalName();
                $hash_name = $f->hashName();
                $size = $f->getClientSize();
                
                
                $data = [
                    'pg_id'     => $pg_id,
                    'file_name' => $file_name,
                    'hash_name' => $hash_name,
                    'date_added'=> time()
                ];

                $file_inserted = (bool)DB::table('photos')->insert($data);
                if($file_inserted){
                    if( isset($file_name) && !empty($file_name) && isset($hash_name) && !empty($hash_name) && isset($size) && $size > 0){
                        $f->store('/public/gallery/'.$hash_check);
                    }else{
                        return response()->json(['error' => 'Upload crashed'], 400);
                    } 
                }else{
                    return response()->json(['error' => 'Database error'], 400);
                }

            }   
        }else{
            return response()->json(['error' => 'No files found'], 400);
        }
        
    }

    public function photos_edit($pg_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($pg_id)){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $gallery_params = DB::table('photo_gallery')->where('pg_id', $pg_id)->first();
        if(!$gallery_params){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $photos = DB::table('photos')->where('pg_id', $pg_id)->get();
        $photos = (!$photos) ? [] : $photos;

        $data = [
            'title'     => $this->module_name,
            'gallery'   => $gallery_params,
            'photos'    => $photos
        ];
       
        return view('intranet::photos/photos_edit', $data);
    }

    public function photos_edit_action( $pg_id = 0, Request $request ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($pg_id)){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        
        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 128){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Title SK bad format - empty string or max 128 characters']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 128){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Title SK bad format - empty string or max 128 characters']);
        }

        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en
        ];
       
        $res = (bool)DB::table('photo_gallery')->where('pg_id', $pg_id)->update($data);
        if($res){
            return redirect('/photos-admin-upload/'.$pg_id)->with('err_code', ['type' => 'success', 'msg' => 'Record updated!']);
        }
        return redirect('/photos-admin')->with('err_code', ['type' => 'Warning', 'msg' => 'Any data has been changed!']);
    }

    // OK OK OK OK OK OK OK 
    public function photos_delete_action($pg_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($pg_id)){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        // files on disc
        $files_to_delete = DB::table('photos')->where('pg_id', $pg_id)->get();
        $folder = DB::table('photo_gallery')->where('pg_id', $pg_id)->first();
        if($folder){
            $path = base_path('storage/app/public/gallery/'.$folder->folder.'/');   
            $files_to_delete = (!$files_to_delete) ? [] : $files_to_delete;
        }else{
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        // files in db
        $res = (bool) DB::table('photo_gallery')->where('pg_id', $pg_id)->delete();
        $res_files = (bool) DB::table('photos')->where('pg_id', $pg_id)->delete();

        if($res){
            foreach($files_to_delete as $f){
                if(is_file($path.$f->hash_name)){
                    unlink($path.$f->hash_name);
                }
            }
            if(is_dir($path)){
                rmdir($path);
            }
            return redirect('/photos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Record deleted successfuly!']);
        }
        return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB delete error!']);
    }

    public function photos_single_delete_action($p_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($p_id) || $p_id == 0){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $file_to_delete = DB::table('photos')->where('p_id', $p_id)->first();
        if($file_to_delete){
            $folder = DB::table('photo_gallery')->where('pg_id', $file_to_delete->pg_id)->first();
            $res_files = (bool) DB::table('photos')->where('p_id', $p_id)->delete();
            $path = base_path('storage/app/public/gallery/'.$folder->folder.'/'.$file_to_delete->hash_name); 
            if(is_file($path)){
                unlink($path); 
            }
            return redirect('/photos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted successfuly!']); 
        }else{
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']); 
        }
        return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']); 
           
    }

    public function photos_activate_action($pg_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        
        if(!is_numeric($pg_id) || $pg_id == 0){
            return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        // ak je aktivne tak deaktivuj inak aktivuj
        $item = DB::table('photo_gallery')->where('pg_id', $pg_id)->select('activated')->first();

        if($item->activated){
            DB::table('photo_gallery')->where('pg_id', $pg_id)->update(['activated' => 0]);
            return redirect('/photos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deactivated!']);
        }else{
            DB::table('photo_gallery')->where('pg_id', $pg_id)->update(['activated' => 1]);
            return redirect('/photos-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item activated!']);
        }
        return redirect('/photos-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
    }
}
