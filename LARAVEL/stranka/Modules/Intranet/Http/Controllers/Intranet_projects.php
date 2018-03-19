<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_projects extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function projects_all(){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $all_projects = DB::table('project')->get();
        $all_projects = (!$all_projects) ? [] : $all_projects;

        $data = [ 
            'title' => $this->module_name, 
            'projects' => $all_projects,
            'activation' => config('projects_admin.activation')
        ];

        return view('intranet::study/projects_all', $data);
    }

    public function projects_add(){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $types = config('projects_admin.types');
        $staff = DB::table('staff')->get();
        // TODO prepojenie so staff bootstrap chosen
        $data = [
            'title' => $this->module_name,
            'types' => $types,
            'staff' => $staff
        ];
        
        return view('intranet::study/projects_add', $data);
    }

    public function projects_add_action( Request $request ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
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
        
        if(!is_string($type) || strlen($type) < 1 || strlen($type) > 128){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format type!']);
        }

        if(!is_string($number) || strlen($number) < 1 || strlen($number) > 32){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format number - max 32 characters!']);
        }

        if(!is_string($titleEN) || strlen($titleEN) < 1 || strlen($titleEN) > 512){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format english title - max 512 characters!']);
        }

        if(!is_string($titleSK) || strlen($titleSK) < 1 || strlen($titleSK) > 512){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format slovak title - max 512 characters!']);
        }

        if(!is_string($duration) || strlen($duration) < 1 || strlen($duration) > 32){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format duration - max 32 characters!']);
        }

        if(!is_string($coordinator) || strlen($coordinator) < 1 || strlen($coordinator) > 128){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format coordinator - max 128 characters!']);
        }

        if(!is_string($partners) || strlen($partners) < 1 || strlen($partners) > 1024){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format partners - max 1024 characters!']);
        }

        if(!is_string($web) || strlen($web) < 1 || strlen($web) > 512){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format web link - max 512 characters!']);
        }

        if(!is_string($iCode) || strlen($iCode) < 1 || strlen($iCode) > 16){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format web link - max 16 characters!']);
        }


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
        return redirect('/projects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item added successfuly!']);

        //return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function projects_edit( $pr_id = 0 ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($pr_id)){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $item = DB::table('project')->where('pr_id', $pr_id)->first();
        if(!$item){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        $types = config('projects_admin.types');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types
        ];

        return view('intranet::study/projects_edit', $data);
    }

    public function projects_edit_action( $pr_id = 0, Request $request ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($pr_id)){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
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
        
        if(!is_string($type) || strlen($type) < 1 || strlen($type) > 128){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format type!']);
        }

        if(!is_string($number) || strlen($number) < 1 || strlen($number) > 32){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format number - max 32 characters!']);
        }

        if(!is_string($titleEN) || strlen($titleEN) < 1 || strlen($titleEN) > 512){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format english title - max 512 characters!']);
        }

        if(!is_string($titleSK) || strlen($titleSK) < 1 || strlen($titleSK) > 512){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format slovak title - max 512 characters!']);
        }

        if(!is_string($duration) || strlen($duration) < 1 || strlen($duration) > 32){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format duration - max 32 characters!']);
        }

        if(!is_string($coordinator) || strlen($coordinator) < 1 || strlen($coordinator) > 128){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format coordinator - max 128 characters!']);
        }

        if(!is_string($partners) || strlen($partners) < 1 || strlen($partners) > 1024){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format partners - max 1024 characters!']);
        }

        if(!is_string($web) || strlen($web) < 1 || strlen($web) > 512){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format web link - max 512 characters!']);
        }

        if(!is_string($iCode) || strlen($iCode) < 1 || strlen($iCode) > 16){
            return redirect('/projects-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format web link - max 16 characters!']);
        }

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

        $res = (bool) DB::table('project')->where('pr_id', $pr_id)->update($data);
        if($res){
            return redirect('/projects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item edited successfuly!']);
        }

        return redirect('/projects-admin')->with('err_code', ['type' => 'Warning', 'msg' => 'Any data has been changed!']);

    }

    public function projects_delete_action( $pr_id = 0 ){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($pr_id)){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $res = (bool) DB::table('project')->where('pr_id', $pr_id)->delete();
        if($res){
            return redirect('/projects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted successfuly!']);
        }
        return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function project_activate_action($pr_id = 0){
        if(!has_permission('editor')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        
        if(!is_numeric($pr_id) || $pr_id == 0){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        $item = DB::table('project')->where('pr_id', $pr_id)->select('activated')->first();

        if($item->activated){
            DB::table('project')->where('pr_id', $pr_id)->update(['activated' => 0]);
            return redirect('/projects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deactivated!']);
        }else{
            DB::table('project')->where('pr_id', $pr_id)->update(['activated' => 1]);
            return redirect('/projects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item activated!']);
        }
        return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
    }
}
