<?php
return [
    "web" =>
        [
            "index" =>
                [
                    "view" => "_template_web.index"
                ],
            "member" =>
                [
                    "userinfo" =>
                        [
                            "view" => "_template_web._member.userinfo"
                        ]
                ],
            "admin" =>
                [
                    "member" =>
                        [
                            "customer" =>
                                [
                                    "view" => "_template_web.admin.member.customer.index",
                                    "menu_access" => "111",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.admin.member.customer.add",
                                            "menu_access" => "111",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ]
                                ],
                            "employee" =>
                                [
                                    "view" => "_template_web.admin.member.employee.index",
                                    "menu_access" => "112",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.admin.member.employee.add",
                                            "menu_access" => "112",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ]
                                ],    
                            "dealer" =>
                                [
                                    "view" => "_template_web.admin.member.dealer.index",
                                    "menu_access" => "113",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.admin.member.dealer.add",
                                            "menu_access" => "113",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ]
                                ],    
                        ],
                    "dealer" =>
                        [
                            "view" => "_template_web.admin.dealer.index",
                            "menu_access" => "12",
                            "menu_parent" =>
                                [
                                    "1",
                                    "0"
                                ],     
                        ],    
                ],

            "product" =>
                [
                    "car" =>
                        [
                            "brand" =>
                                [
                                    "view" => "_template_web.product.car.brand.index",
                                    "menu_access" => "21",
                                    "menu_parent" =>
                                        [
                                            "2",
                                            "0"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.car.brand.add",
                                            "menu_access" => "21",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.car.brand.edit",
                                            "menu_access" => "21",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ]    
                                ],
                            "colors" =>
                                [
                                    "view" => "_template_web.product.car.colors.index",
                                    "menu_access" => "22",
                                    "menu_parent" =>
                                        [
                                            "2",
                                            "0"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.car.colors.add",
                                            "menu_access" => "22",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.car.colors.edit",
                                            "menu_access" => "22",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ]    
                                ],    
                            "models" =>
                                [
                                    "view" => "_template_web.product.car.models.index",
                                    "menu_access" => "23",
                                    "menu_parent" =>
                                        [
                                            "2",
                                            "0"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.car.models.add",
                                            "menu_access" => "23",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.car.models.edit",
                                            "menu_access" => "23",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ],
                                    "image" =>
                                        [
                                            "view" => "_template_web.product.car.models.image",
                                            "menu_access" => "23",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "0"
                                                ],
                                        ]         
                                ],
                            "search" =>
                                [
                                    "view" => "_template_web.product.car.search.index",
                                    "menu_access" => "24",
                                    "menu_parent" =>
                                        [
                                            "2",
                                            "0"
                                        ],
                                ],
                            "dealer" =>
                                [
                                    "manage" =>
                                        [
                                           "view" => "_template_web.product.car.dealer.manage.index",
                                            "menu_access" => "281",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "28"
                                                ],
                                            "brandadd" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.manage.brandadd",
                                                    "menu_access" => "281",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],
                                            "models" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.manage.models",
                                                    "menu_access" => "281",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],    
                                            "modelsadd" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.manage.modelsadd",
                                                    "menu_access" => "281",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],
                                            "colors" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.manage.colors",
                                                    "menu_access" => "281",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],    
                                            "colorsadd" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.manage.colorsadd",
                                                    "menu_access" => "281",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ] 
                                        ],
                                    "download" => 
                                        [
                                            "view" => "_template_web.product.car.dealer.download.index",
                                            "menu_access" => "282",
                                            "menu_parent" =>
                                                [
                                                    "2",
                                                    "28"
                                                ],
                                            "brandadd" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.download.brandadd",
                                                    "menu_access" => "282",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],
                                            "models" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.download.models",
                                                    "menu_access" => "282",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],    
                                            "modelsadd" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.download.modelsadd",
                                                    "menu_access" => "282",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],
                                            "colors" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.download.colors",
                                                    "menu_access" => "282",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ],    
                                            "colorsadd" =>
                                                [
                                                    "view" => "_template_web.product.car.dealer.download.colorsadd",
                                                    "menu_access" => "282",
                                                    "menu_parent" =>
                                                        [
                                                            "2",
                                                            "28"
                                                        ],
                                                ]
                                        ]         
                                ],    
                        ],
                ], 

            "article" =>
                [
                    "category" =>
                        [
                            "view" => "_template_web.article.category.index",
                            "menu_access" => "31",
                            "menu_parent" =>
                                [
                                    "3",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.article.category.add",
                                    "menu_access" => "31",
                                    "menu_parent" =>
                                        [
                                            "3",
                                            "0"
                                        ],
                                ],
                            "edit" =>
                                [
                                    "view" => "_template_web.article.category.edit",
                                    "menu_access" => "31",
                                    "menu_parent" =>
                                        [
                                            "3",
                                            "0"
                                        ],
                                ]    
                        ],
                    "content" =>
                        [
                            "view" => "_template_web.article.content.index",
                            "menu_access" => "32",
                            "menu_parent" =>
                                [
                                    "3",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.article.content.add",
                                    "menu_access" => "32",
                                    "menu_parent" =>
                                        [
                                            "3",
                                            "0"
                                        ],
                                ],
                            "edit" =>
                                [
                                    "view" => "_template_web.article.content.edit",
                                    "menu_access" => "32",
                                    "menu_parent" =>
                                        [
                                            "3",
                                            "0"
                                        ],
                                ]    
                        ],
                    "classification" =>
                        [
                            "view" => "_template_web.article.classification.index",
                            "menu_access" => "33",
                            "menu_parent" =>
                                [
                                    "3",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.article.classification.add",
                                    "menu_access" => "32",
                                    "menu_parent" =>
                                        [
                                            "3",
                                            "0"
                                        ],
                                ],
                        ],    
                    "dealer" =>
                        [
                            "view" => "_template_web.article.dealer.index",
                            "menu_access" => "35",
                            "menu_parent" =>
                                [
                                    "3",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.article.dealer.add",
                                    "menu_access" => "35",
                                    "menu_parent" =>
                                        [
                                            "3",
                                            "0"
                                        ],
                                ],
                        ],    
                ],       
            
            "website" =>
                [
                    "manage" =>
                        [
                            "view" => "_template_web.website.manage.index",
                            "menu_access" => "51",
                            "menu_parent" =>
                                [
                                    "5",
                                    "0"
                                ],
                        ],
                ],

            "bigdata" =>
                [
                    "website" =>
                        [
                            "view" => "_template_web.bigdata.website.index",
                            "menu_access" => "71",
                            "menu_parent" =>
                                [
                                    "7",
                                    "0"
                                ],
                        ],
                    "product" =>
                        [
                            "view" => "_template_web.bigdata.product.index",
                            "menu_access" => "72",
                            "menu_parent" =>
                                [
                                    "7",
                                    "0"
                                ],
                        ],    
                ],    

            "material" =>
                [
                    "image" =>
                        [
                            "view" => "_template_web.material.image.index",
                            "menu_access" => "61",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.material.image.add",
                                    "menu_access" => "61",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ],
                            "edit" =>
                                [
                                    "view" => "_template_web.material.image.edit",
                                    "menu_access" => "61",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]    
                        ],
                ],

            "dealer" =>
                [
                    "download" =>
                        [
                            "view" => "_template_web.dealer.download",
                            "menu_access" => "81",
                            "menu_parent" =>
                                [
                                    "8",
                                    "0"
                                ],
                        ],
                    "inquire" =>
                        [
                            "view" => "_template_web.dealer.inquire",
                            "menu_access" => "82",
                            "menu_parent" =>
                                [
                                    "8",
                                    "0"
                                ],
                        ],    
                ],      
        ],
];