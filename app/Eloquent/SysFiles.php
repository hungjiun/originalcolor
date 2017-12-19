<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysFiles extends Model {
	public $timestamps = false;
	protected $table = 'sys_files';
	protected $primaryKey = 'iId';
	
	/*
	 *
	 */
	public function __construct() {
	}
}
