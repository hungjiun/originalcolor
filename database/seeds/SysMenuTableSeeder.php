<?php

use Illuminate\Database\Seeder;
use App\SysMenu;

class SysMenuTableSeeder extends Seeder
{
	protected $table = 'sys_menu';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_arr = [
            // admin
            [
                //管理員功能
                "iId" => 1,
                "vName" => "admin",
                "vUrl" => "",
                "vCss" => "fa-power-off",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //帳號管理
                            "iId" => 11,
                            "vName" => "admin.member",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //一般會員管理
                                        "iId" => 111,
                                        "vName" => "admin.member.customer",
                                        "vUrl" => "web/admin/member/customer",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //一般會員管理
                                        "iId" => 112,
                                        "vName" => "admin.member.employee",
                                        "vUrl" => "web/admin/member/employee",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //經銷商帳號管理
                                        "iId" => 113,
                                        "vName" => "admin.member.dealer",
                                        "vUrl" => "web/admin/member/dealer",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ],    
                        ],
                        [
                            //經銷商管理
                            "iId" => 12,
                            "vName" => "admin.dealer",
                            "vUrl" => "web/admin/dealer",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //系統設定管理
                            "iId" => 13,
                            "vName" => "admin.system.arealang",
                            "vUrl" => "web/admin/system/arealang",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],    
                    ],
            ], 
            //商品管理
            [
                //商品管理功能
                "iId" => 2,
                "vName" => "product",
                "vUrl" => "",
                "vCss" => "fa-car",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //車廠管理
                            "iId" => 21,
                            "vName" => "product.car.brand",
                            "vUrl" => "web/product/car/brand",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,   
                        ],
                        [
                            //車色管理
                            "iId" => 22,
                            "vName" => "product.car.colors",
                            "vUrl" => "web/product/car/colors",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ], 
                        [
                            //車型管理
                            "iId" => 23,
                            "vName" => "product.car.models",
                            "vUrl" => "web/product/car/models",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //車型車色查詢
                            "iId" => 24,
                            "vName" => "product.car.search",
                            "vUrl" => "web/product/car/search",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //經銷商商品管理
                            "iId" => 28,
                            "vName" => "product.car.dealer",
                            "vUrl" => "web/product/car/dealer",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //商品管理
                                        "iId" => 281,
                                        "vName" => "product.car.dealer.manage",
                                        "vUrl" => "web/product/car/dealer/manage",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 28,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //下載管理
                                        "iId" => 282,
                                        "vName" => "product.car.dealer.download",
                                        "vUrl" => "web/product/car/dealer/download",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 28,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ],
                        ],
                        [
                            //商品修改紀錄
                            "iId" => 29,
                            "vName" => "product.car.log",
                            "vUrl" => "web/product/car/log",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                        ],   
                    ],
            ],
            //文章管理
            [
                //文章管理功能
                "iId" => 3,
                "vName" => "article",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //文章類別管理
                            "iId" => 31,
                            "vName" => "article.category",
                            "vUrl" => "web/article/category",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3,
                            "vAccess" => "1,2",
                            "bOpen" => 0,   
                        ],
                        [
                            //文章內容管理
                            "iId" => 32,
                            "vName" => "article.content",
                            "vUrl" => "web/article/content",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //文章分類管理
                            "iId" => 33,
                            "vName" => "article.classification",
                            "vUrl" => "web/article/classification",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                        ],
                        [
                            //經銷商文章管理
                            "iId" => 35,
                            "vName" => "article.dealer",
                            "vUrl" => "web/article/dealer",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //文章修改紀錄
                            "iId" => 39,
                            "vName" => "article.log",
                            "vUrl" => "web/article/log",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                        ],   
                    ],
            ],
            //網站設定管理
            [
                //網站管理功能
                "iId" => 5,
                "vName" => "website",
                "vUrl" => "",
                "vCss" => "fa-desktop",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //頁首管理
                            "iId" => 51,
                            "vName" => "website.manage",
                            "vUrl" => "web/website/manage",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 1,   
                        ],
                        [
                            //網站修改紀錄
                            "iId" => 59,
                            "vName" => "website.log",
                            "vUrl" => "web/website/log",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                        ],   
                    ],
            ],

            //數據統計與行為紀錄
            [
                //網站管理功能
                "iId" => 7,
                "vName" => "bigdata",
                "vUrl" => "",
                "vCss" => "fa-bar-chart",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //網站行為
                            "iId" => 71,
                            "vName" => "bigdata.website",
                            "vUrl" => "web/bigdata/website",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 7,
                            "vAccess" => "1,2",
                            "bOpen" => 0,   
                        ],
                        [
                            //商品行為
                            "iId" => 72,
                            "vName" => "bigdata.product",
                            "vUrl" => "web/bigdata/product",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 7,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],   
                    ],
            ], 

            //素材管理
            [
                //素材管理功能
                "iId" => 6,
                "vName" => "material",
                "vUrl" => "",
                "vCss" => "fa-picture-o",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //圖片管理
                            "iId" => 61,
                            "vName" => "material.image",
                            "vUrl" => "web/material/image",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,   
                        ],
                    ],
            ],
            //經銷商專區
            [
                //經銷商專區
                "iId" => 8,
                "vName" => "dealer",
                "vUrl" => "",
                "vCss" => "fa-search",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,41",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //經銷商資料下載
                            "iId" => 81,
                            "vName" => "dealer.download",
                            "vUrl" => "web/dealer/download",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 8,
                            "vAccess" => "1,41",
                            "bOpen" => 1,   
                        ],
                        [
                            //經銷商商品查詢
                            "iId" => 82,
                            "vName" => "dealer.inquire",
                            "vUrl" => "web/dealer/inquire",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 8,
                            "vAccess" => "1,41",
                            "bOpen" => 1,   
                        ],
                    ],
            ],               
        ];

    	DB::table($this->table)->delete();

    	$maxRank = 0;
        foreach ($data_arr as $key => $var) {
            $Dao = new SysMenu();
            $Dao->iId = $var ['iId'];
            $Dao->iType = isset( $var ['iType'] ) ? $var ['iType'] : 0;
            $Dao->vName = $var ['vName'];
            $Dao->vUrl = $var ['vUrl'];
            $Dao->vCss = $var ['vCss'];
            $Dao->bSubMenu = $var ['bSubMenu'];
            $Dao->iParentId = $var ['iParentId'];
            $Dao->vAccess = $var ['vAccess'];
            $Dao->bOpen = $var ['bOpen'];
            $Dao->iRank = ( isset( $var ['iRank'] ) ) ? $var ['iRank'] : $maxRank + 1;
            $maxRank++;
            $Dao->save();
            if ($Dao->bSubMenu) {
                $maxRank_child = 0;
                foreach ($var['child'] as $key_child => $var_child) {
                    $DaoChild = new SysMenu();
                    $DaoChild->iId = $var_child ['iId'];
                    $DaoChild->iType = isset( $var_child ['iType'] ) ? $var_child ['iType'] : 0;
                    $DaoChild->vName = $var_child ['vName'];
                    $DaoChild->vUrl = $var_child ['vUrl'];
                    $DaoChild->vCss = $var_child ['vCss'];
                    $DaoChild->bSubMenu = $var_child ['bSubMenu'];
                    $DaoChild->iParentId = $var_child ['iParentId'];
                    $DaoChild->vAccess = $var_child ['vAccess'];
                    $DaoChild->bOpen = $var_child ['bOpen'];
                    $DaoChild->iRank = ( isset( $var_child ['iRank'] ) ) ? $var_child ['iRank'] : $maxRank_child + 1;
                    $DaoChild->save();
                    $maxRank_child++;
                    if ($DaoChild->bSubMenu) {
                        $maxRank_child2 = 0;
                        foreach ($var_child['child'] as $key_child2 => $var_child2) {
                            $DaoChild2 = new SysMenu ();
                            $DaoChild2->iId = $var_child2 ['iId'];
                            $DaoChild2->iType = isset( $var_child2 ['iType'] ) ? $var_child2 ['iType'] : 0;
                            $DaoChild2->vName = $var_child2 ['vName'];
                            $DaoChild2->vUrl = $var_child2 ['vUrl'];
                            $DaoChild2->vCss = $var_child2 ['vCss'];
                            $DaoChild2->bSubMenu = $var_child2 ['bSubMenu'];
                            $DaoChild2->iParentId = $var_child2 ['iParentId'];
                            $DaoChild2->vAccess = $var_child2 ['vAccess'];
                            $DaoChild2->bOpen = $var_child2 ['bOpen'];
                            $DaoChild2->iRank = ( isset( $var_child2 ['iRank'] ) ) ? $var_child2 ['iRank'] : $maxRank_child2 + 1;
                            $DaoChild2->save();
                            $maxRank_child2++;
                        }
                    }
                }
            }
        }
    }
}
