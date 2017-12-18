<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class Intranet extends Controller
{
    public function intranet()
    {
		$module_name = config('intranet.name');
		
		$data = [ 'title' => $module_name ];
		
        return view('intranet::intranet', $data);
    }

}
