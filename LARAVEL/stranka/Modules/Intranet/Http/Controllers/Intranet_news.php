<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
        $hash_id = uniqid();

        $data = [
            'title' => $this->module_name,
            'types' => $types,
            'hash_id' => $hash_id,
        ];
    
        return view('intranet::news/news_add', $data);
    }

    public function news_add_action( Request $request ){
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
        
        $res = DB::table('news')->insertGetId($data);

        if($res){
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
                    
                /*if($res2){
                    return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
                }*/
                    //debug($add_files, true);
                }

                
            }
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function news_images_upload( Request $request, Response $response ){
        $hash_name = $request->input('news_id_hash');
        $image = $request->file('image');
        
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
                echo json_encode('UPLOAD ERROR');
            }
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
        $items = DB::table('news_dl_files')->where('n_id', $id)->get();
        $types = config('news_admin.types');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types,
            'add_files' => $items,
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
        $orig_img = $request->input('orig_img');

        if(isset($exp) && !empty($exp)){
            $exp = strtotime($exp);
        }else{
            $exp = time();
        }
        
     
        if($orig_img){
            $image_hash_name = DB::table('news')->where('id', $id)->select('image_hash_name')->first()->image_hash_name;
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
            'date_created' => time(),
            'date_expiration' => $exp,
            'type' => $type
        ];
        
        $res = (bool) DB::table('news')->where('id', $id)->update($data);

        if($res){
            $add_files = $request->file('add_files');
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
            }
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);
            
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

    public function news_delete_single_action($nf_id = 0){
        if(!is_numeric($nf_id)){
            return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('news_dl_files')->where('nf_id', $nf_id)->first();
        $parent = DB::table('news')->where('id', $item->n_id)->first();

        $path = base_path('storage/app/public/news/').$parent->hash_id.'/'.$item->file_hash;

        $res = (bool) DB::table('news_dl_files')->where('nf_id', $nf_id)->delete();
        if($res){
            unlink($path);
            return redirect('/news-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/news-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }
    
}
