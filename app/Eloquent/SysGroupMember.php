<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysGroupMember extends Model
{
    public $timestamps = false;
    protected $table = 'sys_group_member';
    protected $primaryKey = 'iMemberId';

    /*
     *
     */
    public function __construct ()
    {
    }
}
