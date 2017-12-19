<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysSessions extends Model
{
    public $timestamps = false;
    protected $table = 'sessions';

    /*
     *
     */
    public function __construct ()
    {
    }

}
