<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysMemberVerification extends Model
{
    public $timestamps = false;
    protected $table = 'sys_member_verification';
    protected $primaryKey = 'iMemberId';

    /*
     *
     */
    public function __construct()
    {
    }
}
