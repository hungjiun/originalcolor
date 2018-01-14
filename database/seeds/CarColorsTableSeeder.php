<?php

use Illuminate\Database\Seeder;

class CarColorsTableSeeder extends Seeder
{
	protected $table = 'car_colors';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$currentTime = time(); 
        //
        $data_arr = [
            [
            	"iId" => 1,
            	"vlang" => "zh-tw",
                "vCarColorName" => "雪貂白",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "040",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 2,
            	"vlang" => "zh-tw",
                "vCarColorName" => "尊爵黑",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "218",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 3,
            	"vlang" => "zh-tw",
                "vCarColorName" => "極光銀",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "1F7",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 4,
            	"vlang" => "zh-tw",
                "vCarColorName" => "雲河灰",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "1G3",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 5,
            	"vlang" => "zh-tw",
                "vCarColorName" => "深鈦藍",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "1H2",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 6,
            	"vlang" => "zh-tw",
                "vCarColorName" => "炫魅紅",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "3R3",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 7,
            	"vlang" => "zh-tw",
                "vCarColorName" => "極致藍",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "8S6",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 8,
            	"vlang" => "zh-tw",
                "vCarColorName" => "檀木黑",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "209",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 9,
            	"vlang" => "zh-tw",
                "vCarColorName" => "熾焰橘",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "4R8",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 10,
            	"vlang" => "zh-tw",
                "vCarColorName" => "星燦灰",
                "vCarColorNameE" => "",
                "vCarColorImg" => "",
                "vCarColorCode" => "1F8",
                "vCarColorNationalCode" => "",
                "iCarBrandId" => 1,
                "iPenNumber" => 0,
                "vSummary" => "",
                "iRank" => 1,
                "iCreateTime" => $currentTime,
                "iUpdateTime" => $currentTime,
                "iStatus" => 1,
                "bDel" => 0
            ],
        ];

        DB::table($this->table)->delete();
        DB::table($this->table)->insert($data_arr);    
    }
}
