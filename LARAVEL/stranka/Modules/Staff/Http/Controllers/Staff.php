<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Staff extends Controller
{
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

		$ais_id = null;
		if($ais->ldapLogin){
			$ais_id = $this->getAisId($ais->ldapLogin);
		}
		
		$data = [
			'title' => $module_name,
			'ais' => $ais,
			'ais_id' => $ais_id
		];
		
		return view('staff::getstaffbyid', $data);
	}
	
	private function getAisId( $ais_login = '' ){
		if($ais_login == ''){
			return false;
		}
		$server = config('staff.ldap_server');
		$port = config('staff.ldap_port');
		$nick = $ais_login;
		
		$ldap = ldap_connect($server,$port);
		$ldaprdn = 'uid='.$nick.',ou=People,DC=stuba,DC=sk';
		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3); 
		
		$filter_person = "(&(uid={$nick}))";
		$sr_person = ldap_search($ldap,'ou=People,DC=stuba,DC=sk',$filter_person);
		$sr = ldap_get_entries($ldap, $sr_person);
		$myUserId = $sr[0]["uisid"][0];
		
		@ldap_close($ldap); 
		return $myUserId;
	}
	
	public function ajax_get_pubs( Request $request){
		$ais_id = $request->input('ais_id');
		$urltopost = "http://is.stuba.sk/lide/clovek.pl";
		$datatopost = [
			"lang" => 'sk',
			"zalozka" => '5',
			"id" => $ais_id,
			"rok"=> '1',
			"order_by"=> 'rok_uplatneni'
		];
		

		$ch = curl_init ($urltopost);

		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

		$returndata = curl_exec($ch);

		curl_close($ch);
		
		$doc = new \DOMDocument();
		libxml_use_internal_errors(true);
		$doc->loadHTML($returndata);
		$xPath = new \DOMXPath($doc);
		$tablePublikacia = $xPath->query('//html/body/div/div/div/table[3]/tbody/tr');
		//??
		$monografie = [];
		$clanky = [];
		$prispevky = [];
		$data = [];
		foreach ($tablePublikacia as $publ) {
			if((intval($publ->childNodes[3]->textContent) > config('staff.publications_year_limit'))){
				if(strpos($publ->childNodes[2]->textContent,"monografie") === 0){
					$data[] = [ 
								'content' => $publ->childNodes[1]->textContent, 
								'type' => $publ->childNodes[2]->textContent, 
								'year' => intval($publ->childNodes[3]->textContent) 
							];
				}
				if(strpos($publ->childNodes[2]->textContent,"články") === 0){
					$data[] = [ 
								'content' => $publ->childNodes[1]->textContent, 
								'type' => $publ->childNodes[2]->textContent, 
								'year' => intval($publ->childNodes[3]->textContent) 
							];
				}
				if(strpos($publ->childNodes[2]->textContent,"príspevky") === 0){
					$data[] = [ 
								'content' => $publ->childNodes[1]->textContent, 
								'type' => $publ->childNodes[2]->textContent, 
								'year' => intval($publ->childNodes[3]->textContent) 
							];
				}
			}
		}
		
		//debug($data);
		
		return json_encode($data);
	}
    
	
}
