<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Config\Repository;

class Intranet extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function intranet(){
		$data = [ 'title' => $this->module_name ];
		
        return view('intranet::intranet', $data);
    }


    /******************************************
                        NEWS
    ******************************************/
    public function news_all(){
        
        $all_news = DB::table('news')->get();
        $pagination_items = DB::table('settings')->value('pagination_count');
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
                'pagination_items' => $pagination_items
            ];
        return view('intranet::news/news_all', $data);
    }
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               NEWS ADD            /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    public function news_add(){

        $types = config('news_admin.types');
        $file_max_size = DB::table('settings')->value('file_max_size');

        $hash_id = uniqid();

        $data = [
            'title' => $this->module_name,
            'types' => $types,
            'hash_id' => $hash_id,
            'file_max_size' => $file_max_size
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
        
        $res = (bool) DB::table('news')->insert($data);

        if($res){
            return redirect('/news-admin')->with('return_msg', 'success');
        }

        return redirect('/news-admin')->with('return_msg', 'error_bad_insertion');
    }

    public function news_set_pagination_action( Request $request ){
        $pagination_count = $request->input('pagination_items');
        if(is_numeric($pagination_count)){
            DB::table('settings')->where('settings_id', 1)->update(['pagination_count' => $pagination_count]);
            return back();
        }else{
            return back();
        }
        return back();  
    }

    public function news_images_upload( Request $request, Response $response ){
        // to do remove bad string , check img allowed types
        $hash_name = $request->input('news_id_hash');
        $image = $request->file('image');

        if(news_create_folder($hash_name) && $image){
            $image->store('/public/news/'.$hash_name);
            $response->link = asset('/storage/news/'.$hash_name.'/'.$image->hashName());
            return stripslashes(json_encode($response));
        }
        else{
            echo json_encode('UPLOAD ERROR');
        }
    }

    public function news_file_upload( Request $request, Response $response ){
        // to do remove bad string
        $hash_name = $request->input('news_id_hash');
        $image = $request->file('attachment');

        if(news_create_folder($hash_name) && $image){
            $image->store('/public/news/'.$hash_name);
            $response->link = asset('/storage/news/'.$hash_name.'/'.$image->hashName());
            return stripslashes(json_encode($response));
        }
        else{
            echo json_encode('UPLOAD ERROR');
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               NEWS EDIT           /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    public function news_edit( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/news-admin')->with('return_msg', 'error_bad_item');
        }

        $item = DB::table('news')->where('id', $id)->first();
        $types = config('news_admin.types');
        $file_max_size = DB::table('settings')->value('file_max_size');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types,
            'file_max_size' => $file_max_size
        ];
       
        return view('intranet::news/news_edit', $data);
    }

    public function news_edit_action( $id = 0, Request $request ){
        if(!is_numeric($id)){
            return redirect('/news-admin')->with('return_msg', 'error_bad_item');
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
            return redirect('/news-admin')->with('return_msg', 'success');
        }

        return redirect('/news-admin')->with('return_msg', 'error_bad_insertion');

    }

    public function news_delete_action( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/news-admin')->with('return_msg', 'error_bad_item');
        }

        $res = (bool) DB::table('news')->where('id', $id)->delete();
        if($res){
           return redirect('/news-admin')->with('return_msg', 'success');
        }
        return redirect('/news-admin')->with('return_msg', 'error_bad_query');
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               PROJECTS            /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    public function projects_all(){
        
        $all_projects = DB::table('project')->get();

        $data = [ 
                'title' => $this->module_name, 
                'projects' => $all_projects 
            ];
        return view('intranet::study/projects_all', $data);
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               PROJECTS ADD        /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////


    public function projects_add(){

        $types = config('projects_admin.types');

        $data = [
            'title' => $this->module_name,
            'types' => $types
        ];
        return view('intranet::study/projects_add', $data);
    }

    public function projects_add_action( Request $request ){
        // TODO REMOVE BAD STRING

        $type = $request->input('type');
        $number = $request->input('id_number');
        $titleEN = $request->input('title_en');
        $titleSK = $request->input('title_sk');
        $duration = $request->input('duration');
        $coordinator = $request->input('coordinator');
        $partners = $request->input('partners');
        $web = $request->input('web');
        $iCode = $request->input('iCode');
        $annotationEN = $request->input('annotationEN');
        $annotationSK = $request->input('annotationSK');
        

        $data = [
            'projectType' => $type,
            'number' => $number,
            'titleSK' => $titleSK,
            'titleEN' => $titleEN,
            'duration' => $duration,
            'coordinator' => $coordinator,
            'partners' => $partners,
            'web' => $web,
            'internalCode' => $iCode,
            'annotationSK' => $annotationSK,
            'annotationEN' => $annotationEN
        ];
       
        $res = (bool) DB::table('project')->insert($data);
        if($res){
            return redirect('/projects-admin')->with('return_msg', 'success');
        }

        return redirect('/projects-admin')->with('return_msg', 'error_bad_insertion');
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               PROJECTS EDIT       /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    public function projects_edit( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/news-admin')->with('return_msg', 'error_bad_item');
        }

        $item = DB::table('project')->where('id', $id)->first();
        $types = config('projects_admin.types');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types
        ];

        return view('intranet::study/projects_edit', $data);
    }

    public function projects_edit_action( $id = 0, Request $request ){
        if(!is_numeric($id)){
            return redirect('/projects-admin')->with('return_msg', 'error_bad_item');
        }

        $type = $request->input('type');
        $number = $request->input('id_number');
        $titleEN = $request->input('title_en');
        $titleSK = $request->input('title_sk');
        $duration = $request->input('duration');
        $coordinator = $request->input('coordinator');
        $partners = $request->input('partners');
        $web = $request->input('web');
        $iCode = $request->input('iCode');
        $annotationEN = $request->input('annotationEN');
        $annotationSK = $request->input('annotationSK');
        

        $data = [
            'projectType' => $type,
            'number' => $number,
            'titleSK' => $titleSK,
            'titleEN' => $titleEN,
            'duration' => $duration,
            'coordinator' => $coordinator,
            'partners' => $partners,
            'web' => $web,
            'internalCode' => $iCode,
            'annotationSK' => $annotationSK,
            'annotationEN' => $annotationEN
        ];

        $res = (bool) DB::table('project')->where('id', $id)->update($data);

        if($res){
            return redirect('/projects-admin')->with('return_msg', 'success');
        }

        return redirect('/projects-admin')->with('return_msg', 'error_bad_insertion');

    }

    public function projects_delete_action( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/projects-admin')->with('return_msg', 'error_bad_item');
        }

        $res = (bool) DB::table('project')->where('id', $id)->delete();
        if($res){
           return redirect('/projects-admin')->with('return_msg', 'success');
        }
        return redirect('/projects-admin')->with('return_msg', 'error_bad_query');
    }


    /* END PROJECTS */





    /* MEDIA */

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
       

        $titleSK = $request->input('title_sk');
        $titleEN = $request->input('title_en');
        $media = $request->input('media');
        $date = $request->input('date');
        $type = $request->input('type');

        $link = null;
        $file = null;
        $file_name = null;
        $hash_name = null;

        if($type == 'link'){
            $link = $request->input('link');
        }elseif($type == 'server'){
            $file = $request->file('file');
            if($file){
                $file_name = $file->getClientOriginalName();
                $hash_name = explode(".",$file->hashName())[0];
            }   
        }elseif($type == 'both'){
            $file = $request->file('file');
            if($file){
                $file_name = $file->getClientOriginalName();
                $hash_name = explode(".",$file->hashName())[0];
            }
            $link = $request->input('link');
        }else{
            $link = null;
            $file_name = null;
            $hash_name = null;
        }
        
        $data = [
            'date' => $date,
            'title' => $titleSK,
            'media' => $media,
            'type' => $type,
            'url' => $link,
            'filename' => $file_name,
            'file_hash_name' => $hash_name,
            'title_EN' => $titleEN
        ];
        
        $res = (bool) DB::table('media')->insert($data);
        if($res){
            if($file){
                $file->store('media');
            }
            return redirect('/media-admin')->with('return_msg', 'success');
        }
        return redirect('/media-admin')->with('return_msg', 'error_bad_insert');

    }

    public function media_edit( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/media-admin')->with('return_msg', 'error_bad_item');
        }

        $media = DB::table('media')->where('id', $id)->first();
        $types = config('media_admin.types');

        $data = [
            'media' => $media,
            'title' => $this->module_name,
            'types' => $types
        ];

        return view('intranet::media/media_edit', $data);
    }


    public function media_delete_action( $id = 0 ){
        if(!is_numeric($id)){
            return redirect('/media-admin')->with('return_msg', 'error_bad_item');
        }

        $res = (bool) DB::table('media')->where('id', $id)->delete();

        if($res){
           return redirect('/media-admin')->with('return_msg', 'success');
        }

        return redirect('/media-admin')->with('return_msg', 'error_bad_query');
    }
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               VIDEOS              /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    public function videos_all(){
        $videos = DB::table('video_gallery')->get();

        $data = [
            'videos' => $videos,
            'title' => $this->module_name
        ];

        return view('intranet::videos/videos_all');
    }

    public function videos_add(){

        $types = config('videos_admin.types');

        $data = [
            'title' => $this->module_name,
            'types' => $types
        ];

        return view('intranet::videos/videos_add');
    }

    public function videos_add_action( Request $request ){

        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');
        $link = $request->input('link');
        $type = $request->input('type');
        
        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'url' => $link,
            'type' => $type,
        ];

        $res = (bool)DB::table('video_gallery')->insert($data);
        if($res){
            return back();
        }
        return back();
    }

    public function videos_edit($id = 0){
        if(!is_numeric($id)){
            return back();
        }

        $video = DB::table('video_gallery')->where('id', $id)->first();

        $data = [
            'title' => $this->module_name,
            'video' => $video
        ];

        return view('intranet::videos/videos_edit');
    }

    public function videos_edit_action( $id = 0, Request $request ){
        if(!is_numeric($id)){
            return back();
        }
        
        $title_sk = $request->input('title_sk');
        $title_en = $request->input('title_en');
        $link = $request->input('link');
        $type = $request->input('type');
        
        $data = [
            'title_SK' => $title_sk,
            'title_EN' => $title_en,
            'url' => $link,
            'type' => $type,
        ];

        $res = (bool)DB::table('video_gallery')->where('id', $id)->insert($data);
        if($res){
            return back();
        }
        return back();
    }

    public function videos_delete_action($id = 0){
        // to do error msg
        if(!is_numeric($id)){
            return back();
        }

        $res = (bool) DB::table('video_gallery')->where('id', $id)->delete();

        if($res){
           return redirect('/videos-admin')->with('return_msg', 'success');
        }

        return redirect('/videos-admin')->with('return_msg', 'error_bad_query');
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////               PRIVATE             /////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
}
