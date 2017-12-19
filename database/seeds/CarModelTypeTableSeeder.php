<?php

use Illuminate\Database\Seeder;

class CarModelTypeTableSeeder extends Seeder
{
    protected $table = 'car_model_type';
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
            	"iId" => 1,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "轎車",
                "vCarModelTypeNameE" => "",
                "iRank" => 1,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
                "iId" => 2,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "掀背車",
                "vCarModelTypeNameE" => "",
                "iRank" => 2,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 3,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "SUV",
                "vCarModelTypeNameE" => "",
                "iRank" => 3,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 4,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "MPV",
                "vCarModelTypeNameE" => "",
                "iRank" => 4,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 5,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "旅行車",
                "vCarModelTypeNameE" => "",
                "iRank" => 5,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 6,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "跑車",
                "vCarModelTypeNameE" => "",
                "iRank" => 6,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 7,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "敞篷車",
                "vCarModelTypeNameE" => "",
                "iRank" => 7,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
            [
            	"iId" => 8,
            	"vlang" => "zh-tw",
                "vCarModelTypeName" => "貨卡車",
                "vCarModelTypeNameE" => "",
                "iRank" => 8,
                "iCreateTime" => 0,
                "iUpdateTime" => 0,
                "iStatus" => 1,
                "bDel" => 0
            ],
        ];

        DB::table($this->table)->delete();
        DB::table($this->table)->insert($data_arr);
        
    }
}
