<?php
namespace App\Http\Controllers\_Web\Dealer;

use App\Http\Controllers\_Web\_WebController;
use App\CarBrand;
use App\CarModels;
use App\CarModelType;
use App\CarColors;
use App\CarModelColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Excel;

class DownloadController extends _WebController
{
    public $module = "dealer";
    public $action = "download";
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
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action;
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
        
        $data_arr = [];
        $mapCarColors ['iCarBrandId'] = $iCarBrandId;
        $mapCarColors ['bDel'] = 0;
        $DaoCarColors = CarColors::where( $mapCarColors )->orderBy('iRank', 'asc')->get();

        foreach ($DaoCarColors as $key => $value) {
            
            $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
            $mapCarModelColors ['car_model_colors.iCarColorId'] = $value->iId;
            $mapCarModelColors ['car_model_colors.bDel'] = 0;
            $mapCarModelColors ['car_models.bDel'] = 0;
            $DaoCarModelColors = CarModelColors::join( 'car_models', function( $join ) {
                $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
            } )->where( $mapCarModelColors )->select(
                'car_model_colors.*', 
                'car_models.vCarModelName'
            )->get();
           
            if(count($DaoCarModelColors) == 0) {
                foreach ($DaoCarModels as $key1 => $value1) {
                    $DaoCarModelColors = new CarModelColors();
                    $DaoCarModelColors->iCarBrandId = $iCarBrandId;
                    $DaoCarModelColors->iCarModelId = $value1->iId;
                    $DaoCarModelColors->iCarColorId = $value->iId;
                    $DaoCarModelColors->iRank = 1;
                    $DaoCarModelColors->iCreateTime = $DaoCarModelColors->iUpdateTime = time();
                    $DaoCarModelColors->iStatus = 0;
                    $DaoCarModelColors->bDel = 0;
                    $DaoCarModelColors->save();
                }

                $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
                $mapCarModelColors ['car_model_colors.iCarColorId'] = $value->iId;
                $mapCarModelColors ['car_model_colors.bDel'] = 0;
                $mapCarModelColors ['car_models.bDel'] = 0;
                $DaoCarModelColors = CarModelColors::join( 'car_models', function( $join ) {
                    $join->on( 'car_model_colors.iCarModelId', '=', 'car_models.iId' );
                } )->where( $mapCarModelColors )->select(
                    'car_model_colors.*', 
                    'car_models.vCarModelName'
                )->get();
            }

            $value->CarModelColors = $DaoCarModelColors;
            $data_arr [ $key ] = $value;
        }
        
        $this->rtndata ['status'] = 1;
        $this->rtndata ['CarBrand'] = $DaoCarBrand;
        $this->rtndata ['CarModels'] = $DaoCarModels;
        $this->rtndata ['aaData'] = $data_arr;

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
        array_push($header, '色碼');
        
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

        foreach ($DaoCarColors as $key => $value) {
            $mapCarModelColors ['car_model_colors.iCarBrandId'] = $iCarBrandId;
            $mapCarModelColors ['car_model_colors.iCarColorId'] = $value->iId;
            $mapCarModelColors ['car_model_colors.bDel'] = 0;
            
            $DaoCarModelColors = CarModelColors::where( $mapCarModelColors )->get();

            $value->CarModelColors = $DaoCarModelColors;
            $data_arr [ $key ] = $value;

        }
        

        foreach ($data_arr as $key => $var) {
            $data = [];
            array_push($data, $var->vCarColorName);
            array_push($data, $var->vCarColorCode);

            foreach ($DaoCarModels as $key1 => $var1) {
                if($var['CarModelColors'][$key1]['iStatus'] == 1) {
                    array_push($data, 1);
                } else {
                    array_push($data, 0);
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
