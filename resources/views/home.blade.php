@extends('layouts.app')
@section('application-title','Dashboard')
    

@section('content')

@php
    $totalTime=strtotime($totalidletimes->totalidle) + $totalproductivetimes->totalproductive;
    $utilizationPer = number_format(($totalproductivetimes->totalproductive/$totalTime) * 100,2);

    //users yesterday utilization %
    if (empty($yesterdayIdleTimes) && empty($yesterdayProductiveTimes)) {
        $yesterUtilizationPer = 0;
     }elseif (empty($yesterdayProductiveTimes)) {
        $yesterUtilizationPer = 0;
     }elseif (empty($yesterdayIdleTimes)) {
        $yesterTotaltime = $yesterdayProductiveTimes->yesterdayproductive;
        $yesterUtilizationPer = number_format(($yesterdayProductiveTimes->yesterdayproductive/$yesterTotaltime) * 100,4);
     }else {
        $yesterTotaltime=strtotime($yesterdayIdleTimes->yesterdayidle) + $yesterdayProductiveTimes->yesterdayproductive;
        $yesterUtilizationPer = number_format(($yesterdayProductiveTimes->yesterdayproductive/$yesterTotaltime) * 100,4);
    }
    //users lastweek utilization %
    if (empty($lastWeekIdleTimes) && empty($lastweekProductiveTimes)) {
        $lastWeekUtilizationPer = 0;
     }elseif (empty($lastweekProductiveTimes)) {
        $lastWeekUtilizationPer = 0;
     }elseif (empty($lastWeekIdleTimes)) {
        $lastWeekTotaltime = $lastweekProductiveTimes->lastweekproductive;
        $lastWeekUtilizationPer = number_format(($lastweekProductiveTimes->lastweekproductive/$lastWeekTotaltime) * 100,4);
     }else {
        $lastWeekTotaltime=strtotime($lastWeekIdleTimes->lastweekidle) +  $lastweekProductiveTimes->lastweekproductive;
        $lastWeekUtilizationPer = number_format(($lastweekProductiveTimes->lastweekproductive/$lastWeekTotaltime) * 100,4);
    }
    //users currentMonth utilization %
    if (empty($currentMonthidle) && empty($currentMonthProductive)) {
        $currentMonthUtilizationPer = 0;
     }elseif (empty($currentMonthProductive)) {
        $currentMonthUtilizationPer = 0;
     }elseif (empty($currentMonthidle)) {
        $currentMonthTotaltime = $currentMonthProductive->currentmonthproductive;
        $currentMonthUtilizationPer = number_format(( $currentMonthProductive->currentmonthproductive/$currentMonthTotaltime) * 100,4);
     }else {
        $currentMonthTotaltime=strtotime($currentMonthidle->currentmonthidle) +  $currentMonthProductive->currentmonthproductive;
        $currentMonthUtilizationPer = number_format(( $currentMonthProductive->currentmonthproductive/$currentMonthTotaltime) * 100,4);
    }
     //$yesterUtilizationPer =  $yesterTotaltime;
    @endphp
<script>
    //  alert('{{strtotime($yesterdayIdleTimes->yesterdayidle)}}');
    //  alert('{{$yesterdayProductiveTimes->yesterdayproductive}}');
    alert('{{$totalTime}}')
