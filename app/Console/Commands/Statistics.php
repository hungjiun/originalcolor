<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
    }

    // 1 * * * * curl http://bigdata.pin2wall.com/autorun/astotal >> /tmp/crontab.log
    // 31 * * * * curl http://bigdata.pin2wall.com/autorun/astotal >> /tmp/crontab.log
    // 每30分鐘更新PageView Total與Visit Total
    public function statistics_total() {
        $rtndata ['states'] = 1;
        $rtndata ['msg'] = "";
        $rtndata ['info'] = "";
        
        // 時間戳記 30分鐘前的記錄
        $start_time = mktime ( date ( 'H' ) - 1, '0', '0', date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
        $end_time = time ();
        $times = floor ( ($end_time - $start_time) / 1800 );
        
        for($i = 0; $i <= $times; $i ++) {
            // 時間戳記 30分鐘前的記錄
            $between1 = $start_time + (1800 * $i);
            $between2 = $start_time + (1800 * ($i + 1));
            // 統計報表時間戳記
            $check_time = $between1 + 900;
            
            // VISITOR
            $visit_total = BigViewWebPageview::select ( DB::raw ( "DISTINCT big_view_web_pageview.iVisit_id, vSourceID, vUserID,vRemoteAddr" ) )->join ( 'big_view_web_visit_online', function ($join) {
                $join->on ( 'big_view_web_pageview.iVisit_id', '=', 'big_view_web_visit_online.iVisit_id' );
            } )->where ( "iStates", "=", "0" )->whereBetween ( 'big_view_web_pageview.iStartTime', array (
                    $between1,
                    $between2 
            ) )->get ();
            foreach ( $visit_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vRemoteAddr'] = $var->vRemoteAddr;
                $addinfo ['vType'] = "Visit";
                $addinfo ['iTotal'] = '1';
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebVisit::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '0';
            $updateinfo ['iStates'] = "1";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // PAGEVIEW
            $pageview_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID, vReferer, vReferer2" ) )->where ( "iStates", "=", "1" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID', 'vReferer', 'vReferer', 'vReferer2' )->get ();
            
            foreach ( $pageview_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vReferer'] = $var->vReferer;
                $addinfo ['vReferer2'] = $var->vReferer2;
                $addinfo ['vType'] = "PageView";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebPageview::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '1';
            $updateinfo ['iStates'] = "2";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // CLICK
            $click_total = BigViewWebClick::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID,vReferer2, vGroup, vMod, vFunc, vAction" ) )->where ( "iStates", "=", "0" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID', 'vReferer2', 'vGroup', 'vMod', 'vFunc', 'vAction' )->get ();
            
            foreach ( $click_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vReferer2'] = $var->vReferer2;
                $addinfo ['vGroup'] = $var->vGroup;
                $addinfo ['vMod'] = $var->vMod;
                $addinfo ['vFunc'] = $var->vFunc;
                $addinfo ['vAction'] = $var->vAction;
                $addinfo ['vType'] = "Click";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebClick::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '0';
            $updateinfo ['iStates'] = "1";
            BigViewWebClick::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // AGENT
            $agent_total = BigViewWebPageview::select ( DB::raw ( "COUNT(big_view_web_pageview.iVisit_id) as total,vSourceID,vUserID,vLang,vSystem,vOS,vDevice,vBrowers" ) )->join ( 'big_view_web_visit_agent', function ($join) {
                $join->on ( 'big_view_web_pageview.iVisit_id', '=', 'big_view_web_visit_agent.iVisit_id' );
            } )->where ( "iStates", "=", "2" )->whereBetween ( 'big_view_web_pageview.iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID', 'vLang', 'vSystem', 'vOS', 'vDevice', 'vBrowers' )->get ();
            foreach ( $agent_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vLang'] = $var->vLang;
                $addinfo ['vSystem'] = $var->vSystem;
                $addinfo ['vOS'] = $var->vOS;
                $addinfo ['vDevice'] = $var->vDevice;
                $addinfo ['vBrowers'] = $var->vBrowers;
                $addinfo ['vType'] = "Agent";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebAgent::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '2';
            $updateinfo ['iStates'] = "3";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // LOCATION
            $location_total = BigViewWebPageview::select ( DB::raw ( "COUNT(big_view_web_pageview.iVisit_id) as total,vSourceID,vUserID,vCountry,vCity,vLat,vLon" ) )->join ( 'big_view_web_visit_location', function ($join) {
                $join->on ( 'big_view_web_pageview.iVisit_id', '=', 'big_view_web_visit_location.iVisit_id' );
            } )->where ( "iStates", "=", "3" )->whereBetween ( 'big_view_web_pageview.iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID', 'vCountry', 'vCity', 'vLat', 'vLon' )->get ();
            foreach ( $location_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vCountry'] = $var->vCountry;
                $addinfo ['vCity'] = $var->vCity;
                $addinfo ['vLat'] = $var->vLat;
                $addinfo ['vLon'] = $var->vLon;
                $addinfo ['vType'] = "Location";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebLocation::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '3';
            $updateinfo ['iStates'] = "4";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // ONLINE
            // 開始時間在區段
            $online_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "4" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->whereNotBetween ( 'iEndTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID' )->get ();
            
            $online_total += BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "7" )->whereNotBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->whereBetween ( 'iEndTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID' )->get ();
            
            $online_total += BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "4" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->whereBetween ( 'iEndTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID' )->get ();
            
            foreach ( $online_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vType'] = "Online";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebOnline::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '4';
            $updateinfo ['iStates'] = "5";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // STAYTIME
            $staytime_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID, SUM(iStayTime) as iStayTime" ) )->where ( "iStates", "=", "5" )->where ( "iStayTime", ">", "0" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID' )->get ();
            
            foreach ( $staytime_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['iVisit_total'] = $var->total;
                $addinfo ['iStayTime_total'] = $var->iStayTime;
                $addinfo ['vType'] = "StayTime";
                $addinfo ['iTotal'] = ($var->total) ? intval ( $var->iStayTime / $var->total ) : 0;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebStaytime::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '5';
            $updateinfo ['iStates'] = "6";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
            
            // BOUNCE
            $bounce_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "6" )->where ( "iStayTime", "=", "0" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID' )->get ();
            
            $all_total = BigViewWebPageview::select ( DB::raw ( "COUNT(iVisit_id) as total, vSourceID, vUserID" ) )->where ( "iStates", "=", "6" )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->groupBy ( 'vSourceID', 'vUserID' )->get ();
            
            foreach ( $bounce_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vType'] = "Bounce";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebBounce::insert ( $addinfo );
            }
            
            foreach ( $all_total as $var ) {
                $addinfo = array ();
                $addinfo ['vSourceID'] = $var->vSourceID;
                $addinfo ['vUserID'] = (! in_array ( $var->vSourceID, config::get ( 'system.webappmaker_sid' ) )) ? $var->vUserID : strtok ( $var->vUserID, ":" );
                $addinfo ['vType'] = "All";
                $addinfo ['iTotal'] = $var->total;
                $addinfo ['iDateTime'] = $check_time;
                BigTotalWebBounce::insert ( $addinfo );
            }
            
            $map = array ();
            $updateinfo = array ();
            $map ['iStates'] = '6';
            $updateinfo ['iStates'] = "7";
            BigViewWebPageview::where ( $map )->whereBetween ( 'iStartTime', array (
                    $between1,
                    $between2 
            ) )->update ( $updateinfo );
        }
        
        return response ()->json ( $rtndata );
    }
}
