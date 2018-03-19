<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function intranet(){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        /*$id = 43;
        $res = DB::table('staff')->where('s_id', $id)->first();
        $role = json_decode($res->roles);
        $check = sha1(md5($res->name.$res->surname).$res->surname);

        $user = [
            'id' => $id,
            'logged' => true,
            'role' => $role,
            'check' => $check,
        ];

        session()->put('user',$user);*/

		$data = [ 'title' => $this->module_name ];
		
        return view('intranet::intranet', $data);
    }

}
