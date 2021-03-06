<?php
namespace App\Http\Controllers\_Web\Product;

use App\Http\Controllers\_Web\_WebController;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Excel;

class CarSearchController extends _WebController
{
    public $module = "product";
    public $action = "car";
    /*
     *
     */
    public function __construct ()
    {
    }

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".search" => url( 'web/' . $this->module . '/' . $this->action . '/search' )
        ];

        $this->title = $this->module . "." . $this->action . ".search";

        $this->func = "web." . $this->module . "." . $this->action . ".search";
        $this->__initial();

        $mapCarBrand ['bDel'] = 0;    
        $DaoCarBrand = CarBrand::where($mapCarBrand)->orderBy ( 'iRank', 'ASC' )->get();

        $this->view->with ( 'carBrand', $DaoCarBrand );
        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $iCarBrandId = ( Input::has( 'iCarBrandId' ) ) ? Input::get( 'iCarBrandId' ) : 0;

        $mapCarBrand ['iId'] = $iCarBrandId;
        $mapCarBrand ['bDel'] = 0;
        $DaoCarBrand = CarBrand::where( $mapCarBrand )->first();
        
        $mapCarModels ['iCarBrandId'] = $iCarBrandId;
        $mapCarModels ['bDel'] = 0;
        $DaoCarModels = CarModels::where( $mapCarModels )->orderBy('iRank', 'asc')->get();
        
        $mapCarColors ['iCarBrandId'] = $iCarBrandId;
        $mapCarColors ['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->orderBy('iRank', 'asc')->get();
        foreach ($DaoCarColors as $key1 => $var1) {
            $var1->vCarColorCode = $var1->vCarColorCode ? $var1->vCarColorCode : "";
            $var1->vCarColorNationalCode = $var1->vCarColorNationalCode ? $var1->vCarColorNationalCode : "";
            $carModels = [];
            foreach ($DaoCarModels as $key2 => $var2) {
                $carModels[$key2]['vCarModelName'] = $var2->vCarModelName;

                $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
                $mapCarModelColors ['car_model_colors.iCarModelId'] = $var2->iId;
                $mapCarModelColors ['car_model_colors.iCarColorId'] = $var1->iId;
                $DaoCarModelColors = CarModelColors::where( $mapCarModelColors )->first();
                if($DaoCarModelColors) {
                    if($DaoCarModelColors->iStatus == 1) {
                        $carModels[$key2]['iColorStatus'] = 1; 
                    } else {
                        $carModels[$key2]['iColorStatus'] = 0; 
                    }
                } else {
                    $DaoCarModelColors = new CarModelColors();
                    $DaoCarModelColors->iCarBrandId = $iCarBrandId;
                    $DaoCarModelColors->iCarModelId = $var2->iId;
                    $DaoCarModelColors->iCarColorId = $var1->iId;
                    $DaoCarModelColors->iStatus = 0;
                    $DaoCarModelColors->bDel = 0;
                    $DaoCarModelColors->iCreateTime = $DaoCarModelColors->iUpdateTime = time ();
                    $DaoCarModelColors->save();

                    $carModels[$key2]['iColorStatus'] = 0;
                }
                $carModels[$key2]['iId'] = $DaoCarModelColors->iId;
            }
            $var1->carModels = $carModels;
        }
        
        $this->rtndata ['status'] = 1;
        $this->rtndata ['CarBrand'] = $DaoCarBrand;
        $this->rtndata ['CarModels'] = $DaoCarModels;
        $this->rtndata ['aaData'] = $DaoCarColors;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $mapCarModelColors['iId'] = $iId;
        $mapCarModelColors['bDel'] = 0;
        $DaoCarModelColors = CarModelColors::where( $mapCarModelColors )->first();
        if ( !$DaoCarModelColors) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iRank' ) ) {
            $DaoCarModelColors->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoCarModelColors->iStatus = ( $DaoCarModelColors->iStatus ) ? 0 : 1;
        }
        $DaoCarModelColors->iUpdateTime = time();
        if ($DaoCarModelColors->save()) {
            //Logs
            $this->_saveLogAction( $DaoCarModelColors->getTable(), $DaoCarModelColors->iId, 'edit', json_encode( $DaoCarModelColors ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['colorStatus'] = $DaoCarModelColors->iStatus;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /**
     * 
     */
    public function exportExcel( Request $request ) {
        $iCarBrandId = ( $request->exists( 'iCarBrandId' ) ) ? $request->input( 'iCarBrandId' ) : 0;

        $exportData = [];
        $header = [];

        $mapCarBrand ['iId'] = $iCarBrandId;
        $mapCarBrand ['bDel'] = 0;
        $DaoCarBrand = CarBrand::where( $mapCarBrand )->first();
        array_push($header, $DaoCarBrand->vCarBrandName);
        //array_push($header, '色碼');
        
        $mapCarModels ['iCarBrandId'] = $iCarBrandId;
        $mapCarModels ['bDel'] = 0;
        $DaoCarModels = CarModels::where( $mapCarModels )->orderBy('iRank', 'asc')->get();
        foreach ($DaoCarModels as $key => $var) {
            array_push($header, $var->vCarModelName);
        }

        array_push($exportData, $header);
        
        $data_arr = [];
        $mapCarColors ['iCarBrandId'] = $iCarBrandId;
        $mapCarColors ['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->orderBy('iRank', 'asc')->get();

        foreach ($DaoCarColors as $key1 => $var1) {
            $data = [];
            array_push($data, $var1->vCarColorName);

            foreach ($DaoCarModels as $key2 => $var2) {
                $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
                $mapCarModelColors ['car_model_colors.iCarModelId'] = $var2->iId;
                $mapCarModelColors ['car_model_colors.iCarColorId'] = $var1->iId;
                $DaoCarModelColors = CarModelColors::where( $mapCarModelColors )->first();
                if($DaoCarModelColors) {
                    if($DaoCarModelColors->iStatus == 1) {
                        array_push($data, 1);
                    } else {
                        array_push($data, "");
                    }
                } 
            }
            array_push($exportData, $data);
        }

        Excel::create('車色表', function($excel) use ($exportData) {
            $excel->sheet('車色表', function($sheet) use ($exportData) {
                $sheet->rows($exportData);
            });
        })->export('xls');
    }
}
