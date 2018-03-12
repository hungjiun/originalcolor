<?php

use Illuminate\Database\Seeder;
use App\SysDealer;

class SysDealerTableSeeder extends Seeder
{
	protected $table = 'sys_dealer';
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
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "3D無刮痕補漆筆",
                "vDealerNameE" => "",
                "vUrlName" => "3dmats.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(255, 255, 255, 0)",
                "vDealerDesp" => "",
                "iStatus" => 1
            ],
            [
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "",
                "vDealerNameE" => "",
                "vUrlName" => "3dmats_th.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(255, 255, 255, 0)",
                "vDealerDesp" => "",
                "vUserContact" => "",
                "iStatus" => 1
            ],
            [
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "立大川企業",
                "vDealerNameE" => "",
                "vUrlName" => "lidachuan.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(255, 255, 255, 0)",
                "vDealerDesp" => "",
                "iStatus" => 1
            ],
            [
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "陸立捷有限公司",
                "vDealerNameE" => "",
                "vUrlName" => "knowledge.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(255, 255, 255, 0)",
                "vDealerDesp" => "",
                "iStatus" => 1
            ],
            [
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "崴海衛國際股份有限公司",
                "vDealerNameE" => "",
                "vUrlName" => "waynway.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(255, 255, 255, 0)",
                "vDealerDesp" => "",
                "iStatus" => 1
            ],
            [
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "愛車褓母",
                "vDealerNameE" => "",
                "vUrlName" => "autocare.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(32, 175, 234)",
                "vDealerDesp" => "",
                "iStatus" => 1
            ],
            [
            	"iType" => 1,
                "vDealerCode" => "",
                "vDealerName" => "愛車褓母",
                "vDealerNameE" => "",
                "vUrlName" => "autocare_pch.html",
                "vDealerImg" => "",
                "vDealerTel" => "",
                "vDealerFax" => "",
                "vDealerEmail" => "",
                "vDealerAddr" => "",
                "bLink" => 0,
                "vDealerLink" => "",
                "vDealerColor" => "rgb(32, 175, 234)",
                "vDealerDesp" => "",
                "iStatus" => 1
            ],
        ];

        DB::table($this->table)->delete();
        
        foreach ($data_arr as $key => $var) {
            $Dao = new SysDealer ();
            $Dao->iType = $var['iType'];
            $Dao->vDealerCode = $var ['vDealerCode'];
            $Dao->vDealerName = $var ['vDealerName'];
            $Dao->vDealerNameE = $var ['vDealerNameE'];
            $Dao->vUrlName = $var ['vUrlName'];
            $Dao->vDealerImg = $var ['vDealerImg'];
            $Dao->vDealerTel = $var ['vDealerTel'];
            $Dao->vDealerFax = $var ['vDealerFax'];
            $Dao->vDealerEmail = $var ['vDealerEmail'];
            $Dao->vDealerAddr = $var ['vDealerAddr'];
            $Dao->bLink = $var ['bLink'];
            $Dao->vDealerLink = $var ['vDealerLink'];
            $Dao->vDealerColor = $var ['vDealerColor'];
            $Dao->vDealerDesp = $var ['vDealerDesp'];
            $Dao->iStatus = $var ['iStatus'];
            $Dao->bDel = 0;
            $Dao->save();
        }
    }
}
