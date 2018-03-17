<?php

namespace Modules\Intranet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Storage;

class Intranet_attendance extends Controller
{
    private $module_name;

    public function __construct(){
        $this->module_name = config('intranet.name');
    }

    public function attendance($year = -1, $month = -1){

        if(!is_numeric($year) || $year < 0){
            $year = date('Y'); // current year
        }else{
            $year = $year;
        }
        $next_year = intval(date('Y')) +1; // next year

        if(!is_numeric($month) || $month < 1 || $month > 12 ){
            $month = date('n'); // current month as number
            $n_curr_month_days = date('t'); // count of days in current month
        }else{
            $month = $month;
            $n_curr_month_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }

        // for select years
        $db_years = DB::table('nepritomnosti')->select('rok')->groupBy('rok')->get();
        $tmp = [];
        foreach($db_years as $dy){
            $tmp[] = $dy->rok;
        }
        if(!in_array($year, $tmp)){
            
            $tmp[] = $year;
        }

        if(!in_array($next_year, $tmp)){
            $tmp[] = $next_year;
        }

        // staff names
        $staff = DB::table('staff')->get();
        // radio btns 
        $absence = DB::table('typ_nepritomnosti')->get();

        $staff_attendance = DB::table('nepritomnosti')
                            ->join('typ_nepritomnosti', 'id_typu', '=', 't_id')
                            ->where('rok', $year)
                            ->where('mesiac', $month)
                            ->orderBy('den')
                            ->get();

        $staff_attendance = (!$staff_attendance) ? [] : $staff_attendance;
        foreach($staff as $s){
            $tmp2 = [];
            $skratky = [];

            foreach($staff_attendance as $sa){
                if($s->s_id == $sa->id_zamestnanca){
                    for($i = 1; $i < $n_curr_month_days+1; $i++){
                        if($sa->den == $i){
                            $skratky[$i] = strtolower($sa->skratka);
                        }
                    }
                }
            }
            $tmp2['skratky'] = $skratky;
            
            $s->att = $tmp2;
        }

        $data = [ 
            'title'         => $this->module_name,
            'num_days'      => $n_curr_month_days,
            'curr_month'    => $month, 
            'staff'         => $staff,
            'absence'       => $absence,
            'curr_year'     => $year,
            'years'         => $tmp
        ];

        return view('intranet::attendance/attendance', $data);
    }

    public function attendance_pdf_ajax( Request $request ){
        $table = $request->input('table');
        if(!is_string($table)){
            return response()->json(['error' => 'Failed'], 400);
        }
        $table = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><style>*{ font-family: DejaVu Sans !important;}</style>'.$table.'</html>';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($table);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        
        Storage::put('public/pdf_attendance.pdf', $output);
        $exists = Storage::disk('public')->exists('pdf_attendance.pdf');

        if($exists){
            return response()->json(['error' => 'Success'], 200);
        }
        return response()->json(['error' => 'Failed'], 400);
    }

    public function download_pdf(){
        $exists = Storage::disk('public')->exists('pdf_attendance.pdf');
        if($exists){
            $file = public_path(). "/storage/pdf_attendance.pdf";
            $headers = [
                "Content-type :application/pdf",
                "Cache-Control : no-store, no-cache",
                "Content-disposition", "attachment; filename=pdf_attendance.pdf"
            ];
            return response()->download($file, 'pdf_attendance.pdf', $headers);
        }
        return redirect('/attendance-admin')->with('err_code', ['type' => 'error', 'msg' => 'Internal server error - PDF does not exists!']);
    }


    public function attendance_ajax( Request $request ){
        $id_zamestnanca = $request->input('staff');
        $rok = $request->input('year');
        $mesiac = $request->input('month');
        $den = $request->input('day');
        $id_typu = $request->input('type');

        if(date('N',strtotime($rok.'-'.$mesiac.'-'.$den)) < 6){
            if($id_typu == -1){
                DB::table('nepritomnosti')
                        ->where('id_zamestnanca', $id_zamestnanca)
                        ->where('rok', $rok)
                        ->where('mesiac', $mesiac)
                        ->where('den', $den)
                        ->delete();
            }else{
                $data = [
                    'id_zamestnanca' => $id_zamestnanca,
                    'rok' => $rok,
                    'mesiac' => $mesiac,
                    'den' => $den,
                    'id_typu' => $id_typu,
                ];

                $tmp = DB::table('nepritomnosti')
                        ->where('id_zamestnanca', $id_zamestnanca)
                        ->where('rok', $rok)
                        ->where('mesiac', $mesiac)
                        ->where('den', $den)
                        ->get();
                
                if(count($tmp) > 0){
                    DB::table('nepritomnosti')->where('id_zamestnanca', $id_zamestnanca)->where('rok', $rok)->where('mesiac', $mesiac)->where('den', $den)->update($data);
                    echo json_encode(['code' => 200, 'message' => 'OK']);
                }else{
                    if(DB::table('nepritomnosti')->insertGetId($data)){
                        echo json_encode(['code' => 200, 'message' => 'OK']);
                    }else{
                        echo json_encode(['code' => 400, 'message' => 'ERROR']);
                    }
                }
            }
        }
    }
}
