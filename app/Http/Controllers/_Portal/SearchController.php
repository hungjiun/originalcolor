<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\FuncController;
use App\SysDealer;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use App\DealerCarBrand;
use App\DealerCarModels;
use App\DealerCarColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class SearchController extends _PortalController
{
    /*
     *
     */
    public function index ( Request $request )
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.search" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $mapDealerCarBrand['dealer_car_brand.bDel'] = 0;
        $mapDealerCarBrand['dealer_car_brand.iDealerId'] = $DaoSysDealer->iId;
        $mapDealerCarBrand['car_brand.iStatus'] = 1;
        $mapDealerCarBrand['car_brand.bDel'] = 0;
        $DaoDealerCarBrand = DealerCarBrand::join( 'car_brand', function( $join ) {
            $join->on( 'dealer_car_brand.iCarBrandId', '=', 'car_brand.iId' );
        } )->where($mapDealerCarBrand)->select( 
            'car_brand.*'
        )->get();


        if($DaoDealerCarBrand) {
            $mapDealerCarModels['dealer_car_models.bDel'] = 0;
            $mapDealerCarModels['dealer_car_models.iDealerId'] = $sysDealer;
            $mapDealerCarModels['dealer_car_models.iCarBrandId'] = $DaoDealerCarBrand[0]['iId'];
            $mapDealerCarModels['car_models.iStatus'] = 1;
            $mapDealerCarModels['car_models.bDel'] = 0;
            $DaoDealerCarModels = DealerCarModels::join( 'car_models', function( $join ) {
                $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
            } )->where($mapDealerCarModels)->select( 
                'car_models.*'
            )->get();
        }

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        $this->view->with ( 'dealerCarModels', isset($DaoDealerCarModels) ? $DaoDealerCarModels : [] );

        return $this->view;
    }

    /*
     *
     */
    public function doSearch( Request $request ) {
    	$iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;
        $iCarModelId = ( $request->exists( 'iCarModelId' ) ) ? $request->input( 'iCarModelId' ) : 0;
        $vCarColorCode = ( $request->exists( 'vCarColorCode' ) ) ? $request->input( 'vCarColorCode' ) : "";

        session()->put( 'carBrandId', $iCarBrandId );
        session()->put( 'carModelId', $iCarModelId );
        session()->put( 'carColorCode', $vCarColorCode );

        $this->rtndata ['status'] = 1;
        return response ()->json ( $this->rtndata );
    }
    /*
     *
     */
    public function Search1( Request $request ) {
    	$this->_init();
        $this->view = View()->make( "_template_portal.carColorSearch1" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;
        $iCarBrandId = session ()->has( 'carBrandId' ) ? session ()->get( 'carBrandId' ) : 0;
        $iCarModelId = session ()->has( 'carModelId' ) ? session ()->get( 'carModelId' ) : 0;
        $vCarColorCode = session ()->has( 'carColorCode' ) ? session ()->get( 'carColorCode' ) : "";

        if ( $iCarBrandId != 0 ) {
            $mapDealerCarColors['dealer_car_colors.iCarBrandId'] = $iCarBrandId;
        }
        if ( $iCarModelId != 0 ) {
            $mapDealerCarColors['car_model_colors.iCarModelId'] = $iCarModelId;
        }

        $mapDealerCarColors['dealer_car_colors.bDel'] = 0;
        $mapDealerCarColors['dealer_car_colors.iDealerId'] = $sysDealer;
        $mapDealerCarColors['car_colors.iStatus'] = 1;
        $mapDealerCarColors['car_colors.bDel'] = 0;
        $mapDealerCarColors['car_model_colors.iStatus'] = 1;
        $DaoDealerCarColors = DealerCarColors::join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors.iCarColorsId', '=', 'car_colors.iId' );
        } )->join( 'car_model_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->join( 'car_models', function( $join ) {
            $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where($mapDealerCarColors)->select( 
            'car_colors.*',
            'car_models.iId as iCarModelId',
            'car_models.vCarModelName'
        )->get();
        foreach ($DaoDealerCarColors as $key => $var) {
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
        }

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            $DaoSysDealer = new SysDealer();
            $DaoSysDealer->vDealerName = "";
        }
        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarColors', isset($DaoDealerCarColors) ? $DaoDealerCarColors : [] );
        return $this->view;
    }
    /*
     *
     */
    public function Search2( Request $request ) {
    	$this->_init();
        $this->view = View()->make( "_template_portal.carColorSearch2" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;
        $vCarColorCode = session ()->has( 'carColorCode' ) ? session ()->get( 'carColorCode' ) : "";

        $mapDealerCarColors['dealer_car_colors.bDel'] = 0;
        $mapDealerCarColors['dealer_car_colors.iDealerId'] = $sysDealer;
        $mapDealerCarColors['car_colors.vCarColorCode'] = $vCarColorCode;
        $mapDealerCarColors['car_colors.iStatus'] = 1;
        $mapDealerCarColors['car_colors.bDel'] = 0;
        $DaoDealerCarColors = DealerCarColors::join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors.iCarColorsId', '=', 'car_colors.iId' );
        } )->where ( function ($query) use($vCarColorCode) {
                $query->Where ( 'car_colors.vCarColorCode', 'like', '%' . $vCarColorCode . '%' );
        } )->where($mapDealerCarColors)->select( 
            'car_colors.*'
        )->get();
        foreach ($DaoDealerCarColors as $key => $var) {
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
        }

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            $DaoSysDealer = new SysDealer();
            $DaoSysDealer->vDealerName = "";
        }
        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarColors', isset($DaoDealerCarColors) ? $DaoDealerCarColors : [] );

        return $this->view;
    }

    /*
     *
     */
    public function getCarModels( Request $request ) {
        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;
        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;

        $mapDealerCarModels['dealer_car_models.bDel'] = 0;
        $mapDealerCarModels['dealer_car_models.iDealerId'] = $sysDealer;
        $mapDealerCarModels['dealer_car_models.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarModels['car_models.iStatus'] = 1;
        $mapDealerCarModels['car_models.bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
        } )->where($mapDealerCarModels)->select( 
            'car_models.*'
        )->get();

        $this->rtndata ['status'] = 1;
        $this->rtndata ['carModels'] = $DaoDealerCarModels;
        return response ()->json ( $this->rtndata );
    }
}
