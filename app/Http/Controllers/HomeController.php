<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idletimes;
use App\Windowtitles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalidletimes = Idletimes::where('created_at',date('Y-m-d'))
                        ->Select('macaddress','created_at',Idletimes::raw("SUM(apparentidletime) as totalidle"))
                        ->groupBy('macaddress','created_at')
                        ->having('macaddress','00FFF441BABA')
                        ->first();
        
        $totalproductivetimes = Windowtitles::where('created_at',date('Y-m-d'))
                            ->Select('macaddress','created_at',Windowtitles::raw("SUM(total_time) as totalproductive"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','00FFF441BABA')
                            ->first();

        $yesterdayIdleTimes = Idletimes::where('created_at', date('Y-m-d',strtotime('-1 day')))
                            ->Select('macaddress','created_at',Idletimes::raw("SUM(apparentidletime) as yesterdayIdle"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','E86A64F972D6')
                            ->first();
            
        $yesterdayProductiveTimes = Windowtitles::where('created_at',date('Y-m-d',strtotime('-1 day')))
                            ->Select('macaddress','created_at',Windowtitles::raw("SUM(total_time) as yesterdayProductive"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','E86A64F972D6')
                            ->first();

        $lastWeekIdleTimes = Idletimes::whereBetween('created_at', [date('Y-m-d',strtotime('-1 week')),date('Y-m-d')])
                            ->Select('macaddress','created_at',Idletimes::raw("SUM(apparentidletime) as lastWeekIdle"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','E86A64F972D6')
                            ->first();
            
        $lastweekProductiveTimes = Windowtitles::whereBetween('created_at', [date('Y-m-d',strtotime('-1 week')),date('Y-m-d')])
                            ->Select('macaddress','created_at',Windowtitles::raw("SUM(total_time) as lastweekProductive"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','E86A64F972D6')
                            ->first();

        $currentMonthidle = Idletimes::whereBetween('created_at', [date('Y-m-01'),date('Y-m-d')])
                            ->Select('macaddress','created_at',Idletimes::raw("SUM(apparentidletime) as currentmonthidle"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','E86A64F972D6')
                            ->first();
        
        $currentMonthProductive = Windowtitles::whereBetween('created_at', [date('Y-m-01'),date('Y-m-d')])
                            ->Select('macaddress','created_at',Windowtitles::raw("SUM(total_time) as currentmonthproductive"))
                            ->groupBy('macaddress','created_at')
                            ->having('macaddress','E86A64F972D6')
                            ->first();

        return view('home',['totalidletimes'=>$totalidletimes,
                    'totalproductivetimes'=>$totalproductivetimes,
                    'yesterdayIdleTimes'=>$yesterdayIdleTimes,
                    'yesterdayProductiveTimes'=>$yesterdayProductiveTimes,
                    'lastWeekIdleTimes'=>$lastWeekIdleTimes,
                    'lastweekProductiveTimes'=>$lastweekProductiveTimes,
                    'currentMonthidle'=>$currentMonthidle,
                    'currentMonthProductive'=>$currentMonthProductive]);
        //return  $currentMonthidle . "--       --".$currentMonthProductive;
        //return view('home');
        
    }
}
