<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Config\Repository;

class Intranet_news extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function news_all(){
        
        $all_news = DB::table('news')->get();

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
        }

        $data = [ 
                'title' => $this->module_name, 
                'news' => $all_news,
            ];
        return view('intranet::news/news_all', $data);
    }

    public function news_add(){
        $types = config('news_admin.types');
       // $file_max_size = DB::table('settings')->value('file_max_size');

        $hash_id = uniqid();

        $data = [
            'title' => $this->module_name,
            'types' => $types,
            'hash_id' => $hash_id,
            //'file_max_size' => $file_max_size
        ];
    
        return view('intranet::news/news_add', $data);
    }

    public function news_add_action( Request $request ){
        // TODO REMOVE BAD STRING
        $hash_id = $request->input('news_id_hash');
        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
        $preview_sk = $request->input('preview_sk');
        $preview_en = $request->input('preview_en');
        $editor_sk =$request->input('editor_content_sk');
        $editor_en =$request->input('editor_content_en');
        $type = $request->input('type');
        $exp = $request->input('expiration');

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
        
        $res = (bool) DB::table('news')->insert($data);

        if($res){
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }

        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function news_images_upload( Request $request, Response $response ){
        // to do remove bad string , check img allowed types
        $hash_name = $request->input('news_id_hash');
        $image = $request->file('image');
       
        if(news_create_folder($hash_name) && $image){
            $image->store('/public/news/'.$hash_name);
            $response->link = '/storage/news/'.$hash_name.'/'.$image->hashName();
            return stripslashes(json_encode($response->link));
        }
        else{
            echo json_encode('UPLOAD ERROR');
        }
    }

    public function news_edit( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('news')->where('id', $id)->first();
        $types = config('news_admin.types');
       // $file_max_size = DB::table('settings')->value('file_max_size');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types,
            //'file_max_size' => $file_max_size
        ];
       
        return view('intranet::news/news_edit', $data);
    }

    public function news_edit_action( $id = 0, Request $request ){
        if(!is_numeric($id)){
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
       

        if(isset($exp) && !empty($exp)){
            $exp = strtotime($exp);
        }else{
            $exp = time();
        }

        $image = $request->file('image');
        $image_hash_name = null;
        if($image){
            $image->store('public/news');
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
        
        $res = (bool) DB::table('news')->where('id', $id)->update($data);

        if($res){
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }

        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);

    }

    public function news_delete_action( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('news')->where('id', $id)->first();
        $path = base_path('storage/app/public/news/').$item->hash_id;
        
        $res = (bool) DB::table('news')->where('id', $id)->delete();
        if($res){
            array_map('unlink', glob("$path/*.*"));
            rmdir($path);
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

}
