<?php
namespace App\Http\Controllers\_Web\Product;

use App\Http\Controllers\_Web\_WebController;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class CarModelsController extends _WebController
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
            $this->module . "." . $this->action . ".models" => url( 'web/' . $this->module . '/' . $this->action . '/models' )
        ];

        $this->title = $this->module . "." . $this->action . ".models";

        $this->func = "web." . $this->module . "." . $this->action . ".models";
        $this->__initial();

        $mapCarBrand ['bDel'] = 0;    
        $DaoCarBrand = CarBrand::where($mapCarBrand)->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;
        
        $map['car_brand.bDel'] = 0;
        $map['car_models.bDel'] = 0;
        $data_arr = CarModels::join( 'car_brand', function( $join ) {
            $join->on( 'car_models.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($iCarBrandId) {
            if ($iCarBrandId != 0) {
                $query->Where ( 'iCarBrandId', '=', $iCarBrandId );
            }
        } )->where($map)->select( 'car_models.*', 'car_brand.vCarBrandName' )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vCarModelImg = $this->_getFilePathById($var->vCarModelImg);
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
    public function add ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".models.add" => url( 'web/' . $this->module . '/' . $this->action . '/models/add' )
        ];

        $this->title = $this->module . "." . $this->action . ".models";

        $this->func = "web." . $this->module . "." . $this->action . ".models.add";
        $this->__initial();

        $map['bDel'] = 0;    
        $DaoCarBrand = CarBrand::where($map)->orderBy ( 'iRank', 'ASC' )->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );
        return $this->view;
    }

    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $iCarBrandId = ( Input::has( 'iCarBrandId' ) ) ? Input::get( 'iCarBrandId' ) : 0;
        $vCarModelName = ( Input::has( 'vCarModelName' ) ) ? Input::get( 'vCarModelName' ) : "";
        $iCarModelType = ( Input::has( 'iCarModelType' ) ) ? Input::get( 'iCarModelType' ) : 0;
        $vCarModelImg = ( Input::has( 'vCarModelImg' ) ) ? Input::get( 'vCarModelImg' ) : "";
        $vCarModelAge = ( Input::has( 'vCarModelAge' ) ) ? Input::get( 'vCarModelAge' ) : "";
        $vSummary = ( Input::has( 'vSummary' ) ) ? Input::get( 'vSummary' ) : "";
        $vCarModelUrl = ( Input::has( 'vCarModelUrl' ) ) ? Input::get( 'vCarModelUrl' ) : "";
        
        $DaoCarModels = new CarModels ();
        $DaoCarModels->iCarBrandId = $iCarBrandId;
        $DaoCarModels->vCarModelName = $vCarModelName;
        $DaoCarModels->iCarModelType = $iCarModelType;
        $DaoCarModels->vCarModelImg = $vCarModelImg;
        $DaoCarModels->vCarModelAge = $vCarModelAge;
        $DaoCarModels->vSummary = $vSummary;
        $DaoCarModels->vCarModelUrl = $vCarModelUrl;
        $DaoCarModels->iCreateTime = $DaoCarModels->iUpdateTime = time();
        $DaoCarModels->iRank = 1;
        $DaoCarModels->iStatus = 1;
        $DaoCarModels->bDel = 0;
        if ($DaoCarModels->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarModels->getTable(), $DaoCarModels->iId, 'add', json_encode( $DaoCarModels ) );

            $mapCarColors ['iCarBrandId'] = $iCarBrandId;
            $mapCarColors ['bDel'] = 0;
            $DaoCarColors = CarColors::where( $mapCarColors )->get();
            foreach ($DaoCarColors as $key => $value) {
                $DaoCarModelColors = new CarModelColors();
                $DaoCarModelColors->iUserId = 0;
                $DaoCarModelColors->iCarBrandId = $iCarBrandId;
                $DaoCarModelColors->iCarModelId = $DaoCarModels->iId;
                $DaoCarModelColors->iCarColorId = $value->iId;
                $DaoCarModelColors->iCreateTime = $DaoCarModelColors->iUpdateTime = time();
                $DaoCarModelColors->iRank = 1;
                $DaoCarModelColors->iStatus = 0;
                $DaoCarModelColors->bDel = 0;
                $DaoCarModelColors->save();
            }

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );

        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function edit ( Request $request )
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".models.edit" => url( 'web/' . $this->module . '/' . $this->action . '/models/edit' )
        ];

        $this->title = $this->module . "." . $this->action . ".models";

        $this->func = "web." . $this->module . "." . $this->action . ".models.edit";
        $this->__initial();

        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $mapCarModels['iId'] = $iId;
        $mapCarModels['bDel'] = 0;
        $DaoCarModels = CarModels::where( $mapCarModels )->first();
        if ( !$DaoCarModels) {
            $DaoCarModels = new CarModels();
        }

        $DaoCarModels->Img = $this->_getFilePathById($DaoCarModels->vCarModelImg);

        $mapCarBrand['bDel'] = 0;
        $DaoCarBrand = CarBrand::where($mapCarBrand)->orderBy ( 'iRank', 'ASC' )->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );
        $this->view->with ( 'carModels', $DaoCarModels );
        return $this->view;
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoCarModels = CarModels::where( $map )->first();
        if ( !$DaoCarModels) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iCarBrandId' ) ) {
            $DaoCarModels->iCarBrandId = $request->input( 'iCarBrandId' );
        }
        if ( $request->exists( 'vCarModelName' ) ) {
            $DaoCarModels->vCarModelName = $request->input( 'vCarModelName' );
        }
        if ( $request->exists( 'iCarModelType' ) ) {
            $DaoCarModels->iCarModelType = $request->input( 'iCarModelType' );
        }
        if ( $request->exists( 'vCarModelImg' ) ) {
            $DaoCarModels->vCarModelImg = $request->input( 'vCarModelImg' );
        }
        if ( $request->exists( 'vCarModelAge' ) ) {
            $DaoCarModels->vCarModelAge = $request->input( 'vCarModelAge' );
        }
        if ( $request->exists( 'vSummary' ) ) {
            $DaoCarModels->vSummary = $request->input( 'vSummary' );
        }
        if ( $request->exists( 'vCarModelUrl' ) ) {
            $DaoCarModels->vCarModelUrl = $request->input( 'vCarModelUrl' );
        }
        if ( $request->exists( 'iRank' ) ) {
            $DaoCarModels->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoCarModels->iStatus = ( $DaoCarModels->iStatus ) ? 0 : 1;
        }

        $DaoCarModels->iUpdateTime = time();
        if ($DaoCarModels->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarModels->getTable(), $DaoCarModels->iId, 'edit', json_encode( $DaoCarModels ) );
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
    public function doDel ( Request $request )
    {
        $iId = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoCarModels = CarModels::where( $map )->first();
        if ( !$DaoCarModels) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $DaoCarModels->bDel = 1;

        $DaoCarModels->iUpdateTime = time();
        if ($DaoCarModels->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarModels->getTable(), $DaoCarModels->iId, 'del', json_encode( $DaoCarModels ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.del_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.del_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function getModelColorList ( Request $request )
    {
        $iCarModelId = $request->input( 'iCarModelId', 0 );

        $mapCarModelColors['iCarModelId'] = $iCarModelId;
        $DaoCarModelColors = CarModelColors::join( 'car_models', function( $join ) {
            $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where( $mapCarModelColors )->select(
            'car_model_colors.*', 
            'car_models.vCarModelName',
            'car_colors.vCarColorName'
        )->get();

        foreach ($DaoCarModelColors as $key => $var) {
            $var->vCarModelImage = $this->_getFilePathById($var->vCarModelImage);
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['carModelColors'] = $DaoCarModelColors;
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function image ( Request $request )
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".models.image" => url( 'web/' . $this->module . '/' . $this->action . '/models/image' )
        ];

        $this->title = $this->module . "." . $this->action . ".models";

        $this->func = "web." . $this->module . "." . $this->action . ".models.image";
        $this->__initial();

        $iCarModelId = $request->input( 'iCarModelId', 0 );

        $mapCarModelColors['car_model_colors.iCarModelId'] = $iCarModelId;
        $mapCarModelColors['car_colors.bDel'] = 0;
        $DaoCarModelColors = CarModelColors::join( 'car_models', function( $join ) {
            $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where( $mapCarModelColors )->select(
            'car_model_colors.*', 
            'car_models.vCarModelName',
            'car_colors.vCarColorName'
        )->get();

        foreach ($DaoCarModelColors as $key => $var) {
            $var->vImage = $this->_getFilePathById($var->vCarModelImage);
        }

        $this->view->with ( 'carModelColors', $DaoCarModelColors );
        return $this->view;
    }

    /*
     *
     */
    public function doImageSave ( Request $request )
    {
        $image = $request->exists( 'image' ) ? $request->input ( 'image' ) : []; 

        foreach ($image as $key => $var) {
            $map['iId'] = $var['iId'];
            $DaoCarModelColors = CarModelColors::where($map)->first();
            if($DaoCarModelColors) {
                $DaoCarModelColors->vCarModelImage = $var['iImage'];
                $DaoCarModelColors->save();

                $this->_saveLogAction( $DaoCarModelColors->getTable(), $DaoCarModelColors->iId, 'edit', json_encode( $DaoCarModelColors ) );
            }
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.save_success' );
        
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doColorSave ( Request $request )
    {
        
    }
}
