<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Intranet_schedule extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function index(){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        debug(" TREBA PREROBIT DO FRAMEWORK STYLU ", true);
		$data = [ 'title' => $this->module_name ];
		
        return view('intranet::schedule/index', $data);
    }

}
