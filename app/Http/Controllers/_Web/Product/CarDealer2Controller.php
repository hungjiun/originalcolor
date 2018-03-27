<?php
namespace App\Http\Controllers\_Web\Product;

use App\Http\Controllers\_Web\_WebController;
use App\SysDealer;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use App\DealerCarBrand;
use App\DealerCarModels;
use App\DealerCarColors;
use App\DealerCarModelColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class CarDealer2Controller extends _WebController
{
    public $module = "product";
    public $action = "car";
    /*
     *
     */
    public function __construct ()
    {
    }

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage";
        $this->__initial();

        $mapDealer ['bDel'] = 0;    
        $DaoSysDealer = SysDealer::where($mapDealer)->get();

        $this->view->with ( 'dealer', $DaoSysDealer );

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;

        $map['sys_dealer.bDel'] = 0;
        $map['dealer_car_brand.bDel'] = 0;
        $map['car_brand.bDel'] = 0;
        $data_arr = DealerCarBrand::join( 'sys_dealer', function( $join ) {
            $join->on( 'dealer_car_brand.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_brand.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($iDealerId) {
            if ($iDealerId != 0) {
                $query->Where ( 'dealer_car_brand.iDealerId', '=', $iDealerId );
            }
        } )->where($map)->select( 
            'dealer_car_brand.*',
            'sys_dealer.iId as iDealerId',
            'sys_dealer.vDealerName',
            'car_brand.iId as iCarBrandId',
            'car_brand.vCarBrandName' 
        )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function brandAdd ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage.brandadd" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage/brandadd' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage.brandadd";
        $this->__initial();

        $mapDealer ['bDel'] = 0;    
        $DaoSysDealer = SysDealer::where($mapDealer)->get();

        $this->view->with ( 'dealer', $DaoSysDealer );
        return $this->view;
    }

    /*
     *
     */
    public function getBrandAddList ()
    {
        //$map['iStatus'] = 0;
        $map['bDel'] = 0;
        $data_arr = CarBrand::where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doBrandAdd ( Request $request )
    {
        $brand = Input::get( 'brand' );
        $brand_arr = $brand  ? explode ( ',', rtrim(Input::get( 'brand' ), ",") ) : $brand;
        $iDealerId = (Input::has ( 'iDealerId' )) ? Input::get ( 'iDealerId' ) : 0;

        if($iDealerId == 0) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.dealer_empty' );

            return response()->json( $this->rtndata );  
        }

        foreach ( $brand_arr as $key => $var ) {
            $map ['iCarBrandId'] = $var;
            $map ['iDealerId'] = $iDealerId;
            $map ['bDel'] = 0;
            $DaoDealerCarBrand = DealerCarBrand::where ( $map )->first ();
            if( !$DaoDealerCarBrand ) {
                $DaoDealerCarBrand = new DealerCarBrand ();
                $DaoDealerCarBrand->iDealerId = $iDealerId;
                $DaoDealerCarBrand->iCarBrandId = $var;
                //$DaoDealerCarBrand->iRank = 1;
                $DaoDealerCarBrand->iStatus = 1;
                $DaoDealerCarBrand->iCreateTime = $DaoDealerCarBrand->iUpdateTime = time ();
                $DaoDealerCarBrand->save();

                $this->_saveLogAction( $DaoDealerCarBrand->getTable(), $DaoDealerCarBrand->iId, 'add', json_encode( $DaoDealerCarBrand ) );
            } else {
                $DaoDealerCarBrand->iUpdateTime = time ();
                $DaoDealerCarBrand->save();
            }
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.add_success' );
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doBrandSave ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarBrand = DealerCarBrand::where( $map )->first();
        if ( !$DaoDealerCarBrand) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iRank' ) ) {
            $DaoDealerCarBrand->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoDealerCarBrand->iStatus = ( $DaoDealerCarBrand->iStatus ) ? 0 : 1;
        }

        $DaoDealerCarBrand->iUpdateTime = time();
        if ($DaoDealerCarBrand->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarBrand->getTable(), $DaoDealerCarBrand->iId, 'edit', json_encode( $DaoDealerCarBrand ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doBrandDel ( Request $request ) 
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        
        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarBrand = DealerCarBrand::where( $map )->first();
        if ( !$DaoDealerCarBrand) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $DaoDealerCarBrand->bDel = 1;

        $DaoDealerCarBrand->iUpdateTime = time();
        if ($DaoDealerCarBrand->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarBrand->getTable(), $DaoDealerCarBrand->iId, 'del', json_encode( $DaoDealerCarBrand ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.delete_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.delete_fail' );
        }
    }

    /*
     *
     */
    public function config ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage.config" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage/config' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage.config";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage.config";
        $this->__initial();

        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        $mapCarBrand ['iId'] = $iCarBrandId;
        $mapCarBrand ['bDel'] = 0;
        $DaoCarBrand = CarBrand::where( $mapCarBrand )->first();
        
        $mapCarModels ['iCarBrandId'] = $iCarBrandId;
        $mapCarModels ['bDel'] = 0;
        $DaoCarModels = CarModels::where( $mapCarModels )->orderBy('iRank', 'asc')->get();
        foreach ($DaoCarModels as $key => $var) {
            $mapDealerCarModels ['iCarModelsId'] = $var->iId;
            $mapDealerCarModels ['iDealerId'] = $iDealerId;
            $mapDealerCarModels ['bDel'] = 0;
            $DaoDealerCarModels = DealerCarModels::where ( $mapDealerCarModels )->first ();
            if( !$DaoDealerCarModels ) {
                $DaoDealerCarModels = new DealerCarModels ();
                $DaoDealerCarModels->iDealerId = $iDealerId;
                $DaoDealerCarModels->iCarBrandId = $iCarBrandId;
                $DaoDealerCarModels->iCarModelsId = $var->iId;
                $DaoDealerCarModels->iRank = $var->iRank;
                $DaoDealerCarModels->iStatus = 0;
                $DaoDealerCarModels->iCreateTime = $DaoDealerCarModels->iUpdateTime = time ();
                $DaoDealerCarModels->save();
            }
        }

        $mapDealerCarModels2 ['dealer_car_models.iDealerId'] = $iDealerId;
        $mapDealerCarModels2 ['dealer_car_models.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarModels2 ['dealer_car_models.bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
        } )->where ( $mapDealerCarModels2 )->select(
            'dealer_car_models.*',
            'car_models.vCarModelName'
        )->get ();
        
        $mapCarColors ['iCarBrandId'] = $iCarBrandId;
        $mapCarColors ['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->orderBy('iRank', 'asc')->get();
        foreach ($DaoCarColors as $key => $var) {
            $mapDealerCarColors ['iCarColorsId'] = $var->iId;
            $mapDealerCarColors ['iDealerId'] = $iDealerId;
            $mapDealerCarColors ['bDel'] = 0;
            $DaoDealerCarColors = DealerCarColors::where ( $mapDealerCarColors )->first ();
            if( !$DaoDealerCarColors ) {
                $DaoDealerCarColors = new DealerCarColors ();
                $DaoDealerCarColors->iDealerId = $iDealerId;
                $DaoDealerCarColors->iCarBrandId = $iCarBrandId;
                $DaoDealerCarColors->iCarColorsId = $var->iId;
                $DaoDealerCarColors->iRank = $var->iRank;
                $DaoDealerCarColors->iStatus = 0;
                $DaoDealerCarColors->iCreateTime = $DaoDealerCarColors->iUpdateTime = time ();
                $DaoDealerCarColors->save();
            }
        }

        $mapDealerCarColors2 ['dealer_car_colors.iDealerId'] = $iDealerId;
        $mapDealerCarColors2 ['dealer_car_colors.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarColors2 ['dealer_car_colors.bDel'] = 0;
        $DaoDealerCarColors = DealerCarColors::join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors.iCarColorsId', '=', 'car_colors.iId' );
        } )->where ( $mapDealerCarColors2 )->select(
            'dealer_car_colors.*', 
            'car_colors.vCarColorName',
            'car_colors.vCarColorCode',
            'car_colors.vCarColorNationalCode'
        )->get ();
        foreach ($DaoDealerCarColors as $key1 => $var1) {
            $carModels = [];
            foreach ($DaoCarModels as $key2 => $var2) {
                $carModels[$key2]['iId'] = $var2->iId;
                $carModels[$key2]['vCarModelName'] = $var2->vCarModelName;

                $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
                $mapCarModelColors ['car_model_colors.iCarModelId'] = $var2->iId;
                $mapCarModelColors ['car_model_colors.iCarColorId'] = $var1->iId;
                $DaoCarModelColors = CarModelColors::where( $mapCarModelColors )->first();
                if(!$DaoCarModelColors) {
                    $DaoCarModelColors = new CarModelColors();
                    $DaoCarModelColors->iStatus = 0;
                }

                $mapDealerCarModelColors ['iDealerId'] = $iDealerId;
                $mapDealerCarModelColors ['iCarBrandId'] = $iCarBrandId;
                $mapDealerCarModelColors ['iCarModelId'] = $var2->iId;
                $mapDealerCarModelColors ['iCarColorId'] = $var1->iId;
                $DaoDealerCarModelColors = DealerCarModelColors::where( $mapDealerCarModelColors )->first();
                if($DaoDealerCarModelColors) {
                    if(($DaoDealerCarModelColors->iStatus == 1) && ($DaoCarModelColors->iStatus == 1)) {
                        $carModels[$key2]['iColorStatus'] = 2; 
                    } else if ($DaoCarModelColors->iStatus == 1) {
                        $carModels[$key2]['iColorStatus'] = 1; 
                    } else {
                        $carModels[$key2]['iColorStatus'] = 0; 
                    }
                } else {
                    $DaoDealerCarModelColors = new DealerCarModelColors();
                    $DaoDealerCarModelColors->iDealerId = $iDealerId;
                    $DaoDealerCarModelColors->iCarBrandId = $iCarBrandId;
                    $DaoDealerCarModelColors->iCarModelId = $var2->iId;
                    $DaoDealerCarModelColors->iCarColorId = $var1->iId;
                    $DaoDealerCarModelColors->iStatus = 0;
                    $DaoDealerCarModelColors->bDel = 0;
                    $DaoDealerCarModelColors->iCreateTime = $DaoDealerCarModelColors->iUpdateTime = time ();
                    $DaoDealerCarModelColors->save();

                    if($DaoCarModelColors->iStatus == 1) {
                        $carModels[$key2]['iColorStatus'] = 1;
                    } else {
                        $carModels[$key2]['iColorStatus'] = 0;
                    }
                }
            }
            $var1->carModels = $carModels;
        }

        //dd($DaoDealerCarColors);

        $this->view->with ( 'iDealerId', $iDealerId );
        $this->view->with ( 'iCarBrandId', $iCarBrandId );
        $this->view->with ( 'carBrand', $DaoCarBrand );
        $this->view->with ( 'carModels', $DaoDealerCarModels );
        $this->view->with ( 'carColors', $DaoDealerCarColors );

        return $this->view;
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $iDealerId = ( $request->exists( 'iDealerId' ) ) ? $request->input( 'iDealerId' ) : 0;
        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;
        $iCarModelId = ( $request->exists( 'iCarModelId' ) ) ? $request->input( 'iCarModelId' ) : 0;
        $iCarColorId = ( $request->exists( 'iCarColorId' ) ) ? $request->input( 'iCarColorId' ) : 0;

        $mapCarModelColors ['iCarBrandId'] = $iCarBrandId;
        $mapCarModelColors ['iCarModelId'] = $iCarModelId;
        $mapCarModelColors ['iCarColorId'] = $iCarColorId;
        $mapCarModelColors ['bDel'] = 0;
        $DaoCarModelColors = CarModelColors::where ( $mapCarModelColors )->first ();
        if ( !$DaoCarModelColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $mapDealerCarModelColors ['iDealerId'] = $iDealerId;
        $mapDealerCarModelColors ['iCarBrandId'] = $iCarBrandId;
        $mapDealerCarModelColors ['iCarModelId'] = $iCarModelId;
        $mapDealerCarModelColors ['iCarColorId'] = $iCarColorId;
        $mapDealerCarModelColors ['bDel'] = 0;
        $DaoDealerCarModelColors = DealerCarModelColors::where ( $mapDealerCarModelColors )->first ();
        if ( !$DaoDealerCarModelColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iStatus' ) ) {
            $DaoDealerCarModelColors->iStatus = ( $DaoDealerCarModelColors->iStatus ) ? 0 : 1;
        }

        $DaoDealerCarModelColors->iUpdateTime = time();
        if ($DaoDealerCarModelColors->save()) {
            if($DaoCarModelColors->iStatus == 1 && $DaoDealerCarModelColors->iStatus == 1) {
                $iColorStatus = 2;
            } else if ($DaoCarModelColors->iStatus == 1) {
                $iColorStatus = 1;
            } else {
                $iColorStatus = 0;
            }
             
            //Logs
            $this->_saveLogAction( $DaoDealerCarModelColors->getTable(), $DaoDealerCarModelColors->iId, 'edit', json_encode( $DaoDealerCarModelColors ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['colorStatus'] = $iColorStatus;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doModelSave ( Request $request )
    {
        $iId = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;

        $mapDealerCarModels ['dealer_car_models.iId'] = $iId;
        $mapDealerCarModels ['dealer_car_models.bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::where ( $mapDealerCarModels )->first ();
        if ( !$DaoDealerCarModels) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iStatus' ) ) {
            $DaoDealerCarModels->iStatus = ( $DaoDealerCarModels->iStatus ) ? 0 : 1;
        }

        $DaoDealerCarModels->iUpdateTime = time();
        if ($DaoDealerCarModels->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarModels->getTable(), $DaoDealerCarModels->iId, 'edit', json_encode( $DaoDealerCarModels ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function models ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage.models" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage/models' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage.models";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage.models";
        $this->__initial();

        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        $this->view->with ( 'iDealerId', $iDealerId );
        $this->view->with ( 'iCarBrandId', $iCarBrandId );

        return $this->view;
    }

    /*
     *
     */
    public function getModelsList ()
    {
        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;
        
        $map['sys_dealer.bDel'] = 0;
        $map['dealer_car_models.iDealerId'] = $iDealerId;
        $map['dealer_car_models.iCarBrandId'] = $iCarBrandId;
        $map['dealer_car_models.bDel'] = 0;
        $map['car_models.bDel'] = 0;
        $data_arr = DealerCarModels::join( 'sys_dealer', function( $join ) {
            $join->on( 'dealer_car_models.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_models.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
        } )->where($map)->select( 
            'dealer_car_models.*', 
            'sys_dealer.iId as iDealerId',
            'sys_dealer.vDealerName', 
            'car_brand.iId as iCarBrandId',
            'car_brand.vCarBrandName',
            'car_models.vCarModelName' 
        )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;
        
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function modelsAdd ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage.modelsadd" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage/modelsadd' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage.modelsadd";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage.modelsadd";
        $this->__initial();

        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        $this->view->with ( 'iDealerId', $iDealerId );
        $this->view->with ( 'iCarBrandId', $iCarBrandId );

        return $this->view;
    }

    /*
     *
     */
    public function getModelsAddList ()
    {
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        //$map['iStatus'] = 0;
        $map['bDel'] = 0;
        $data_arr = CarModels::where ( function ($query) use($iCarBrandId) {
            if ($iCarBrandId != 0) {
                $query->Where ( 'iCarBrandId', '=', $iCarBrandId );
            }
        } )->where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doModelsAdd ( Request $request )
    {
        $models = Input::get( 'models' );
        $models_arr = $models  ? explode ( ',', rtrim(Input::get( 'models' ), ",") ) : $models;
        $iDealerId = (Input::has ( 'iDealerId' )) ? Input::get ( 'iDealerId' ) : 0;

        foreach ( $models_arr as $key => $var ) {
            $map ['iCarModelsId'] = $var;
            $map ['iDealerId'] = $iDealerId;
            $map ['bDel'] = 0;
            $DaoDealerCarModels = DealerCarModels::where ( $map )->first ();
            if( !$DaoDealerCarModels ) {
                $mapCarModels['iId'] = $var;
                $mapCarModels['bDel'] = 0;
                $DaoCarModels = CarModels::where($mapCarModels)->first();

                $DaoDealerCarModels = new DealerCarModels ();
                $DaoDealerCarModels->iDealerId = $iDealerId;
                $DaoDealerCarModels->iCarBrandId = $DaoCarModels ? $DaoCarModels->iCarBrandId : 0;
                $DaoDealerCarModels->iCarModelsId = $var;
                $DaoDealerCarModels->iRank = 1;
                $DaoDealerCarModels->iStatus = 1;
                $DaoDealerCarModels->iCreateTime = $DaoDealerCarModels->iUpdateTime = time ();
                $DaoDealerCarModels->save();

                $this->_saveLogAction( $DaoDealerCarModels->getTable(), $DaoDealerCarModels->iId, 'add', json_encode( $DaoDealerCarModels ) );
            } else {
                $DaoDealerCarModels->iUpdateTime = time ();
                $DaoDealerCarModels->save();
            }
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.add_success' );
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doModelsSave ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::where( $map )->first();
        if ( !$DaoDealerCarModels) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iRank' ) ) {
            $DaoDealerCarModels->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoDealerCarModels->iStatus = ( $DaoDealerCarModels->iStatus ) ? 0 : 1;
        }

        $DaoDealerCarModels->iUpdateTime = time();
        if ($DaoDealerCarModels->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarModels->getTable(), $DaoDealerCarModels->iId, 'edit', json_encode( $DaoDealerCarModels ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doModelsDel ( Request $request ) 
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        
        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::where( $map )->first();
        if ( !$DaoDealerCarModels) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $DaoDealerCarModels->bDel = 1;

        $DaoDealerCarModels->iUpdateTime = time();
        if ($DaoDealerCarModels->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarModels->getTable(), $DaoDealerCarModels->iId, 'del', json_encode( $DaoDealerCarModels ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.delete_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.delete_fail' );
        }
    }

    /*
     *
     */
    public function colors ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage.colors" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage/colors' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage.colors";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage.colors";
        $this->__initial();

        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        $this->view->with ( 'iDealerId', $iDealerId );
        $this->view->with ( 'iCarBrandId', $iCarBrandId );

        return $this->view;
    }

    /*
     *
     */
    public function getColorsList ()
    {
        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;
        
        $map['sys_dealer.bDel'] = 0;
        $map['dealer_car_colors.iDealerId'] = $iDealerId;
        $map['dealer_car_colors.iCarBrandId'] = $iCarBrandId;
        $map['dealer_car_colors.bDel'] = 0;
        $map['car_colors.bDel'] = 0;
        $data_arr = DealerCarColors::join( 'sys_dealer', function( $join ) {
            $join->on( 'dealer_car_colors.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors.iCarColorsId', '=', 'car_colors.iId' );
        } )->where($map)->select( 
            'dealer_car_colors.*', 
            'sys_dealer.vDealerName', 
            'car_brand.vCarBrandName',
            'car_colors.vCarColorName' 
        )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;
        
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function colorsAdd ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.manage.colorsadd" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/manage/colorsadd' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.manage";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.manage.colorsadd";
        $this->__initial();

        $mapCarBrand ['bDel'] = 0;
        $DaoCarBrand = CarBrand::where($mapCarBrand)->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );

        $iDealerId = ( Input::has ( 'iDealerId' ) ) ? Input::get ( 'iDealerId' ) : 0;
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        $this->view->with ( 'iDealerId', $iDealerId );
        $this->view->with ( 'iCarBrandId', $iCarBrandId );
        
        return $this->view;
    }

    /*
     *
     */
    public function getColorsAddList ()
    {
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;

        //$map['iStatus'] = 0;
        $map['bDel'] = 0;
        $data_arr = CarColors::where ( function ($query) use($iCarBrandId) {
            if ($iCarBrandId != 0) {
                $query->Where ( 'iCarBrandId', '=', $iCarBrandId );
            }
        } )->where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doColorsAdd ( Request $request )
    {
        $colors = Input::get( 'colors' );
        $colors_arr = $colors  ? explode ( ',', rtrim(Input::get( 'colors' ), ",") ) : $colors;
        $iDealerId = (Input::has ( 'iDealerId' )) ? Input::get ( 'iDealerId' ) : 0;
        
        foreach ( $colors_arr as $key => $var ) {
            $map ['iCarColorsId'] = $var;
            $map ['iDealerId'] = $iDealerId;
            $map ['bDel'] = 0;
            $DaoDealerCarColors = DealerCarColors::where ( $map )->first ();
            if( !$DaoDealerCarColors ) {
                $mapCarColors['iId'] = $var;
                $mapCarColors['bDel'] = 0;
                $DaoCarColors = CarColors::where( $mapCarColors )->first();

                $DaoDealerCarColors = new DealerCarColors ();
                $DaoDealerCarColors->iDealerId = $iDealerId;
                $DaoDealerCarColors->iCarBrandId = $DaoCarColors ? $DaoCarColors->iCarBrandId : 0;
                $DaoDealerCarColors->iCarColorsId = $var;
                $DaoDealerCarColors->iRank = 1;
                $DaoDealerCarColors->iStatus = 1;
                $DaoDealerCarColors->iCreateTime = $DaoDealerCarColors->iUpdateTime = time ();
                $DaoDealerCarColors->save();

                $this->_saveLogAction( $DaoDealerCarColors->getTable(), $DaoDealerCarColors->iId, 'add', json_encode( $DaoDealerCarColors ) );
            } else {
                $DaoDealerCarColors->iUpdateTime = time ();
                $DaoDealerCarColors->save();
            }
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.add_success' );
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doColorsSave ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarColors = DealerCarColors::where( $map )->first();
        if ( !$DaoDealerCarColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iRank' ) ) {
            $DaoDealerCarColors->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoDealerCarColors->iStatus = ( $DaoDealerCarColors->iStatus ) ? 0 : 1;
        }

        $DaoDealerCarColors->iUpdateTime = time();
        if ($DaoDealerCarColors->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarColors->getTable(), $DaoDealerCarColors->iId, 'edit', json_encode( $DaoDealerCarColors ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doColorsDel ( Request $request ) 
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        
        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarColors = DealerCarColors::where( $map )->first();
        if ( !$DaoDealerCarColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $DaoDealerCarColors->bDel = 1;

        $DaoDealerCarColors->iUpdateTime = time();
        if ($DaoDealerCarColors->save()) {
            //Logs
            $this->_saveLogAction( $DaoDealerCarColors->getTable(), $DaoDealerCarColors->iId, 'del', json_encode( $DaoDealerCarColors ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.delete_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.delete_fail' );
        }
    }
}
