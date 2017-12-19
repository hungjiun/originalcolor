<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysMemberAccess extends Model
{
    public $timestamps = false;
    protected $table = 'sys_member_access';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
