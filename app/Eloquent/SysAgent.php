<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysAgent extends Model {
	public $timestamps = false;
	protected $table = 'sys_agent';
	protected $primaryKey = 'iId';
	
	/*
	 *
	 */
	public function __construct() {
	}
}
