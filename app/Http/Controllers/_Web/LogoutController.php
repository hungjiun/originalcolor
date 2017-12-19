<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller {
	/*
	 *
	 */
	public function __construct() {
	}
	
	/*
	 *
	 */
	public function index(Request $request) {
        $request->session()->flush();
        $request->session()->regenerate();
		return redirect ()->guest ( 'web/login' );
	}
	
	/*
	 *
	 */
	public function doLogout() {
		session ()->flush ();
		$this->rtndata ['status'] = 1;
		$this->rtndata ['message'] = trans ( '_web_message.logout.success' );
		return response ()->json ( $this->rtndata );
	}
}
