<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\_Portal\_PortalController;
use App\SysDealer;
use App\CarBrand;
use App\CarModels;
use App\CarColors;
use App\CarColorsLang;
use App\CarModelColors;
use App\DealerCarBrand;
use App\DealerCarModels;
use App\DealerCarColors;
use App\DealerCarModelColors;
use App\ArticleContent;
use App\ArticleDealer;
use Illuminate\Http\Request;

class DealerController extends _PortalController
{
    /*
     *
     */
    public function index ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        return $this->view;
    }

    /*
     *
     */
    public function threedmats ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = '3dmats.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function threedmats_th ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = '3dmats_th.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function lidachuan ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = 'lidachuan.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function knowledge ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = 'knowledge.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function waynway ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = 'waynway.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function autocare ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = 'autocare.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function autocare_pch ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = 'autocare_pch.html';
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );
        return $this->view;
    }

    /*
     *
     */
    public function website ($dealername)
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.index" );

        $mapDealer['vUrlName'] = $dealername;
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
        foreach ($DaoDealerCarBrand as $key => $var) {
            $var->vCarBrandImg = $this->_getFilePathById($var->vCarBrandImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );
        session()->put( 'sysDealer_url', $DaoSysDealer->vUrlName );
        session()->put( 'sysDealer_company_url', $DaoSysDealer->vDealerCompanyUrl );

        $this->getArticle( $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );

        return $this->view;
    }

    /*
     *
     */
    public function carModels (Request $request)
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.carModel" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;

        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $mapDealerCarModels2 ['dealer_car_models.iDealerId'] = $sysDealer;
        $mapDealerCarModels2 ['dealer_car_models.iStatus'] = 1;
        $mapDealerCarModels2 ['dealer_car_models.bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
        } )->where ( $mapDealerCarModels2 )->select(
            'car_models.*',
            'dealer_car_models.iStatus'
        )->get ();
        foreach ($DaoDealerCarModels as $key => $var) {
            $var->vCarModelImg = $this->_getFilePathById($var->vCarModelImg);
        }

        /*
        $mapDealerCarModels['dealer_car_models.bDel'] = 0;
        $mapDealerCarModels['dealer_car_models.iDealerId'] = $DaoSysDealer->iId;
        $mapDealerCarModels['dealer_car_models.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarModels['car_models.iStatus'] = 1;
        $mapDealerCarModels['car_models.bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
        } )->where($mapDealerCarModels)->select( 
            'car_models.*'
        )->orderBy('car_models.iRank', 'asc')->get();
        foreach ($DaoDealerCarModels as $key => $var) {
            $var->vCarModelImg = $this->_getFilePathById($var->vCarModelImg);
        }
        */

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarModels', isset($DaoDealerCarModels) ? $DaoDealerCarModels : [] );

        return $this->view;
    }

    /*
     *
     */
    public function carColors (Request $request)
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.carColor" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;

        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;
        $iCarModelId = ( $request->exists( 'iCarModelId' ) ) ? $request->input( 'iCarModelId' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $mapDealerCarModelColors ['dealer_car_model_colors.iDealerId'] = $sysDealer;
        $mapDealerCarModelColors ['dealer_car_model_colors.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarModelColors ['dealer_car_model_colors.iCarModelId'] = $iCarModelId;
        $mapDealerCarModelColors ['dealer_car_model_colors.iStatus'] = 1;
        $DaoDealerCarModelColors = DealerCarModelColors::join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where( $mapDealerCarModelColors )->select( 
            'car_colors.*'
        )->orderBy('car_colors.iRank', 'asc')->get();
        foreach ($DaoDealerCarModelColors as $key => $var) {
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);

            $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
            $mapCarModelColors ['car_model_colors.iCarModelId'] = $iCarModelId;
            $mapCarModelColors ['car_model_colors.iCarColorId'] = $var->iId;
            $DaoCarModelColors = CarModelColors::where( $mapCarModelColors )->first();

            $var->vImage = $this->_getFilePathById($DaoCarModelColors->vCarModelImage);

            //車色其他語言
            $mapCarColorsLang['car_colors_lang.iCarColorId'] = $var->iId;
            $mapCarColorsLang['sys_dealer.iId'] = $sysDealer;
            $mapCarColorsLang['sys_area_lang.bDel'] = 0;
            $DaoCarColorsLang = CarColorsLang::join( 'sys_area_lang', function( $join ) {
                $join->on( 'car_colors_lang.iLangId', '=', 'sys_area_lang.iId' );
            } )->join( 'sys_dealer', function( $join ) {
                $join->on( 'car_colors_lang.iLangId', '=', 'sys_dealer.iAreaLangId' );
            } )->where($mapCarColorsLang)->select('car_colors_lang.*')->first();
            if($DaoCarColorsLang && $DaoCarColorsLang->vCarColorName != "") {
               $var->vCarColorName = $DaoCarColorsLang->vCarColorName;
            }
        }

        /*
        $mapDealerCarColors['dealer_car_colors.bDel'] = 0;
        $mapDealerCarColors['dealer_car_colors.iDealerId'] = $DaoSysDealer->iId;
        $mapDealerCarColors['dealer_car_colors.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarColors['car_colors.iStatus'] = 1;
        $mapDealerCarColors['car_colors.bDel'] = 0;
        $mapDealerCarColors['car_model_colors.iCarModelId'] = $iCarModelId;
        $mapDealerCarColors['car_model_colors.iStatus'] = 1;
        $DaoDealerCarColors = DealerCarColors::join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors.iCarColorsId', '=', 'car_colors.iId' );
        } )->join( 'car_model_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where($mapDealerCarColors)->select( 
            'car_colors.*',
            'car_model_colors.vCarModelImage'
        )->orderBy('car_colors.iRank', 'asc')->get();
        foreach ($DaoDealerCarColors as $key => $var) {
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
            $var->vImage = $this->_getFilePathById($var->vCarModelImage);
        }
        */

        $mapCarModels['iId'] = $iCarModelId;
        $mapCarModels['bDel'] = 0;
        $mapCarModels['iStatus'] = 1;
        $DaoCarModels = CarModels::where($mapCarModels)->first();
        if(!$DaoCarModels) {
            $DaoCarModels = new CarModels();
            $DaoCarModels->vCarModelName = "";
        }

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'carModels', $DaoCarModels );
        $this->view->with ( 'dealerCarColors', isset($DaoDealerCarModelColors) ? $DaoDealerCarModelColors : [] );

        return $this->view;
    }

    /*
     *
     */
    public function carColorNumber (Request $request)
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.carNumber" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;
        $iCarModelId = ( $request->exists( 'iCarModelId' ) ) ? $request->input( 'iCarModelId' ) : 0;
        $iCarColorId = ( $request->exists( 'iCarColorId' ) ) ? $request->input( 'iCarColorId' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $mapCarModels['iId'] = $iCarModelId;
        $mapCarModels['bDel'] = 0;
        $DaoCarModels = CarModels::where( $mapCarModels )->first();
        if ( !$DaoCarModels) {
            $DaoCarModels = new CarColors();
        }

        $DaoCarModels->vCarModelImg = $this->_getFilePathById($DaoCarModels->vCarModelImg);

        /*
        $mapCarColors['iId'] = $iCarColorId;
        $mapCarColors['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->first();
        if ( !$DaoCarColors) {
            $DaoCarColors = new CarColors();
        }
        */
       
        $mapDealerCarColors['dealer_car_colors.bDel'] = 0;
        $mapDealerCarColors['dealer_car_colors.iDealerId'] = $DaoSysDealer->iId;
        $mapDealerCarColors['dealer_car_colors.iCarBrandId'] = $DaoCarModels->iCarBrandId;
        $mapDealerCarColors['car_colors.iId'] = $iCarColorId;
        $mapDealerCarColors['car_colors.iStatus'] = 1;
        $mapDealerCarColors['car_colors.bDel'] = 0;
        $mapDealerCarColors['car_model_colors.iCarModelId'] = $iCarModelId;
        $mapDealerCarColors['car_model_colors.iStatus'] = 1;
        $DaoDealerCarColors = DealerCarColors::join( 'car_colors', function( $join ) {
            $join->on( 'dealer_car_colors.iCarColorsId', '=', 'car_colors.iId' );
        } )->join( 'car_model_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where($mapDealerCarColors)->select( 
            'car_colors.*',
            'car_model_colors.vCarModelImage'
        )->first();
        if($DaoDealerCarColors) {
            $DaoDealerCarColors->vImage = $this->_getFilePathById($DaoDealerCarColors->vCarModelImage);
        }

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'carModels', $DaoCarModels );
        $this->view->with ( 'carColors', $DaoDealerCarColors );
        
        return $this->view;
    }

    /*
     *
     */
    public function article (Request $request)
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.article" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;
        $iArticleId = ( $request->exists( 'iArticleId' ) ) ? $request->input( 'iArticleId' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);
        
        $mapArticle['article_dealer.iDealerId'] = $sysDealer;
        $mapArticle['article_dealer.bDel'] = 0;
        $mapArticle['sys_dealer.bDel'] = 0;
        $mapArticle['article_content.iId'] = $iArticleId;
        $mapArticle['article_content.bDel'] = 0;
        $DaoArticleContent = ArticleDealer::join( 'sys_dealer', function( $join ) {
            $join->on( 'article_dealer.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'article_content', function( $join ) {
            $join->on( 'article_dealer.iArticleId', '=', 'article_content.iId' );
        } )->where($mapArticle)->select('article_content.*')->first();
        if(!$DaoArticleContent) {
            return redirect('');
        }

        $this->getArticle( $sysDealer );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'articleContent', $DaoArticleContent );

        return $this->view;
    }


}
