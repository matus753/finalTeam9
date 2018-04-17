<?php

namespace Modules\About\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class About extends Controller
{
    public function history(){
        $module_name = config('about.name');

        return view('about::history')->with('title', $module_name);
    }

    public function management(){
        $module_name = config('about.name');

        //SELECT sf.*, s.name, f.title FROM staff_function sf INNER JOIN staff s on sf.id_staff = s.s_id LEFT JOIN functions f on sf.id_func = f.id WHERE sf.id_func = 1

        $staff1 = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', '=', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', '=', 'functions.f_id')
            ->where('staff_function.id_func', '=', 1)
            ->get();
        $staff2 = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', '=', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', '=', 'functions.f_id')
            ->where('staff_function.id_func', '=', 5)
            ->get();
        $staff3 = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', '=', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', '=', 'functions.f_id')
            ->where('staff_function.id_func', '=', 4)
            ->get();
        $staff4 = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', '=', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', '=', 'functions.f_id')
            ->where('staff_function.id_func', '=', 6)
            ->get();

        $data = [
            'title' => $module_name,
            'staff1all' => $staff1,
            'staff2all' => $staff2,
            'staff3all' => $staff3,
            'staff4all' => $staff4
        ];

        return view('about::management', $data);
    }

    public function institutes(){
        $module_name = config('about.name');

        //SELECT sf.*, s.name, f.title FROM staff_function sf INNER JOIN staff s on sf.id_staff = s.s_id LEFT JOIN functions f on sf.id_func = f.id WHERE sf.id_func = 2 AND s.department = 'OAMM'
        $vOAMM = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 2)
            ->where('staff.department', 'OAMM')
            ->get();
        $zOAMM = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 3)
            ->where('staff.department', 'OAMM')
            ->get();

        $vOIKR = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 2)
            ->where('staff.department', 'OIKR')
            ->get();
        $zOIKR = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 3)
            ->where('staff.department', 'OIKR')
            ->get();

        $vOEMP = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 2)
            ->where('staff.department', 'OEMP')
            ->get();
        $zOEMP = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 3)
            ->where('staff.department', 'OEMP')
            ->get();

        $vOEAP = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 2)
            ->where('staff.department', 'OEAP')
            ->get();
        $zOEAP = DB::table('staff_function')
            ->join('staff', 'staff_function.id_staff', 'staff.s_id')
            ->join('functions', 'staff_function.id_func', 'functions.f_id')
            ->where('staff_function.id_func', 3)
            ->where('staff.department', 'OEAP')
            ->get();

        $data = [
            'title' => $module_name,
            'vOAMM' => $vOAMM,
            'zOAMM' => $zOAMM,
            'vOIKR' => $vOIKR,
            'zOIKR' => $zOIKR,
            'vOEMP' => $vOEMP,
            'zOEMP' => $zOEMP,
            'vOEAP' => $vOEAP,
            'zOEAP' => $zOEAP

        ];

        return view('about::institutes', $data);
    }
}
