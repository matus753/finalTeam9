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
        
        $categories = DB::table('documents_categories')->get();

        /*foreach($categories as $c){
            $docs = DB::table('documents')->where('dc_id', $c->dc_id)->get();
            foreach($docs as $d){
                $docs_files = DB::table('documents_files')->where('hash_id', $d->hash_name)->get();
                $d->files = $docs_files;
            }
            
            
            $c->docs = $docs;
        }*/

        $data = [ 
                'title' => $this->module_name, 
                'categories' => $categories,
            ];
        return view('intranet::documents/documents_all', $data);
    }

    public function documents_add_category(){
        
        $data = [
            'title' => $this->module_name,
        ];
    
        return view('intranet::documents/documents_add_category', $data);
    }

    public function documents_add_category_action( Request $request ){
        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');

        $hash_id = md5(uniqid());
        documents_category_create_folder($hash_id);

        $data = [
            'hash_name' => $hash_id,
            'name_en' => $title_en,
            'name_sk' => $title_sk,
        ];
        
        $res = DB::table('documents_categories')->insertGetId($data);

        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }

        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function documents_add_item($dc_id = 0){
        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item!']);
        }

        $hash_id = md5(uniqid());
        documents_create_folder($hash_id);

        $category = DB::table('documents_categories')->where('dc_id', $dc_id)->first();
        
        $data = [
            'title' => $this->module_name,
            'category' => $category,
            'hash_id' => $hash_id
        ];

        return view('intranet::documents/documents_add_item', $data);
    }

    public function documents_add_item_action( Request $request ){
        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
        $editor_en = $request->input('editor_content_sk');
        $editor_sk = $request->input('editor_content_en');
        $hash_id = $request->input('save_to');
        $category = $request->input('category');
        $category_id = $request->input('category_id');
        
        if(!documents_create_folder($category, $hash_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        $data = [
            'dc_id' => $category_id,
            'hash_name' => $hash_id,
            'name_en' => $title_en,
            'name_sk' => $title_sk,
            'text_en' => $editor_en,
            'text_sk' => $editor_sk
        ];
  
        $res = DB::table('documents')->insertGetId($data);

        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }

        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function documents_image_upload( Request $request, Response $response ){
        $image = $request->file('image');
        $hash_id = $request->input('save_to');
        $category = $request->input('category');

        $valid = false;
        $allowed_types = explode(',', config('documents_admin.img_types_allowed'));
        foreach($allowed_types as $at){
            if($at == explode('.', $image->hashName())[1]){
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

                $image->store('/public/documents/'.$category.'/'.$hash_id);
                $response->link = '/storage/documents/'.$category.'/'.$hash_id.'/'.$image->hashName();
                DB::table('documents_files')->insert($data);
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

    public function documents_file_upload(Request $request, Response $response){
        $files = $request->file('file');

        foreach($files as $file){
            $hash_id = $request->input('save_to');
            $category = $request->input('category');
        
            $valid = false;
            $allowed_types = explode(',', config('documents_admin.img_types_allowed'));
            foreach($allowed_types as $at){
                if($at == explode('.', $file->hashName())[1]){
                    $valid = true;
                }
            }

            if($valid){
                if(documents_create_folder($category, $hash_id) && $file){
                    $data = [
                        'hash_id'   => $hash_id,
                        'file_hash' => $file->hashName(),
                        'file_name' => $file->getClientOriginalName()
                    ];
                    $file->store('/public/documents/'.$category.'/'.$hash_id);
                    //$response->link = '/storage/documents/'.$hash_name.'/'.$file->hashName();
                    
                    DB::table('documents_files')->insert($data);
                }
                else{
                    echo json_encode('UPLOAD ERROR');
                }
            }
            else{
                echo json_encode('UPLOAD ERROR');
            }
        }
    }

    ///////////////////////////////////////////////////////////////
    //////////////////////// EDIT /////////////////////////////////
    ///////////////////////////////////////////////////////////////

    public function documents_edit_category( $dc_id = 0 ){
        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('documents_categories')->where('dc_id', $dc_id)->first();

        $data = [
            'title' => $this->module_name,
            'item' => $item
        ];
      
        return view('intranet::documents/documents_edit_category', $data);
    }

    public function documents_edit_category_action( $dc_id = 0, Request $request ){
        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
           
        $data = [
            'name_en' => $title_en,
            'name_sk' => $title_sk
        ];
        
        $res = DB::table('documents_categories')->where('dc_id', $dc_id)->update($data);
        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);
        }

        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);

    }

    ///////////////////////////////////////////////////////////////
    //////////////////////// DELETE ///////////////////////////////
    ///////////////////////////////////////////////////////////////


    public function documents_delete_category_action( $dc_id = 0 ){
        if(!is_numeric($dc_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('documents_categories')->where('dc_id', $dc_id)->first();
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
        if(!is_numeric($d_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('documents')->where('d_id', $d_id)->first();
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


        $res = (bool) DB::table('documents')->where('d_id', $d_id)->delete();
        if($res){
            return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////// AJAX /////////////////////////////////////
    ///////////////////////////////////////////////////////////////////

    public function ajax_get_category_content( Request $request ){
        $dc_id = $request->input('id');
    
        $docs = DB::table('documents')->where('dc_id', $dc_id)->get();
        /*foreach($docs as $d){
            $docs_files = DB::table('documents_files')->where('hash_id', $d->hash_name)->get();
            $d->files = $docs_files;
        }*/

        $data = [ 
            'docs' => $docs,
            'tab'  => $dc_id
        ];  
        //debug($data, true);
        return response()->json($data);
    }
    
}
