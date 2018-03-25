<?php
return [
    'member' =>
        [
            'title' => '會員',
            'userinfo' =>
                [
                    'title' => '個人資料',
                ]
        ],
    'admin' =>
        [
            'title' => '管理員功能',
            'member' =>
                [
                    'title' => '帳號管理',
                    'customer' => [
                        'title' => '一般會員帳號',
                        'add' =>
                            [
                                'title' => '新增一般會員'
                            ],
                        'edit' =>
                            [
                                'title' => '編輯'
                            ]
                    ],
                    'employee' => [
                        'title' => '部門員工帳號',
                        'add' =>
                            [
                                'title' => '新增部門員工'
                            ],
                        'edit' =>
                            [
                                'title' => '編輯'
                            ]
                    ],
                    'dealer' => [
                        'title' => '經銷商帳號',
                        'add' =>
                            [
                                'title' => '新增經銷商帳號'
                            ],
                        'edit' =>
                            [
                                'title' => '編輯'
                            ],
                        'access' => [
                            'title' => '權限設置',
                        ],
                    ],
                ],
            'dealer' =>
                [
                    'title' => '經銷商管理',
                    'add' =>
                        [
                            'title' => '新增'
                        ],
                    'edit' =>
                        [
                            'title' => '編輯'
                        ]
                ],
            'category' =>
                [
                    'title' => '系統類別管理',
                    'sub' =>
                        [
                            'title' => '類別項目'
                        ]
                ],
        ],
    'product' =>
        [
            'title' => '商品管理',
            'car' =>
                [
                    'brand' => 
                        [
                            'title' => '車廠管理',
                            'add' => 
                                [
                                    'title' => '新增車廠'
                                ],
                            'edit' => 
                                [
                                    'title' => '編輯車廠'
                                ]    
                        ],
                    'models' =>
                        [
                            'title' => '車款管理',
                            'add' => 
                                [
                                    'title' => '新增車款'
                                ],
                            'edit' => 
                                [
                                    'title' => '編輯車款'
                                ],
                            'image' => 
                                [
                                    'title' => '編輯車款圖片'
                                ]    
                        ],
                    'colors' =>
                        [
                            'title' => '車色管理',
                            'add' => 
                                [
                                    'title' => '新增車色'
                                ],
                            'edit' => 
                                [
                                    'title' => '編輯車色'
                                ]
                        ],
                    'search' =>
                        [
                            'title' => '車色設定',
                        ],
                    'dealer' =>
                        [
                            'title' => '經銷商管理',
                            'manage' => 
                                [
                                    'title' => '經銷商商品管理',
                                    'brand' => 
                                        [
                                            'title' => '經銷商車廠管理'
                                        ],
                                    'config' =>
                                        [
                                            'title' => '經銷商商品設定'
                                        ],        
                                    'models' =>
                                        [
                                            'title' => '經銷商車款管理'
                                        ], 
                                    'colors' =>
                                        [
                                            'title' => '經銷商車色管理'
                                        ], 
                                    'brandadd' =>
                                        [
                                            'title' => '車廠設定',
                                        ],
                                    'modelsadd' => 
                                        [
                                            'title' => '車款設定',
                                        ],
                                    'colorsadd' => 
                                        [
                                            'title' => '車色設定',
                                        ]
                                ],
                            'download' =>
                                [
                                    'title' => '經銷商下載管理',
                                    'brand' => 
                                        [
                                            'title' => '經銷商車廠下載管理'
                                        ],    
                                    'models' =>
                                        [
                                            'title' => '經銷商車款下載管理'
                                        ], 
                                    'colors' =>
                                        [
                                            'title' => '經銷商車色下載管理'
                                        ], 
                                    'brandadd' =>
                                        [
                                            'title' => '車廠下載設定',
                                        ],
                                    'modelsadd' => 
                                        [
                                            'title' => '車款下載設定',
                                        ],
                                    'colorsadd' => 
                                        [
                                            'title' => '車色下載設定',
                                        ]
                                ]
                        ],     
                    'log' =>
                        [
                            'title' => '修改紀錄'
                        ]    
                ],
        ],
    'article' =>
        [
            'title' => '文章管理',
            'category' => 
                [
                    'title' => '文章類別管理',
                ],
            'content' =>
                [
                    'title' => '文章內容管理',
                    'add' => 
                        [
                            'title' => '新增文章'
                        ],
                    'edit' => 
                        [
                            'title' => '編輯文章'
                        ]
                ],
            'classification' =>
                [
                    'title' => '文章分類管理',
                    'add' => 
                        [
                            'title' => '新增分類文章'
                        ],
                ],
            'dealer' =>
                [
                    'title' => '經銷商文章管理',
                    'add' => 
                        [
                            'title' => '新增經銷商文章'
                        ],
                ],    
            'log' =>
                [
                    'title' => '修改紀錄'
                ]    
        ],    
    'website' =>
        [
            'title' => '網站管理',
            'manage' => 
                [
                    'title' => '網站設定管理',
                ],
            'log' =>
                [
                    'title' => '修改紀錄'
                ] 
        ],

    'bigdata' =>
        [
            'title' => '數據統計與行為記錄',
            'website' =>
                [
                    'title' => '網站行為'
                ],
            'product' =>
                [
                    'title' => '商品行為',
                    'click' =>
                        [
                            'title' => '點擊',
                        ],
                    'history' =>
                        [
                            'title' => '歷史記錄'
                        ],
                ]
        ],    

    'material' =>
        [
            'title' => '素材庫管理',
            'image' =>
                [
                    'title' => '圖片管理',
                    'add' =>
                        [
                            'title' => '新增圖片'
                        ],
                    'edit' =>
                        [
                            'title' => '編輯圖片'
                        ]
                ]
        ],
                 
    'log' =>
        [
            'title' => '數據統計與行為記錄',
            'action' =>
                [
                    'title' => '網站行為'
                ],
            'product' =>
                [
                    'title' => '商品行為',
                    'click' =>
                        [
                            'title' => '點擊',
                        ],
                    'keep' =>
                        [
                            'title' => '收藏'
                        ],
                    'cart' =>
                        [
                            'title' => '加入購物車'
                        ],
                    'history' =>
                        [
                            'title' => '歷史記錄'
                        ],
                ]
        ],

    'dealer' =>
        [
            'title' => '經銷商專區',
            'download' =>
                [
                    'title' => '經銷商資料下載',
                ],
            'inquire' => 
                [
                    'title' => '經銷商商品查詢',
                ]    
        ],    
];
