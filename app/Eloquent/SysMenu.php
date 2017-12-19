<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysMenu extends Model {
	public $timestamps = false;
	protected $table = 'sys_menu';
	protected $primaryKey = 'iId';
	
	/*
	 *
	 */
	public function __construct() {
	}
}
