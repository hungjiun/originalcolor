<?php
namespace App\Http\Controllers\_Web\Product;

use App\Http\Controllers\_Web\_WebController;
use App\SysDealer;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use App\DealerCarBrandDownload;
use App\DealerCarModelsDownload;
use App\DealerCarColorsDownload;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class CarDownloadController extends _WebController
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
            $this->module . "." . $this->action . ".dealer.download" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/download' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.download";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.download";
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
        $map['dealer_car_brand_download.bDel'] = 0;
        $map['car_brand.bDel'] = 0;
        $data_arr = DealerCarBrandDownload::join( 'sys_dealer', function( $join ) {
            $join->on( 'dealer_car_brand_download.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_brand_download.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($iDealerId) {
            if ($iDealerId != 0) {
                $query->Where ( 'dealer_car_brand_download.iDealerId', '=', $iDealerId );
            }
        } )->where($map)->select( 
            'dealer_car_brand_download.*',
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
            $this->module . "." . $this->action . ".dealer.download.brandadd" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/download/brandadd' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.download";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.download.brandadd";
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
            $DaoDealerCarBrand = DealerCarBrandDownload::where ( $map )->first ();
            if( !$DaoDealerCarBrand ) {
                $DaoDealerCarBrand = new DealerCarBrandDownload ();
                $DaoDealerCarBrand->iDealerId = $iDealerId;
                $DaoDealerCarBrand->iCarBrandId = $var;
                //$DaoDealerCarBrand->iRank = 1;
                $DaoDealerCarBrand->iStatus = 1;
                $DaoDealerCarBrand->iCreateTime = $DaoDealerCarBrand->iUpdateTime = time ();
                $DaoDealerCarBrand->save();
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
        $DaoDealerCarBrand = DealerCarBrandDownload::where( $map )->first();
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
        $DaoDealerCarBrand = DealerCarBrandDownload::where( $map )->first();
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
    public function models ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".dealer.download.models" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/download/models' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.download.models";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.download.models";
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
        $map['dealer_car_models_download.iDealerId'] = $iDealerId;
        $map['dealer_car_models_download.iCarBrandId'] = $iCarBrandId;
        $map['dealer_car_models_download.bDel'] = 0;
        $map['car_models.bDel'] = 0;
        $data_arr = DealerCarModelsDownload::join( 'sys_dealer', function( $join ) {
            $join->on( 'dealer_car_models_download.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_models_download.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models_download.iCarModelsId', '=', 'car_models.iId' );
        } )->where($map)->select( 
            'dealer_car_models_download.*', 
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
            $this->module . "." . $this->action . ".dealer.download.modelsadd" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/download/modelsadd' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.download.modelsadd";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.download.modelsadd";
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
            $DaoDealerCarModels = DealerCarModelsDownload::where ( $map )->first ();
            if( !$DaoDealerCarModels ) {
                $mapCarModels['iId'] = $var;
                $mapCarModels['bDel'] = 0;
                $DaoCarModels = CarModels::where($mapCarModels)->first();

                $DaoDealerCarModels = new DealerCarModelsDownload ();
                $DaoDealerCarModels->iDealerId = $iDealerId;
                $DaoDealerCarModels->iCarBrandId = $DaoCarModels ? $DaoCarModels->iCarBrandId : 0;
                $DaoDealerCarModels->iCarModelsId = $var;
                $DaoDealerCarModels->iRank = 1;
                $DaoDealerCarModels->iStatus = 1;
                $DaoDealerCarModels->iCreateTime = $DaoDealerCarModels->iUpdateTime = time ();
                $DaoDealerCarModels->save();
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
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoDealerCarModels = DealerCarModelsDownload::where( $map )->first();
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
        $DaoDealerCarModels = DealerCarModelsDownload::where( $map )->first();
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
            $this->module . "." . $this->action . ".dealer.download.colors" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/download/colors' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.download.colors";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.download.colors";
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
        $map['dealer_car_colors_download.iDealerId'] = $iDealerId;
        $map['dealer_car_colors_download.iCarBrandId'] = $iCarBrandId;
        $map['dealer_car_colors_download.bDel'] = 0;
        $map['car_colors.bDel'] = 0;
        $data_arr = DealerCarColorsDownload::join( 'sys_dealer', function( $join ) {
            $join->on( 'dealer_car_colors_download.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_colors_download.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors_download.iCarColorsId', '=', 'car_colors.iId' );
        } )->where($map)->select( 
            'dealer_car_colors_download.*', 
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
            $this->module . "." . $this->action . ".dealer.download.colorsadd" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/download/colorsadd' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.download";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.download.colorsadd";
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
            $DaoDealerCarModels = DealerCarColorsDownload::where ( $map )->first ();
            if( !$DaoDealerCarModels ) {
                $mapCarColors['iId'] = $var;
                $mapCarColors['bDel'] = 0;
                $DaoCarColors = CarColors::where( $mapCarColors )->first();

                $DaoDealerCarModels = new DealerCarColorsDownload ();
                $DaoDealerCarModels->iDealerId = $iDealerId;
                $DaoDealerCarModels->iCarBrandId = $DaoCarColors ? $DaoCarColors->iCarBrandId : 0;
                $DaoDealerCarModels->iCarColorsId = $var;
                $DaoDealerCarModels->iRank = 1;
                $DaoDealerCarModels->iStatus = 1;
                $DaoDealerCarModels->iCreateTime = $DaoDealerCarModels->iUpdateTime = time ();
                $DaoDealerCarModels->save();
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
        $DaoDealerCarColors = DealerCarColorsDownload::where( $map )->first();
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
        $DaoDealerCarColors = DealerCarColorsDownload::where( $map )->first();
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
