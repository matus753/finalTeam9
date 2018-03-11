<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_subjects extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function subjects_all(){
        $subjects = DB::table('subjects')->get();
        foreach($subjects as $subject){
            $subject->subcategories = DB::table('subjects_subcategories')->where('sub_id', $subject->sub_id)->get();
        }

        $data = [ 
                'title' => $this->module_name, 
                'subjects' => $subjects,
            ];

        //debug($data ,true);
        return view('intranet::subjects/subjects_all', $data);
    }

    public function subjects_add_item($sub_id = 0){
        if(!is_numeric($sub_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item!']);
        }

        $subject = DB::table('subjects')->where('sub_id', $sub_id)->first();
        if(strlen($subject->hash_name) == 0){
            $hash_id = md5(uniqid());
            subjects_category_create_folder($hash_id);
            DB::table('subjects')->where('sub_id', $sub_id)->update(['hash_name' => $hash_id]);
        }else{
            subjects_category_create_folder($subject->hash_name);
            $hash_id = $subject->hash_name;
        }

        
        $data = [
            'title' => $this->module_name,
            'subject' => $subject,
            'hash_id' => $hash_id
        ];

        return view('intranet::subjects/subjects_add_item', $data);
    }

    public function subjects_add_item_action( Request $request ){
        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
        $editor_en = $request->input('editor_content_sk');
        $editor_sk = $request->input('editor_content_en');
        $hash_id = $request->input('save_to');
        $subject = $request->input('subject');
        $subject_id = $request->input('subject_id');
        
        if(!subjects_create_folder($subject, $hash_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        $data = [
            'sub_id' => $subject_id,
            'hash_name' => $hash_id,
            'name_en' => $title_en,
            'name_sk' => $title_sk,
            'text_en' => $editor_en,
            'text_sk' => $editor_sk
        ];
  
        $res = DB::table('subjects_subcategories')->insertGetId($data);

        if($res){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item inserted!']);
        }

        return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function subjects_image_upload( Request $request, Response $response ){
        $image = $request->file('image');
        $hash_id = $request->input('save_to');
        $subject = $request->input('category');

        $valid = false;
        $allowed_types = explode(',', config('subjects_admin.img_types_allowed'));
        foreach($allowed_types as $at){
            if($at == explode('.', $image->hashName())[1]){
                $valid = true;
            }
        }
        //debug($subject, true);
        if($valid){
            if(subjects_create_folder($subject, $hash_id) && $image){
                $data = [
                    'hash_id'   => $hash_id,
                    'hash_name' => $image->hashName(),
                    'file_name' => $image->getClientOriginalName()
                ];

                $image->store('/public/subjects/'.$subject.'/'.$hash_id);
                $response->link = url('/storage/subjects/'.$subject.'/'.$hash_id.'/'.$image->hashName());
                // TODO je treba do DB ????
                DB::table('subjects_files')->insert($data);
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

    public function subjects_file_upload(Request $request, Response $response){
        $files = $request->file('file');

        foreach($files as $file){
            $hash_id = $request->input('save_to');
            $category = $request->input('category');
        
            $valid = false;
            $allowed_types = explode(',', config('subjects_admin.img_types_allowed'));
            foreach($allowed_types as $at){
                if($at == explode('.', $file->hashName())[1]){
                    $valid = true;
                }
            }

            if($valid){
                if(subjects_create_folder($category, $hash_id) && $file){
                    $data = [
                        'hash_id'   => $hash_id,
                        'hash_name' => $file->hashName(),
                        'file_name' => $file->getClientOriginalName()
                    ];
                    $file->store('/public/subjects/'.$category.'/'.$hash_id);
                    //$response->link = url('/storage/documents/'.$hash_name.'/'.$file->hashName());
                    
                    DB::table('subjects_files')->insert($data);
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
    public function subjects_edit_item($ss_id = 0){
        if(!is_numeric($ss_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

    }


    public function subjects_edit_item_action($ss_id = 0, Request $request){
        if(!is_numeric($ss_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $title_en = $request->input('title_en');
        $title_sk = $request->input('title_sk');
        $editor_en = $request->input('editor_content_sk');
        $editor_sk = $request->input('editor_content_en');
        $hash_id = $request->input('save_to');
        $category = $request->input('subject');
        $category_id = $request->input('subject_id');
        
        if(!documents_create_folder($category, $hash_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        $data = [
            'sub_id' => $category_id,
            'hash_name' => $hash_id,
            'name_en' => $title_en,
            'name_sk' => $title_sk,
            'text_en' => $editor_en,
            'text_sk' => $editor_sk
        ];
  
        $res = DB::table('subjects_subcategories')->where('ss_id', $ss_id)->update($data);
        return redirect('/subjects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);    
    }

    ///////////////////////////////////////////////////////////////
    //////////////////////// DELETE ///////////////////////////////
    ///////////////////////////////////////////////////////////////

    public function subjects_delete_single_action($d_id = 0){
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

    public function subjects_delete_single_file_action($df_id = 0){
        if(!is_numeric($df_id)){
            return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        $file_db = DB::table('documents_files')->where('df_id', $df_id)->first();
        $category_id = DB::table('documents')->where('hash_name', $file_db->hash_id)->select('dc_id')->first()->dc_id;
        $category_hash = DB::table('documents_categories')->where('dc_id', $category_id)->first()->hash_name;
        $path = base_path('storage/app/public/documents/').$category_hash.'/'.$file_db->hash_id.'/'.$file_db->file_hash;
        //debug($path, true);
        unlink($path);

        $res = (bool)DB::table('documents_files')->where('df_id', $df_id)->delete();
        if($res){
            return redirect()->back()->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/documents-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }
}
