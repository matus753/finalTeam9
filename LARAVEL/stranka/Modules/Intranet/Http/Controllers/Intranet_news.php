<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class Intranet_news extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function news_all(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $all_news = DB::table('news')->get();
        $all_news = (!$all_news) ? [] : $all_news;

        foreach($all_news as $a){
            if($a->type == 0){
                $a->type = 'Propagácia';
            }
            if($a->type == 1){
                $a->type = 'Oznamy';
            }
            if($a->type == 2){
                $a->type = 'Zo života fakulty';
            }

            if ($a->date_expiration <= time()) {
                $a->exp = 'expired';
            } else {
                $a->exp = 'current';
            }
        }

        $data = [ 
            'title' => $this->module_name, 
            'news' => $all_news
        ];
        return view('intranet::news/news_all', $data);
    }

    public function news_add(){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $types = config('news_admin.types');
        $hash_id = md5(uniqid());

        $data = [
            'title' => $this->module_name,
            'types' => $types,
            'hash_id' => $hash_id,
        ];
    
        return view('intranet::news/news_add', $data);
    }

    public function news_add_action( Request $request ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $hash_id = $request->input('news_id_hash');
        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
        $preview_sk = $request->input('preview_sk');
        $preview_en = $request->input('preview_en');
        $editor_sk =$request->input('editor_content_sk');
        $editor_en =$request->input('editor_content_en');
        $type = $request->input('type');
        $exp = $request->input('expiration');
        
        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        if(!is_numeric($type)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max length 256 characters']);
        }

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max length 256 characters']);
        }

        
        if(!is_string($preview_sk) || strlen($preview_sk) < 1 || strlen($preview_sk) > 65535){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Preview text max length 65535 characters']);
        }
        
        if(!is_string($preview_en) || strlen($preview_en) < 1 || strlen($preview_en) > 65535){
                return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Preview text max length 65535 characters']);
        }

        if($request->filled('editor_sk')){
            if(!is_string($editor_sk) || strlen($editor_sk) < 1 || strlen($editor_sk) > 4294967295){
                return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Page text longer than can be saved!']);
            }
        }else{
            $editor_sk = null;
        }

        if($request->filled('editor_en')){
            if(!is_string($editor_en) || strlen($editor_en) < 1 || strlen($editor_en) > 4294967295){
                return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Page text longer than can be saved!']);
            }
        }else{
            $editor_en = null;
        }

        if(isset($exp) && !empty($exp)){
            $exp = strtotime($exp);
        }else{
            $exp = time();
        }

        news_create_folder($hash_id);
        $image = $request->file('image');
        $image_hash_name = null;
        if($image){
            $image->store('public/news/'.$hash_id);
            $image_hash_name = $image->hashName();
        }else{
            $image_hash_name = config('news_admin.default_image');
        }

        $data = [
            'hash_id' => $hash_id,
            'title_en' => $title_en,
            'title_sk' => $title_sk,
            'image_hash_name' => $image_hash_name,
            'preview_sk' => $preview_sk,
            'preview_en' => $preview_en,
            'editor_content_sk' => $editor_sk,
            'editor_content_en' => $editor_en,
            'date_created' => time(),
            'date_expiration' => $exp,
            'type' => $type
        ];
        
        $res = DB::table('news')->insertGetId($data);
        if($res){
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
        /*if($res){
            $add_files = $request->file('add_files');
            $allowed_types = explode(',', config('news_admin.add_files_types_allowed'));
            if($add_files){
                foreach($add_files as $a){
                    $valid = false;
                    foreach($allowed_types as $at){
                        if($at == explode('.', $a->hashName())[1]){
                            $valid = true;
                        }
                    }

                    if($valid){
                        $a->store('public/news/'.$hash_id);
                        $add_files_db[] = [
                            'n_id'      => $res,
                            'file_hash' => $a->hashName(),
                            'file_name' => $a->getClientOriginalName(),
                        ];
                        $res2 = (bool)DB::table('news_dl_files')->insert($add_files_db);
                    }
                    
                }

                
            }
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);*/
    }

    public function news_images_upload( Request $request, Response $response ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $hash_name = $request->input('news_id_hash');
        $image = $request->file('image');

        if(!is_string($hash_name) || strlen($hash_name) < 1 || strlen($hash_name) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'Error', 'msg' => 'Internal server error!']);
        }

        $valid = false;
        $allowed_types = explode(',', config('news_admin.img_types_allowed')); 
        foreach($allowed_types as $at){
            if($at == explode('.', $image->hashName())[1]){
                $valid = true;
            }
        }
        
        if($valid){
            if(news_create_folder($hash_name) && $image){
                $image->store('/public/news/'.$hash_name);
                $response->link = url('/storage/news/'.$hash_name.'/'.$image->hashName());
                return stripslashes(json_encode($response->link));
            }
            else{
                return response()->json(['error' => 'Bad request'], 400);              
            }
        }
        else{
            return response()->json(['error' => 'Bad request'], 400);                      
        }
        return response()->json(['error' => 'Bad request'], 400);          
      
        
    }

    public function news_edit( $n_id = 0 ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($n_id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('news')->where('n_id', $n_id)->first();
        if(!$item){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $items = DB::table('news_dl_files')->where('n_id', $n_id)->get();
        $types = config('news_admin.types');

        $items = (!$items) ? [] : $items;
       
        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types,
            'add_files' => $items,
        ];
      
        return view('intranet::news/news_edit', $data);
    }

    public function news_edit_action( $n_id = 0, Request $request ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($n_id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $hash_id = $request->input('news_id_hash');
        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
        $preview_sk = $request->input('preview_sk');
        $preview_en = $request->input('preview_en');
        $editor_sk =$request->input('editor_content_sk');
        $editor_en =$request->input('editor_content_en');
        $type = $request->input('type');
        $exp = $request->input('expiration');
        $orig_img = $request->input('orig_img');

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        if(!is_numeric($type)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max length 256 characters']);
        }

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 32){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max length 256 characters']);
        }

        if(!is_string($preview_sk) || strlen($preview_sk) < 1 || strlen($preview_sk) > 65535){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Preview text max length 65535 characters']);
        }

        if(!is_string($preview_en) || strlen($preview_en) < 1 || strlen($preview_en) > 65535){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Preview text max length 65535 characters']);
        }

        if(!is_string($editor_sk) || strlen($editor_sk) < 1 || strlen($editor_sk) > 4294967295){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Page text longer than can be saved!']);
        }

        if(!is_string($editor_en) || strlen($editor_en) < 1 || strlen($editor_en) > 4294967295){
            return redirect('/news-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Page text longer than can be saved!']);
        }

        if(isset($exp) && !empty($exp)){
            $exp = strtotime($exp);
        }else{
            $exp = time();
        }
        
        if($orig_img){
            $image_hash_name = DB::table('news')->where('n_id', $n_id)->select('image_hash_name')->first()->image_hash_name;
        }
        else{
            if($request->hasFile('image')){
                $image = $request->file('image');
                $valid = false;
                
                $allowed_types = explode(',', config('news_admin.img_types_allowed'));
                foreach($allowed_types as $at){
                    if($at == explode('.', $image->hashName())[1]){
                        $valid = true;
                    }
                }
                
                if($valid){
                    $image_hash_name = null;
                    $image->store('public/news/'.$hash_id.'/');
                    $image_hash_name = $image->hashName();
                }
            }else{
                $image_hash_name = config('news_admin.default_image');
            }
        }
           
        $data = [
            'hash_id' => $hash_id,
            'title_en' => $title_en,
            'title_sk' => $title_sk,
            'image_hash_name' => $image_hash_name,
            'preview_sk' => $preview_sk,
            'preview_en' => $preview_en,
            'editor_content_sk' => $editor_sk,
            'editor_content_en' => $editor_en,
            'date_expiration' => $exp,
            'type' => $type
        ];
        
        $res = (bool) DB::table('news')->where('n_id', $n_id)->update($data);

        if($res){
            /*$add_files = $request->file('add_files');
            $allowed_types = explode(',', config('news_admin.add_files_types_allowed'));
            if($add_files != null){
                foreach($add_files as $a){
                    $valid = false;
                    foreach($allowed_types as $at){
                        if($at == explode('.', $a->hashName())[1]){
                            $valid = true;
                        }
                    }

                    if($valid){
                        $a->store('public/news/'.$hash_id);
                        $add_files_db[] = [
                            'n_id'      => $res,
                            'file_hash' => $a->hashName(),
                            'file_name' => $a->getClientOriginalName(),
                        ];
                    }
                }
                $res2 = (bool)DB::table('news_dl_files')->insert($add_files_db);
            
                if($res2){
                    return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);
                }else{
                    return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Added files error!']);
                }
            }*/
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);
            
        }

        return redirect('/news-admin')->with('err_code', ['type' => 'Warning', 'msg' => 'Any data has been changed!']);

    }

    public function news_delete_action( $n_id = 0 ){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($n_id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('news')->where('n_id', $n_id)->first();
        if(!$item){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $path = base_path('storage/app/public/news/').$item->hash_id;
        
        $res = (bool) DB::table('news')->where('n_id', $n_id)->delete();
        if($res){
            array_map('unlink', glob("$path/*.*"));
            if(is_dir($path)){
                rmdir($path);
            }
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function news_delete_single_action($nf_id = 0){
        if(!has_permission('reporter')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        if(!is_numeric($nf_id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('news_dl_files')->where('nf_id', $nf_id)->first();
        if(!$item){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $parent = DB::table('news')->where('n_id', $item->n_id)->first();

        $path = base_path('storage/app/public/news/').$parent->hash_id.'/'.$item->file_hash;

        $res = (bool) DB::table('news_dl_files')->where('nf_id', $nf_id)->delete();
        if($res){
            if(is_file($path)){
                unlink($path);
            }
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }
    
}
