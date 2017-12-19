<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysDealer extends Model
{
    public $timestamps = false;
    protected $table = 'sys_dealer';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
