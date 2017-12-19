<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysMember extends Model
{
    public $timestamps = false;
    protected $table = 'sys_member';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
    }

    /*
     *
     */
    static function getMemberInfo ( $iId )
    {
        $Dao = SysMember::join( 'sys_member_info', function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_member.iId' );
        } )->find( $iId );

        return $Dao;
    }
}
