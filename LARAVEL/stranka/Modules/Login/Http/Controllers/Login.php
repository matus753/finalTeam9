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

		$login = $request->input('name');
		$password = $request->input('pass');
		
		if(!is_string($login) || strlen($login) == 0 || !is_string($password) || strlen($password) == 0 ){
			return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Bad login parameters!']);
		}
	
		if($this->local_login($login, $password)){
			return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Authentification success!']);
		}
	
		$in_table = DB::table('staff')->where('ldapLogin', $login)->where('activated', 1)->first();
		
		if($in_table == null){
			return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
		}
		
		$ldap_server = config('login.ldapServer');
		if($connect=@ldap_connect($ldap_server)){ // if connected to ldap server
			ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

			if(($bind = @ldap_bind($connect)) == false){
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}

			if (($res_id = @ldap_search( $connect,"dc=stuba, dc=sk","uid=$login")) == false) {
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}

			if (( $entry_id = @ldap_first_entry($connect, $res_id))== false) {
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}

			if (( $user_dn = @ldap_get_dn($connect, $entry_id)) == false) {
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}
			
			$connection = @ldap_bind($connect, $user_dn, $password);

			if ($connection == FALSE) {
				return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
			}
			
			$id = $in_table->s_id;
			$check = sha1(md5($in_table->name.$in_table->surname).$in_table->surname);
			$role = json_decode($in_table->roles);

			$role = (!$role) ? [] : $role;

			$user = [
				'id' => $id,
				'logged' => true,
				'role' => $role,
				'check' => $check,
			];

			session()->put('user', $user);
			return redirect('/documents-admin')->with('err_code', ['type' => 'success', 'msg' => 'Authentification success!']);
		}
	
		return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Authentification failed!']);
	}

	public function logout_action(){
		if(isLogged()){
			session()->forget('user');
			return redirect('/')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly logged out']);
		}else{
			return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Your session expired']);
		}
		return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error']);
	}


	private function local_login($login = '', $password = ''){
		if(!is_string($login) || strlen($login) == 0 || !is_string($password) || strlen($password) == 0 ){
			return redirect('/login')->with('err_code', ['type' => 'error', 'msg' => 'Bad login parameters!']);
		}

		$local_name = config('login.locale_admin_name');
		$local_pass = config('login.locale_admin_pass');
		$salt = config('login.locale_admin_salt');
											
		if($local_name == $login && sha1($login.sha1(sha1($password)).$salt) == sha1($local_name.sha1($local_pass).$salt) ){
			$user = [
				'id' => 10001,
				'logged' => true,
				'role' => ['locale']
			];
			session()->put('user', $user);
			return true;
		}else{
			return false;
		}
		return false;
	}
	
}
