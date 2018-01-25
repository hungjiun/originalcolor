<?php

namespace App\Http\Controllers\_Web\Bigdata;

use App\Http\Controllers\_Web\_WebController;

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

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ProductController extends _WebController {
	public $module = "bigdata";
    public $action = "product";
	
	/*
	 *
	 */
	public function index() {
		$this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action )
        ];

        $this->title = $this->module . "." . $this->action;

		$this->func = "web." . $this->module . "." . $this->action;
        $this->__initial();

		return $this->view;
	}

	/*
	 *
	 */
	public function getColorStatistics() {
		$iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

		$mapCarBrand ['iId'] = $iCarBrandId;
        $mapCarBrand ['bDel'] = 0;
        $DaoCarBrand = CarBrand::where( $mapCarBrand )->first();
        
        $mapCarModels ['iCarBrandId'] = $iCarBrandId;
        $mapCarModels ['bDel'] = 0;
        $DaoCarModels = CarModels::where( $mapCarModels )->orderBy('iRank', 'asc')->get();
        
        $data_arr = [];
        $mapCarColors ['iCarBrandId'] = $iCarBrandId;
        $mapCarColors ['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->orderBy('iRank', 'asc')->get();

        $mapTotalWebPageview[]
        $total = BigTotalWebPageview::select ( DB::raw ( "SUM( iTotal ) as Total" ) )->where ( $this->defaultmap )->where ( 'vReferer', 'like', 'N/A' )->first ();

		$this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
	}
}
