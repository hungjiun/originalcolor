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

class CarColorsController extends _WebController
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
            $this->module . "." . $this->action . ".colors" => url( 'web/' . $this->module . '/' . $this->action . '/colors' )
        ];

        $this->title = $this->module . "." . $this->action . ".colors";

        $this->func = "web." . $this->module . "." . $this->action . ".colors";
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
        $map['car_colors.bDel'] = 0;
        $data_arr = CarColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($iCarBrandId) {
            if ($iCarBrandId != 0) {
                $query->Where ( 'iCarBrandId', '=', $iCarBrandId );
            }
        } )->where($map)->select( 'car_colors.*', 'car_brand.vCarBrandName' )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
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
            $this->module . "." . $this->action . ".colors.add" => url( 'web/' . $this->module . '/' . $this->action . '/colors/add' )
        ];

        $this->title = $this->module . "." . $this->action . ".colors";

        $this->func = "web." . $this->module . "." . $this->action . ".colors.add";
        $this->__initial();

        $map['bDel'] = 0;    
        $DaoCarBrand = CarBrand::where($map)->orderBy ( 'iRank', 'ASC' )->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );
        return $this->view;
    }

    /*
     *
     */
    public function doAdd ()
    {
        $iCarBrandId = ( Input::has( 'iCarBrandId' ) ) ? Input::get( 'iCarBrandId' ) : 0;
        $vCarColorName = ( Input::has( 'vCarColorName' ) ) ? Input::get( 'vCarColorName' ) : "";
        $vCarColorImg = ( Input::has( 'vCarColorImg' ) ) ? Input::get( 'vCarColorImg' ) : "";
        $vCarColorCode = ( Input::has( 'vCarColorCode' ) ) ? Input::get( 'vCarColorCode' ) : "";
        $vCarColorNationalCode = ( Input::has( 'vCarColorNationalCode' ) ) ? Input::get( 'vCarColorNationalCode' ) : "";
        $vPenNumber = ( Input::has( 'vPenNumber' ) ) ? Input::get( 'vPenNumber' ) : "";
        $vSummary = ( Input::has( 'vSummary' ) ) ? Input::get( 'vSummary' ) : "";
        
        $DaoCarColors = new CarColors ();
        $DaoCarColors->iCarBrandId = $iCarBrandId;
        $DaoCarColors->vCarColorName = $vCarColorName;
        $DaoCarColors->vCarColorImg = $vCarColorImg;
        $DaoCarColors->vCarColorCode = $vCarColorCode;
        $DaoCarColors->vCarColorNationalCode = $vCarColorNationalCode;
        $DaoCarColors->vPenNumber = $vPenNumber;
        $DaoCarColors->vSummary = $vSummary;
        $DaoCarColors->iCreateTime = $DaoCarColors->iUpdateTime = time();
        $DaoCarColors->iRank = 1;
        $DaoCarColors->iStatus = 1;
        $DaoCarColors->bDel = 0;
        if ($DaoCarColors->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarColors->getTable(), $DaoCarColors->iId, 'add', json_encode( $DaoCarColors ) );

            $mapCarModels ['iCarBrandId'] = $iCarBrandId;
            $mapCarModels ['bDel'] = 0;
            $DaoCarModels = CarModels::where( $mapCarModels )->get();
            foreach ($DaoCarModels as $key => $value) {
                $DaoCarModelColors = new CarModelColors();
                $DaoCarModelColors->iUserId = 0;
                $DaoCarModelColors->iCarBrandId = $iCarBrandId;
                $DaoCarModelColors->iCarModelId = $value->iId;
                $DaoCarModelColors->iCarColorId = $DaoCarColors->iId;
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
            $this->module . "." . $this->action . ".colors.edit" => url( 'web/' . $this->module . '/' . $this->action . '/colors/edit' )
        ];

        $this->title = $this->module . "." . $this->action . ".colors";

        $this->func = "web." . $this->module . "." . $this->action . ".colors.edit";
        $this->__initial();

        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $mapCarColors['iId'] = $iId;
        $mapCarColors['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->first();
        if ( !$DaoCarColors) {
            $DaoCarColors = new CarColors();
        }

        $DaoCarColors->Img = $this->_getFilePathById($DaoCarColors->vCarColorImg);

        $mapCarBrand['bDel'] = 0;    
        $DaoCarBrand = CarBrand::where($mapCarBrand)->orderBy ( 'iRank', 'ASC' )->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );
        $this->view->with ( 'carColors', $DaoCarColors );
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
        $DaoCarColors = CarColors::where( $map )->first();
        if ( !$DaoCarColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iCarBrandId' ) ) {
            $DaoCarColors->iCarBrandId = $request->input( 'iCarBrandId' );
        }
        if ( $request->exists( 'vCarColorName' ) ) {
            $DaoCarColors->vCarColorName = $request->input( 'vCarColorName' );
        }
        if ( $request->exists( 'vCarColorImg' ) ) {
            $DaoCarColors->vCarColorImg = $request->input( 'vCarColorImg' );
        }
        if ( $request->exists( 'vCarColorCode' ) ) {
            $DaoCarColors->vCarColorCode = $request->input( 'vCarColorCode' );
        }
        if ( $request->exists( 'vCarColorNationalCode' ) ) {
            $DaoCarColors->vCarColorNationalCode = $request->input( 'vCarColorNationalCode' );
        }
        if ( $request->exists( 'vSummary' ) ) {
            $DaoCarColors->vSummary = $request->input( 'vSummary' );
        }
        if ( $request->exists( 'iCarBrandId' ) ) {
            $DaoCarColors->iCarBrandId = $request->input( 'iCarBrandId' );
        }
        if ( $request->exists( 'vPenNumber' ) ) {
            $DaoCarColors->vPenNumber = $request->input( 'vPenNumber' );
        }
        if ( $request->exists( 'iRank' ) ) {
            $DaoCarColors->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoCarColors->iStatus = ( $DaoCarColors->iStatus ) ? 0 : 1;
        }
        $DaoCarColors->iUpdateTime = time();
        if ($DaoCarColors->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarColors->getTable(), $DaoCarColors->iId, 'edit', json_encode( $DaoCarColors ) );
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
        $DaoCarColors = CarColors::where( $map )->first();
        if ( !$DaoCarColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $DaoCarColors->bDel = 1;
        
        $DaoCarColors->iUpdateTime = time();
        if ($DaoCarColors->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarColors->getTable(), $DaoCarColors->iId, 'del', json_encode( $DaoCarColors ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.del_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.del_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
