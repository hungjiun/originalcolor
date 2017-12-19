<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;

class LocaleController extends Controller {
	/*
	 *
	 */
	public function __construct() {
	}
	
	/*
	 *
	 */
	public function index() {
	}
	
	/*
	 *
	 */
	public function doSetLocale($locale) {
		session ()->put ( 'locale', $locale );
		$this->rtndata ['status'] = 1;
		return response ()->json ( $this->rtndata );
	}
}
