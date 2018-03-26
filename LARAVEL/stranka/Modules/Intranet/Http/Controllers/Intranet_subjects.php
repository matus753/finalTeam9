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
        if(has_permission('admin')){
            $subjects = DB::table('subjects')->get();
            $subjects = (!$subjects) ? [] : $subjects;
        }else{
            $subjects = DB::table('subjects')->join('subjects_staff_rel', 'subjects_staff_rel.sub_id', '=', 'subjects.sub_id')->where('s_id', get_user_id())->get();
        }

        foreach($subjects as $subject){
            $subject->subcategories = DB::table('subjects_subcategories')->where('sub_id', $subject->sub_id)->get();
        }

        $data = [ 
            'title' => $this->module_name, 
            'subjects' => $subjects,
        ];

        return view('intranet::subjects/subjects_all', $data);
    }

    public function subjects_add_item($sub_id = 0){
        if(!is_numeric($sub_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item!']);
        }

        $subject = DB::table('subjects')->where('sub_id', $sub_id)->first();
        if(!$subject){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item!']);
        }

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
        
        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 256){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 256 characters!']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 256){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 256 characters!']);
        }

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 128){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Internal server error!']);
        }

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

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 128){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Internal server error!']);
        }

        $valid = false;
        $allowed_types = explode(',', config('subjects_admin.img_types_allowed'));
        foreach($allowed_types as $at){
            $extension = explode('.', $file->hashName());
            $extension = $extension[count($extension)-1];
            if($at == $extension){
                $valid = true;
            }
        }
        
        if($valid){
            if(subjects_create_folder($subject, $hash_id) && $image){
                $data = [
                    'hash_id'   => $hash_id,
                    'hash_name' => $image->hashName(),
                    'file_name' => $image->getClientOriginalName()
                ];

                $image->store('/public/subjects/'.$subject.'/'.$hash_id);
                $response->link = url('/storage/subjects/'.$subject.'/'.$hash_id.'/'.$image->hashName());
                DB::table('subjects_files')->insert($data);
                return stripslashes(json_encode($response->link));
            }
            else{
                return response()->json(['error' => 'Bad request'], 400);
            }
        }
        else{
            return response()->json(['error' => 'Bad request'], 400);
        }
    }

    public function subjects_file_upload(Request $request, Response $response){
        $files = $request->file('file');

        foreach($files as $file){
            
            $hash_id = $request->input('save_to');
            if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 128){
                return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Internal server error!']);
            }
            $category = $request->input('category');
        
            $valid = false;
            $allowed_types = explode(',', config('subjects_admin.file_types_allowed'));
            foreach($allowed_types as $at){
                $extension = explode('.', $file->hashName());
                $extension = $extension[count($extension)-1];
                if($at == $extension){
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
                    DB::table('subjects_files')->insert($data);
                }
                else{
                    return response()->json(['error' => 'Bad request'], 400);
                }
            }
            else{
                return response()->json(['error' => 'File type not valid'], 400);
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

        $subjects_subcategories = DB::table('subjects_subcategories')->where('ss_id', $ss_id)->first();
        if(!$subjects_subcategories){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $subject = DB::table('subjects')->where('sub_id', $subjects_subcategories->sub_id)->first();
        $subject_files = DB::table('subjects_files')->where('hash_id', $subjects_subcategories->hash_name)->first();
        $hash_id = $subject->hash_name;
        $subject_files = (!$subject_files) ? [] : $subject_files;

        $data = [
            'title' => $this->module_name,
            'subject' => $subject,
            'item' => $subjects_subcategories,
            'files' => $subject_files,
            'hash_id' => $hash_id
        ];
 
        return view('intranet::subjects/subjects_edit_item', $data);
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
        
        if(!is_string($title_sk) || strlen($title_sk) < 1 || strlen($title_sk) > 256){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 256 characters!']);
        }

        if(!is_string($title_en) || strlen($title_en) < 1 || strlen($title_en) > 256){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title max 256 characters!']);
        }

        if(!is_string($hash_id) || strlen($hash_id) < 1 || strlen($hash_id) > 128){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Internal server error!']);
        }

        if(!subjects_create_folder($subject, $hash_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
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
        if($res){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated!']);    
        }
        return redirect('/subjects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Any data has been changed!']);
    }

    ///////////////////////////////////////////////////////////////
    //////////////////////// DELETE ///////////////////////////////
    ///////////////////////////////////////////////////////////////

    public function subjects_delete_single_action($ss_id = 0){
        if(!is_numeric($ss_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $item = DB::table('subjects_subcategories')->where('ss_id', $ss_id)->first();
        if(!$item){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $parent = DB::table('subjects')->where('sub_id', $item->sub_id)->first();
        if(!$parent){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }

        $path = base_path('storage/app/public/subjects/').$parent->hash_name.'/'.$item->hash_name;
        $files = DB:: table('subjects_files')->where('hash_id', $item->hash_name)->get();
        foreach($files as $f){
            $tmp = $path.'/'.$f->hash_name;
            if(is_file($tmp)){
                unlink($tmp);
            }
        }
        if(is_dir($path)){
            rmdir($path);
        }


        $res = (bool) DB::table('subjects_subcategories')->where('ss_id', $ss_id)->delete();
        if($res){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function subjects_delete_single_file_action($sf_id = 0){
        if(!is_numeric($sf_id)){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $file_db = DB::table('subjects_files')->where('sf_id', $sf_id)->first();
        if(!$file_db){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $sub_sub = DB::table('subjects_subcategories')->where('hash_name', $file_db->hash_id)->first();
        if(!$sub_sub){
            return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
        }
        $subject_hash = DB::table('subjects')->where('sub_id', $sub_sub->sub_id)->first()->hash_name;
        $path = base_path('storage/app/public/subjects/').$subject_hash.'/'.$file_db->hash_id.'/'.$file_db->hash_name;

        if(is_file($path)){
            unlink($path);
        }

        $res = (bool)DB::table('subjects_files')->where('sf_id', $sf_id)->delete();
        if($res){
            return redirect()->back()->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/subjects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }
}
