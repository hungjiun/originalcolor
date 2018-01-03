<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\_Portal\_PortalController;
use App\SysDealer;
use App\CarModels;
use App\DealerCarBrand;
use App\DealerCarModels;
use App\DealerCarColors;
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

        $mapDealerCarModels['dealer_car_models.bDel'] = 0;
        $mapDealerCarModels['dealer_car_models.iDealerId'] = $DaoSysDealer->iId;
        $mapDealerCarModels['dealer_car_models.iCarBrandId'] = $iCarBrandId;
        $mapDealerCarModels['car_models.iStatus'] = 1;
        $mapDealerCarModels['car_models.bDel'] = 0;
        $DaoDealerCarModels = DealerCarModels::join( 'car_models', function( $join ) {
            $join->on( 'dealer_car_models.iCarModelsId', '=', 'car_models.iId' );
        } )->where($mapDealerCarModels)->select( 
            'car_models.*'
        )->get();
        foreach ($DaoDealerCarModels as $key => $var) {
            $var->vCarModelImg = $this->_getFilePathById($var->vCarModelImg);
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );

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
            'car_colors.*'
        )->get();
        //dd($DaoDealerCarColors);
        foreach ($DaoDealerCarColors as $key => $var) {
            $var->vCarColorImg = $this->_getFilePathById($var->vCarColorImg);
        }

        $mapCarModels['iId'] = $iCarModelId;
        $mapCarModels['bDel'] = 0;
        $mapCarModels['iStatus'] = 1;
        $DaoCarModels = CarModels::where($mapCarModels)->first();
        if(!$DaoCarModels) {
            $DaoCarModels = new CarModels();
            $DaoCarModels->vCarModelName = "";
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'carModels', $DaoCarModels );
        $this->view->with ( 'dealerCarColors', isset($DaoDealerCarColors) ? $DaoDealerCarColors : [] );

        return $this->view;
    }


    /*
     *
     */
    public function search ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.search" );

        return $this->view;
    }
}
