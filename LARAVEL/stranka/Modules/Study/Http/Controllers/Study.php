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

        $module_name = config('study.name');

        list($thesisType, $thesisTypeId, $urlBack, $studyType) = $this->getThesisType($id);
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

    public function subjects($id){
        if($id == 1) {
            $titleSK = 'Bakalárske predmety';
            $titleEN = 'Bachelor courses';
            $find = 'B-%';
        } else if ($id == 2) {
            $titleSK = 'Inžinierske predmety';
            $titleEN = 'Master courses';
            $find = 'I-%';
        }
//        $subjects = DB::table('subjects')->get();

        $subjects = DB::table('subjects')->where('abbrev', 'like', $find)->get();
        foreach($subjects as $subject){
            $subject->subcategories = DB::table('subjects_subcategories')->where('sub_id', $subject->sub_id)->get();
        }

        $data = [ 
                'title' => config('study.name'), 
                'subjects' => $subjects,
                'titleSK' => $titleSK,
                'titleEN' => $titleEN
            ];

        
        return view('study::subjects', $data);
    }

    public function subject($id) {
        $module_name = config('study.name');
        $subject = DB::table('subjects')->where('sub_id', $id)->first();
        $subcats = DB::table('subjects_subcategories')->where('sub_id', $subject->sub_id)->get();
        $subcats = (!$subcats) ? [] : $subcats;
        $data = [
            'title' => $module_name,
            'subject' => $subject->title,
            'subcats' => $subcats
        ];

        return view('study::subject', $data);
    }
}
