<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\_Portal\_PortalController;
use App\SysDealer;
use App\DealerCarBrand;
use Illuminate\Http\Request;

class IndexController extends _PortalController
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
    public function intro ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.intro" );

        return $this->view;
    }

    /*
     *
     */
    public function description ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.description" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $this->view->with ( 'sysDealer', $DaoSysDealer );

        $this->getArticle( $sysDealer );
        
        return $this->view;
    }

    /*
     *
     */
    public function color_card ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.color_card" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $this->view->with ( 'sysDealer', $DaoSysDealer );

        $this->getArticle( $sysDealer );

        return $this->view;
    }

    /*
     *
     */
    public function qa ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.qa" );

        $sysDealer = session ()->has ( 'sysDealer' ) ? session ()->get ( 'sysDealer' ) : 0;

        $mapDealer['iId'] = $sysDealer;
        $mapDealer['iStatus'] = 1;
        $DaoSysDealer = SysDealer::where($mapDealer)->first();
        if(!$DaoSysDealer) {
            return redirect('');
        }

        $DaoSysDealer->vDealerImg = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $this->view->with ( 'sysDealer', $DaoSysDealer );

        $this->getArticle( $sysDealer );

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
