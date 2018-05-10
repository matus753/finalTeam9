<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_documents extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function documents_all(){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        storage_deletor('documents');
        $categories = DB::table('documents_categories')->get();
        $categories = (!$categories) ? [] : $categories;


        $data = [ 
                'title' => $this->module_name, 
                'categories' => $categories,

        ];
        return view('intranet::documents/documents_all', $data);
    }

    public function show_document($d_id = 0){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($d_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item error!']);
        }

        $document = DB::table('documents')->where('d_id', $d_id)->first();
        if(!$document){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item error!']);
        }

        $d_files = [];
        $category_hash = DB::table('documents_categories')->where('dc_id', $document->dc_id )->first();
        $d_files = DB::table('documents_files')->where('hash_id', $document->hash_name )->get();
        
        $data = [
            'title' => $this->module_name, 
            'document' => $document,
            'files' => $d_files,
            'category_hash' => $category_hash
        ];
        
        return view('intranet::documents/show_document', $data);
    
    }

    public function documents_add_category(){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $data = [
            'title' => $this->module_name,
        ];
    
        return view('intranet::documents/documents_add_category', $data);
    }

    public function documents_add_category_action( Request $request ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $title_sk = $request->input('title_sk');
        $category_text = $request->input('cat_text');
        
        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 64 characters!']);
        }

        $hash_id = md5(uniqid());
        documents_category_create_folder($hash_id);

        $data = [
            'hash_name' => $hash_id,
            'name_sk' => $title_sk,
            'category_text' => $category_text
        ];
        
        $res = DB::table('documents_categories')->insertGetId($data);
        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }

        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function documents_add_item($dc_id = 0){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item!']);
        }

        $category = DB::table('documents_categories')->where('dc_id', $dc_id)->first();
        if(!$category){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item!']);
        }

        $hash_id = md5(uniqid());
        documents_create_folder($hash_id);
        $allowed = config('documents_admin.file_types_allowed');
        $allowed = str_replace(',', ' .', $allowed);
        $data = [
            'title' => $this->module_name,
            'category' => $category,
            'hash_id' => $hash_id,
            'allowed' => $allowed
        ];

        return view('intranet::documents/documents_add_item', $data);
    }

    public function documents_add_item_action( Request $request ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        
        $title_sk = $request->input('title_sk');
        $preview_sk = $request->input('preview_sk');
        $editor_sk = $request->input('editor_content_sk');

        $hash_id = $request->input('save_to');
        $category = $request->input('category');
        $category_id = $request->input('category_id');
        
        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 64 characters!']);
        }

        if(!is_string($preview_sk) || strlen($preview_sk) < 1 || strlen($preview_sk) > 4096){
            return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 4096 characters!']);
        }

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
        }

        if(!is_numeric($category_id) || $category_id < 0){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
        }

        if(!documents_create_folder($category, $hash_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        $data = [
            'dc_id' => $category_id,
            'hash_name' => $hash_id,
            'name_sk' => $title_sk,
            'preview_sk' => $preview_sk,
            'text_sk' => $editor_sk
        ];
  
        $res = DB::table('documents')->insertGetId($data);
        if($res){
            DB::table('deletor')->where('type', 'documents')->where('path', $category.'/'.$hash_id)->delete();
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function documents_image_upload( Request $request, Response $response ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $image = $request->file('image');
        $hash_id = $request->input('save_to');
        $category = $request->input('category');

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
        }

        $valid = false;
        $allowed_types = explode(',', config('documents_admin.img_types_allowed'));
        foreach($allowed_types as $at){
            $extension = explode('.', $image->hashName());
            $extension = $extension[count($extension)-1];
            if($at == $extension){
                $valid = true;
            }
        }
        
        if($valid){
            if(documents_create_folder($category, $hash_id) && $image){
                $data = [
                    'hash_id'   => $hash_id,
                    'file_hash' => $image->hashName(),
                    'file_name' => $image->getClientOriginalName()
                ];
                DB::table('documents_files')->insert($data);
                DB::table('deletor')->insert(['type' => 'documents', 'path' => $category.'/'.$hash_id]);
                $image->store('/public/documents/'.$category.'/'.$hash_id);
                $response->link = url('/storage/documents/'.$category.'/'.$hash_id.'/'.$image->hashName());
                return stripslashes(json_encode($response->link));
            }
            else{
                return response()->json(['error' => 'Bad request'], 400);
            }
        }else{
            return response()->json(['error' => 'Bad request'], 400);
        }
        return response()->json(['error' => 'Bad request'], 400);
    }

    public function documents_file_upload(Request $request, Response $response){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $files = $request->file('file');

        foreach($files as $file){
            $hash_id = $request->input('save_to');
            if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 64){
                return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
            }
            $category = $request->input('category');
            
            $valid = false;
            $allowed_types = explode(',', config('documents_admin.file_types_allowed'));
            foreach($allowed_types as $at){
                $extension = explode('.', $file->hashName());
                $extension = $extension[count($extension)-1];
                if($at == $extension){
                    $valid = true;
                }
            }

            if($valid){
                if(documents_create_folder($category, $hash_id) && $file){
                    $name = $file->getClientOriginalName();
                    $data = [
                        'hash_id'   => $hash_id,
                        'file_hash' => $file->hashName(),
                        'file_name' => $file->getClientOriginalName()
                    ];
                    DB::table('deletor')->insert(['type' => 'documents', 'path' => $category.'/'.$hash_id]);
                    $file->store('/public/documents/'.$category.'/'.$hash_id);   
                    $file_id = DB::table('documents_files')->insertGetId($data);
                    return response()->json(['error' => 'Success' , 'file' => $file_id, 'name' => $name], 200);
                }
                else{
                    return response()->json(['error' => 'Bad request'], 400);
                }
            }
            else{
                return response()->json(['error' => 'Bad request'], 400);
            }
        }

    }

    public function file_name_update(Request $request){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $f_id = $request->input('file');
        if(!is_numeric($f_id)){
            return response()->json(['error' => 'Bad request'], 400);
        }

        $file_name = $request->input('file_name');
        if(!is_string($file_name) || strlen($file_name) < 1 || strlen($file_name) > 256){
            return response()->json(['error' => 'Bad request'], 400);
        } 

        $data = [
            'file_name' => $file_name
        ];
        
        DB::table('documents_files')->where('df_id', $f_id)->update($data);
        return response()->json(['error' => 'Aktualizované'], 200);
    }

    ///////////////////////////////////////////////////////////////
    //////////////////////// EDIT /////////////////////////////////
    ///////////////////////////////////////////////////////////////

    public function documents_edit_category( $dc_id = 0 ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('documents_categories')->where('dc_id', $dc_id)->first();
        if(!$item){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $data = [
            'title' => $this->module_name,
            'item' => $item
        ];
      
        return view('intranet::documents/documents_edit_category', $data);
    }

    public function documents_edit_category_action( $dc_id = 0, Request $request ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $title_sk = $request->input('title_sk');
        $category_text = $request->input('cat_text');

        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 64 characters!']);
        }

        $data = [
            'name_sk' => $title_sk,
            'category_text' => $category_text
        ];
        
        $res = DB::table('documents_categories')->where('dc_id', $dc_id)->update($data);
        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);
        }

        return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Any data has been changed!']);

    }

    public function documents_edit_category_item($d_id = 0){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($d_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $document = DB::table('documents')->where('d_id', $d_id)->first();
        if(!$document){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $category = DB::table('documents_categories')->where('dc_id', $document->dc_id)->first();
        $files = DB::table('documents_files')->where('hash_id', $document->hash_name)->get();

        $files = (!$files) ? [] : $files;

        $allowed = config('documents_admin.file_types_allowed');
        $allowed = str_replace(',', ' .', $allowed);

        $data = [
            'title' => $this->module_name,
            'document' => $document,
            'category' => $category,
            'hash_id' => $document->hash_name,
            'files' => $files,
            'allowed' => $allowed
        ];
        
        return view('intranet::documents/documents_edit_category_item', $data);
    }

    public function documents_edit_category_item_action($d_id = 0, Request $request){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($d_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $title_sk = $request->input('title_sk');
        $preview_sk = $request->input('preview_sk');
        $editor_sk = $request->input('editor_content_sk');

        $hash_id = $request->input('save_to');
        $category = $request->input('category');
        $category_id = $request->input('category_id');
        
        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 64 characters!']);
        }

        if(!is_string($preview_sk) || strlen($preview_sk) < 1 || strlen($preview_sk) > 4096){
            return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Preview max 4096 characters!']);
        }

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 64){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
        }

        if(!is_numeric($category_id) || $category_id < 0){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
        }

        if(!documents_create_folder($category, $hash_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        $data = [
            'dc_id' => $category_id,
            'hash_name' => $hash_id,
            'name_sk' => $title_sk,
            'preview_sk' => $preview_sk,
            'text_sk' => $editor_sk
        ];
  
        $res = DB::table('documents')->where('d_id', $d_id)->update($data);
        if($res){
            DB::table('deletor')->where('type', 'documents')->where('path', $category.'/'.$hash_id)->delete();
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']); 
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Any data has been changed!']);   
    }

    ///////////////////////////////////////////////////////////////
    //////////////////////// DELETE ///////////////////////////////
    ///////////////////////////////////////////////////////////////


    public function documents_delete_category_action( $dc_id = 0 ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('documents_categories')->where('dc_id', $dc_id)->first();
        if(!$item){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $path = base_path('storage/app/public/documents/').$item->hash_name;
        $docs = DB::table('documents')->where('dc_id', $dc_id)->get();
        
        foreach($docs as $d){
            $doc_files = DB::table('documents_files')->where('hash_id', $d->hash_name)->get();     
            if($doc_files){
                foreach($doc_files as $df){
                    $path_tmp = $path."/".$d->hash_name."/".$df->file_hash;
                    DB::table('documents_files')->where('df_id', $df->df_id)->delete();
                    if(is_file($path_tmp)){
                        unlink($path_tmp);
                    }
                }
            }
            DB::table('documents')->where('d_id', $d->d_id)->delete();
            $path_tmp2 = $path."/".$d->hash_name;
            if(is_dir($path_tmp2)){
                rmdir($path_tmp2);
            }
        }
        
        if(is_dir($path)){
            rmdir($path);
        }
        
        $res = (bool) DB::table('documents_categories')->where('dc_id', $dc_id)->delete();
        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function documents_delete_single_action($d_id = 0){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($d_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('documents')->where('d_id', $d_id)->first();
        if(!$item){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $parent = DB::table('documents_categories')->where('dc_id', $item->dc_id)->first();

        $path = base_path('storage/app/public/documents/').$parent->hash_name.'/'.$item->hash_name;
        $files = DB:: table('documents_files')->where('hash_id', $item->hash_name)->get();
       
        foreach($files as $f){
            $tmp = $path.'/'.$f->file_hash;
            if(is_file($tmp)){
                unlink($tmp);
            }
        }
        if(is_dir($path)){
            rmdir($path);
        }
        DB:: table('documents_files')->where('hash_id', $item->hash_name)->delete();

        $res = (bool) DB::table('documents')->where('d_id', $d_id)->delete();
        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function documents_delete_single_file_action($df_id = 0){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($df_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $file_db = DB::table('documents_files')->where('df_id', $df_id)->first();
        if(!$file_db){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $category_id = DB::table('documents')->where('hash_name', $file_db->hash_id)->select('dc_id')->first()->dc_id;
        $category_hash = DB::table('documents_categories')->where('dc_id', $category_id)->first()->hash_name;
        $path = base_path('storage/app/public/documents/').$category_hash.'/'.$file_db->hash_id.'/'.$file_db->file_hash;

        unlink($path);

        $res = (bool)DB::table('documents_files')->where('df_id', $df_id)->delete();
        if($res){
            return redirect()->back()->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////// AJAX /////////////////////////////////////
    ///////////////////////////////////////////////////////////////////

    public function ajax_get_category_content( Request $request ){

        $dc_id = $request->input('id');
        if(!is_numeric($dc_id)){
            return response()->json(['error' => 'Bad request'], 400);
        }
        
        session()->put('cat_tab', $dc_id);

        $docs = DB::table('documents')->where('dc_id', $dc_id)->get();
        $cat_text = DB::table('documents_categories')->where('dc_id', $dc_id)->first()->category_text;
        if(!$docs){
            return response()->json(['error' => 'Bad request'], 400);
        }

        $data = [ 
            'docs' => $docs,
            'cat_text' => $cat_text,
            'tab' => $dc_id
        ];  
      
        return response()->json($data);
    }
    
}
