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
        if(!is_numeric($s_id) || $s_id == 0){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $staff = DB::table('staff')->where('s_id', $s_id)->first();
        $ais = (!$staff) ? [] : $staff;

        $data = [ 
                'title' => $this->module_name, 
                'ais' => $ais,
            ];

        return view('intranet::staff/staff_show_profile', $data);
    }

    public function staff_add(){

        /*$departments = DB::table('staff')->select('department')->groupBy('department')->get();
        $roles = DB::table('staff')->select('staffRole')->groupBy('staffRole')->get();*/
        $locale = session()->get('locale');
        if($locale == 'sk'){
            $roles = config('staff_admin.rolesSK');
        }else{
            $roles = config('staff_admin.rolesEN');
        }

        $departments = config('staff_admin.departments');
        $permission_roles = config('staff_admin.permission_roles');

        $data = [
            'title' => $this->module_name,
            'departments' => $departments,
            'roles' => $roles,
            'permission_roles' => $permission_roles
        ];
        //debug($data, true);
        return view('intranet::staff/staff_add', $data);
    }

    public function staff_add_action( Request $request ){
        // TODO REMOVE BAD STRING
        
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
        $perm = $request->input('perm');
       
        if(is_array($perm)){
            $permissions = [];
            foreach($perm as $p){
                $permissions[] = $p;
            }
        }else{
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'Input error error!']);
        }
    
        $x_rule = config('staff_admin.x_rule');
        if($x_rule){
            $ldap = $request->input('ldap');
            if($ldap[0] != 'x'){
                return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'LDAP syntax error!']);
            }
        }

        if($url){
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
        }

        $gender_rule = config('staff_admin.gender_rule');
        if($img){
            $photo = $img->hashName();
            $img->store('/public/staff/');
        }else{
            if($gender_rule && strlen($surname) > 2 ){
                if(substr($surname, -4) == 'ová'){
                    $photo = config('staff_admin.default_imgs')['default_female_img'];
                }else{
                    $photo = config('staff_admin.default_imgs')['default_male_img'];
                }
            }else{
                $photo = config('staff_admin.default_imgs')['default_img'];
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
            'function' => $func,
            'roles' => json_encode($permissions),
            'email' => $email,
            'web' => $url
        ];
       
        $res = (bool) DB::table('staff')->insert($data);
        if($res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item added successfuly!']);
        }
        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function staff_edit( $s_id = 0 ){
        if(!is_numeric($s_id)){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }

        $item = DB::table('staff')->where('s_id', $s_id)->first();
        $item->roles = json_decode($item->roles);
        /*$departments = DB::table('staff')->select('department')->groupBy('department')->get();
        $roles = DB::table('staff')->select('staffRole')->groupBy('staffRole')->get();*/

        $locale = session()->get('locale');
        if($locale == 'sk'){
            $roles = config('staff_admin.rolesSK');
        }else{
            $roles = config('staff_admin.rolesEN');
        }
        $departments = config('staff_admin.departments');
        $permission_roles = config('staff_admin.permission_roles');

        $data = [
            'title' => $this->module_name,
            'item' => $item,
            'departments' => $departments,
            'roles' => $roles,
            'permission_roles' => $permission_roles
        ];
        //debug($data, true);
        return view('intranet::staff/staff_edit', $data);
    }

    public function staff_edit_action( $s_id = 0, Request $request ){
        if(!is_numeric($s_id)){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        
        // TODO REMOVE BAD STRING
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
        //file
        $img = $request->file('img');
        $default_photo = $request->input('default_photo');
        $perm = $request->input('perm');
       
        if(is_array($perm)){
            $permissions = [];
            foreach($perm as $p){
                $permissions[] = $p;
            }
        }else{
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'Input error error!']);
        }

        $x_rule = config('staff_admin.x_rule');
        if($x_rule){
            $ldap = $request->input('ldap');
            if($ldap[0] != 'x'){
                return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'LDAP syntax error!']);
            }
        }

        if($url){
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) {
                $url = 'http://'.ltrim($url, '/');
            }
        }

        $gender_rule = config('staff_admin.gender_rule');
        if($img && !$default_photo){
            $original_img = DB::table('staff')->select('photo')->where('s_id', $s_id)->first();
            if(array_search($original_img->photo, config('staff_admin.default_imgs')) == null){
                $path = $path = base_path('storage/app/public/staff/').$original_img->photo;
                unlink($path);
            }
            $photo = $img->hashName();
            $img->store('/public/staff/');
        }else{
            $original_img = DB::table('staff')->select('photo')->where('s_id', $s_id)->first();
            if(array_search($original_img->photo, config('staff_admin.default_imgs')) == null){
                $path = $path = base_path('storage/app/public/staff/').$original_img->photo;
                unlink($path);
            }
            if($gender_rule && strlen($surname) > 2 ){
                if(substr($surname, -4) == 'ová'){
                    $photo = config('staff_admin.default_imgs')['default_female_img'];
                }else{
                    $photo = config('staff_admin.default_imgs')['default_male_img'];
                }
            }else{
                $photo = config('staff_admin.default_imgs')['default_img'];
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
            'function' => $func,
            'roles' => json_encode($permissions),
            'email' => $email,
            'web' => $url
        ];

        $res = DB::table('staff')->where('s_id', $s_id)->update($data);
        if($res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item updated successfuly!']);
        }
        return redirect('/staff-admin')->with('err_code', ['type' => 'warning', 'msg' => 'DB error or no changes!']);
    }

    public function staff_delete_action( $s_id = 0 ){
        if(!is_numeric($s_id)){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        
        $original_img = DB::table('staff')->select('photo')->where('s_id', $s_id)->first();
        if(array_search($original_img->photo, config('staff_admin.default_imgs')) == null){
            $path = $path = base_path('storage/app/public/staff/').$original_img->photo;
            unlink($path);
        }

        $res = (bool) DB::table('staff')->where('s_id', $s_id)->delete();
        if($res){
            return redirect('/staff-admin')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted successfuly!']);
        }
        return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB error!']);
    }

    public function staff_activate_user($s_id = 0){
        if(!is_numeric($s_id) || $s_id == 0){
            return redirect('/staff-admin')->with('err_code', ['type' => 'error', 'msg' => 'DB bad item error!']);
        }
        // ak je aktivne tak deaktivuj inak aktivuj
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
