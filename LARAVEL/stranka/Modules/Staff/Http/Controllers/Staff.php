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
		$activation = config('staff_admin.activation');
		if($activation){
			$staff_db = DB::table('staff')->where('activated', 1)->get();
		}else{
			$staff_db = DB::table('staff')->get();
		}
		
		
		foreach($staff_db as $s){
            $s->function = $this->getFunctions($s->s_id);
			if($s->staffRole != null){
				if($s->staffRole == "administrative"){
					$s->staffRole = trans('staff::staff.administrative');
				}
				if($s->staffRole == "teacher"){
					$s->staffRole = trans('staff::staff.teacher');
				}
				if($s->staffRole == "doktorand"){
					$s->staffRole = trans('staff::staff.doktorand');
				}
				if($s->staffRole == "researcher"){
					$s->staffRole = trans('staff::staff.researcher');
				}
			}
		}

        $data= [
			'title' => $module_name,
			'staff' => $staff_db
		];

        return view('staff::staff', $data);
    }

    public function getFunctions($id){
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
                        array_push($myFuncs, trans('staff::staff.riaditel'));
                        break;
                    case 2:
                        array_push($myFuncs, trans('staff::staff.veduci_oddelenia'));
                        break;
                    case 3:
                        array_push($myFuncs, trans('staff::staff.zastupca_veduceho'));
                        break;
                    case 4:
                        array_push($myFuncs, trans('staff::staff.veduci_vc'));
                        break;
                    case 5:
                        array_push($myFuncs, trans('staff::staff.veduci_ru'));
                        break;
                    case 6:
                        array_push($myFuncs, trans('staff::staff.veduci_pc'));
                        break;
                }
            }
        }
        return $myFuncs;
    }

	public function getStaffById( $id = 0 ){
		if(!is_numeric($id)){
			return redirect('/staff')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
		}

		$module_name = config('staff.name');
		$activation = config('staff_admin.activation');
		if($activation){
			$ais = DB::table('staff')->where( 's_id', $id )->where('activated', 1)->first();
		}else{
			$ais = DB::table('staff')->where( 's_id', $id )->first();
		}

		if($ais){
			$ais_id = null;
			if($ais->ldapLogin && is_string($ais->ldapLogin) && strlen($ais->ldapLogin) > 0){
                $ais_id = $this->getAisId($ais->ldapLogin);
            }
            $ais->function = $this->getFunctions($ais->s_id);
            $ais->function = (!$ais->function) ? [] : $ais->function;

			$data = [
				'title' => $module_name,
				'ais' => $ais,
				'ais_id' => $ais_id
			];
			
			return view('staff::getstaffbyid', $data);
		}else{
			return redirect('/staff')->with('err_code', ['type' => 'warning', 'msg' => 'Item does not exists!']);
		}
		return redirect('/staff')->with('err_code', ['type' => 'error', 'msg' => 'Internal error!']);
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
		$urltopost = "https://is.stuba.sk/lide/clovek.pl";
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
		
		return json_encode($data);
	}
    
	
}
