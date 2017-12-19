<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\_Portal\_PortalController;
use App\SysDealer;
use App\DealerCarBrand;
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
            
        }

        session()->put( 'sysDealer', $DaoSysDealer->iId );

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        $this->view->with ( 'dealerCarBrand', isset($DaoDealerCarBrand) ? $DaoDealerCarBrand : [] );

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
