<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\FuncController;

use Illuminate\Http\Request;

class SearchController extends _PortalController
{
    /*
     *
     */
    public function index ()
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.search" );

        return $this->view;
    }
}
