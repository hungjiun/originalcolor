<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group(
    [
        'prefix' => 'api',
        'namespace' => '_API',
    ],function(){
        
        Route::group(
            [
                'namespace' => 'Bigdata',
            ],function(){
                Route::get ( 'browers', 'BrowersController@index' );
                Route::get ( 'browers/total', 'BrowersController@get_total' );
                Route::any ( 'getDayForTotal', 'BrowersController@getDayForTotal' );
                Route::any ( 'getMonthForTotal', 'BrowersController@getMonthForTotal' );
                Route::any ( 'getOnlineTotal', 'BrowersController@getOnlineTotal' );
                Route::get ( 'online', 'BrowersController@get_online' );
            }
        );
    }
);

/*
 *
 */
Route::group(
    [
        'namespace' => '_Portal',
    ], function() {
    Route::get( '', 'IndexController@intro' );
    Route::get( 'index', 'IndexController@index' );
    Route::get( 'description', 'IndexController@description' );
    Route::get( 'color_card', 'IndexController@color_card' );
    Route::get( 'qa', 'IndexController@qa' );
    //
    Route::get( 'login', 'LoginController@index' );
    Route::post( 'doLogin', 'LoginController@doLogin' );
    //
    Route::get( 'forgotpassword', 'LoginController@forgotpassword' );
    Route::post( 'doResetPassword', 'LoginController@doResetPassword' );
    //
    Route::get( 'register', 'RegisterController@index' );
    Route::post( 'doRegister', 'RegisterController@doRegister' );
    //
    Route::get( 'logout', 'LogoutController@index' );
    Route::post( 'doLogout', 'LogoutController@doLogout' );
    Route::any( 'doSetLocale/{locale}', 'LocaleController@doSetLocale' );
    //
    Route::get( '3dmats_th.html', 'DealerController@threedmats_th' );
    Route::get( '3dmats.html', 'DealerController@threedmats' );
    Route::get( 'lidachuan.html', 'DealerController@lidachuan' );
    Route::get( 'knowledge.html', 'DealerController@knowledge' );
    Route::get( 'waynway.html', 'DealerController@waynway' );
    Route::get( 'autocare.html', 'DealerController@autocare' );
    Route::get( 'autocare_pch.html', 'DealerController@autocare_pch' );

    Route::get( 'article', 'DealerController@article' );
    //
    Route::group(
        [
            'prefix' => 'dealer',
        ], function() {
        Route::group(
            [
                'prefix' => 'web',
            ], function() {
            Route::get( '{dealername}', 'DealerController@website' );
            Route::get( '{error}', function() {
                return abort( 503 );
            } );
        } );
        Route::get( 'carmodels', 'DealerController@carModels' );
        Route::get( 'carcolors', 'DealerController@carColors' );
        Route::get( 'carnumber', 'DealerController@carColorNumber' );
        Route::get( '', 'DealerController@index' );
        Route::get( '{error}', function() {
            return abort( 503 );
        } );
    } );

    //搜尋
    Route::group(
        [
            'prefix' => 'search',
        ], function() {
        Route::get( '', 'SearchController@index' );
        Route::get( 'getcarmodels', 'SearchController@getCarModels' );
        Route::post( 'dosearch', 'SearchController@doSearch' );
        Route::get( 'carColorSearch1', 'SearchController@Search1' );
        Route::get( 'carColorSearch2', 'SearchController@Search2' );
        Route::get( '{error}', function() {
            return abort( 503 );
        } );
    } );
} );

/*
 * 
 */
