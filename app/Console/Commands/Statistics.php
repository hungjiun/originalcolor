<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\BigWebLimit;
use App\BigWebPageview;
use App\BigWebOnline;
use App\BigWebVisit;
use App\BigViewWebClick;
use App\BigViewWebPageview;
use App\BigViewWebAgent;
use App\BigViewWebLocation;
use App\BigViewWebVisitOnline;
use App\BigTotalWebAgent;
use App\BigTotalWebBounce;
use App\BigTotalWebClick;
use App\BigTotalWebLocation;
use App\BigTotalWebOnline;
use App\BigTotalWebPageview;
use App\BigTotalWebStaytime;
use App\BigTotalWebVisit;

class Statistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->statistics_total();
    }

    // 1 * * * * curl http://bigdata.pin2wall.com/autorun/astotal >> /tmp/crontab.log
    // 31 * * * * curl http://bigdata.pin2wall.com/autorun/astotal >> /tmp/crontab.log
    // 每30分鐘更新PageView Total與Visit Total
    public function statistics_total() {
        $rtndata ['states'] = 1;
        $rtndata ['msg'] = "";
        $rtndata ['info'] = "";
        
        // 時間戳記 30分鐘前的記錄
        $start_time = mktime ( date ( 'H' ), '0', '0', date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
        
        // VISITOR
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['big_view_web_pageview.iStates'] = 0;
        $visit_total = BigViewWebPageview::select ( DB::raw ( "DISTINCT big_view_web_pageview.iVisit_id, vSourceID, vUserID,vRemoteAddr" ) )->join ( 'big_view_web_visit_online', function ($join) {
            $join->on ( 'big_view_web_pageview.iVisit_id', '=', 'big_view_web_visit_online.iVisit_id' );
        } )->where ( $mapBigViewWebPageview )->where ( 'big_view_web_pageview.iStartTime', '<', $start_time )->get ();
        foreach ( $visit_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vRemoteAddr'] = $var->vRemoteAddr;
            $addinfo ['vType'] = "Visit";
            $addinfo ['iTotal'] = '1';
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebVisit::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 0;
        $updateinfo = [];
        $updateinfo ['iStates'] = 1;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // PAGEVIEW
        $pageview_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID, vReferer, vReferer2, vGroup, vMod, vFunc, vAction" ) )->where ( "iStates", "=", "1" )->where ( 'iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID', 'vReferer', 'vReferer', 'vReferer2' )->get ();
        
        foreach ( $pageview_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vReferer'] = $var->vReferer;
            $addinfo ['vReferer2'] = $var->vReferer2;
            $addinfo ['vGroup'] = $var->vGroup;
            $addinfo ['vMod'] = $var->vMod;
            $addinfo ['vFunc'] = $var->vFunc;
            $addinfo ['vAction'] = $var->vAction;
            $addinfo ['vType'] = "PageView";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebPageview::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 1;
        $updateinfo = [];
        $updateinfo ['iStates'] = 2;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // CLICK
        $click_total = BigViewWebClick::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID, vReferer2, vGroup, vMod, vFunc, vAction" ) )->where ( "iStates", "=", "0" )->where ( 'iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID', 'vReferer2', 'vGroup', 'vMod', 'vFunc', 'vAction' )->get ();
        
        foreach ( $click_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vReferer2'] = $var->vReferer2;
            $addinfo ['vGroup'] = $var->vGroup;
            $addinfo ['vMod'] = $var->vMod;
            $addinfo ['vFunc'] = $var->vFunc;
            $addinfo ['vAction'] = $var->vAction;
            $addinfo ['vType'] = "Click";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebClick::insert ( $addinfo );
        }
        
        $mapBigViewWebClick = [];
        $mapBigViewWebClick ['iStates'] = 0;
        $updateinfo = [];
        $updateinfo ['iStates'] = 1;
        BigViewWebClick::where ( $mapBigViewWebClick )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // AGENT
        $agent_total = BigViewWebPageview::select ( DB::raw ( "COUNT(big_view_web_pageview.iVisit_id) as total,vSourceID,vUserID,vLang,vSystem,vOS,vDevice,vBrowers" ) )->join ( 'big_view_web_agent', function ($join) {
            $join->on ( 'big_view_web_pageview.iVisit_id', '=', 'big_view_web_agent.iVisit_id' );
        } )->where ( "big_view_web_pageview.iStates", "=", "2" )->where ( 'big_view_web_pageview.iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID', 'vLang', 'vSystem', 'vOS', 'vDevice', 'vBrowers' )->get ();
        foreach ( $agent_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vLang'] = $var->vLang;
            $addinfo ['vSystem'] = $var->vSystem;
            $addinfo ['vOS'] = $var->vOS;
            $addinfo ['vDevice'] = $var->vDevice;
            $addinfo ['vBrowers'] = $var->vBrowers;
            $addinfo ['vType'] = "Agent";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebAgent::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 2;
        $updateinfo = [];
        $updateinfo ['iStates'] = 3;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // LOCATION
        $location_total = BigViewWebPageview::select ( DB::raw ( "COUNT(big_view_web_pageview.iVisit_id) as total,vSourceID,vUserID,vCountry,vCity,vLat,vLon" ) )->join ( 'big_view_web_location', function ($join) {
            $join->on ( 'big_view_web_pageview.iVisit_id', '=', 'big_view_web_location.iVisit_id' );
        } )->where ( "big_view_web_pageview.iStates", "=", "3" )->where ( 'big_view_web_pageview.iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID', 'vCountry', 'vCity', 'vLat', 'vLon' )->get ();
        foreach ( $location_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vCountry'] = $var->vCountry;
            $addinfo ['vCity'] = $var->vCity;
            $addinfo ['vLat'] = $var->vLat;
            $addinfo ['vLon'] = $var->vLon;
            $addinfo ['vType'] = "Location";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebLocation::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 3;
        $updateinfo = [];
        $updateinfo ['iStates'] = 4;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // ONLINE
        // 開始時間在區段
        $online_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "4" )->where ( 'iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID' )->get ();
        
        foreach ( $online_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vType'] = "Online";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebOnline::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 4;
        $updateinfo = [];
        $updateinfo ['iStates'] = 5;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // STAYTIME
        $staytime_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID, SUM(iStayTime) as iStayTime" ) )->where ( "iStates", "=", "5" )->where ( "iStayTime", ">", "0" )->where ( 'iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID' )->get ();
        
        foreach ( $staytime_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['iVisit_total'] = $var->total;
            $addinfo ['iStayTime_total'] = $var->iStayTime;
            $addinfo ['vType'] = "StayTime";
            $addinfo ['iTotal'] = ($var->total) ? intval ( $var->iStayTime / $var->total ) : 0;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebStaytime::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 5;
        $updateinfo = [];
        $updateinfo ['iStates'] = 6;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        // BOUNCE
        $bounce_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "6" )->where ( "iStayTime", "=", "0" )->where ( 'iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID' )->get ();
        
        $all_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "6" )->where ( 'iStartTime', '<', $start_time )->groupBy ( 'vSourceID', 'vUserID' )->get ();
        
        foreach ( $bounce_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vType'] = "Bounce";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebBounce::insert ( $addinfo );
        }
        
        foreach ( $all_total as $var ) {
            $addinfo = array ();
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vType'] = "All";
            $addinfo ['iTotal'] = $var->total;
            $addinfo ['iDateTime'] = $start_time;
            BigTotalWebBounce::insert ( $addinfo );
        }
        
        $mapBigViewWebPageview = [];
        $mapBigViewWebPageview ['iStates'] = 6;
        $updateinfo = [];
        $updateinfo ['iStates'] = 7;
        BigViewWebPageview::where ( $mapBigViewWebPageview )->where ( 'iStartTime', '<', $start_time )->update ( $updateinfo );
        
        return response ()->json ( $rtndata );
    }
}
