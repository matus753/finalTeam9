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
        $subject = $request->input('predmet');
        $semester = $request->input('semester');
        $all_days = $request->input('voidDays');
        
        if($all_days){
            $all_days = true;
        }else{
            $all_days = false;
        }
        
        if($year && is_numeric($year) && $year > 0){
            $year = DB::table('schedule_season')->where('sy_id', $year)->first();
        }else{
            $year = DB::table('schedule_season')->where('active', 1)->first();
            if(!$year){
                $year = null;
            }
        }

        if($subject && is_numeric($subject) && $subject > 0){
            $subject = DB::table('subjects')->where('sub_id', $subject)->first();
            $days_db = DB::table('lectures')->select('day')->where('sub_id', $subject->sub_id )->groupBy('day')->get();
        }else{
            $subject = null;
        }
        
        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
        if($subject){
            foreach($day_names as $key => $dn){
                $day_data = [];
                $tmp = DB::table('lectures')->where('sub_id', $subject->sub_id)->where('day', $key)->select('start_time', 'room_id', 'type')->get();
                if(count($tmp) > 0){
                    for($i = 0; $i < 15; $i++){
                        if(count($tmp) == 0){
                            $day_data[$i+7] = null;
                        }
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
        $other_years_db = DB::table('schedule_season')->pluck('year', 'sy_id')->toArray();
        sort($other_years_db);

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
        return view('intranet::schedule/schedule_subject', $data);
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////// Upravovanie rozvrhov //////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
        najprv sa vyberie predmet
    */
    public function schedule_add_choose(){

        $active_year = DB::table('schedule_season')->where('active', 1)->first();
        $subjects_with_schedule = DB::table('lectures')
                                        ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                                        ->where('semester', $active_year->semester)
                                        ->orWhere('semester', 2)
                                        ->groupBy('subjects.sub_id')
                                        ->get();

        $subjects_with_schedule_ids = DB::table('lectures')
                                        ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                                        ->where('semester', $active_year->semester)
                                        ->orWhere('semester', 2)
                                        ->groupBy('subjects.sub_id')
                                        ->pluck('lectures.sub_id')->toArray();

        $subjects_with_schedule = (!$subjects_with_schedule) ? [] : $subjects_with_schedule;

        $subjects_without_schedule = DB::table('subjects')->whereNotIn('sub_id',$subjects_with_schedule_ids)->get();  

        if(count($subjects_without_schedule) == 0){
            $subjects_without_schedule = DB::table('subjects')->where('semester', $active_year->semester)->orWhere('semester', '2')->get();
        }

        
        

        $data = [
            'title' => $this->module_name, 
            'subjects_with_schedule' => $subjects_with_schedule,
            'subjects_without_schedule' => $subjects_without_schedule,
            'active_year' => $active_year,
        ];

       //debug($data);
       
        return view('intranet::schedule/schedule_add_choose_sub', $data);
    }


    /*
        pridanie prednasok / cvik
    */

    public function schedule_add( Request $request ){

        $sub_id = $request->input('sub');

        if(!is_numeric($sub_id)){
            return redirect('/schedule-admin-subject')->with('err_code', ['type' => 'error', 'msg' => 'Bad item selected!']);
        }
        
        $subject = DB::table('subjects')->where('sub_id', $sub_id)->first();
        $active_year = DB::table('schedule_season')->where('active', 1)->first();
        $rooms = DB::table('schedule_rooms')->get();

        $prednasky = DB::table('lectures')->where('sub_id', $sub_id)->where('type', 'prednaska')->orderBy('start_time')->get();
        if($prednasky){
            foreach($prednasky as $p){
                $p->room = DB::table('schedule_rooms')->where('sr_id', $p->room_id)->first();
            }
        }
        $cvicenia = DB::table('lectures')->where('sub_id', $sub_id)->where('type', 'cvicenie')->get();
        if($cvicenia){
            foreach($cvicenia as $c){
                $c->room = DB::table('schedule_rooms')->where('sr_id', $c->room_id)->first();
            }
        }

        $day_names = ['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok'];
        $schedule_data = [];
       
        foreach($day_names as $key => $dn){
            $day_data = [];
            $tmp = DB::table('lectures')->where('sub_id', $sub_id)->where('day', $key)->select('start_time', 'room_id', 'type')->get();
            for($i = 0; $i < 15; $i++){
                if(count($tmp) == 0){
                    $day_data[$i+7] = null;
                }
                foreach($tmp as $t){

                    if($t->start_time == ($i+7)){
                        if($t->type == 'prednaska'){
                            $day_data[$i+7] = [
                                'duration' => DB::table('subjects')->where('sub_id', $sub_id)->first()->duration_p,
                                'room' => DB::table('schedule_rooms')->where('sr_id', $t->room_id)->first()->room,
                                'color' => config('schedule_admin.prednaska_color')

                            ];
                        }else{
                            $day_data[$i+7] = [
                                'duration' => DB::table('subjects')->where('sub_id', $sub_id)->first()->duration_c,
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
            'schedule_data' => $schedule_data
        ];

        return view('intranet::schedule/schedule_add', $data);
    }


    /**
    *   pridanie action
    */
    public function schedule_add_action(Request $request){
        $type = $request->input('type');
        $start_time = $request->input('start_time');
        $room_id = $request->input('room');
        $sub_id = $request->input('id');
        $duration_p = $request->input('duration_p');
        $duration_c = $request->input('duration_c');
        $day = $request->input('day');
        
        if(!is_numeric($sub_id) || !is_numeric($room_id) || !is_numeric($start_time) || 
            !is_string($type) || strlen($type) < 1 || strlen($type) > 16 || !is_numeric($duration_c) || $duration_c < 1 ||
            !is_numeric($duration_p) || $duration_p < 1 || !is_numeric($day)){
            return response()->json(['error' => 'Input error'], 400);
        }

        $data = [
            'sub_id' => $sub_id,
            'room_id' => $room_id,
            'start_time' => $start_time,
            'type' => $type,
            'day' => $day,
        ];
      
        $check = DB::table('lectures')
                            ->where('day', $day)
                            ->where('sub_id', $sub_id)
                            ->where('room_id', $room_id)
                            ->where('start_time', $start_time)
                            ->where('type', $type)
                            ->where('day', $day)
                            ->first();

        if($check){
            return response()->json(['error' => 'Item already exists'], 400);
        }

        $full_room = DB::table('lectures')
                            ->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')
                            ->where('room_id', $room_id)
                            ->where('day', $day)
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
                return response()->json(['error' => 'Room is not empty at selected time!'], 400);
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
        $item = $request->input('item');
        $start_time = $request->input('start_time');
        $room_id = $request->input('room');
        $duration_p = $request->input('duration_p');
        $duration_c = $request->input('duration_c');
        $day = $request->input('day');
        $type = $request->input('type');
       

        if(!is_numeric($item) || !is_numeric($room_id) || !is_numeric($start_time) || 
            !is_string($type) || strlen($type) < 1 || strlen($type) > 16 || !is_numeric($duration_c) || $duration_c < 1 ||
            !is_numeric($duration_p) || $duration_p < 1 || !is_numeric($day)){
            return response()->json(['error' => 'Input error'], 400);
        }


        $check = DB::table('lectures')
                        ->where('l_id', $item)
                        ->where('room_id', $room_id)
                        ->where('start_time', $start_time)
                        ->where('type', $type)
                        ->where('day', $day)
                        ->first();
        if($check){
            return response()->json(['error' => 'Item already exists'], 400);
        }

        $tmp = DB::table('lectures')->where('l_id', $item)->first();
        DB::table('lectures')->where('l_id', $item)->delete();

        $full_room = DB::table('lectures')->join('subjects', 'lectures.sub_id', '=', 'subjects.sub_id')->where('room_id', $room_id)->get();
        $success = true;
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
                $success = false;
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

        if($success == false){
            $data = [
                'sub_id' => $tmp->sub_id,
                'room_id' => $tmp->room_id,
                'start_time' => $tmp->start_time,
                'type' => $tmp->type,
                'day' => $tmp->day
            ];
            $item = DB::table('lectures')->insertGetId($data);
            return response()->json(['error' => 'Room is not empty at selected time!'], 400);
        }else{
            $data = [
                'sub_id' => $tmp->sub_id,
                'room_id' => $room_id,
                'start_time' => $start_time,
                'type' => $type,
                'day' => $day
            ];
            $item = DB::table('lectures')->insertGetId($data);
            return response()->json(['error' => 'Successfuly updated', 'data' => $data], 200);
        }
        return response()->json(['warning' => 'Any data has been changed'], 400);

    }

    public function schedule_delete_action(Request $request){
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
        if(!has_permission('admin')){
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
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }

        $room = $request->input('room');

        if(!$room || !is_string($room) || strlen($room) < 1 || strlen($room) > 16){
            return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format']);
        }

        if(DB::table('schedule_rooms')->where('room', $room)->exists()){
            return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'warning', 'msg' => 'Item already exists']);
        }

        DB::table('schedule_rooms')->insert(['room' => $room]);

        return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'success', 'msg' => 'Item added']);
    }

    public function schedule_edit_room_action(Request $request){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }

        $room = $request->input('room');
        $room_id = $request->input('id');

        if(!$room_id || !is_numeric($room_id)){
            return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'warning', 'msg' => 'Bad item selected']);
        }

        if(!$room || !is_string($room) || strlen($room) < 1 || strlen($room) > 16){
            return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'warning', 'msg' => 'Bad format - empty string or max 16 characters']);
        }
        
        DB::table('schedule_rooms')->where('sr_id', $room_id)->update(['room' => $room]);

        return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'success', 'msg' => 'Item updated']);
    }

    public function schedule_delete_room_action($sr_id = 0){
        if(!has_permission('admin')){
            return redirect('/')->with('err_code', ['type' => 'Error', 'msg' => 'Operation not permitted!']);
        }

        if(!$sr_id || !is_numeric($sr_id)){
            return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'warning', 'msg' => 'Bad item selected']);
        }

        //TODO delete lectures s danou miestnostou

        DB::table('schedule_rooms')->where('sr_id', $sr_id)->delete();
        return redirect('/schedule-admin-rooms')->with('err_code', ['type' => 'success', 'msg' => 'Item deleted']);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////// YEARS ///////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function schedule_admin_season(){
        if(!has_permission('admin')){
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
        if(!has_permission('admin')){
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
        if(!has_permission('admin')){
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

    // TODO pridavanie hodiny - kontrola ucitela - nemoze byt na 2 miestach naraz

    public function schedule_add_consultations(){
        $my_consultations = DB::table('consultations')->where('staff_id', get_user_id())->get();
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
                /*foreach($my_consultations as $ms){
                    $st = explode(':', $ms->start_time);
                    if(!is_array($st) && count($st) != 2){
                        continue;
                    }
                    if(intval($st[0]) == ($i+7) && $ms->day == $key){
                        $day_data[$i+7] = [
                            'id' => $ms->c_id,
                            'hour' => trim($st[0]),
                            'minutes' => trim($st[1]), 
                            'room' => '',
                            'duration' => $ms->duration,
                            'color' => config('schedule_admin.konzultacia_color')
                        ];
                    }
                }*/
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
        $start_time = $request->input('add_start_time');
        $end_time = $request->input('add_end_time');
        $name = $request->input('add_name');
        $cons = $request->input('cons');
        $day = $request->input('add_day');

        if( !is_string($start_time) || strlen($start_time) < 1 || !is_string($end_time) || strlen($end_time) < 1  ||  
        !is_string($name) || strlen($name) < 1 || !is_numeric($day)){
            return redirect('/schedule-admin-consultations')->with('err_code', ['type' => 'error', 'msg' => 'Input error']);
        }
       
        $data_start = $start_time;
        $data_end = $end_time;

        $start_time = explode(':', $start_time);
        $end_time = explode(':', $end_time);

        if(!is_array($start_time) || !is_array($end_time)){
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
                if($ms->start_time + $tmp_lesson > intval($start_time[0])){
                    $success = false;
                }
            }elseif($ms->start_time == intval($start_time[0])){
                $success = false;
            }else{
                if( intval($end_time[1]) > 0 ){
                    if($ms->start_time < (intval($end_time[0])+1 ) ){
                        $success = false;
                    }
                }else{
                    if($ms->start_time < intval($end_time[0])  ){
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











}


/*
        if(!$year){
            $year = DB::table('schedule_season')->where('active', 1)->first();
            if(!$year){
                $curr_year = date('Y-n');
                $curr_year = explode('-', $curr_year);
                if($curr_year[1] > 0 && $curr_year[1] < 8){
                    $year = ($curr_year[0]-1).'/'.$curr_year[0];
                }else{
                    $year = ($curr_year[0]).'/'.$curr_year[0]+1;
                }
                DB::table('schedule_season')->insert(['year' => $year, 'active' => 1]);
            }
        }*/