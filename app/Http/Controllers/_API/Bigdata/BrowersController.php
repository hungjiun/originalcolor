<?php

namespace App\Http\Controllers\_API\Bigdata;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\BigWebLimit;
use App\BigWebPageview;
use App\BigWebOnline;
use App\BigWebVisit;
use App\BigTotalWebPageview;
use App\BigTotalWebVisit;

class BrowersController extends Controller {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Browers Controller
	 * |--------------------------------------------------------------------------
	 * |提供API 造訪資料收集
	 * |
	 */
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct ();
		$this->sid = (Input::has ( 'SID' )) ? Input::get ( 'SID' ) : "11111";
		$this->uid = (Input::has ( 'UID' )) ? Input::get ( 'UID' ) : "guest";
		$this->group = (Input::has ( 'GROUP' )) ? Input::get ( 'GROUP' ) : "N/A";
		$this->mod = (Input::has ( 'MOD' )) ? Input::get ( 'MOD' ) : "N/A";
		$this->func = (Input::has ( 'FUNC' )) ? Input::get ( 'FUNC' ) : "N/A";
		$this->action = (Input::has ( 'ACTION' )) ? Input::get ( 'ACTION' ) : "N/A";
		$this->referer = (Input::has ( 'REFERRER' )) ? Input::get ( 'REFERRER' ) : "N/A"; // JS 傳送的REFERRER
		$this->time_on_site = 0;
		$this->_init ();
	}
	
	// 取得初始參數
	public function _init() {
		$this->language = (isset ( $_SERVER ['HTTP_ACCEPT_LANGUAGE'] )) ? $_SERVER ['HTTP_ACCEPT_LANGUAGE'] : "N/A";
		$this->user_agent = (isset ( $_SERVER ['HTTP_USER_AGENT'] )) ? $_SERVER ['HTTP_USER_AGENT'] : "N/A";
		$this->x_forwarded_for = (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) ? $_SERVER ['HTTP_X_FORWARDED_FOR'] : "N/A";
		$this->x_bluecoat_via = (isset ( $_SERVER ['HTTP_X_BLUECOAT_VIA'] )) ? $_SERVER ['HTTP_X_BLUECOAT_VIA'] : "N/A";
		$this->remote_addr = (isset ( $_SERVER ['REMOTE_ADDR'] )) ? $_SERVER ['REMOTE_ADDR'] : "N/A";
		$this->referer2 = (isset ( $_SERVER ['HTTP_REFERER'] )) ? $_SERVER ['HTTP_REFERER'] : "N/A"; // PHP 取得的REFERRER
		$this->query_string = (isset ( $_SERVER ['REDIRECT_QUERY_STRING'] )) ? $_SERVER ['REDIRECT_QUERY_STRING'] : "N/A";
		$this->user_code = md5 ( $this->language . $this->remote_addr . $this->user_agent . $this->x_bluecoat_via . $this->x_forwarded_for );
	}
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	// 收集網頁瀏覽行為
	public function index() {
		$rtndata ['status'] = 1;
		$rtndata ['msg'] = "";
		$rtndata ['info'] = "";
		
		// 檢查同樣造訪身分是否超過30分鐘
		$map ['vUserCode'] = $this->user_code;
		$visit = BigWebVisit::where ( $map )->where ( 'iDateTime', '>', time () - env ( 'VISIT_TIME', 1800 ) )->first ();
		
		if (! isset ( $visit )) {
			// 建立新造訪人次
			$this->visit_id = $this->Visit ();
			$this->PageView ();
			$this->Online ( "New" );
		} else {
			$this->visit_id = $visit->iId;
			$this->PageView ();
			$this->time_on_site = time () - intval ( $visit->iDateTime );
			$this->Online ( "Update" );
		}
		
		return response ()->json ( $rtndata );
	}
	
	// 更新在線時間與停留時間
	public function Online($type) {
		switch ($type) {
			case 'New' :
				$addinfo ['iVisit_id'] = $this->visit_id;
				$addinfo ['iDateTime'] = time ();
				$addinfo ['iTimeOnSite'] = $this->time_on_site;
				$addinfo ['bOnline'] = 1;
				BigWebOnline::insert ( $addinfo );
				break;
			case 'Update' :
				$map ['iVisit_id'] = $this->visit_id;
				$upinfo = array ();
				$upinfo ['iDateTime'] = time ();
				$upinfo ['iTimeOnSite'] = $this->time_on_site;
				$upinfo ['bOnline'] = 1;
				BigWebOnline::where ( $map )->update ( $upinfo );
				break;
			default :
				break;
		}
		return;
	}
	
	// 記錄Visit info
	public function PageView() {
		$addinfo ['iVisit_id'] = $this->visit_id;
		$addinfo ['vSourceID'] = $this->sid;
		$addinfo ['vUserID'] = $this->uid;
		$addinfo ['vReferer'] = $this->referer;
		$addinfo ['vReferer2'] = $this->referer2;
		$addinfo ['vQueryString'] = $this->query_string;
		$addinfo ['vGroup'] = $this->group;
		$addinfo ['vMod'] = $this->mod;
		$addinfo ['vFunc'] = $this->func;
		$addinfo ['vAction'] = $this->action;
		$addinfo ['iDateTime'] = time ();
		$addinfo ['iStates'] = 1;
		BigWebPageview::insert ( $addinfo );
	}
	
	// 記錄Visit LOG
	public function Visit() {
		$addinfo ['vUserCode'] = $this->user_code;
		$addinfo ['vLanguage'] = $this->language;
		$addinfo ['vUserAgent'] = $this->user_agent;
		$addinfo ['vXForwardedFor'] = $this->x_forwarded_for;
		$addinfo ['vBluecoatVia'] = $this->x_bluecoat_via;
		$addinfo ['vRemoteAddr'] = $this->remote_addr;
		$addinfo ['iDateTime'] = time ();
		$addinfo ['iStates'] = 1;
		$newid = BigWebVisit::insertGetId ( $addinfo );
		
		return $newid;
	}

	// 提供網頁取得今日參訪人次
	public function get_visit_today() {
		$rtndata ['states'] = 1;
		$rtndata ['msg'] = "";
		$rtndata ['info'] = 0;

		$start_date = strtotime( date("Y-m-d") );
        $end_date = strtotime( date("Y-m-d") ) + 86399;
		
		$total = BigWebVisit::whereBetween ( 'iDateTime', [
				$start_date,
				$end_date
		] )->count();

		$rtndata ['info'] = (isset ( $total ) && $total->Total) ? $total->Total : 0;
		return response ()->json ( $rtndata );
	}

	// 提供網頁取得total參訪人次
	public function get_visit_total() {
		$rtndata ['states'] = 1;
		$rtndata ['msg'] = "";
		$rtndata ['info'] = 0;
		
		$total = BigWebVisit::count();

		$rtndata ['info'] = (isset ( $total ) && $total->Total) ? $total->Total : 0;
		return response ()->json ( $rtndata );
	}
	
	// 提供網頁取得Online
	public function get_online() {
		$rtndata ['states'] = 1;
		$rtndata ['msg'] = "";
		$rtndata ['info'] = 0;
		
		$map ['bOnline'] = 1;
		$total = BigWebOnline::where($map)->count();

		$rtndata ['info'] = (isset ( $total ) && $total->Total) ? $total->Total : 0;
		return response ()->json ( $rtndata );
	}
}
