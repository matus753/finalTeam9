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

    private $module_name;
 
    public function __construct(){
        $this->module_name = config('study.name');
    }

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

    public function subjects($id = 0, Request $request){
        if(!is_numeric($id)){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Bad request!']);
        }
        
        $sem = $request->input('semester');
        $filter = $request->input('filter');
        if(!is_numeric($sem) || $sem < 0 || $sem > 1){
            $active_semester = DB::table('schedule_season')->where('active', 1)->first()->semester;
        }else{
            $active_semester = $sem;
        }
        
        if(!is_string($filter) || strlen($filter) < 1){
            $filter = 'name';
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

        if($filter == 'name'){
            $subjects = DB::table('subjects')->where('semester', $active_semester)->where('abbrev', 'like', $find)->orderBy('title')->get();
        }else{
            $subjects = DB::table('subjects')->where('semester', $active_semester)->where('abbrev', 'like', $find)->orderBy('abbrev')->get();
        }
        
        if($subjects){
            foreach($subjects as $subject){
                $subject->subcategories = DB::table('subjects_subcategories')->where('sub_id', $subject->sub_id)->get();
                $subject->info = DB::table('subjects_info')->where('sub_id', $subject->sub_id)->first();
            }
        }else{
            return redirect('/')->with('err_code', ['type' => 'warning', 'msg' => 'Item does not exists!']);
        }
        
        $data = [ 
                'title' => config('study.name'), 
                'subjects' => $subjects,
                'titleSK' => $titleSK,
                'titleEN' => $titleEN,
                'act_sem' => $active_semester,
                'id' => $id,
                'filter' => $filter
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

    /*
    
    SCHEDULE FRONT END
    
    */

    public function schedule_subject( Request $request ){  
        //$year = $request->input('year');
        $sel_subject = $request->input('predmet');
        //$semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        $year = null;
        $semester = null;
        if($year && is_string($year) && strlen($year) > 0 && is_numeric($semester) ){
            $year = DB::table('schedule_season')->where('year', $year)->first();
            $semester = $semester;
        }else{
            $year = DB::table('schedule_season')->where('active', 1)->first();
            
            if(!$year){
                $year = null;
                $semester = 0;
            }else{
                $semester = $year->semester;
            }
        }
        
        if($sel_subject && is_numeric($sel_subject) && $sel_subject > 0 && $year){
            $subject = DB::table('subjects')->where('sub_id', $sel_subject)->where('semester', $semester)->orWhere('semester', 2)->first();
        }else{
            $subject = null;
        }
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
        if($subject){
            foreach($day_names as $key => $dn){
                $day_data = [];
                $tmp = DB::table('lectures')->where('sub_id', $subject->sub_id)->where('day', $key)->where('year', $year->sy_id)->select('start_time', 'room_id', 'type')->get();
                if(count($tmp) > 0){
                    for($i = 0; $i < 15; $i++){
                        foreach($tmp as $t){
                            if($t->start_time == ($i+7)){
                                if($t->type == 'prednaska'){
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $subject->sub_id)->first()->duration_p,
                                        'room' => DB::table('schedule_rooms')->where('sr_id', $t->room_id)->first()->room,
                                        'color' => config('schedule_admin.prednaska_color')

                                    ];
                                }else{
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $subject->sub_id)->first()->duration_c,
                                        'room' => DB::table('schedule_rooms')->where('sr_id', $t->room_id)->first()->room,
                                        'color' => config('schedule_admin.cvicenie_color')
                                    ];
                                }
                            
                                break;
                            }else{
                                $day_data[$i+7] = null;
                            }
                        }
                    }
                    $schedule_data[$dn] = $day_data;
                }

                if($all_days && !isset($schedule_data[$dn]) ){
                    for($i = 0; $i < 15; $i++){
                        $day_data[$i+7] = null;
                    }
                    $schedule_data[$dn] = $day_data;
                }
            }
        }
       
        $seasons = DB::table('schedule_season')->groupBy('semester')->get();
        
        
        $all_subjects = DB::table('subjects')->where('semester', $semester)->orWhere('semester', 2)->get();
        $other_years_db = DB::table('schedule_season')->select('year')->distinct()->orderBy('year')->get();
     
        $data = [ 
            'schedule_data' => $schedule_data,
            'title' => $this->module_name, 
            'subjects' => $all_subjects,
            'subject' => $subject,
            'other_years_db' => $other_years_db,
            'all_days' => $all_days,
            'year'  => $year,
            'seasons' => $seasons,  
            'day_names' => $day_names,
            'semester' => $semester
        ];
        //debug($data, true);
        return view('study::schedule_subject', $data);
    }

    public function schedule_staff( Request $request ){     
        //$year = $request->input('year');
        $selected_staff = $request->input('staff');
        //$semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        $year = null;
        $semester = null;
        if($year && is_string($year) && strlen($year) > 0 && is_numeric($semester) ){
            $year = DB::table('schedule_season')->where('year', $year)->first();
            $semester = $semester;
            
        }else{
            $year = DB::table('schedule_season')->where('active', 1)->first();
            
            if(!$year){
                $year = null;
                $semester = 0;
            }else{
                $semester = $year->semester;
            }
        }

        $selected_staff = !$selected_staff ? [] : $selected_staff;
        if($selected_staff && is_array($selected_staff) && count($selected_staff) > 0){
            $staff = DB::table('staff')->whereIn('s_id', $selected_staff)->where('activated', 1)->first();
        }else{
            $staff = null;
        }
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];

        if($staff){
            $my_subjects_ids = DB::table('subjects')
                                ->join('subjects_staff_rel', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')
                                ->whereIn('subjects_staff_rel.s_id', $selected_staff)
                                ->where('subjects.semester', $semester)
                                ->pluck('subjects_staff_rel.sub_id');
            
            foreach($day_names as $key => $dn){
                $day_data = [];
                $my_schedule = DB::table('lectures')->whereIn('sub_id', $my_subjects_ids)->where('day', $key)->where('year', $year->sy_id)->get();
                if(count($my_schedule)){
                    for($i = 0; $i < 15; $i++){
                        foreach($my_schedule as $m){
                            if($m->start_time == ($i+7) && $m->day == $key){
                                if($m->type == 'prednaska'){
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_p,
                                        'room' => DB::table('schedule_rooms')->where('sr_id', $m->room_id)->first()->room,
                                        'color' => config('schedule_admin.prednaska_color'),
                                        'abb' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,

                                    ];
                                }else{
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_c,
                                        'room' => DB::table('schedule_rooms')->where('sr_id', $m->room_id)->first()->room,
                                        'color' => config('schedule_admin.cvicenie_color'),
                                        'abb' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,

                                    ];
                                }
                            
                                break;
                            }else{
                                $day_data[$i+7] = null;
                            }
                        }
                    }
                    $schedule_data[$dn] = $day_data;
                }

                if($all_days && !isset($schedule_data[$dn]) ){
                    for($i = 0; $i < 15; $i++){
                        $day_data[$i+7] = null;
                    }
                    $schedule_data[$dn] = $day_data;
                }
            }
        }

        $subject_assignment = [];
        foreach($selected_staff as $ss){
            $subject_assignment[] = DB::table('subjects_staff_rel')
                                    ->join('subjects', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')
                                    ->where('subjects_staff_rel.s_id', $ss)
                                    ->get();
        }
        
        $seasons = DB::table('schedule_season')->groupBy('semester')->get();

        $all_staff = DB::table('staff')->where('activated', 1)->get();
        $other_years_db = DB::table('schedule_season')->select('year')->distinct()->orderBy('year')->get()->toArray();

        $data = [ 
            'schedule_data' => $schedule_data,
            'title' => $this->module_name, 
            'all_staff' => $all_staff,
            'staff' => $staff,
            'other_years_db' => $other_years_db,
            'all_days' => $all_days,
            'year'  => $year,
            'seasons' => $seasons,  
            'day_names' => $day_names,
            'semester' => $semester,
            'selected_staff' => $selected_staff,
            'subject_assignment' => $subject_assignment
        ];
        //debug($data, true);
        return view('study::schedule_staff', $data);
    }

    public function schedule_rooms( Request $request ){
        //$year = $request->input('year');
        $room = $request->input('room');
        //$semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        $year = null;
        $semester = null;
        if($year && is_string($year) && strlen($year) > 0 && is_numeric($semester) ){
            $year = DB::table('schedule_season')->where('year', $year)->first();
            $semester = $semester;
            
        }else{
            $year = DB::table('schedule_season')->where('active', 1)->first();
            
            if(!$year){
                $year = null;
                $semester = 0;
            }else{
                $semester = $year->semester;
            }
        }
        
        if($room && is_numeric($room) && $room > 0){
            $room = DB::table('schedule_rooms')->where('sr_id', $room)->first();
        }else{
            $room = null;
        }
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
        
        if($room){
            foreach($day_names as $key => $dn){
                $day_data = [];
                $my_room = DB::table('lectures')
                                ->join('subjects', 'subjects.sub_id', '=', 'lectures.sub_id')
                                ->where('lectures.room_id', $room->sr_id)
                                ->where('lectures.day', $key)
                                ->where('lectures.year', $year->sy_id)
                                ->where('subjects.semester', $semester)
                                ->get();
                if(count($my_room)){
                    for($i = 0; $i < 15; $i++){
                        foreach($my_room as $m){
                            if($m->start_time == ($i+7) && $m->day == $key){
                                if($m->type == 'prednaska'){
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_p,
                                        'subject' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,
                                        'color' => config('schedule_admin.prednaska_color')

                                    ];
                                }else{
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_c,
                                        'subject' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,
                                        'color' => config('schedule_admin.cvicenie_color')
                                    ];
                                }
                            
                                break;
                            }else{
                                $day_data[$i+7] = null;
                            }
                        }
                    }
                    $schedule_data[$dn] = $day_data;
                }

                if($all_days && !isset($schedule_data[$dn]) ){
                    for($i = 0; $i < 15; $i++){
                        $day_data[$i+7] = null;
                    }
                    $schedule_data[$dn] = $day_data;
                }
            }
        }
        
        $seasons = DB::table('schedule_season')->groupBy('semester')->get();

        $all_rooms = DB::table('schedule_rooms')->get();
        $other_years_db = DB::table('schedule_season')->select('year')->distinct()->orderBy('year')->get()->toArray();

        $data = [ 
            'schedule_data' => $schedule_data,
            'title' => $this->module_name, 
            'all_rooms' => $all_rooms,
            'room' => $room,
            'other_years_db' => $other_years_db,
            'all_days' => $all_days,
            'year'  => $year,
            'seasons' => $seasons,  
            'day_names' => $day_names,
            'semester' => $semester
        ];
    
        return view('study::schedule_rooms', $data);
    }

    public function schedule_departments( Request $request ){
        //$year = $request->input('year');
        $department = $request->input('department');
        //$semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        $year = null;
        $semester = null;
        if($year && is_string($year) && strlen($year) > 0 && is_numeric($semester) ){
            $year = DB::table('schedule_season')->where('year', $year)->first();
            $semester = $semester;
            
        }else{
            $year = DB::table('schedule_season')->where('active', 1)->first();
            
            if(!$year){
                $year = null;
                $semester = 0;
            }else{
                $semester = $year->semester;
            }
        }
        
        if($department && is_string($department) && strlen($department) > 0){
            $department = DB::table('staff')->where('department', $department)->first();
        }else{
            $department = null;
        }
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
        
        if($department){
            $my_subjects_ids = DB::table('subjects')
                                ->join('subjects_staff_rel', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')
                                ->join('staff', 'staff.s_id', '=', 'subjects_staff_rel.s_id')
                                ->join('lectures', 'subjects.sub_id', '=', 'lectures.sub_id')
                                ->where('staff.department', $department->department)
                                ->where('year', $year->sy_id)
                                ->where('semester', $semester)
                                ->pluck('subjects_staff_rel.sub_id');
            
            foreach($day_names as $key => $dn){
                $day_data = [];
                $my_schedule = DB::table('lectures')->whereIn('sub_id', $my_subjects_ids)->where('day', $key)->get();
              
                if(count($my_schedule)){
                    for($i = 0; $i < 15; $i++){
                        foreach($my_schedule as $m){
                            if($m->start_time == ($i+7) && $m->day == $key){
                                if($m->type == 'prednaska'){
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_p,
                                        'subject' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,
                                        'color' => config('schedule_admin.prednaska_color')

                                    ];
                                }else{
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_c,
                                        'subject' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,
                                        'color' => config('schedule_admin.cvicenie_color')
                                    ];
                                }
                            
                                break;
                            }else{
                                $day_data[$i+7] = null;
                            }
                        }
                    }
                    $schedule_data[$dn] = $day_data;
                }

                if($all_days && !isset($schedule_data[$dn]) ){
                    for($i = 0; $i < 15; $i++){
                        $day_data[$i+7] = null;
                    }
                    $schedule_data[$dn] = $day_data;
                }
            }
            $department = $department->department;
        }
       
        $seasons = DB::table('schedule_season')->groupBy('semester')->get();

        $all_departments = DB::table('staff')->select('department')->groupBy('department')->get();
        $other_years_db = DB::table('schedule_season')->select('year')->distinct()->orderBy('year')->get()->toArray();
       
        $data = [ 
            'schedule_data' => $schedule_data,
            'title' => $this->module_name, 
            'all_departments' => $all_departments,
            'department' => $department,
            'other_years_db' => $other_years_db,
            'all_days' => $all_days,
            'year'  => $year,
            'seasons' => $seasons,  
            'day_names' => $day_names,
            'semester' => $semester
        ];
        
        return view('study::schedule_departments', $data);
    }
    
    public function schedule_days( Request $request ){
        //$year = $request->input('year');
        $day = $request->input('day');
        //$semester = $request->input('semester');
        $voidRooms = $request->input('voidRooms');
        
        if($voidRooms){
            $voidRooms = true;
        }else{
            $voidRooms = false;
        }
        $year = null;
        $semester = null;
        if($year && is_string($year) && strlen($year) > 0 && is_numeric($semester) ){
            $year = DB::table('schedule_season')->where('year', $year)->first();
            $semester = $semester;
            
        }else{
            $year = DB::table('schedule_season')->where('active', 1)->first();
            
            if(!$year){
                $year = null;
                $semester = 0;
            }else{
                $semester = $year->semester;
            }
        }
       
        if(!$day && !is_numeric($day) && $day < 0){
            $day = null;
        }
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $all_rooms = DB::table('schedule_rooms')->get();
        $schedule_data = [];
    
        if(is_numeric($day) && $day >= 0){   
            foreach($all_rooms as $r){
                $day_data = [];
                $my_schedule = DB::table('lectures')
                                    ->join('subjects', 'subjects.sub_id', '=', 'lectures.sub_id')
                                    ->where('room_id', $r->sr_id)
                                    ->where('day', $day)
                                    ->where('year', $year->sy_id)
                                    ->where('semester', $semester)
                                    ->get();
               
                if(count($my_schedule)){
                    for($i = 0; $i < 15; $i++){
                        foreach($my_schedule as $m){
                            if($m->start_time == ($i+7) && $m->day == $day){
                                if($m->type == 'prednaska'){
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_p,
                                        'subject' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,
                                        'color' => config('schedule_admin.prednaska_color')

                                    ];
                                }else{
                                    $day_data[$i+7] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_c,
                                        'subject' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->abbrev,
                                        'color' => config('schedule_admin.cvicenie_color')
                                    ];
                                }
                            
                                break;
                            }else{
                                $day_data[$i+7] = null;
                            }
                        }
                    }
                    $schedule_data[$r->room] = $day_data;
                }
                if($voidRooms && !isset($schedule_data[$r->room]) ){
                    for($i = 0; $i < 15; $i++){
                        $day_data[$i+7] = null;
                    }
                    $schedule_data[$r->room] = $day_data;
                }
            }
        }
        
        $seasons = DB::table('schedule_season')->groupBy('semester')->get();
        $other_years_db = DB::table('schedule_season')->select('year')->distinct()->orderBy('year')->get()->toArray();

        $data = [ 
            'schedule_data' => $schedule_data,
            'title' => $this->module_name, 
            'day' => $day,
            'other_years_db' => $other_years_db,
            'voidRooms' => $voidRooms,
            'year'  => $year,
            'seasons' => $seasons,  
            'day_names' => $day_names,
            'semester' => $semester
        ];
        
        return view('study::schedule_days', $data);
    }
}
