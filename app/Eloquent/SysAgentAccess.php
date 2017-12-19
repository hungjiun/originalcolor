<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysAgentAccess extends Model
{
    public $timestamps = false;
    protected $table = 'sys_agent_access';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
