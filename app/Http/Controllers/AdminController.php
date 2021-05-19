<?php

namespace App\Http\Controllers;

use App\Models\Executor;
use App\Models\Patient;
use App\Models\PatientTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $patients=Patient::count();
        $executors=Executor::count();
        $patient_tests=PatientTest::count();
        $pendapatan=PatientTest::all()->pluck('harga')->sum();
        return view('dashboard', compact('patients','executors','patient_tests','pendapatan'));
    }

    public function setting()
    {
        $active = Route::getCurrentRoute()->uri;
        $menus = DB::table('menus')->get();
        return view('admin.setting', compact('active', 'menus'));
    }

    public function pdf()
    {
        return generate_pdf('',2);
    }

    public function dashboard_patient(Request $request)
    {
        //index ke      1  ,  2  ,   3  ,   4  ,   5  ,   6  ,   7  ,   8  ,   9  ,  10  ,  11  ,  12
        $months = [1=>'Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data['statis'] = [0,0,0,0,0,0];
        $month_now = date('n');
        $patients = DB::table('patients')
            ->selectRaw("DATE_FORMAT(created_at, '%d-%m-%Y') AS tanggal,
                         DATE_FORMAT(created_at, '%c') AS bulan,
                         DATE_FORMAT(created_at, '%b') AS nm_bulan,
                         COUNT(*) AS jumlah")
            ->whereRaw("created_at > date_sub(now(), interval 6 month)")
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%c')"))
            ->orderBy("created_at")->get();
        $patients=$patients->toArray();
        for($i=$month_now;$i>$month_now-7;$i--){
            $a=$i<1?$i+12 : $i;
            $month_new[]=$months[$a];
        }
        unset($month_new[count($month_new)-1]);
        foreach($patients as $patient){
            foreach($month_new as $i => $mn){
                if($patient->nm_bulan == $mn){
                    $data['statis'][$i] = intval($patient->jumlah);
                }
            }
        }
        $data['month'] = array_reverse($month_new);
        $data['statis'] = array_reverse($data['statis']);
        return $request->ajax()?response()->json($data):abort(403,'Permintaan harus ajax');
    }

    public function dashboard_pemeriksaan(Request $request)
    {
        //index ke   0   ,   1   ,    2    ,   3   ,   4    ,    5   ,    6
        $days = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $data['statis'] = [0,0,0,0,0,0,0];
        $day_now = date('w');
        for($i=$day_now;$i>$day_now-7;$i--){
            $a=$i<0?$i+7:$i;
            $day_new[]=$days[$a];
        }
        $data['days']=array_reverse($day_new);
        $pemeriksaan = DB::table('patient_tests')
                        ->selectSub("DATE_FORMAT(created_at, '%d-%m-%Y')", 'tanggal')
                        ->selectSub("DATE_FORMAT(created_at, '%w')",'hari')
                        // ->selectSub("COUNT(*)",'jumlah')
                        ->selectSub("SUM(harga)",'jumlah')
                        ->whereRaw("created_at > date_sub(now(), interval 1 week)")
                        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%w')"))
                        ->orderBy('created_at')->get();
        foreach($pemeriksaan as $pm){
            foreach($data['days'] as $i => $d){
                if($days[$pm->hari] == $d){
                    $data['statis'][$i] = intval($pm->jumlah);
                }
            }
        }
        return $request->ajax()?response()->json($data):abort(403,'Permintaan harus ajax');
    }
}
