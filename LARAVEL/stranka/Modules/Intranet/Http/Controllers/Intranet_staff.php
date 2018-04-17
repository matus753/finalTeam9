<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_staff extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function staff_all(){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $staff = DB::table('staff')->get();
        $staff = (!$staff) ? [] : $staff;

        $data = [ 
                'title' => $this->module_name, 
                'staff' => $staff,
                'activation' => config('staff_admin.activation')
            ];

        return view('intranet::staff/staff_all', $data);
    }

    public function staff_show_profile($s_id = 0){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($s_id) || $s_id == 0){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $staff = DB::table('staff')->where('s_id', $s_id)->first();
        if(!$staff){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $function = DB::table('staff_function')->join('functions', 'staff_function.id_func', '=', 'functions.f_id')->where('staff_function.id_staff', $s_id)->get();

        
        $ais = (!$staff) ? [] : $staff;
        $ais->function = (!$function) ? [] : $function;

        $data = [ 
                'title' => $this->module_name, 
                'ais' => $ais,
            ];
        //debug($data, true);
        return view('intranet::staff/staff_show_profile', $data);
    }

    public function staff_add(){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $locale = session()->get('locale');
        if($locale == 'sk'){
            $roles = config('staff_admin.rolesSK');
        }else{
            $roles = config('staff_admin.rolesEN');
        }

        $departments = config('staff_admin.departments');
        $permission_roles = config('staff_admin.permission_roles');
        $functions = DB::table('functions')->get();
        $subjects = DB::table('subjects')->get();

        $data = [
            'title' => $this->module_name,
            'departments' => $departments,
            'roles' => $roles,
            'permission_roles' => $permission_roles,
            'functions' => $functions,
            'subjects'  => $subjects
        ];
      
        return view('intranet::staff/staff_add', $data);
    }

    public function staff_add_action( Request $request ){  
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $title1 = $request->input('title1');
        $title2 = $request->input('title2');
        $room = $request->input('room');
        $phone = $request->input('phone');
        $department = $request->input('department');
        $role = $request->input('role');
        $email = $request->input('email');
        $url = $request->input('web');
        $img = $request->file('img');
        $perm = $request->input('perm');
        $func = $request->input('func');
       
        // povinne
        if(!is_string($name) || strlen($name) < 1 || strlen($name) > 64 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Name max 64 characters!']);
        } 

        if(!is_string($surname) || strlen($surname) < 1 || strlen($surname) > 64 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Surname max 64 characters!']);
        } 

        if(!is_string($department) || strlen($department) < 1 || strlen($department) > 32 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Room max 32 characters!']);
        } 

        if(!is_string($role) || strlen($role) < 1 || strlen($role) > 32 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Staff role max 32 characters!']);
        } 

        // nepovinne
        if($request->filled('title1')){
            if(!is_string($title1) || strlen($title1) < 1 || strlen($title1) > 32 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title 1 max 32 characters!']);
            } 
        }else{
            $title1 = null;
        }

        if($request->filled('title2')){
            if(!is_string($title2) || strlen($title2) < 1 || strlen($title2) > 32 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title 2 max 32 characters!']);
            } 
        }else{
            $title2 = null;
        }
        if($request->filled('room')){
            if(!is_string($room) || strlen($room) < 1 || strlen($room) > 128 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Room max 128 characters!']);
            } 
        }else{
            $room = null;
        }

        if($request->filled('phone')){
            if(!is_string($phone) || strlen($phone) < 1 || strlen($phone) > 16 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Phone max 16 characters!']);
            } 
        }else{
            $phone = null;
        }

        if($request->filled('email')){
            if(!is_string($email) || strlen($email) < 1 || strlen($email) > 128 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Function max 128 characters!']);
            } 
        }else{
            $email = null;
        }
        
        $permissions = [];
        if(is_array($perm) && count($perm) > 0){
            
            foreach($perm as $p){
                if(is_string($p) && strlen($p) > 0){
                    $permissions[] = $p;
                }else{
                    return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'Input error!']);
                }
            }
        }
      
        $ldap = $request->input('ldap');
        if($request->filled('ldap')){
            if(!is_string($ldap) || strlen($ldap) < 1 || strlen($ldap) > 32 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'ldap max 32 characters!']);
            } 
            $tmp = DB::table('staff')->where('ldapLogin', $ldap)->first();
            if($tmp){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'User already exists']);
            }
        }else{
            $ldap = null;
        }

        if($url){
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
        }

        if($img){
            $photo = $img->hashName();
            $img->store('/public/staff/');
        }else{
            $photo = null;/*config('staff_admin.default_imgs')['default_male_img'];*/
        }

        $data = [
            'name' => $name,
            'surname' => $surname,
            'title1' => $title1,
            'title2' => $title2,
            'ldapLogin' => $ldap,
            'photo' => $photo,
            'room' => $room,
            'phone' => $phone,
            'department' => $department,
            'staffRole' => $role,
            'roles' => json_encode($permissions),
            'email' => $email,
            'web' => $url
        ];

        $s_id = DB::table('staff')->insertGetId($data);
        if ($s_id > 0){
            $res = true;
        } else {
            $res = false;
        }
        
        $db_func = DB::table('functions')->pluck('f_id')->toArray();
        if($res){
            if(is_array($func)) {
                foreach($func as $f){
                    if(in_array($f,$db_func)){
                        $resFunc = (bool)DB::table('staff_function')->insert(['id_staff' => $s_id, 'id_func' => $f]);
                        if(!$resFunc){
                            DB::table('staff')->where('s_id', $s_id)->delete();
                            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
                        }
                    }else{
                        DB::table('staff')->where('s_id', $s_id)->delete();
                        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
                    }
                }
            } else{
                DB::table('staff')->where('s_id', $s_id)->delete();
                return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
            }
            
            $subjects_staff = $request->input('subjects_staff');
            if($request->filled('subjects_staff')){
                if(!is_array($subjects_staff)){
                    return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
                }

                foreach($subjects_staff as $ss){
                    $res = DB::table('subjects_staff_rel')->insertGetId(['sub_id' => $ss , 's_id' => $s_id]);
                    if(!$res){
                        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
                    }
                }

            }
        }
        if($res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item added successfuly!']);
        }
        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function getFunctions($id = 0){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }



        $functions = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', '=', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', '=', 'functions.f_id')
            ->where('staff_function.id_staff', '=', $id)
            ->pluck('functions.f_id');

        $myFuncs = [];
        //SELECT f.title FROM staff_function sf INNER JOIN staff s on sf.id_staff = s.s_id LEFT JOIN functions f on sf.id_func = f.id WHERE s.s_id = 12;
        if (count($functions) != 0) {
            foreach ($functions as $f) {
                switch ($f) {
                    case 1:
                        array_push($myFuncs, 1);
                        break;
                    case 2:
                        array_push($myFuncs, 2);
                        break;
                    case 3:
                        array_push($myFuncs, 3);
                        break;
                    case 4:
                        array_push($myFuncs, 4);
                        break;
                    case 5:
                        array_push($myFuncs, 5);
                        break;
                    case 6:
                        array_push($myFuncs, 6);
                        break;
                }
            }
        }
        return $myFuncs;
    }

    public function staff_edit( $s_id = 0 ){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        if(!is_numeric($s_id)){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $item = DB::table('staff')->where('s_id', $s_id)->first();
        if(!$item){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        $item->roles = json_decode($item->roles);

        $locale = session()->get('locale');
        if($locale == 'sk'){
            $roles = config('staff_admin.rolesSK');
        }else{
            $roles = config('staff_admin.rolesEN');
        }

        $departments = config('staff_admin.departments');
        $permission_roles = config('staff_admin.permission_roles');

        $functions = DB::table('functions')->get();
        $subjects_staff = DB::table('subjects_staff_rel')->join('subjects', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')->where('s_id', $s_id)->pluck('subjects_staff_rel.sub_id')->toArray();
        $subjects_staff = (!$subjects_staff) ? [] : $subjects_staff;
        $all_subs = DB::table('subjects')->get();


        $myFunc = $this->getFunctions($s_id);
        $myFunc = (!$myFunc) ? [] : $myFunc;

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'departments' => $departments,
            'roles' => $roles,
            'permission_roles' => $permission_roles,
            'functions' => $functions,
            'myFunc' => $myFunc,
            'subjects' => $all_subs,
            'selected_subs' => $subjects_staff
        ];
    
        return view('intranet::staff/staff_edit', $data);
    }

    public function staff_edit_action( $s_id = 0, Request $request ){
        
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
       
        if(!is_numeric($s_id)){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
    
        $name = $request->input('name');
        $surname = $request->input('surname');
        $title1 = $request->input('title1');
        $title2 = $request->input('title2');
        $room = $request->input('room');
        $phone = $request->input('phone');
        $department = $request->input('department');
        $role = $request->input('role');
        $func = $request->input('func');
        $email = $request->input('email');
        $url = $request->input('web');

        $img = $request->file('img');
        $default_photo = $request->input('default_photo');
        $perm = $request->input('perm');
        
        if(!is_string($name) || strlen($name) < 1 || strlen($name) > 64 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Name max 64 characters!']);
        } 

        if(!is_string($surname) || strlen($surname) < 1 || strlen($surname) > 64 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Surname max 64 characters!']);
        } 

        if(!is_string($department) || strlen($department) < 1 || strlen($department) > 32 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Room max 32 characters!']);
        } 

        if(!is_string($role) || strlen($role) < 1 || strlen($role) > 32 ){
            return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Staff role max 32 characters!']);
        } 

        if($request->filled('title1')){
            if(!is_string($title1) || strlen($title1) < 1 || strlen($title1) > 32 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title 1 max 32 characters!']);
            } 
        }else{
            $title1 = null;
        }

        if($request->filled('title2')){
            if(!is_string($title2) || strlen($title2) < 1 || strlen($title2) > 32 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Title 2 max 32 characters!']);
            } 
        }else{
            $title2 = null;
        }

        if($request->filled('room')){
            if(!is_string($room) || strlen($room) < 1 || strlen($room) > 128 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Room max 128 characters!']);
            } 
        }else{
            $room = null;
        }

        if($request->filled('phone')){
            if(!is_string($phone) || strlen($phone) < 1 || strlen($phone) > 16 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Phone max 16 characters!']);
            } 
        }else{
            $phone = null;
        }

        if($request->filled('email')){
            if(!is_string($email) || strlen($email) < 1 || strlen($email) > 128 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'Function max 128 characters!']);
            } 
        }else{
            $email = null;
        }

        $permissions = [];
        if(is_array($perm) && count($perm) > 0){
            foreach($perm as $p){
                if(is_string($p) && strlen($p) > 0){
                    $permissions[] = $p;
                }else{
                    return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'Input error!']);
                }
            }
        }
        
        $ldap = $request->input('ldap');
        if($request->filled('ldap')){
            if(!is_string($ldap) || strlen($ldap) < 1 || strlen($ldap) > 32 ){
                return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'ldap max 32 characters!']);
            } 
        }else{
            $ldap = null;
        }

        if($url){
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
        }

        if($img && !$default_photo){
            $original_img = DB::table('staff')->select('photo')->where('s_id', $s_id)->first();
            if(!$original_img){
                return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal DB error!']);
            }
            if(array_search($original_img->photo, config('staff_admin.default_imgs')) == null){
                $path = $path = base_path('storage/app/public/staff/').$original_img->photo;
                if(is_file($path)){
                    unlink($path);
                }
            }
            $photo = $img->hashName();
            $img->store('/public/staff/');
        }else{
            $photo = DB::table('staff')->select('photo')->where('s_id', $s_id)->first()->photo;
        }
        
        $db_func = DB::table('functions')->pluck('f_id')->toArray();
        $myFunc = $this->getFunctions($s_id);
        $myFunc = (!$myFunc) ? [] : $myFunc;
        //var_dump($func);
        if(is_array($func)) {
            foreach ($db_func as $f) {
                if (in_array($f, $func) && !in_array($f, $myFunc)) {
                    
                    $res = (bool)DB::table('staff_function')->insert(['id_staff' => $s_id, 'id_func' => $f]);
                    if (!$res){
                        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
                    }
                } else if (!in_array($f, $func) && in_array($f, $myFunc)){
                    $res = (bool)DB::table('staff_function')->where('id_staff', $s_id)->where('id_func', $f)->delete();
                    if (!$res){
                        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
                    }
                }
            }
        } else {

            $res = (bool)DB::table('staff_function')->where('id_staff', $s_id)->delete();
//            debug($res);
//            debug('lala', true);
            if (!$res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
            }
        }
        
        $data = [
            'name' => $name,
            'surname' => $surname,
            'title1' => $title1,
            'title2' => $title2,
            'ldapLogin' => $ldap,
            'photo' => $photo,
            'room' => $room,
            'phone' => $phone,
            'department' => $department,
            'staffRole' => $role,
            'roles' => json_encode($permissions),
            'email' => $email,
            'web' => $url
        ];
        //debug($data, true);

        $res = DB::table('staff')->where('s_id', $s_id)->update($data);
        
        return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated successfuly!']);

    }

    public function staff_delete_action( $s_id = 0 ){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!is_numeric($s_id)){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        
        $original_img = DB::table('staff')->select('photo')->where('s_id', $s_id)->first();
        if(array_search($original_img->photo, config('staff_admin.default_imgs')) == null){
            $path = $path = base_path('storage/app/public/staff/').$original_img->photo;
            if(is_file($path)){
                unlink($path);
            }
        }

        $res = (bool)DB::table('staff_function')->where('id_staff', $s_id)->delete();
        if (!$res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
        }

        $res = (bool) DB::table('staff')->where('s_id', $s_id)->delete();
        if(!$res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
        }
        return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted successfuly!']);
    }

    public function staff_activate_user($s_id = 0){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        
        if(!is_numeric($s_id) || $s_id == 0){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $item = DB::table('staff')->where('s_id', $s_id)->select('activated')->first();

        if($item->activated){
            DB::table('staff')->where('s_id', $s_id)->update(['activated' => 0]);
            return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deactivated!']);
        }else{
            DB::table('staff')->where('s_id', $s_id)->update(['activated' => 1]);
            return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item activated!']);
        }
        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error!']);
    }
}
