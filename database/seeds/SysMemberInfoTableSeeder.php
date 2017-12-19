<?php

use Illuminate\Database\Seeder;
use App\SysMemberInfo;

class SysMemberInfoTableSeeder extends Seeder
{
	protected $table = 'sys_member_info';
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
                "vUserImage" => "/images/admin.jpg",
                "vUserName" => "Admin",
                "vUserEmail" => "",
                "vUserContact" => ""
            ],
            [
                "vUserImage" => "/images/manager.jpg",
                "vUserName" => "Manager",
                "vUserEmail" => "",
                "vUserContact" => ""
            ],
        ];

        DB::table($this->table)->delete();
        
        $iMemberId = 1;
        foreach ($data_arr as $key => $var) {
            $Dao = new SysMemberInfo ();
            $Dao->iMemberId = $iMemberId;
            $Dao->vUserImage = $var ['vUserImage'];
            $Dao->vUserName = $var ['vUserName'];
            $Dao->vUserEmail = $var ['vUserEmail'];
            $Dao->vUserContact = $var ['vUserContact'];
            $Dao->save();
            $iMemberId++;
        }
    }
}
