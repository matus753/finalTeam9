<?php

namespace Modules\Study\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;


class Study extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function getAvailableThesis($id){
        if(!is_numeric($id)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }

        $module_name = config('study.name');
        list($thesisType, $thesisTypeId, $urlBack, $studyType) = $this->getThesisType($id);

        if(!is_string($thesisType) || !is_numeric($thesisTypeId) || !is_string($urlBack) || !is_string($studyType)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }

        $data = [
            'title' => $module_name,
            'typ' => $thesisType,
            'urlBack' => $urlBack,
            'typId' => $thesisTypeId,
            'studyType' => $studyType
        ];

        return view('study::getAvailableThesis', $data);
    }

    public function parseResponse($tableRows){
        $arr =[];
        $studPrograms = [];
        foreach ($tableRows as $value) {
            $obsadenost = explode('/',trim($value->childNodes[8]->textContent));
            if (((string)$obsadenost[1] == (string)" --")  || (intval($obsadenost[0]) < intval($obsadenost[1])) ) {
                $s = explode('?', $value->childNodes[7]->firstChild->firstChild->getAttribute('href') );
                $s = explode(';', $s[1]);
                $s = explode('=', $s[0]);
                $arr[] = [
                    'a1' => $value->childNodes[7]->firstChild->firstChild->getAttribute('href'),
                    'a2' => $value->childNodes[2]->textContent,
                    'a3' => $value->childNodes[2]->textContent,
                    'a4' => $value->childNodes[3]->textContent,
                    'a5' => $value->childNodes[5]->textContent,
                    'a6' => $s[1]
                ];
                if ( !in_array($value->childNodes[5]->textContent, $studPrograms)){
                    array_push($studPrograms, $value->childNodes[5]->textContent);
                }
            }
        }
        return array($arr, $studPrograms);
    }

    public function getThesisType($id){
        if(!is_numeric($id)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }

        if ($id == 1){
            $thesisType = 'bakalárske';
            $studyType = 'bakalárske';
            $thesisTypeId = 1;
            $urlBack = 'bachelor';
        } else {
            $thesisType = 'diplomové';
            $studyType = 'inžinierske';
            $urlBack = 'master';
            $thesisTypeId = 2;
        }
        return array($thesisType, $thesisTypeId, $urlBack, $studyType);
}

    public function getThesisAnot(Request $request){
        $url = $request->input('urlka');
        $annotationURL = 'http://is.stuba.sk'.$url;

        $ch = curl_init($annotationURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $returndata = curl_exec($ch);
        curl_close($ch);

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($returndata);
        $xPath = new \DOMXPath($doc);
        $annotation = $xPath->query('//html/body/div/div/div/table[1]/tbody/tr[last()]/td[last()]')[0]->textContent;
        return $annotation;
    }

    public function getFilterThesis(Request $request){
        $ustav = $request->input('ustav');
        $id = $request->input('id');
        $lang = $request->input('lang');

        $urltopost = "http://is.stuba.sk/pracoviste/prehled_temat.pl";
        $datatopost = array (
            "lang" => $lang,
            "filtr_typtemata2" => $id,
            "filtr_programtemata2" => "1",
            "filtr_vedtemata2" => "0",
            "pracoviste" => $ustav,
            'omezit_temata2' => 'Obmedziť',
        );

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
        $tableRows = $xPath->query('//html/body/div/div/div/form/table[last()]/tbody/tr');

        list($arr, $studPrograms) = $this->parseResponse($tableRows);

        $data = [
            'hodnoty' => $arr,
            'studPrograms' => $studPrograms,
            'ustav' => $ustav
        ];

        return $data;
    }

    public function admission()
    {
        $module_name = config('study.name');

        $data = [
            'title' => $module_name,
        ];

        return view('study::admission', $data);
    }

    public function bachelor()
    {
        $module_name = config('study.name');

        $data = [
            'title' => $module_name,
        ];

        return view('study::bachelor', $data);
    }

    public function master()
    {
        $module_name = config('study.name');

        $data = [
            'title' => $module_name,
        ];

        return view('study::master', $data);
    }

    public function doctoral()
    {
        $module_name = config('study.name');

        $data = [
            'title' => $module_name,
        ];

        return view('study::doctoral', $data);
    }

    public function subjects($id = 0){
        if(!is_numeric($id)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }

        if($id == 1) {
            $titleSK = 'Bakalárske predmety';
            $titleEN = 'Bachelor courses';
            $find = 'B-%';
        } else if ($id == 2) {
            $titleSK = 'Inžinierske predmety';
            $titleEN = 'Master courses';
            $find = 'I-%';
        }
        $subjects = DB::table('subjects')->where('abbrev', 'like', $find)->get();
        if($subjects){
            foreach($subjects as $subject){
                $subject->subcategories = DB::table('subjects_subcategories')->where('sub_id', $subject->sub_id)->get();
            }
        }else{
            return redirect('/')->with('err_code', ['type' => 'warning', 'msg' => 'Item does not exists!']);
        }
        
        $data = [ 
                'title' => config('study.name'), 
                'subjects' => $subjects,
                'titleSK' => $titleSK,
                'titleEN' => $titleEN
            ];
        
        return view('study::subjects', $data);
    }

    public function subject($id = 0) {
        if(!is_numeric($id)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }

        $module_name = config('study.name');
        $subject = DB::table('subjects')->where('sub_id', $id)->first();

        if($subject){
            $locale = session()->get('locale');
            if($locale == 'sk'){
                $info = DB::table('subjects_info')->select('info_sk as info')->where('sub_id', $subject->sub_id)->first();    
                $subcats = DB::table('subjects_subcategories')->select('ss_id', 'name_sk as name')->where('sub_id', $subject->sub_id)->get();
            }else{
                $info = DB::table('subjects_info')->select('info_en as info')->where('sub_id', $subject->sub_id)->first();    
                $subcats = DB::table('subjects_subcategories')->select('ss_id', 'name_en as name')->where('sub_id', $subject->sub_id)->get();
            }
        }else{
            return redirect('/')->with('err_code', ['type' => 'warning', 'msg' => 'Subject does not exists!']);
        }

        if(!$info){
            $info = null;
        }
        $subcats = (!$subcats) ? [] : $subcats;
        $data = [
            'title' => $module_name,
            'subject' => $subject,
            'subcats' => $subcats,
            'info' => $info
        ];

        return view('study::subject', $data);
    }

    public function show_subject_item($ss_id = 0){
        if(!is_numeric($ss_id)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }

        $module_name = config('study.name');
        


        $locale = session()->get('locale');
        if($locale == 'sk'){
            $subcat = DB::table('subjects_subcategories')->select('sub_id', 'hash_name', 'name_sk as name', 'text_sk as text')->where('ss_id', $ss_id)->first();
        }else{
            $subcat = DB::table('subjects_subcategories')->select('sub_id', 'hash_name', 'name_en as name', 'text_en as text')->where('ss_id', $ss_id)->first();
        }
       
        if($subcat){
            $subject = DB::table('subjects')->where('sub_id', $subcat->sub_id)->first();
            $files = DB::table('subjects_files')->where('hash_id', $subcat->hash_name)->get();
        }else{
            return redirect('/')->with('err_code', ['type' => 'warning', 'msg' => 'Item does not exists!']);
        }
        $files = (!$files) ? [] : $files;

        $data = [
            'title' => $module_name,
            'subcat' => $subcat,
            'subject' => $subject,
            'files' => $files
        ];

        return view('study::subject_subcategory', $data);
    }
}
