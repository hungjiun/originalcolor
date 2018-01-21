<?php

namespace App\Http\Controllers\_Web\Bigdata;

use App\Http\Controllers\_Web\_WebController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class WebsiteController extends _WebController {
	public $module = "bigdata";
    public $action = "website";
	
	/*
	 *
	 */
	public function index() {
		$this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action )
        ];

        $this->title = $this->module . "." . $this->action;

		$this->func = "web." . $this->module . "." . $this->action;
        $this->__initial();

		return $this->view;
	}
}
