<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Config\Repository;

class Intranet_projects extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function projects_all(){
        
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
            return redirect('/projects-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item added successfuly!']);
        }

        return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function projects_edit( $pr_id = 0 ){
        if(!is_numeric($pr_id)){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $item = DB::table('project')->where('pr_id', $pr_id)->first();
        $types = config('projects_admin.types');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'types' => $types
        ];

        return view('intranet::study/projects_edit', $data);
    }

    public function projects_edit_action( $pr_id = 0, Request $request ){
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

        return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);

    }

    public function projects_delete_action( $pr_id = 0 ){
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
        if(!is_numeric($pr_id) || $pr_id == 0){
            return redirect('/projects-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        // ak je aktivne tak deaktivuj inak aktivuj
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