//Route::get( '', '_Web\LoginController@index' );
Route::group(
    [
        'middleware' => 'CheckLang',
        'prefix' => 'web',
        'namespace' => '_Web'
    ], function() {
    Route::get( '', 'LoginController@index' );    
    Route::get( 'login', 'LoginController@index' );
    Route::get( 'forgotpassword', 'LoginController@forgotpassword' );
    //Route::get( 'register', 'RegisterController@index' );
    Route::get( 'logout', 'LogoutController@index' );
    Route::post( 'doLogin', 'LoginController@doLogin' );
    Route::post( 'doResetPassword', 'LoginController@doResetPassword' );
    //Route::post( 'doRegister', 'RegisterController@doRegister' );
    Route::post( 'doLogout', 'LogoutController@doLogout' );
    Route::post( 'doSetLocale/{locale}', 'LocaleController@doSetLocale' );
    Route::group(
        [
            'middleware' => 'CheckLogin'
        ], function() {
        Route::get( 'index', 'IndexController@index' );
        Route::post( 'upload_image', 'UploadController@doUploadImage' );
        Route::post( 'upload_image_base64', 'UploadController@doUploadImageBase64' );
        Route::post( 'upload_image2', 'UploadController@doUploadImage2' );
        // Member
        Route::group(
            [
                'prefix' => 'member',
                'namespace' => '_Member',
            ], function() {
            Route::get( 'userinfo', 'IndexController@index' );
            Route::post( 'userinfo/dosave', 'IndexController@doSave' );
            Route::post( 'userinfo/dosavepassword', 'IndexController@doSavePassword' );
        } );
        // Admin
        Route::group(
            [
                'prefix' => 'admin',
                'namespace' => '_Admin',
                'middleware' => 'CheckAdmin'
            ], function() {
            Route::group(
                [
                    'prefix' => 'member',
                    'namespace' => 'Member',
                ], function() {
                Route::group(
                    [
                        'prefix' => 'customer'
                    ], function() {
                    Route::get( '', 'CustomerController@index' );
                    Route::get( 'getlist', 'CustomerController@getList' );
                    Route::get( 'add', 'CustomerController@add' );
                    Route::get( 'edit', 'CustomerController@edit' );
                    Route::post( 'doadd', 'CustomerController@doAdd' );
                    Route::post( 'dosave', 'CustomerController@doSave' );
                    Route::post( 'doinfosave', 'CustomerController@doMemberInfoSave' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::group(
                    [
                        'prefix' => 'employee'
                    ], function() {
                    Route::get( '', 'EmployeeController@index' );
                    Route::get( 'getlist', 'EmployeeController@getList' );
                    Route::get( 'add', 'EmployeeController@add' );
                    Route::get( 'edit', 'EmployeeController@edit' );
                    Route::post( 'doadd', 'EmployeeController@doAdd' );
                    Route::post( 'dosave', 'EmployeeController@doSave' );
                    Route::post( 'doinfosave', 'EmployeeController@doMemberInfoSave' );
                    Route::get( 'access/{id}', 'EmployeeController@access' );
                    Route::post( 'dosaveaccess', 'EmployeeController@doSaveAccess' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::group(
                    [
                        'prefix' => 'dealer'
                    ], function() {
                    Route::get( '', 'DealerController@index' );
                    Route::get( 'getlist', 'DealerController@getList' );
                    Route::get( 'add', 'DealerController@add' );
                    Route::get( 'edit', 'DealerController@edit' );
                    Route::post( 'doadd', 'DealerController@doAdd' );
                    Route::post( 'dosave', 'DealerController@doSave' );
                    Route::post( 'doinfosave', 'DealerController@doMemberInfoSave' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::get( '{error}', function() {
                    return abort( 503 );
                } );
            } );
            Route::group(
                [
                    'prefix' => 'dealer',
                    'namespace' => 'Dealer',
                ], function() {
                Route::get( '', 'DealerController@index' );
                Route::get( 'getlist', 'DealerController@getList' );
                Route::get( 'add', 'DealerController@add' );
                Route::get( 'edit', 'DealerController@edit' );
                Route::post( 'doadd', 'DealerController@doAdd' );
                Route::post( 'dosave', 'DealerController@doSave' );
                Route::post( 'dodel', 'DealerController@doDel' );
                Route::get ( 'dodownloadqrcode', 'DealerController@doDownloadQrcode' );
                Route::get( '{error}', function() {
                    return abort( 503 );
                } );
            } );
            Route::group(
                [
                    'prefix' => 'system',
                    'namespace' => 'System',
                ], function() {
                    Route::group(
                    [
                        'prefix' => 'arealang'
                    ], function() {
                    Route::get( '', 'AreaLangController@index' );
                    Route::get( 'getlist', 'AreaLangController@getList' );
                    Route::post( 'doadd', 'AreaLangController@doAdd' );
                    Route::post( 'dosave', 'AreaLangController@doSave' );
                    Route::post( 'dodel', 'AreaLangController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::get( '{error}', function() {
                    return abort( 503 );
                } );
            } );
        } );

        // Product
        Route::group(
            [
                'prefix' => 'product',
                'namespace' => 'Product',
            ], function() {
            Route::group(
                [
                    'prefix' => 'car',
                ], function() {
                Route::group(
                    [
                        'prefix' => 'brand'
                    ], function() {
                    Route::get( '', 'CarBrandController@index' );
                    Route::get( 'getlist', 'CarBrandController@getList' );
                    Route::get( 'add', 'CarBrandController@add' );
                    Route::post( 'doadd', 'CarBrandController@doAdd' );
                    Route::get( 'edit', 'CarBrandController@edit' );
                    Route::post( 'dosave', 'CarBrandController@doSave' );
                    Route::post( 'dodel', 'CarBrandController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::group(
                    [
                        'prefix' => 'models'
                    ], function() {
                    Route::get( '', 'CarModelsController@index' );
                    Route::get( 'getlist', 'CarModelsController@getList' );
                    Route::get( 'add', 'CarModelsController@add' );
                    Route::post( 'doadd', 'CarModelsController@doAdd' );
                    Route::get( 'edit', 'CarModelsController@edit' );
                    Route::post( 'dosave', 'CarModelsController@doSave' );
                    Route::post( 'dodel', 'CarModelsController@doDel' );
                    Route::get( 'image', 'CarModelsController@image' );
                    Route::post( 'doimagesave', 'CarModelsController@doImageSave' );
                    Route::get( 'getmodelcolorlist', 'CarModelsController@getModelColorList' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::group(
                    [
                        'prefix' => 'colors'
                    ], function() {
                    Route::get( '', 'CarColorsController@index' );
                    Route::get( 'getlist', 'CarColorsController@getList' );
                    Route::get( 'add', 'CarColorsController@add' );
                    Route::post( 'doadd', 'CarColorsController@doAdd' );
                    Route::get( 'edit', 'CarColorsController@edit' );
                    Route::post( 'dosave', 'CarColorsController@doSave' );
                    Route::get( 'lang', 'CarColorsController@lang' );
                    Route::post( 'dolangsave', 'CarColorsController@doLangSave' );
                    Route::post( 'dodel', 'CarColorsController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::group(
                    [
                        'prefix' => 'search'
                    ], function() {
                    Route::get( '', 'CarSearchController@index' );
                    Route::get( 'getlist', 'CarSearchController@getList' );
                    Route::post( 'dosave', 'CarSearchController@doSave' );
                    Route::get( 'doexport', 'CarSearchController@exportExcel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                    } );
                } );
                Route::group(
                    [
                        'prefix' => 'dealer'
                    ], function() {
                        Route::group(
                        [
                            'prefix' => 'manage'
                        ], function() {
                            Route::get( '', 'CarDealerController@index' );
                            Route::get( 'getlist', 'CarDealerController@getList' );
                            Route::get( 'brandadd', 'CarDealerController@brandAdd' );
                            Route::get( 'getbrandaddlist', 'CarDealerController@getBrandAddList' );
                            Route::get( 'models', 'CarDealerController@models' );
                            Route::get( 'getmodelslist', 'CarDealerController@getModelsList' );
                            Route::get( 'modelsadd', 'CarDealerController@modelsAdd' );
                            Route::get( 'getmodelsaddlist', 'CarDealerController@getModelsAddList' );
                            Route::get( 'colors', 'CarDealerController@colors' );
                            Route::get( 'getcolorslist', 'CarDealerController@getColorsList' );
                            Route::get( 'colorsadd', 'CarDealerController@colorsAdd' );
                            Route::get( 'getcolorsaddlist', 'CarDealerController@getColorsAddList' );
                            Route::post( 'dobrandadd', 'CarDealerController@doBrandAdd' );
                            Route::post( 'domodelsadd', 'CarDealerController@doModelsAdd' );
                            Route::post( 'docolorsadd', 'CarDealerController@doColorsAdd' );
                            Route::post( 'dobrandsave', 'CarDealerController@doBrandSave' );
                            Route::post( 'domodelssave', 'CarDealerController@doModelsSave' );
                            Route::post( 'docolorssave', 'CarDealerController@doColorsSave' );
                            Route::post( 'dobranddel', 'CarDealerController@doBrandDel' );
                            Route::post( 'domodelsdel', 'CarDealerController@doModelsDel' );
                            Route::post( 'docolorsdel', 'CarDealerController@doColorsDel' );

                            Route::get( 'config', 'CarDealer2Controller@config' );
                            Route::post( 'dosave', 'CarDealer2Controller@doSave' );
                            Route::post( 'domodelsave', 'CarDealer2Controller@doModelSave' );
                            Route::get( '{error}', function() {
                                return abort( 503 );
                            });
                        } );
                        Route::group(
                        [
                            'prefix' => 'download'
                        ], function() {
                            Route::get( '', 'CarDownloadController@index' );
                            Route::get( 'getlist', 'CarDownloadController@getList' );
                            Route::get( 'brandadd', 'CarDownloadController@brandAdd' );
                            Route::get( 'getbrandaddlist', 'CarDownloadController@getBrandAddList' );
                            Route::get( 'models', 'CarDownloadController@models' );
                            Route::get( 'getmodelslist', 'CarDownloadController@getModelsList' );
                            Route::get( 'modelsadd', 'CarDownloadController@modelsAdd' );
                            Route::get( 'getmodelsaddlist', 'CarDownloadController@getModelsAddList' );
                            Route::get( 'colors', 'CarDownloadController@colors' );
                            Route::get( 'getcolorslist', 'CarDownloadController@getColorsList' );
                            Route::get( 'colorsadd', 'CarDownloadController@colorsAdd' );
                            Route::get( 'getcolorsaddlist', 'CarDownloadController@getColorsAddList' );
                            Route::post( 'dobrandadd', 'CarDownloadController@doBrandAdd' );
                            Route::post( 'domodelsadd', 'CarDownloadController@doModelsAdd' );
                            Route::post( 'docolorsadd', 'CarDownloadController@doColorsAdd' );
                            Route::post( 'dobrandsave', 'CarDownloadController@doBrandSave' );
                            Route::post( 'domodelssave', 'CarDownloadController@doModelsSave' );
                            Route::post( 'docolorssave', 'CarDownloadController@doColorsSave' );
                            Route::post( 'dobranddel', 'CarDealerController@doBrandDel' );
                            Route::post( 'domodelsdel', 'CarDealerController@doModelsDel' );
                            Route::post( 'docolorsdel', 'CarDealerController@doColorsDel' );
                            Route::get( '{error}', function() {
                                return abort( 503 );
                            });
                        } );
                } );
                Route::get( '{error}', function() {
                    return abort( 503 );
                } );
            } );
        } );

        // Article
        Route::group(
            [
                'prefix' => 'article',
                'namespace' => 'Article',
            ], function() {
            Route::group(
                [
                    'prefix' => 'category',
                ], function() {
                    Route::get( '', 'ArticleCategoryController@index' );
                    Route::get( 'getlist', 'ArticleCategoryController@getList' );
                    Route::get( 'add', 'ArticleCategoryController@add' );
                    Route::post( 'doadd', 'ArticleCategoryController@doAdd' );
                    Route::get( 'edit', 'ArticleCategoryController@edit' );
                    Route::post( 'dosave', 'ArticleCategoryController@doSave' );
                    Route::post( 'dodel', 'ArticleCategoryController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                } );
            } );
            Route::group(
                [
                    'prefix' => 'content',
                ], function() {
                    Route::get( '', 'ArticleContentController@index' );
                    Route::get( 'getlist', 'ArticleContentController@getList' );
                    Route::get( 'add', 'ArticleContentController@add' );
                    Route::post( 'doadd', 'ArticleContentController@doAdd' );
                    Route::get( 'edit', 'ArticleContentController@edit' );
                    Route::post( 'dosave', 'ArticleContentController@doSave' );
                    Route::post( 'dodel', 'ArticleContentController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                } );
            } );
            Route::group(
                [
                    'prefix' => 'classification',
                ], function() {
                    Route::get( '', 'ArticleClassificationController@index' );
                    Route::get( 'getlist', 'ArticleClassificationController@getList' );
                    Route::get( 'add', 'ArticleClassificationController@add' );
                    Route::post( 'doadd', 'ArticleClassificationController@doAdd' );
                    Route::get( 'edit', 'ArticleClassificationController@edit' );
                    Route::post( 'dosave', 'ArticleClassificationController@doSave' );
                    Route::post( 'dodel', 'ArticleClassificationController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                } );
            } );
            Route::group(
                [
                    'prefix' => 'dealer',
                ], function() {
                    Route::get( '', 'ArticleDealerController@index' );
                    Route::get( 'getlist', 'ArticleDealerController@getList' );
                    Route::get( 'add', 'ArticleDealerController@add' );
                    Route::post( 'doadd', 'ArticleDealerController@doAdd' );
                    Route::post( 'dosave', 'ArticleDealerController@doSave' );
                    Route::post( 'dodel', 'ArticleDealerController@doDel' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                } );
            } );
        } );

        // Website
        Route::group(
            [
                'prefix' => 'website',
                'namespace' => 'Website',
            ], function() {
            Route::group(
                [
                    'prefix' => 'manage',
                ], function() {
                Route::get( '', 'ManageController@index' );
                Route::post( 'dosave', 'ManageController@doSave' );
                Route::get( '{error}', function() {
                    return abort( 503 );
                });
            });
        });

        // Bigdata
        Route::group(
            [
                'prefix' => 'bigdata',
                'namespace' => 'Bigdata',
            ], function() {
            Route::group(
                [
                    'prefix' => 'website',
                ], function() {
                Route::get( '', 'WebsiteController@index' );
                Route::get( 'getdata', 'ProductController@getStatistics' );
                Route::get( '{error}', function() {
                    return abort( 503 );
                });
            });    
            Route::group(
                [
                    'prefix' => 'product',
                ], function() {
                Route::get( '', 'ProductController@index' );
                Route::get( 'getdata', 'ProductController@getColorStatistics' );
                Route::get( '{error}', function() {
                    return abort( 503 );
                });
            });
        });

        // Material
        Route::group(
            [
                'prefix' => 'material',
                'namespace' => 'Material',
            ], function() {
            Route::group(
                [
                    'prefix' => 'image',
                ], function() {
                    Route::get( '', 'ImageController@index' );
                    Route::get( 'getlist', 'ImageController@getList' );
                    Route::get( 'getimagelist', 'ImageController@getImageList' );
                    Route::get( 'add', 'ImageController@add' );
                    Route::post( 'doadd', 'ImageController@doAdd' );
                    Route::get( 'edit', 'ImageController@edit' );
                    Route::post( 'dosave', 'ImageController@doSave' );
                    Route::post( 'dodel', 'ImageController@doDel' );
                    Route::post( 'dodelmulti', 'ImageController@doDelMulti' );
                    Route::post( 'docutimage', 'ImageController@doCutImage' );
                    Route::get( '{error}', function() {
                        return abort( 503 );
                } );
            } );
        } );

        // Dealer
        Route::group(
            [
                'prefix' => 'dealer',
                'namespace' => 'Dealer',
            ], function() {
            Route::group(
                [
                    'prefix' => 'download',
                ], function() {
                Route::get( '', 'DownloadController@index' );
                Route::get( 'getlist', 'DownloadController@getList' );
                Route::get( '{error}', function() {
                    return abort( 503 );
                });
            });    
            Route::group(
                [
                    'prefix' => 'inquire',
                ], function() {
                Route::get( '', 'InquireController@index' );
                Route::get( 'getlist', 'InquireController@getList' );
                Route::get( 'getcarmodels', 'InquireController@getCarModels' );
                Route::get( '{error}', function() {
                    return abort( 503 );
                });
            });
        });
    });
});