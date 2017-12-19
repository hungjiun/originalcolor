<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysAirport extends Model
{
    public $timestamps = false;
    protected $table = 'sys_airport';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
