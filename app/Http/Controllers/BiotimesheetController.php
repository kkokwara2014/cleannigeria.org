<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Biotimesheet;
use Illuminate\Http\Request;
use App\Models\Scannerlocation;

class BiotimesheetController extends Controller
{
   
    public function index()
    {
        return view('admin.biometric.timesys');
    }


    public function store(Request $request)
    {
        $timesheet = new Biotimesheet;
        $existInTime = $this->checkTimeSheet($request);
        if($existInTime){
            if($existInTime->location_id == $request->location_id){
                $timesheet = $existInTime;
            }
        }

        $timesheet->user_id = $request->user_id;
        $timesheet->location_id = $request->location_id;
        $timesheet->clocked_out = ($timesheet->clocked_in) ? date('Y-m-d H:i:s') : $timesheet->clocked_out;
        $timesheet->clocked_in = ($timesheet->clocked_in == null) ? date('Y-m-d H:i:s') : $timesheet->clocked_in;
        $timesheet->user_location = $this->location($request->location_id)->name;
        $timesheet->save();

        return response()->json(['message'=>'Time captured'], 200);

    }

    private function location($id)
    {
        return Scannerlocation::find($id);
    }

    private function checkTimeSheet($data)
    {
        $today = date('Y-m-d');
        return  Biotimesheet::whereUserId($data->user_id)
                                ->whereLocationId($data->location_id)
                                ->whereDate('created_at', '=', $today)
                                ->whereNull('clocked_out')->latest()
                                ->first();
    }

    public function camskey()
    {
        return config('services.camsbio.key');
    }

    public function report()
    {
        $user = Auth::user();
        $timesheet = $this->allReport();
        return view('admin.biometric.timesheet_report', compact('user', 'timesheet'));
    }

    public function allReport()
    {
        $timesheet = Biotimesheet::with(['user','location'])->get();
        return $timesheet;
    }

    public function monthlyReport($user_id, $date)
    {
        $user = Auth::user();
        $monthlyData = $this->individualMonthlyReport($user_id, $date);
        $for_period = $monthlyData['for_period'];
        $timesheet = $monthlyData['timesheet'];
        $manhour = $monthlyData['manhour'];

        return view('admin.biometric.user_timesheet_report', compact('user', 'manhour', 'timesheet', 'for_period'));
    }

    // 7:00 - 7:30 Green
    // 7:31 - 8am yellow
    // 8:00 - above Red
    
    public function yearlyReport($user_id, $date)
    {
        $user = Auth::user();
        $yearlyData = $this->individualYearlyReport($user_id, $date);
        $for_period = $yearlyData['for_period'];
        $timesheet = $yearlyData['timesheet'];
        $manhour = $yearlyData['manhour'];
                
        return view('admin.biometric.user_timesheet_report', compact('user', 'manhour', 'timesheet', 'for_period'));
    }

    public function individualYearlyReport($user_id, $date)
    {
        $data['for_period'] = 'yearly';
        $year = date('Y', strtotime($date));
        $data['timesheet'] = Biotimesheet::whereUserId($user_id)
                                            ->whereYear('created_at', $year)
                                            ->with(['user','location'])->get();

        $data['manhour'] = round($data['timesheet']->sum('duration') / 60, PHP_ROUND_HALF_UP);

        return $data;
    }

    public function individualMonthlyReport($user_id, $date)
    {
        $user = Auth::user();
        $data['for_period'] = 'monthly';
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $data['timesheet'] = Biotimesheet::whereUserId($user_id)
                                            ->whereYear('created_at', $year)
                                            ->whereMonth('created_at', $month)
                                            ->with(['user','location'])->get();

        $data['manhour'] = round($data['timesheet']->sum('duration') / 60, PHP_ROUND_HALF_UP);

        return $data;
    }

    public function print($user_id, $date, $printType = null)
    {

        if($printType == null){
            $data = $this->allReport();
        }

        if($printType == 'yearly'){
            $data = $this->individualYearlyReport($user_id, $date);
        }

        if($printType == 'monthly'){
            $data = $this->individualMonthlyReport($user_id, $date);
        }

        $user = Auth::user();
        $for_period = $data['for_period'];
        $timesheet = $data['timesheet'];
        $manhour = $data['manhour'];

        return view('admin.biometric.print.print', compact('user', 'manhour', 'timesheet', 'for_period'));
    }

   
    public function destroy(Biotimesheet $biotimesheet)
    {
        //
    }
}
