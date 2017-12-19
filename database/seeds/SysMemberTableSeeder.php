<?php

use Illuminate\Database\Seeder;
use App\SysMember;

class SysMemberTableSeeder extends Seeder
{
	protected $table = 'sys_member';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_arr = [
            [
                "iAcType" => 1,
                "vAccount" => "admin"
            ],
            [
                "iAcType" => 2,
                "vAccount" => "manager"
            ],
        ];

        DB::table($this->table)->delete();

        $iUserId = 1000000001;
        foreach ($data_arr as $key => $var) {
            $str = md5( uniqid( mt_rand(), true ) );
            $uuid = substr( $str, 0, 8 ) . '-';
            $uuid .= substr( $str, 8, 4 ) . '-';
            $uuid .= substr( $str, 12, 4 ) . '-';
            $uuid .= substr( $str, 16, 4 ) . '-';
            $uuid .= substr( $str, 20, 12 );
            //
            $Dao = new SysMember ();
            $Dao->vAgentCode = "PEN";
            $Dao->iUserId = $iUserId;
            $Dao->vUserCode = $uuid;
            $Dao->iAcType = $var ['iAcType'];
            $Dao->vAccount = $var ['vAccount'];
            $Dao->vPassword = hash( 'sha256', $Dao->vAgentCode . md5( "abc123" ) . $Dao->vUserCode );
            $Dao->vCreateIP = Request::ip();
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->bActive = 1;
            $Dao->iStatus = 1;
            $Dao->save();
            $iUserId++;
        }
    }
}
