<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class Login extends Controller
{
    public function index()
    {
		$module_name = config('login.name');
		
		$data = [ 'title' => $module_name ];
		
        return view('login::index', $data);
    }

	public function login_action( Request $request ){
		#!!!!!!!!!!! TO DO REMOVE BAD STRING
		$login = $request->input('name');
		$password = $request->input('pass');
		
		$in_table = DB::table('staff')->where('ldapLogin', $login)->first();
		
		if($in_table == null){
			return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
		}
		
		$ldap_server = config('login.ldapServer');
		if($connect=@ldap_connect($ldap_server)){ // if connected to ldap server
			ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

			if(($bind=@ldap_bind($connect)) == false){
				//print "bind:__FAILED__<br>\n";
				//return false;
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}

			if (($res_id = ldap_search( $connect,"dc=stuba, dc=sk","uid=$login")) == false) {
				//print "failure: search in LDAP-tree failed<br>";
				//return false;
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}

			if (( $entry_id = ldap_first_entry($connect, $res_id))== false) {
				//print "failure: entry of searchresult couln't be fetched<br>\n";
				//return false;
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}

			if (( $user_dn = ldap_get_dn($connect, $entry_id)) == false) {
				//print "failure: user-dn coulnd't be fetched<br>\n";
				//return false;
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}
			
			if (($link_id = ldap_bind($connect, $user_dn, $password)) == false) {
				//print "failure: username, password didn't match: $user_dn<br>\n";
				//return false;
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}
			
			$log = $in_table->id."/".$in_table->name."+".$in_table->surname;
			$role = $in_table->role;
			$user = [
				'logged' => $log,
				'role' => $role
			];
			//session()->forget('error');
			session()->put('user', $user);
			return redirect('/login')->with('err_code', ['type' => 'success', 'msg' => 'Authentification success!']);
		}
	
		return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
		
	}
	
}
