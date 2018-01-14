<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\FuncController;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class SearchController extends _PortalController
{
    /*
     *
     */
    public function index ( Request $request )
    {
        $this->_init();

        $this->view = View()->make( "_template_portal.search" );

        return $this->view;
    }

    /*
     *
     */
    public function doSearch( Request $request ) {
        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;
        $iCarModelId = ( $request->exists( 'iCarModelId' ) ) ? $request->input( 'iCarModelId' ) : 0;
        $vCarColorCode = ( $request->exists( 'vCarColorCode' ) ) ? $request->input( 'vCarColorCode' ) : "";

        if ( $iCarBrandId != 0 ) {
        	$mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
        }
        if ( $iCarModelId != 0 ) {
        	$mapCarModelColors ['car_model_colors.iCarModelId'] = $iCarModelId;
        }
        
        $mapCarModelColors ['car_model_colors.bDel'] = 0;
        $mapCarModelColors ['car_models.bDel'] = 0;
        $DaoCarModelColors = CarModelColors::join( 'car_models', function( $join ) {
            $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
        } )->join( 'car_colors', function( $join ) {
            $join->on( 'car_model_colors.iCarColorId', '=', 'car_colors.iId' );
        } )->where ( function ($query) use($vCarColorCode) {
            if ($vCarColorCode != "") {
                $query->Where ( 'car_colors.vOrderNum', 'like', '%' . $vCarColorCode . '%' );
            }
        } )->where( $mapCarModelColors )->select(
            'car_model_colors.*', 
            'car_models.vCarModelName',
            'car_colors.vCarColorName'
        )->get();

        $this->rtndata ['status'] = 1;
        return response ()->json ( $this->rtndata );
    }
}
