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

use App\BigSystemGeoipData;

use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

class UpdateInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateInfo';

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

        $this->datetime = mktime ( date ( 'H' ), date ( 'i' ), '0', date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->agent_info();
    }

    // */30 * * * * curl http://bigdata.pin2wall.com/autorun/agent >> /tmp/crontab.log
    // 手動更新agen info
    public function agent_info() {        
        
        $mapBigWebVisit ['iStates'] = "1";
        $visit_arr = BigWebVisit::where ( $mapBigWebVisit )->where ( 'iDateTime', '<', $this->datetime )->get ();
        
        foreach ( $visit_arr as $key => $var ) {
            // ID
            $this->visit_id = $var->iId;
            
            // 語系
            preg_match ( '/^([a-z\-]+)/i', $var->vLanguage, $matches );
            $this->language = (isset ( $matches [0] )) ? strtolower ( trim ( $matches [0] ) ) : "other";
            $this->user_agent = $var->vUserAgent;
            preg_match ( '/Mozilla\/.*?\((.*?)[\s;]/', $this->user_agent, $matches );
            $this->user_system = (isset ( $matches [1] )) ? trim ( $matches [1] ) : "other";
            $this->user_system = ($this->user_system == "Linux") ? "Android" : $this->user_system;
            // 系統不同，OS資訊位置不同
            if (preg_match ( '/Android/', $this->user_system )) {
                preg_match ( '/(Android.*?)[;\)]/', $this->user_agent, $matches );
            } elseif (preg_match ( '/Windows/', $this->user_system )) {
                preg_match ( '/(' . str_replace ( '/', ' ', $this->user_system ) . '.*?)[;\)]/', $this->user_agent, $matches );
            } elseif (preg_match ( '/Mobile/', $this->user_system )) {
                preg_match ( '/' . str_replace ( '/', ' ', $this->user_system ) . ';(.*?); Android/', $this->user_agent, $matches );
            } else {
                preg_match ( '/' . str_replace ( '/', ' ', $this->user_system ) . ';(.*?)\)/', $this->user_agent, $matches );
            }
            $this->user_os = (isset ( $matches [1] )) ? trim ( $matches [1] ) : $this->user_system;
            
            // 系統不同，Device資訊位置不同
            if (preg_match ( '/Android/', $this->user_agent )) {
                preg_match ( '/' . str_replace ( '/', ' ', $this->user_os ) . '\;(.*?)\)/', $this->user_agent, $matches );
                $this->user_device = (isset ( $matches [1] )) ? trim ( $matches [1] ) : "other";
            } elseif (preg_match ( '/WPDesktop/', $this->user_agent )) {
                preg_match ( '/WPDesktop\;(.*?)\)/', $this->user_agent, $matches );
                $this->user_device = (isset ( $matches [1] )) ? trim ( $matches [1] ) : "other";
            } else {
                $this->user_device = $this->user_system;
            }
            
            if (preg_match ( '/Mobile/', $this->user_agent, $matches )) {
                $this->user_browers = "Mobile";
                preg_match ( '/(Firefox)|(Chrome)/', $this->user_agent, $matches );
                $this->user_browers .= (isset ( $matches [0] )) ? " " . trim ( $matches [0] ) : "";
                preg_match ( '/Mobile.*? (.*?)\//', $this->user_agent, $matches );
                $this->user_browers .= (isset ( $matches [1] )) ? " " . trim ( $matches [1] ) : "";
            } else {
                preg_match ( '/(Firefox)|(Chrome)|(Trident)|(Safari)/', $this->user_agent, $matches );
                $this->user_browers = (isset ( $matches [0] )) ? trim ( $matches [0] ) : "other";
            }
            
            $addinfo ['iVisit_id'] = $this->visit_id;
            $addinfo ['vLang'] = $this->language;
            $addinfo ['vSystem'] = $this->user_system;
            $addinfo ['vOS'] = $this->user_os;
            $addinfo ['vDevice'] = $this->user_device;
            $addinfo ['vBrowers'] = $this->user_browers;
            BigViewWebAgent::insert ( $addinfo );
        }
        
        $mapBigWebVisit ['iStates'] = '1';
        $updateinfo ['iStates'] = "2";
        BigWebVisit::where ( $mapBigWebVisit )->where ( 'iDateTime', '<', $this->datetime )->update ( $updateinfo );
        
        $this->location_info ();
        $this->online_info ();
        $this->pageview_info ();
        $this->click_info ();
        
        return true;
    }
    
    // */30 * * * * curl http://bigdata.pin2wall.com/autorun/location >> /tmp/crontab.log
    // 手動更新location
    public function location_info() {       
        
        $geoip = new Reader ( base_path () . '/database/maxmind/GeoLite2-City.mmdb' );
        
        $mapBigWebVisit ['iStates'] = "2";
        $visit_info = BigWebVisit::select ( DB::raw ( "DISTINCT vRemoteAddr" ) )->where ( $mapBigWebVisit )->where ( 'iDateTime', '<', $this->datetime )->get ();
        
        foreach ( $visit_info as $var ) {
            $mapBigSystemGeoipData ['vIP'] = $var->vRemoteAddr;
            $geoip_data = BigSystemGeoipData::where ( $mapBigSystemGeoipData )->first ();
            
            if ( isset ( $geoip_data ) && $geoip_data ) {
                continue;
            }
            if( $var->vRemoteAddr != '127.0.0.1' ) {
                $location = $geoip->city ( $var->vRemoteAddr );
            } else {
                $location = '';
            }
            
            $addinfo ['vIP'] = $var->vRemoteAddr;
            $addinfo ['vISOCode'] = ($location) ? $location->country->isoCode : "N/A";
            $addinfo ['vCountry'] = ($location) ? $location->country->name : "N/A";
            $addinfo ['vCity'] = ($location) ? $location->city->name : "N/A";
            $addinfo ['vState'] = ($location) ? $location->mostSpecificSubdivision->name : "N/A";
            $addinfo ['vPostal_Code'] = ($location) ? $location->postal->code : "N/A";
            $addinfo ['vLat'] = ($location) ? $location->location->latitude : "N/A";
            $addinfo ['vLon'] = ($location) ? $location->location->longitude : "N/A";
            $addinfo ['vTimeZone'] = ($location) ? $location->location->timeZone : "N/A";
            $addinfo ['vContinent'] = ($location) ? $location->continent->code : "N/A";
            $addinfo ['vISP_domain'] = ($location) ? $location->traits->domain : "N/A";
            $addinfo ['vISP_autonomousSystemNumber'] = ($location) ? $location->traits->autonomousSystemNumber : "N/A";
            $addinfo ['vISP_organization'] = ($location) ? $location->traits->organization : "N/A";
            $addinfo ['vISP_isp'] = ($location) ? $location->traits->isp : "N/A";
            $addinfo ['vISP_autonomousSystemOrganization'] = ($location) ? $location->traits->autonomousSystemOrganization : "N/A";
            BigSystemGeoipData::insert ( $addinfo );
        }
        
        
        $mapBigWebVisit ['iStates'] = "2";
        $visit_arr = BigWebVisit::where ( $mapBigWebVisit )->where ( 'iDateTime', '<', $this->datetime )->get ();
        
        foreach ( $visit_arr as $var ) {
            $mapBigSystemGeoipData ['vIP'] = $var->vRemoteAddr;
            $geoip_data = BigSystemGeoipData::where ( $mapBigSystemGeoipData )->first ();
            if ($geoip_data) {
                $addinfo = [];
                $addinfo ['iVisit_id'] = $var->iId;
                $addinfo ['vISOCode'] = $geoip_data->vISOCode;
                $addinfo ['vCountry'] = $geoip_data->vCountry;
                $addinfo ['vCity'] = $geoip_data->vCity;
                $addinfo ['vState'] = $geoip_data->vState;
                $addinfo ['vPostal_Code'] = $geoip_data->vPostal_Code;
                $addinfo ['vLat'] = $geoip_data->vLat;
                $addinfo ['vLon'] = $geoip_data->vLon;
                $addinfo ['vTimeZone'] = $geoip_data->vTimeZone;
                $addinfo ['vContinent'] = $geoip_data->vContinent;
                $addinfo ['vISP_domain'] = $geoip_data->vISP_domain;
                $addinfo ['vISP_autonomousSystemNumber'] = $geoip_data->vISP_autonomousSystemNumber;
                $addinfo ['vISP_organization'] = $geoip_data->vISP_organization;
                $addinfo ['vISP_isp'] = $geoip_data->vISP_isp;
                $addinfo ['vISP_autonomousSystemOrganization'] = $geoip_data->vISP_autonomousSystemOrganization;
                $addinfo ['bDefault'] = "1";
                BigViewWebLocation::insert ( $addinfo );
            }
        }
                
        $mapBigWebVisit ['iStates'] = '2';
        $updateinfo ['iStates'] = "3";
        BigWebVisit::where ( $mapBigWebVisit )->where ( 'iDateTime', '<', $this->datetime )->update ( $updateinfo );
        
        return true;
    }
    
    // */30 * * * * curl http://bigdata.pin2wall.com/autorun/online >> /tmp/crontab.log
    // 手動更新online
    public function online_info() {
               
        $mapBigWebVisit ['big_web_visit.iStates'] = "3";
        $online_arr = BigWebVisit::select ( DB::raw ( "big_web_visit.iId,vUserCode,vRemoteAddr,big_web_visit.iDateTime as iStartTime,big_web_online.iDateTime as iEndTime" ) )->join ( 'big_web_online', function ($join) {
            $join->on ( 'big_web_visit.iId', '=', 'big_web_online.iVisit_id' );
        } )->where ( $mapBigWebVisit )->where ( 'big_web_visit.iDateTime', '<', $this->datetime )->get ();
        
        foreach ( $online_arr as $var ) {
            $addinfo ['iVisit_id'] = $var->iId;
            $addinfo ['vUserCode'] = $var->vUserCode;
            $addinfo ['vRemoteAddr'] = $var->vRemoteAddr;
            $addinfo ['iStartTime'] = $var->iStartTime;
            $addinfo ['iEndTime'] = $var->iEndTime;
            $addinfo ['iStayTime'] = intval ( $var->iEndTime - $var->iStartTime );
            BigViewWebVisitOnline::insert ( $addinfo );
        }
        
        $mapBigWebVisit ['iStates'] = '3';
        $updateinfo ['iStates'] = "4";
        BigWebVisit::where ( $mapBigWebVisit )->where ( 'iDateTime', '<', $this->datetime )->update ( $updateinfo );
        
        return true;
    }
    
    // */30 * * * * curl http://bigdata.pin2wall.com/autorun/pageview >> /tmp/crontab.log
    // 手動更新pageview
    public function pageview_info() {

        $mapBigWebPageview ['iStates'] = "1";
        $pageview_arr = BigWebPageview::select ( DB::raw ( "iVisit_id, vSourceID, vUserID, vReferer, vReferer2, vGroup, vMod, vFunc, vAction, iDateTime" ) )->where ( $mapBigWebPageview )->where ( 'iDateTime', '<', $this->datetime )->orderBy ( 'iVisit_id', 'ASC' )->orderBy ( 'iDateTime', 'ASC' )->get ();
        
        $staytime = 0;
        $start_time = 0;
        $end_time = 0;
        foreach ( $pageview_arr as $key => $var ) {
            if (isset ( $pageview_arr [$key + 1] )) {
                $next_var = $pageview_arr [$key + 1];
                if ($var->iVisit_id == $next_var->iVisit_id) {
                    $start_time = $var->iDateTime;
                    $end_time = $next_var->iDateTime;
                    $staytime = intval ( $end_time - $start_time );
                } else {
                    $start_time = $var->iDateTime;
                    $end_time = $var->iDateTime;
                    $staytime = 0;
                }
            } else {
                $start_time = $var->iDateTime;
                $end_time = $var->iDateTime;
                $staytime = 0;
                $start_id = 0;
            }
            
            $addinfo ['iVisit_id'] = $var->iVisit_id;
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vReferer'] = $var->vReferer;
            $addinfo ['vReferer2'] = $var->vReferer2;
            $addinfo ['vGroup'] = $var->vGroup;
            $addinfo ['vMod'] = $var->vMod;
            $addinfo ['vFunc'] = $var->vFunc;
            $addinfo ['vAction'] = $var->vAction;
            $addinfo ['iStartTime'] = $start_time;
            $addinfo ['iEndTime'] = $end_time;
            $addinfo ['iStayTime'] = $staytime;
            BigViewWebPageview::insert ( $addinfo );
        }
        
        $mapBigWebPageview ['iStates'] = '1';
        $updateinfo ['iStates'] = "2";
        BigWebPageview::where ( $mapBigWebPageview )->where ( 'iDateTime', '<', $this->datetime )->update ( $updateinfo );
        
        return true;
    }
    
    // */30 * * * * curl http://bigdata.pin2wall.com/autorun/click >> /tmp/crontab.log
    // 手動更新click
    public function click_info() {

        $mapBigWebPageview ['iStates'] = "2";
        $click_arr = BigWebPageview::select ( DB::raw ( "iVisit_id, vSourceID, vUserID, vReferer, vReferer2, vGroup, vMod, vFunc, vAction, iDateTime" ) )->where ( $mapBigWebPageview )->where ( 'iDateTime', '<', $this->datetime )->orderBy ( 'iVisit_id', 'ASC' )->orderBy ( 'iDateTime', 'ASC' )->get ();
        
        $costtime = 0;
        $start_time = 0;
        $end_time = 0;
        foreach ( $click_arr as $key => $var ) {
            if ($var->vGroup == 'N/A') {
                continue;
            }
            if (isset ( $click_arr [$key + 1] )) {
                $next_var = $click_arr [$key + 1];
                if ($var->iVisit_id == $next_var->iVisit_id && $next_var->vGroup == 'N/A' && $next_var->vReferer == $var->vReferer2) {
                    $start_time = $var->iDateTime;
                    $end_time = $next_var->iDateTime;
                    $costtime = intval ( $end_time - $start_time );
                } else {
                    $start_time = $var->iDateTime;
                    $end_time = $var->iDateTime;
                    $costtime = 0;
                }
            } else {
                $start_time = $var->iDateTime;
                $end_time = $var->iDateTime;
                $costtime = 0;
            }
           
            $addinfo ['iVisit_id'] = $var->iVisit_id;
            $addinfo ['vSourceID'] = $var->vSourceID;
            $addinfo ['vUserID'] = $var->vUserID;
            $addinfo ['vReferer'] = $var->vReferer;
            $addinfo ['vReferer2'] = $var->vReferer2;
            $addinfo ['vGroup'] = $var->vGroup;
            $addinfo ['vMod'] = $var->vMod;
            $addinfo ['vFunc'] = $var->vFunc;
            $addinfo ['vAction'] = $var->vAction;
            $addinfo ['iStartTime'] = $start_time;
            $addinfo ['iEndTime'] = $end_time;
            $addinfo ['iCostTime'] = $costtime;
            BigViewWebClick::insert ( $addinfo );
        }  
        
        $mapBigWebPageview ['iStates'] = '2';
        $updateinfo ['iStates'] = "3";
        BigWebPageview::where ( $mapBigWebPageview )->where ( 'iDateTime', '<', $this->datetime )->update ( $updateinfo );
        
        return true;
    }
}
