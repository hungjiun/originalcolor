<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\_Web\_WebController;

class IndexController extends _WebController {
	public $module = "admin";
    public $action = "member";
	/*
	 *
	 */
	public function __construct() {
	}
	
	/*
	 *
	 */
	public function index() {
		$this->func = "web.index";
		$this->__initial ();
		return $this->view;
	}
}
