<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Staff extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$module_name = config('staff.name');
		$staff_db = DB::table('staff')->get();
		
		$data= [
			'title' => $module_name,
			'staff' => $staff_db
		];
		
        return view('staff::staff', $data);
    }
	
	public function getStaffById( $id = 0 ){
		if(!is_numeric($id)){
			return false;
		}
		$module_name = config('staff.name');
		$ais = DB::table('staff')->where( 'id', $id )->first();
		
		//TO DO LDAP nejde
		//$ais_id = $this->getAisId($ais->ldapLogin);
		
		$data = [
			'title' => $module_name,
			'ais' => $ais
		];
		//debug($data,true);
		
		return view('staff::getstaffbyid', $data);
	}
	
	private function getAisId( $ais_login = '' ){
		if($ais_login == ''){
			return false;
		}
		$server = config('staff.ldap_server');
		$port = config('staff.ldap_port');
		$ldap = @ldap_connect($server ,$port );
		if(@ldap_bind($ldap)){
			@ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			
			$search_person = @ldap_search($ldap,'ou=People,DC=stuba,DC=sk', "(&(uid={$ais_login}))");
			$person = @ldap_get_entries($ldap, $search_person);
			//return $person[0]["uisid"][0];
			return "lalala";
		}
		echo 'something is bad';
		@ldap_close($ldap); 
		return false;
		
	}
    
	
}
