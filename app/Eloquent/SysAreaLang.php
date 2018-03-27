<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysAreaLang extends Model {
	public $timestamps = false;
	protected $table = 'sys_area_lang';
	protected $primaryKey = 'iId';
	
	/*
	 *
	 */
	public function __construct() {
	}
}
