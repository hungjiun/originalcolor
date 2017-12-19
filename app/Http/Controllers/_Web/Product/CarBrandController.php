<?php
namespace App\Http\Controllers\_Web\Product;

use App\Http\Controllers\_Web\_WebController;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class CarBrandController extends _WebController
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
            $this->module . "." . $this->action . ".brand" => url( 'web/' . $this->module . '/' . $this->action. '/brand' )
        ];

        $this->title = $this->module . "." . $this->action . ".brand";

        $this->func = "web." . $this->module . "." . $this->action . ".brand";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $map['bDel'] = 0;    
        $data_arr = CarBrand::where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
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
            $this->module . "." . $this->action . ".brand.add" => url( 'web/' . $this->module . '/' . $this->action . '/brand/add' )
        ];

        $this->title = $this->module . "." . $this->action . ".brand";

        $this->func = "web." . $this->module . "." . $this->action . ".brand.add";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function doAdd ()
    {
        $vCarBrandName = ( Input::has( 'vCarBrandName' ) ) ? Input::get( 'vCarBrandName' ) : "";
        $vCarBrandCountry = ( Input::has( 'vCarBrandCountry' ) ) ? Input::get( 'vCarBrandCountry' ) : "";
        $vCarBrandImg = ( Input::has( 'vCarBrandImg' ) ) ? Input::get( 'vCarBrandImg' ) : "";
        $vSummary = ( Input::has( 'vSummary' ) ) ? Input::get( 'vSummary' ) : "";
        $vCarBrandUrl = ( Input::has( 'vCarBrandUrl' ) ) ? Input::get( 'vCarBrandUrl' ) : "";

        $DaoCarBrand = new CarBrand ();
        $DaoCarBrand->vCarBrandName = $vCarBrandName;
        $DaoCarBrand->vCarBrandCountry = $vCarBrandCountry;
        $DaoCarBrand->vCarBrandImg = $vCarBrandImg;
        $DaoCarBrand->vSummary = $vSummary;
        $DaoCarBrand->vCarBrandUrl = $vCarBrandUrl;
        $DaoCarBrand->iCreateTime = $DaoCarBrand->iUpdateTime = time();
        $DaoCarBrand->iRank = 1;
        $DaoCarBrand->iStatus = 1;
        $DaoCarBrand->bDel = 0;
        if ($DaoCarBrand->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarBrand->getTable(), $DaoCarBrand->iId, 'add', json_encode( $DaoCarBrand ) );
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
            $this->module . "." . $this->action . ".brand.edit" => url( 'web/' . $this->module . '/' . $this->action . '/brand/edit' )
        ];

        $this->title = $this->module . "." . $this->action . ".brand";

        $this->func = "web." . $this->module . "." . $this->action . ".brand.edit";
        $this->__initial();

        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoCarBrand = CarBrand::where( $map )->first();
        if ( !$DaoCarBrand) {
            $DaoCarBrand = new CarBrand();
        }

        $DaoCarBrand->Img = $this->_getFilePathById($DaoCarBrand->vCarBrandImg);

        $this->view->with ( 'carBrand', $DaoCarBrand );
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
        $DaoCarBrand = CarBrand::where( $map )->first();
        if ( !$DaoCarBrand) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'vCarBrandName' ) ) {
            $DaoCarBrand->vCarBrandName = $request->input( 'vCarBrandName' );
        }
        if ( $request->exists( 'vCarBrandCountry' ) ) {
            $DaoCarBrand->vCarBrandCountry = $request->input( 'vCarBrandCountry' );
        }
        if ( $request->exists( 'vCarBrandImg' ) ) {
            $DaoCarBrand->vCarBrandImg = $request->input( 'vCarBrandImg' );
        }
        if ( $request->exists( 'vSummary' ) ) {
            $DaoCarBrand->vSummary = $request->input( 'vSummary' );
        }
        if ( $request->exists( 'vCarBrandUrl' ) ) {
            $DaoCarBrand->vCarBrandUrl = $request->input( 'vCarBrandUrl' );
        }
        if ( $request->exists( 'iRank' ) ) {
            $DaoCarBrand->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoCarBrand->iStatus = ( $DaoCarBrand->iStatus ) ? 0 : 1;
        }
        
        $DaoCarBrand->iUpdateTime = time();
        if ($DaoCarBrand->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarBrand->getTable(), $DaoCarBrand->iId, 'edit', json_encode( $DaoCarBrand ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
