<?php

namespace App\Http\Controllers\_Web\Website;

use App\SysFiles;
use App\Http\Controllers\_Web\_WebController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ManageController extends _WebController {
	public $module = "website";
    public $action = "manage";
	
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
	public function edit() {
		$this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action ),
            $this->module . "." . $this->action . ".edit" => url( 'web/' . $this->module . '/' . $this->action . '/edit' )
        ];
        $this->title = $this->module . "." . $this->action . ".edit";
        $this->func = "web." . $this->module . "." . $this->action . ".edit";
        $this->__initial();

		$product_id = (Input::has ( 'id' )) ? Input::get ( 'id' ) : 0;
		$productInfo = ModTravel::find ( $product_id );
		if (! $productInfo) {
			return redirect ( 'web/website/manage' );
		}
		
		$productInfo->vPaymentType = explode( ',', $productInfo->vPaymentType );
		$productInfo->vProductImage = $this->_getFilePathById ( $productInfo->vProductImage );
		$productInfo->TravelCountry = explode ( ";", $productInfo->vTravelCountry );
		$productInfo->TravelCity = explode ( ";", $productInfo->vTravelCity );
		
		$this->view->with ( 'productInfo', $productInfo );
		$this->view->with ( 'placeType', $placeType );
		$this->view->with ( 'placeDao', $placeDao );

		return $this->view;
	}
	
	/*
	 *
	 */
	public function doSave(Request $request) {
		$productId = ($request->exists ( 'id' )) ? Input::get ( 'id' ) : 0;
		$Dao = ModTravelTicket::find ( $productId );
		if (! $Dao) {
			$this->rtndata ['status'] = 0;
			$this->rtndata ['message'] = trans ( 'web.travel.edit.fail' );
			return response ()->json ( $this->rtndata );
		}

		if ($request->exists( 'vMissionNumber' )) {
			$Dao->vMissionNumber = $request->input ( 'vMissionNumber' );
		}
		if ($request->exists( 'iProductType' )) {
			$Dao->iProductType = $request->input ( 'iProductType' );
		}
		if ($request->exists( 'vTravelContinent' )) {
			$Dao->vTravelContinent = $request->input ( 'vTravelContinent' );
		}
		if ($request->exists( 'vTravelCountry' )) {
			$Dao->vTravelCountry = implode ( ";", $request->input ( 'vTravelCountry' ) );
		}
		if ($request->exists( 'vTravelCity' )) {
			$Dao->vTravelCity = implode ( ";", $request->input ( 'vTravelCity' ) );
		}
		if ($request->exists( 'vProductTitle' )) {
			$Dao->vProductTitle = $request->input ( 'vProductTitle' );
		}
		/* +Hungjiun 20170103, add travel product keyword */
		if ($request->exists( 'vProductKeyword' )) {
			$Dao->vProductKeyword = $request->input ( 'vProductKeyword' );
		}
		/***********************/
		if ($request->exists( 'vProductImage' )) {
			$Dao->vProductImage = $request->input ( 'vProductImage' );
		}
		if ($request->exists( 'vProductSummary' )) {
			$Dao->vProductSummary = $request->input ( 'vProductSummary' );
		}
		if ($request->exists( 'ProductMessage' )) {
			$Dao->vProductMessage = $request->input ( 'ProductMessage' );
		}
		if ($request->exists( 'vPaymentType' )) {
			$Dao->vPaymentType = $request->input ( 'vPaymentType' );
		}
		if ($request->exists( 'bShow' )) {
			$Dao->bShow = $request->input ( 'bShow' );
		}
		if ($request->exists( 'bOpen' )) {
			$Dao->bOpen = $request->input ( 'bOpen' );
		}
		
		$Dao->iUpdateTime = time ();
		if ($Dao->save ()) {
			$this->rtndata ['status'] = 1;
			$this->rtndata ['message'] = trans ( 'web.travel.edit.success' );
		} else {
			$this->rtndata ['status'] = 0;
			$this->rtndata ['message'] = trans ( 'web.travel.edit.fail' );
		}
		$this->rtndata ['status'] = 1;
		return response ()->json ( $this->rtndata );
	}
}
