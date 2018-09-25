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

    public function schedule_subject( Request $request ){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $year = $request->input('year');
        $sel_subject = $request->input('predmet');
        $semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        
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
                    foreach($tmp as $t){
                        for($i = 0; $i < 15; $i++){
                            if($t->start_time == ($i+7)){
                                if($t->type == 'prednaska'){
                                    
                                    $day_data[$i+7][] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $subject->sub_id)->first()->duration_p,
                                        'room' => DB::table('schedule_rooms')->where('sr_id', $t->room_id)->first()->room,
                                        'color' => config('schedule_admin.prednaska_color')

                                    ];
                                }else{
                                    $day_data[$i+7][] = [
                                        'duration' => DB::table('subjects')->where('sub_id', $subject->sub_id)->first()->duration_c,
                                        'room' => DB::table('schedule_rooms')->where('sr_id', $t->room_id)->first()->room,
                                        'color' => config('schedule_admin.cvicenie_color')
                                    ];
                                }
                                
                                break;
                            }else{
                                if(!isset($day_data[$i+7])){
                                    $day_data[$i+7] = null;
                                }
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
       
        return view('intranet::schedule/schedule_subject', $data);
    }

    public function schedule_staff( Request $request ){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $year = $request->input('year');
        $selected_staff = $request->input('staff');
        $semester = $request->input('semester');
        $all_days = $request->input('voidDays');
       
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        
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
            $staff = DB::table('staff')->whereIn('s_id', $selected_staff)->where('activated', 1)->get();
        }else{
            $staff = null;
        }
       
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];

        $clrs = [];
        $data_days = [];
        
        if($staff){ 
            $my_subjects_ids = DB::table('lectures')->join('subjects', 'subjects.sub_id', '=', 'lectures.sub_id')->whereIn('lectures.s_id', $selected_staff)->where('subjects.semester', $semester)->distinct()->pluck('subjects.sub_id');
            foreach($day_names as $key => $dn){   
                for($i = 0; $i < 15; $i++){
                    $my_schedule = DB::table('lectures')->whereIn('sub_id', $my_subjects_ids)->where('day', $key)->where('start_time', ($i+7))->where('year', $year->sy_id)->get();
                    if(count($my_schedule) > 0){
                        foreach($my_schedule as $ms){
                            $row_cnt = 0;
                            while(isset($data_days[$dn][$row_cnt][$i+7]) || isset($data_days[$dn][$row_cnt][$i+6]) || isset($data_days[$dn][$row_cnt][$i+8]) ){
                                $row_cnt++;
                            }

                            $sub = DB::table('subjects')->where('sub_id', $ms->sub_id)->get()[0];
                            if(!isset($clrs[$sub->abbrev])){
                                $clrs[$sub->abbrev] = 'background-color: '.$this->random_color().';';
                            }

                            if($ms->type == 'prednaska'){
                                $data_days[$dn][$row_cnt][$i+7] = [
                                    'abb' => $sub->abbrev,
                                    'title' => $sub->title,
                                    'duration' => $sub->duration_p,
                                    'staff' => DB::table('staff')->select('name','surname','title1','title2')->where('s_id', $ms->s_id)->get()[0],
                                    'room' => DB::table('schedule_rooms')->select('room')->where('sr_id', $ms->room_id)->get()[0],
                                    'cvicenie' => false
                                ];
                            }else{
                                $data_days[$dn][$row_cnt][$i+7] = [
                                    'abb' => $sub->abbrev,
                                    'title' => $sub->title,
                                    'duration' => $sub->duration_c,
                                    'staff' => DB::table('staff')->select('name','surname','title1','title2')->where('s_id', $ms->s_id)->get()[0],
                                    'room' => DB::table('schedule_rooms')->select('room')->where('sr_id', $ms->room_id)->get()[0],
                                    'cvicenie' => true
                                ];
                            }
                            for($j = 0; $j < 15; $j++){
                                if(!isset($data_days[$dn][$row_cnt][$j+7])){
                                    $data_days[$dn][$row_cnt][$j+7] = null;
                                    
                                }
                            }
                            ksort($data_days[$dn][$row_cnt]);
                        }
                       
                    }
                }   

                if($all_days && !isset($data_days[$dn]) ){
                    for($i = 0; $i < 15; $i++){
                        $data_days[$dn][0][$i+7] = null;
                    }
                }
            }
        }

        $seasons = DB::table('schedule_season')->groupBy('semester')->get();
        $all_staff = DB::table('staff')->where('activated', 1)->get();
        $other_years_db = DB::table('schedule_season')->select('year')->distinct()->orderBy('year')->get()->toArray();

        $data = [ 
            'schedule_data' => $data_days,
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
            'clrs' => $clrs,
            
        ];
        
        return view('intranet::schedule/schedule_staff', $data);
    }

    public function schedule_rooms( Request $request ){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $year = $request->input('year');
        $room = $request->input('room');
        $semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        
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

        if(is_numeric($room) && $room > 0){
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
        
        return view('intranet::schedule/schedule_rooms', $data);
    }

    public function schedule_departments( Request $request ){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $year = $request->input('year');
        $department = $request->input('department');
        $semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        
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
       
        return view('intranet::schedule/schedule_departments', $data);
    }
    
    public function schedule_days( Request $request ){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $year = $request->input('year');
        $day = $request->input('day');
        $semester = $request->input('semester');
        $voidRooms = $request->input('voidRooms');
        
        if($voidRooms){
            $voidRooms = true;
        }else{
            $voidRooms = false;
        }
        
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
        
        return view('intranet::schedule/schedule_days', $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////// Upravovanie rozvrhov //////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
        najprv sa vyberie predmet
    */
    public function schedule_add_choose(){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $active_year = DB::table('schedule_season')->where('active', 1)->first();
        $subjects_with_schedule = DB::table('lectures')
                                        ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                                        ->where('semester', $active_year->semester)
                                        ->orderBy('subjects.title')
                                        ->groupBy('subjects.sub_id')
                                        ->get();

        $subjects_with_schedule_ids = DB::table('lectures')
                                        ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                                        ->where('semester', $active_year->semester)
                                        ->groupBy('subjects.sub_id')
                                        ->orderBy('subjects.title')
                                        ->pluck('lectures.sub_id')->toArray();

        $subjects_with_schedule = (!$subjects_with_schedule) ? [] : $subjects_with_schedule;

        $subjects_without_schedule = DB::table('subjects')
                                        ->whereNotIn('sub_id',$subjects_with_schedule_ids)
                                        ->where('semester', $active_year->semester)
                                        ->orderBy('subjects.title')
                                        ->get();  

        if(count($subjects_without_schedule) == 0){
            $subjects_without_schedule = DB::table('subjects')->where('semester', $active_year->semester)->orderBy('subjects.title')->get();
        }

        $data = [
            'title' => $this->module_name, 
            'subjects_with_schedule' => $subjects_with_schedule,
            'subjects_without_schedule' => $subjects_without_schedule,
            'active_year' => $active_year,
        ];
        
        return view('intranet::schedule/schedule_add_choose_sub', $data);
    }

    /*
        pridanie prednasok / cvik
    */

    public function schedule_add( Request $request ){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }

        $sub_id = $request->input('sub');

        if(!is_numeric($sub_id)){
            return redirect('/schedule-admin-subject')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        $subject = DB::table('subjects')->where('sub_id', $sub_id)->first();
        $active_year = DB::table('schedule_season')->where('active', 1)->first();
        $rooms = DB::table('schedule_rooms')->get();

        $prednasky = DB::table('lectures')->where('sub_id', $sub_id)->where('type', 'prednaska')->orderBy('day')->orderBy('start_time')->get();
        if($prednasky){
            foreach($prednasky as $p){ 
                
                $p->room = DB::table('schedule_rooms')->where('sr_id', $p->room_id)->first();
                $p->teacher = DB::table('staff')->where('s_id', $p->s_id)->first();
            }
        }

        $cvicenia = DB::table('lectures')->where('sub_id', $sub_id)->where('type', 'cvicenie')->orderBy('day')->orderBy('start_time')->get();
        if($cvicenia){
            foreach($cvicenia as $c){
                $c->room = DB::table('schedule_rooms')->where('sr_id', $c->room_id)->first();
                $c->teacher = DB::table('staff')->where('s_id', $c->s_id)->first();
            }
        }

        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
       
        foreach($day_names as $key => $dn){
            $day_data = [];
            $tmp = DB::table('lectures')->where('sub_id', $sub_id)->where('day', $key)->get();
            for($i = 0; $i < 15; $i++){
                if(count($tmp) == 0){
                    $day_data[$i+7] = null;
                }
                foreach($tmp as $t){
                    if($t->start_time == ($i+7)){
                        if($t->type == 'prednaska'){
                            $day_data[$i+7] = [
                                'duration' => DB::table('subjects')->where('sub_id', $sub_id)->first()->duration_p,
                                'room' => DB::table('lectures')
                                                    ->join('schedule_rooms', 'schedule_rooms.sr_id', '=', 'lectures.room_id')
                                                    //->where('room_id', $t->room_id)
                                                    ->where('sub_id', $sub_id)
                                                    ->where('day', $key)
                                                    ->where('start_time', $t->start_time)
                                                    ->where('type', 'prednaska')
                                                    ->distinct()
                                                    ->pluck('room')->toArray(),

                                'color' => config('schedule_admin.prednaska_color'),
                                'teachers' => DB::table('lectures')
                                                    ->join('staff', 'staff.s_id', '=', 'lectures.s_id')
                                                    ->where('sub_id', $sub_id)
                                                    ->where('day', $key)
                                                    ->where('room_id', $t->room_id)
                                                    ->where('start_time', $t->start_time)
                                                    ->where('type', 'prednaska')
                                                    ->pluck('surname')->toArray()
                            ];
                        }else{
                            $day_data[$i+7] = [
                                'duration' => DB::table('subjects')->where('sub_id', $sub_id)->first()->duration_c,
                                'room' => DB::table('lectures')
                                                    ->join('schedule_rooms', 'schedule_rooms.sr_id', '=', 'lectures.room_id')
                                                    //->where('room_id', $t->room_id)
                                                    ->where('sub_id', $sub_id)
                                                    ->where('day', $key)
                                                    ->where('start_time', $t->start_time)
                                                    ->where('type', 'cvicenie')
                                                    ->distinct()
                                                    ->pluck('room')->toArray(),

                                'color' => config('schedule_admin.cvicenie_color'),
                                'teachers' => DB::table('lectures')
                                                    ->join('staff', 'staff.s_id', '=', 'lectures.s_id')
                                                    ->where('sub_id', $sub_id)
                                                    ->where('day', $key)
                                                    //->where('room_id', $t->room_id)
                                                    ->where('start_time', $t->start_time)
                                                    ->where('type', 'cvicenie')
                                                    ->pluck('surname')->toArray()
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
 
        $staff = DB::table('staff')->where('activated', 1)->orderBy('surname')->get();

        $prednasky = (!$prednasky) ? [] : $prednasky;
        $cvicenia = (!$cvicenia) ? [] : $cvicenia;

        $data = [
            'title' => $this->module_name, 
            'active_year' => $active_year,
            'subject' => $subject,
            'rooms' => $rooms,
            'prednasky' => $prednasky,
            'cvicenia' => $cvicenia,
            'day_names' => $day_names,
            'schedule_data' => $schedule_data,
            'staff' => $staff
        ];

        return view('intranet::schedule/schedule_add', $data);
    }


    /**
    *   pridanie action
    */
    public function schedule_add_action(Request $request){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        
        $type = $request->input('type');
        $start_time = $request->input('start_time');
        $room_id = $request->input('room');
        $sub_id = $request->input('id');
        $duration_p = $request->input('duration_p');
        $duration_c = $request->input('duration_c');
        $day = $request->input('day');
        $year = $request->input('year');
        $staff = $request->input('staff');

        if(!is_numeric($sub_id) || !is_numeric($room_id) || !is_numeric($start_time) || 
            !is_string($type) || strlen($type) < 1 || strlen($type) > 16 || !is_numeric($duration_c) || $duration_c < 1 ||
            !is_numeric($duration_p) || $duration_p < 1 || !is_numeric($day) || !is_numeric($year) || !is_numeric($staff)){
            return response()->json(['error' => 'Input error'], 400);
        }

        $data = [
            'sub_id' => $sub_id,
            'room_id' => $room_id,
            'start_time' => $start_time,
            'type' => $type,
            'day' => $day,
            'year' => $year,
            's_id' => $staff
        ];
      
        // existuje ta ista polozka ?
        $check = DB::table('lectures')
                            ->where('day', $day)
                            ->where('sub_id', $sub_id)
                            ->where('room_id', $room_id)
                            ->where('start_time', $start_time)
                            ->where('type', $type)
                            ->where('s_id', $staff)
                            ->first();

        if($check){
            return response()->json(['error' => 'Item already exists'], 400);
        }

       
        // ma cas ucitel vzhladom na predmety ? 
        $check_freetime = DB::table('lectures')
                            ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                            ->where('day', $day)
                            ->where('s_id', $staff)
                            ->get();
        
   
        foreach($check_freetime as $f){
            if( $f->start_time < $start_time ){
                if($f->type == 'prednaska'){
                    if($f->start_time + $f->duration_p > $start_time){
                        return response()->json(['error' => 'User has not free time in selected time!'], 400);
                    }
                }else{
                    if($f->start_time + $f->duration_c > $start_time){
                        return response()->json(['error' => 'User has not free time in selected time!'], 400);
                    }
                }
            }elseif($f->start_time == $start_time){
                return response()->json(['error' => 'User has not free time in selected time!'], 400);
            }else{
                if($type == 'prednaska'){
                    if( $start_time + $duration_p > $f->start_time){
                        return response()->json(['error' => 'User has not free time in selected time!'], 400);
                    }
                }else{
                    
                    if( $start_time + $duration_c > $f->start_time){
                        return response()->json(['error' => 'User has not free time in selected time!'], 400);
                    }
                }
            }
        }       

        // ma cas ucitel vzhladom na konzultacie ? 
        $users_cons = DB::table('consultations')
                            ->where('day', $day)
                            ->where('staff_id', $staff)
                            ->get();

        foreach($users_cons as $f){
            if($f->start_time < $start_time){
                if( $f->end_time > $start_time){
                    return response()->json(['error' => 'User has consultation in selected time!'], 400);
                }
            }elseif($f->start_time == $start_time){
                return response()->json(['error' => 'User has consultation in selected time!'], 400);
            }else{
                if($type == "prednaska"){
                    if( $f->start_time < $start_time + $duration_p){
                        return response()->json(['error' => 'User has consultation in selected time!'], 400);
                    }
                }else{
                    if( $f->start_time < $start_time + $duration_c){
                        return response()->json(['error' => 'User has consultation in selected time!'], 400);
                    }
                }
            }
        }

        // kontrola volnej miestnosti
        $full_room = DB::table('lectures')
                            ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                            ->where('room_id', $room_id)
                            ->where('day', $day)
                            //->where('s_id', $staff)
                            ->get();
                                
        foreach($full_room as $f){
            if( $f->start_time < $start_time ){
                if($f->type == 'prednaska'){
                    if($f->start_time + $f->duration_p > $start_time){
                        return response()->json(['error' => 'Room is not empty at selected time!'], 400);
                    }
                }else{
                    if($f->start_time + $f->duration_c > $start_time){
                        return response()->json(['error' => 'Room is not empty at selected time!'], 400);
                    }
                }
            }elseif($f->start_time == $start_time){
                if($f->sub_id != $sub_id){
                    return response()->json(['error' => 'Room is not empty at selected time!'], 400);
                }
            }else{
                if($type == 'prednaska'){
                    if( $start_time + $duration_p > $f->start_time){
                        return response()->json(['error' => 'Room is not empty at selected time!'], 400);
                    }
                }else{
                    
                    if( $start_time + $duration_c > $f->start_time){
                        return response()->json(['error' => 'Room is not empty at selected time!'], 400);
                    }
                }
            }
        }

        $item = DB::table('lectures')->insertGetId($data);
        if($item > 0){
            return response()->json(['error' => 'Successfuly added', 'data' => $data], 200);
        }else{
            return response()->json(['error' => 'Insert error'], 400);
        }
    }

    public function schedule_update_action(Request $request){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        $item = $request->input('item');
        $start_time = $request->input('start_time');
        $room_id = $request->input('room');
        $duration_p = $request->input('duration_p');
        $duration_c = $request->input('duration_c');
        $day = $request->input('day');
        $type = $request->input('type');
        $staff = $request->input('teacher');
        
        if(!is_numeric($item) || !is_numeric($room_id) || !is_numeric($start_time) || 
            !is_string($type) || strlen($type) < 1 || strlen($type) > 16 || !is_numeric($duration_c) || $duration_c < 1 ||
            !is_numeric($duration_p) || $duration_p < 1 || !is_numeric($day) || !is_numeric($staff)){
            return response()->json(['error' => 'Input error'], 400);
        }


        $check = DB::table('lectures')
                        ->where('l_id', $item)
                        ->where('room_id', $room_id)
                        ->where('start_time', $start_time)
                        ->where('type', $type)
                        ->where('day', $day)
                        ->where('s_id', $staff)
                        ->first();
        if($check){
            return response()->json(['error' => 'Item already exists'], 400);
        }

        $tmp = DB::table('lectures')->where('l_id', $item)->first();

        $users_cons = DB::table('consultations')
                            ->where('day', $day)
                            ->where('staff_id', $staff)
                            ->get();
        
        $success = true;
       
        foreach($users_cons as $f){
            if($f->start_time < $start_time){
                if( $f->end_time > $start_time){
                    $success = false;
                }
            }elseif($f->start_time == $start_time){
                $success = false;
            }else{
                if($type == "prednaska"){
                    if( $f->start_time < $start_time + $duration_p){
                        $success = false;
                    }
                }else{
                    if( $f->start_time < $start_time + $duration_c){
                        $success = false;
                    }
                }
            }
        }

        if($success == true){
            $check_freetime = DB::table('lectures')
                                ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                                ->where('day', $day)
                                ->where('s_id', $staff)
                                ->where('l_id', '!=', $item)
                                ->get();
            
            foreach($check_freetime as $f){
                if( $f->start_time < $start_time ){
                    if($f->type == 'prednaska'){
                        if($f->start_time + $f->duration_p > $start_time){
                            $success = false;
                        }
                    }else{
                        if($f->start_time + $f->duration_c > $start_time){
                            $success = false;
                        }
                    }
                }elseif($f->start_time == $start_time){
                    if($f->sub_id != $tmp->sub_id && $f->room_id == $room_id){
                        $success = false;
                    }
                }else{
                    if($type == 'prednaska'){
                        if( $start_time + $duration_p > $f->start_time){
                            $success = false;
                        }
                    }else{
                        
                        if( $start_time + $duration_c > $f->start_time){
                            $success = false;
                        }
                    }
                }
            }       
        }else{
            return response()->json(['error' => 'User has no free time at selected time!'], 400);
        }
        
      
        if($success == true){

            $full_room = DB::table('lectures')
                                ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                                ->where('room_id', $room_id)
                                ->where('day', $day)
                                ->where('s_id', $staff)
                                ->where('l_id', '!=', $item)
                                ->get();
            
            
            foreach($full_room as $f){
                if( $f->start_time < $start_time ){
                    if($f->type == 'prednaska'){
                        if($f->start_time + $f->duration_p > $start_time){
                            $success = false;
                        }
                    }else{
                        if($f->start_time + $f->duration_c > $start_time){
                            $success = false;
                        }
                    }
                }elseif($f->start_time == $start_time){
                    if($f->sub_id != $sub_id){
                        $success = false;
                    }
                }else{
                    if($type == 'prednaska'){
                        if( $start_time + $duration_p > $f->start_time){
                            $success = false;
                        }
                    }else{
                        if( $start_time + $duration_c > $f->start_time){
                            $success = false;
                        }
                    }
                }
            }
            
        }else{
            return response()->json(['error' => 'User already has lecture at selected time!'], 400);
        }
       
        if($success == false){
            $data = [
                'sub_id' => $tmp->sub_id,
                'room_id' => $tmp->room_id,
                'start_time' => $tmp->start_time,
                'type' => $tmp->type,
                'day' => $tmp->day,
                's_id' => $tmp->s_id,
                'year' => $tmp->year
            ];
            DB::table('lectures')->where('l_id', $item)->delete();
            $item = DB::table('lectures')->insertGetId($data);
            return response()->json(['error' => 'Room is not empty at selected time!'], 400);
        }else{
            $data = [
                'sub_id' => $tmp->sub_id,
                'room_id' => $room_id,
                'start_time' => $start_time,
                'type' => $type,
                'day' => $day,
                's_id' => $staff,
                'year' => $tmp->year
            ];
            DB::table('lectures')->where('l_id', $item)->delete();
            $item = DB::table('lectures')->insertGetId($data);
            return response()->json(['error' => 'Successfuly updated', 'data' => $data], 200);
        }

        return response()->json(['warning' => 'Any data has been changed'], 400);

    }

    public function schedule_delete_action(Request $request){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        $l_id = $request->input('item');
        if(!is_numeric($l_id)){
            return redirect('/schedule-admin-add-choose')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }

        $res = DB::table('lectures')->where('l_id', $l_id)->delete();
        if($res){
            return redirect('/schedule-admin-add-choose')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted!']);
        }
        return redirect('/schedule-admin-add-choose')->with('err_code', ['type' => 'warning', 'msg' => 'Any data deleted!']);
    }

    /**
     *  Info o predmete
     */

    public function ajax_get_subject_info( Request $request ){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Access denied!']);
        }
        $sub_id = $request->input('id');

        if(!is_numeric($sub_id)){
            return response()->json(['error' => 'Bad item'], 400);
        }

        $subject_info = DB::table('subjects')->where('sub_id', $sub_id)->first();

        if($subject_info){
            return response()->json( $subject_info , 200);
        }else{
            return response()->json(['error' => 'Bad item'], 400);
        }

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////// ROOMS ////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function schedule_admin_rooms(){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Permission denied!']);
        }

        $rooms = DB::table('schedule_rooms')->get();

        $data = [ 
            'title' => $this->module_name, 
            'rooms' => $rooms
        ];

        return view('intranet::schedule/schedule_admin_rooms', $data);
    }

    public function schedule_add_room_action( Request $request ){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }

        $room = $request->input('room');

        if(!$room || !is_string($room) || strlen($room) < 1 || strlen($room) > 16){
            return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format']);
        }

        if(DB::table('schedule_rooms')->where('room', $room)->exists()){
            return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'warning', 'msg' => 'Item already exists']);
        }

        DB::table('schedule_rooms')->insert(['room' => $room]);

        return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'success', 'msg' => 'Item added']);
    }

    public function schedule_edit_room_action(Request $request){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }

        $room = $request->input('room');
        $room_id = $request->input('id');

        if(!$room_id || !is_numeric($room_id)){
            return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'warning', 'msg' => 'Bad item selected']);
        }

        if(!$room || !is_string($room) || strlen($room) < 1 || strlen($room) > 16){
            return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format - empty string or max 16 characters']);
        }
        
        DB::table('schedule_rooms')->where('sr_id', $room_id)->update(['room' => $room]);

        return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'success', 'msg' => 'Item updated']);
    }

    public function schedule_delete_room_action($sr_id = 0){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }

        if(!$sr_id || !is_numeric($sr_id)){
            return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'warning', 'msg' => 'Bad item selected']);
        }
        
        DB::table('schedule_rooms')->where('sr_id', $sr_id)->delete();
        return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted']);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////// YEARS ///////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function schedule_admin_season(){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Permission denied!']);
        }

        $years = DB::table('schedule_season')->select('sy_id', 'year', 'active')->groupBy('year')->get();
        $active_year = DB::table('schedule_season')->where('active', 1)->first();

        $data = [ 
            'title' => $this->module_name, 
            'years' => $years,
            'active_year' => $active_year
        ];
        //debug($data, true);
        return view('intranet::schedule/schedule_admin_season', $data);
    }

    public function schedule_admin_activate_season(Request $request){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }
       
        $season = $request->input('season');
        $year = $request->input('year');

        if(!$year || !is_string($year) || strlen($year) < 1 || strlen($year) > 16 || !is_numeric($season)){
            return redirect('/schedule-admin-season')->with('err_code', ['type' => 'error', 'msg' => 'Input bad format!']);
        }

        DB::table('schedule_season')->where('active', 1)->update(['active' => 0]);
        DB::table('schedule_season')->where('year', $year)->where('semester', $season)->update(['active' => 1]);
        return redirect('/schedule-admin-season')->with('err_code', ['type' => 'success', 'msg' => 'Updated!']);
    }

 
    public function schedule_add_year_action( Request $request ){
        if(!has_permission('schedule')){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        $year = $request->input('year');

        if(!$year || !is_string($year) || strlen($year) < 1 || strlen($year) > 16){
            return redirect('/schedule-admin-subject')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format']);
        }

        $tmp = explode('/', $year);
        if(!is_numeric($tmp[0]) || !is_numeric($tmp[1]) || count($tmp) > 2 || $tmp[0] > $tmp[1] ){
            return redirect('/schedule-admin-subject')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format']);
        }


        DB::table('schedule_season')->insert([['year' => $year, 'semester' => '0'], ['year' => $year, 'semester' => '1']]);

        return redirect('/schedule-admin-subject')->with('err_code', ['type' => 'success', 'msg' => 'Item added']);
    }

    public function schedule_add_consultations(){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        $my_consultations = DB::table('consultations')->where('staff_id', get_user_id())->orderBy('day')->get();
        $my_consultations_sched = DB::table('consultations')->where('staff_id', get_user_id())->orderBy('start_time', 'desc')->get();
        $my_subjects_ids = DB::table('subjects')
                            ->join('subjects_staff_rel', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')
                            ->where('subjects_staff_rel.s_id', get_user_id())
                            ->pluck('subjects_staff_rel.sub_id');

        $my_schedule = DB::table('lectures')->whereIn('sub_id', $my_subjects_ids)->get();
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
        
        foreach($day_names as $key => $dn){
            $day_data = [];
            for($i = 0; $i < 15; $i++){
                //pridanie hodin
                foreach($my_schedule as $m){
                    if($m->start_time == ($i+7) && $m->day == $key){
                        if($m->type == 'prednaska'){
                            $day_data[$i+7] = [
                                'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_p,
                                'room' => DB::table('schedule_rooms')->where('sr_id', $m->room_id)->first()->room,
                                'color' => config('schedule_admin.prednaska_color')

                            ];
                        }else{
                            $day_data[$i+7] = [
                                'duration' => DB::table('subjects')->where('sub_id', $m->sub_id)->first()->duration_c,
                                'room' => DB::table('schedule_rooms')->where('sr_id', $m->room_id)->first()->room,
                                'color' => config('schedule_admin.cvicenie_color')
                            ];
                        }
                    
                        break;
                    }
                }
                //pridanie konzultacii
                foreach($my_consultations_sched as $ms){
                    $st = explode(':', $ms->start_time);
                    if(!is_array($st) && count($st) != 2){
                        continue;
                    }
                    if(intval($st[0]) == ($i+7) && $ms->day == $key){
                        $day_data[$i+7] = [
                            'id' => $ms->c_id,
                            'room' => '',
                            'duration' => $ms->duration,
                            'color' => config('schedule_admin.konzultacia_color')
                        ];
                    }
                }
                // nie je tam nic
                if(!isset($day_data[$i+7])){
                    $day_data[$i+7] = null;
                }
            }
            $schedule_data[$dn] = $day_data;
        }

        $data = [ 
            'title' => $this->module_name, 
            'schedule_data' => $schedule_data,
            'day_names' => $day_names,
            'consultations' => $my_consultations
        ];
        //debug($data, true);
        return view('intranet::schedule/schedule_admin_consultations', $data);
    }

    public function schedule_add_consultations_action(Request $request){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        $start_time = $request->input('add_start_time');
        $end_time = $request->input('add_end_time');
        $name = $request->input('add_name');
        $cons = $request->input('cons');
        $day = $request->input('add_day');

        if( !is_string($start_time) || strlen($start_time) < 1 || !is_string($end_time) || strlen($end_time) < 1  ||  
        !is_string($name) || strlen($name) < 1 || !is_numeric($day)){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Input error']);
        }
       
        $start_time = explode(':', $start_time);
        $end_time = explode(':', $end_time);

        $data_start = trim($start_time[0]).':'.trim($start_time[1]);
        $data_end = trim($end_time[0]).':'.trim($end_time[1]);

        if(!is_array($start_time) || !is_array($end_time) || count($start_time) != 2 || count($end_time) != 2){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Input error']);
        }

        $my_subjects_ids = DB::table('subjects')
                            ->join('subjects_staff_rel', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')
                            ->where('subjects_staff_rel.s_id', get_user_id())
                            ->pluck('subjects_staff_rel.sub_id');

        $my_schedule = DB::table('lectures')->whereIn('sub_id', $my_subjects_ids)->get();
        $success = true;
        
        foreach($my_schedule as $ms){
            if($ms->type = 'prednaska'){
                $tmp_lesson = DB::table('subjects')->where('sub_id', $ms->sub_id)->first()->duration_p;
            }else{
                $tmp_lesson = DB::table('subjects')->where('sub_id', $ms->sub_id)->first()->duration_c;
            }
            
            if($ms->start_time < $start_time[0]){
                if($ms->start_time + $tmp_lesson > intval($start_time[0]) && $ms->day == $day){
                    $success = false;
                }
            }elseif($ms->start_time == intval($start_time[0]) && $ms->day == $day){
                $success = false;
            }else{
                if( intval($end_time[1]) > 0 ){
                    if($ms->start_time < (intval($end_time[0])+1 ) && $ms->day == $day){
                        $success = false;
                    }
                }else{
                    if($ms->start_time < intval($end_time[0])  && $ms->day == $day){
                        $success = false;
                    }
                }
            }
        }

        if($success == false){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'You have no free time at selected time!']);
        }

        $start_time = strtotime($start_time[0].' hours '.$start_time[1].' minutes'); 
        $end_time = strtotime($end_time[0].' hours '.$end_time[1].' minutes'); 
        
        if($start_time >= $end_time){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => '(Still) Not possible to go back in time!']);
        }

        $duration = ( ($end_time - $start_time) / 60) / 15;
        $data = [
            'staff_id' => get_user_id(),
            'start_time' => $data_start,
            'end_time' => $data_end,
            'duration' => $duration,
            'name' => $name,
            'consultants' => $cons,
            'day' => $day
        ];

        $res = DB::table('consultations')->insertGetId($data);

        if($res){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly added']);
        }
        return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Error occured']);
    }

    public function schedule_edit_consultations_action(Request $request){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }
        $id = $request->input('id');
        if(!is_numeric($id)){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Error occured']);
        }

        $current_cons = DB::table('consultations')->where('c_id', $id)->first();

        $name = $request->filled('new_name') ? $request->input('new_name') : $current_cons->name;
        $start_time = $request->filled('new_start_time') ? $request->input('new_start_time') : $current_cons->start_time;
        $end_time = $request->filled('new_end_time') ? $request->input('new_end_time') : $current_cons->end_time;
        $consultants = $request->filled('new_consultants') ? $request->input('new_consultants') : $current_cons->consultants;
        $day = $request->filled('new_day') ? $request->input('new_day') : $current_cons->day;

        if(!is_string($name) || strlen($name) < 1 || strlen($name) > 256 || !is_numeric($day)){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Error occured']);
        }

        $data_start = $start_time;
        $data_end = $end_time;

        $start_time = explode(':', $start_time);
        $end_time = explode(':', $end_time);

        if(!is_array($start_time) || !is_array($end_time) || count($start_time) != 2 || count($end_time) != 2){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Input error']);
        }

        $my_subjects_ids = DB::table('subjects')
                            ->join('subjects_staff_rel', 'subjects.sub_id', '=', 'subjects_staff_rel.sub_id')
                            ->where('subjects_staff_rel.s_id', get_user_id())
                            ->pluck('subjects_staff_rel.sub_id');

        $my_schedule = DB::table('lectures')->whereIn('sub_id', $my_subjects_ids)->get();
        $success = true;
        foreach($my_schedule as $ms){
            if($ms->type = 'prednaska'){
                $tmp_lesson = DB::table('subjects')->where('sub_id', $ms->sub_id)->first()->duration_p;
            }else{
                $tmp_lesson = DB::table('subjects')->where('sub_id', $ms->sub_id)->first()->duration_c;
            }
            
            if($ms->start_time < $start_time[0]){
                if($ms->start_time + $tmp_lesson > intval($start_time[0]) && $ms->day == $day){
                    $success = false;
                }
            }elseif($ms->start_time == intval($start_time[0]) && $ms->day == $day){
                $success = false;
            }else{
                if( intval($end_time[1]) > 0 ){
                    if($ms->start_time < (intval($end_time[0])+1 ) && $ms->day == $day){
                        $success = false;
                    }
                }else{
                    if($ms->start_time < intval($end_time[0])  && $ms->day == $day){
                        $success = false;
                    }
                }
            }
        }

        if($success == false){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'You have no free time at selected time!']);
        }

        $start_time = strtotime($start_time[0].' hours '.$start_time[1].' minutes'); 
        $end_time = strtotime($end_time[0].' hours '.$end_time[1].' minutes'); 
        
        if($start_time >= $end_time){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => '(Still) Not possible to go back in time!']);
        }

        $duration = ( ($end_time - $start_time) / 60) / 15;
        $data = [
            'start_time' => $data_start,
            'end_time' => $data_end,
            'duration' => $duration,
            'name' => $name,
            'consultants' => $consultants,
            'day' => $day
        ];
        
        $res = DB::table('consultations')->where('c_id', $id)->where('staff_id', get_user_id())->update($data);
        return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'success', 'msg' => 'Successfuly updated']);
    }


    public function schedule_delete_consultations_action($c_id = 0){
        if(!isLogged()){
            return redirect('/')->with('err_code', ['type' => 'error', 'msg' => 'Operation not permitted!']);
        }

        if(!$c_id || !is_numeric($c_id)){
            return redirect('/schedule-admin-rooms-add')->with('err_code', ['type' => 'warning', 'msg' => 'Bad item selected']);
        }

        DB::table('consultations')->where('c_id', $c_id)->delete();
        return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted']);
    }



    private function random_color_part($down, $up) {
        return str_pad( dechex( mt_rand( $down, $up ) ), 2, '0', STR_PAD_LEFT);
    }
    
    function random_color() {
        return '#' . $this->random_color_part(96, 127) . $this->random_color_part(96, 127) . $this->random_color_part(127, 192);
    }
    
}
