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
        $iCarModelId = ( Input::has ( 'iCarModelId' ) ) ? Input::get ( 'iCarModelId' ) : 0;
        $vCarColorCode = ( Input::has ( 'vCarColorCode' ) ) ? Input::get ( 'vCarColorCode' ) : "";

        if ( $iCarBrandId != 0 ) {
            $mapCarModelColors['car_model_colors.iCarBrandId'] = $iCarBrandId;
        }
        if ( $iCarModelId != 0 ) {
            $mapCarModelColors['car_model_colors.iCarModelId'] = $iCarModelId;
        }

        $mapCarModelColors ['car_model_colors.bDel'] = 0;
        $mapCarModelColors ['car_models.bDel'] = 0;

        $count = CarModelColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_model_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_models', function( $join ) {
            $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarModelColors )->count();

        $DaoCarModelColors = CarModelColors::join( 'car_brand', function( $join ) {
            $join->on( 'car_model_colors.iCarBrandId', '=', 'car_brand.iId' );
        } )->join( 'car_models', function( $join ) {
            $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarModelColors )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )
        ->select(
            'car_model_colors.*',
            'car_brand.vCarBrandName', 
            'car_models.vCarModelName',
            'car_colors.vCarColorName',
            'car_colors.vCarColorCode',
            'car_colors.vCarColorNationalCode',
            'car_colors.iPenNumber'
        )->get();

        foreach ($DaoCarModelColors as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
        }
        
        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $count;
        $this->rtndata ['iTotalRecords'] = $count;
        $this->rtndata ['aaData'] = $DaoCarModelColors;
        
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