</script>
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box  hover-expand-effect">
                <div class="icon" style="
                background-color: #17a2b8!important;">

                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text font-bold">PRODUCTIVE<i class="material-icons"></i></div>
                    <div class="number">
                        <small>{{gmdate("H:i:s", $totalproductivetimes->totalproductive)}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box hover-expand-effect">
                <div class="icon" style="
                background-color: #dc355c!important;
                    ">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text font-bold">IDLE</div>
                    <div class="number"><small>{{gmdate("H:i:s",strtotime($totalidletimes->totalidle))}}</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box  hover-expand-effect">
                <div class="icon" style="background-color:#28a745!important">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text font-bold">TOTAL</div>
                <div class="number"><small>{{gmdate("H:i:s",$totalTime)}}</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="icon" style="
                background-color: #ffc107!important;">
                    <div class="chart chart-pie">30, 35, 35</div>
                </div>
                <div class="content">
                    <div class="text font-bold">UTILIZATION %</div>
                <div class="number"><small>{{$utilizationPer}}%</small></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    <div class="row clearfix">
        <!-- Visitors -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card"   style="
            background-color: #17a2b8!important;">
                <div class="body" style="
                color: white;">
                    <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                         data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                         data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                         data-fill-Color="rgba(0, 188, 212, 0)">
                        12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                    </div>
                    <ul class="dashboard-stat-list">
                        <li>
                            YESTERDAY
                        <span class="pull-right"><b>{{$yesterUtilizationPer}}%</b> <small></small></span>
                        </li>
                        <li>
                            LAST WEEK
                        <span class="pull-right"><b>{{$lastWeekUtilizationPer}}%</b> <small></small></span>
                        </li>
                        <li>
                            CURRENT MONTH
                        <span class="pull-right"><b>{{$currentMonthUtilizationPer}}%</b> <small></small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Visitors -->
        <!-- Latest Social Trends -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="header">
                    <h2>CATEGORY</h2>
                </div>
                <div class="body">
                    <small class="badge small">
                    Business</small>
                    <span class="badge data-percentage">%</span>
                    <div class="progress">
                        <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                        </div>
                    </div>
                    <small class="badge small" >Communication</small>
                    <span class="badge data-percentage">60%</span>
                    <div class="progress">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        </div>
                    </div>
                    <small class="badge small" >Uncategorized</small>
                    <span class="badge data-percentage">50%</span>
                    <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                        </div>
                    </div>
                    <small class="badge small">Social Networking</small>
                    <span class="badge data-percentage">80%</span>
                    <div class="progress">
                        <div class="progress-bar bg-brown" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        </div>
                    </div>
                    <small class="badge small">Browsers</small>
                    <span class="badge data-percentage">70%</span>
                    <div class="progress">
                        <div class="progress-bar bg-deep-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card" style="
            background-color: #dc355c!important;
        ">
                <div class="body" style="color:white;">
                    <div class="m-b--35 font-bold">PRODUCTIVE UTILIZATION PERCENTAGE</div>
                    <ul class="dashboard-stat-list">
                        <li>
                            #socialtrends
                            <span class="pull-right">
                                <i class="material-icons">trending_up</i>
                            </span>
                        </li>
                        <li>
                            #materialdesign
                            <span class="pull-right">
                                <i class="material-icons">trending_up</i>
                            </span>
                        </li>
                        <li>#adminbsb</li>
                        <li>#freeadmintemplate</li>
                        <li>#bootstraptemplate</li>
                        <li>
                            #freehtmltemplate
                            <span class="pull-right">
                                <i class="material-icons">trending_up</i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <!-- #END# Latest Social Trends -->
        <!-- Answered Tickets -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card" style="
            background-color: #28a745!important;">
                <div class="body" style="color: white;">
                    <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                    <ul class="dashboard-stat-list">
                        <li>
                            TODAY
                            <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST MONTH
                            <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST YEAR
                            <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            ALL
                            <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Answered Tickets -->
    </div>

    <div class="row clearfix">
        <!-- Task Info -->
        <!-- #END# Task Info -->
        <!-- Browser Usage -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="header">
                    <h2>BROWSER USAGE</h2>
                </div>
                <div class="body">
                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                </div>
            </div>
        </div>
        <!-- #END# Browser Usage -->
        <!-------Progress bar------->
         
        <!----#END# Progress bar---->                
        <!-- CPU Usage -->
        <div class="row clearfix" id="cpuChart">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>CPU USAGE (%)</h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12">REAL TIME</span>
                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                </div>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="real_time_chart" class="dashboard-flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- #END# CPU Usage -->

    </div>
</div>
@endsection
