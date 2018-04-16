<?php
namespace App\Http\Controllers\_Web\Dealer;

use App\Http\Controllers\_Web\_WebController;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Excel;

class InquireController extends _WebController
{
    public $module = "dealer";
    public $action = "inquire";
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
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action;
        $this->__initial();

        $mapCarBrand ['bDel'] = 0;    
        $DaoCarBrand = CarBrand::where($mapCarBrand)->orderBy ( 'iRank', 'ASC' )->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );
        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $iDisplayLength = Input::get( 'iDisplayLength' );
        $iDisplayStart = Input::get( 'iDisplayStart' );
        $sEcho = Input::get( 'sEcho' );
        $sort_arr = explode ( ',', Input::get( 'sColumns' ) );
        $sort_name = $sort_arr[ Input::get( 'iSortCol_0' ) ];
        $sort_dir = Input::get( 'sSortDir_0' );

        $iCarBrandId = ( Input::has ( 'iCarBrandId' ) ) ? Input::get ( 'iCarBrandId' ) : 0;
        $vCarColorName = ( Input::has ( 'vCarColorName' ) ) ? Input::get ( 'vCarColorName' ) : "";
        $vCarColorCode = ( Input::has ( 'vCarColorCode' ) ) ? Input::get ( 'vCarColorCode' ) : "";

        if($iCarBrandId == 0 && $vCarColorName == "" && $vCarColorCode == "") {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['sEcho'] = $sEcho;
            $this->rtndata ['iTotalDisplayRecords'] = 0;
            $this->rtndata ['iTotalRecords'] = 0;
            $this->rtndata ['aaData'] = [];
            
            return response()->json( $this->rtndata );
        }

        if ( $iCarBrandId != 0 ) {
            $mapCarColors['car_colors.iCarBrandId'] = $iCarBrandId;
        }

        $mapCarColors ['car_colors.bDel'] = 0;

        $CarColorsCount = CarColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($vCarColorName, $vCarColorCode) {
            if ($vCarColorName != "") {
                $query->Where ( 'car_colors.vCarColorName', 'like', '%' . $vCarColorName . '%' );
            }
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarColors )->select('car_colors.*')->count();

        $DaoCarColors = CarColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($vCarColorName, $vCarColorCode) {
            if ($vCarColorName != "") {
                $query->Where ( 'car_colors.vCarColorName', 'like', '%' . $vCarColorName . '%' );
            }
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarColors )->select('car_colors.*', 'car_brand.vCarBrandName')->get();

        /*
        $CarColorsCount = CarColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($vCarColorName) {
            if ($vCarColorName != "") {
                $query->Where ( 'car_colors.vCarColorName', 'like', '%' . $vCarColorName . '%' );
            }
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarColors )->select('car_colors.*')->count();

        $DaoCarColors = CarColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->where ( function ($query) use($vCarColorName) {
            if ($vCarColorName != "") {
                $query->Where ( 'car_colors.vCarColorName', 'like', '%' . $vCarColorName . '%' );
            }
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarColors )->select('car_colors.*', 'car_brand.vCarBrandName')->get();
        */
        
        /*
        $mapCarModelColors ['car_model_colors.bDel'] = 0;
        $mapCarModelColors ['car_colors.bDel'] = 0;
        $CarModelColorsCount = CarModelColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_model_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where ( function ($query) use($vCarColorName) {
            if ($vCarColorName != "") {
                $query->Where ( 'car_colors.vCarColorName', 'like', '%' . $vCarColorName . '%' );
                $query->orWhere ( 'car_colors.vCarColorNameE', 'like', '%' . $vCarColorName . '%' );
            }
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarModelColors )->groupBy('car_model_colors.iCarColorId')->select('car_model_colors.*')->get();
        $count = count($CarModelColorsCount);

        $DaoCarModelColors = CarModelColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_model_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where ( function ($query) use($vCarColorName) {
            if ($vCarColorName != "") {
                $query->Where ( 'car_colors.vCarColorName', 'like', '%' . $vCarColorName . '%' );
                $query->orWhere ( 'car_colors.vCarColorNameE', 'like', '%' . $vCarColorName . '%' );
            }
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarModelColors )->groupBy('car_model_colors.iCarColorId')->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )
        ->select(
            'car_model_colors.*',
            'car_brand.vCarBrandName', 
            'car_colors.vCarColorName',
            'car_colors.vCarColorCode',
            'car_colors.vCarColorNationalCode',
            'car_colors.vPenNumber'
        )->get();
        */

        foreach ($DaoCarColors as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $CarColorsCount;
        $this->rtndata ['iTotalRecords'] = $CarColorsCount;
        $this->rtndata ['aaData'] = $DaoCarColors;
        
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function getCarModels( Request $request ) {
        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;

        $mapCarModels['car_models.iCarBrandId'] = $iCarBrandId;
        $mapCarModels['car_models.iStatus'] = 1;
        $mapCarModels['car_models.bDel'] = 0;
        $DaoCarModels = CarModels::where($mapCarModels)->get();

        $this->rtndata ['status'] = 1;
        $this->rtndata ['carModels'] = $DaoCarModels;
        return response ()->json ( $this->rtndata );
    }
}
