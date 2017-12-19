<?php
namespace App\Http\Controllers\_Web\_Admin\Dealer;

use App\Http\Controllers\_Web\_WebController;
use App\SysDealer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class DealerController extends _WebController
{
    public $module = "admin";
    public $action = "dealer";
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

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $map['bDel'] = 0;    
        $data_arr = SysDealer::where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            //$var->vDealerImg = $this->_getFilePathById($var->vDealerImg);
            $var->vImage = $this->_getFilePathById($var->vDealerImg);
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function add ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".add" => url( 'web/' . $this->module . '/' . $this->action . '/add' )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action . ".add";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function doAdd ( Request $request )
    {
        /*
        $vDealerName = ( $request->exists( 'vDealerName' ) ) ? $request->input( 'vDealerName' ) : "";
        $vDealerNameE = ( $request->exists( 'vDealerNameE' ) ) ? $request->input( 'vDealerNameE' ) : "";
        $vDealerTel = ( $request->exists( 'vDealerTel' ) ) ? $request->input( 'vDealerTel' ) : "";
        $vDealerEmail = ( $request->exists( 'vDealerEmail' ) ) ? $request->input( 'vDealerEmail' ) : "";
        $vDealerAddr = ( $request->exists( 'vDealerAddr' ) ) ? $request->input( 'vDealerAddr' ) : "";
        $vDealerFax = ( $request->exists( 'vDealerFax' ) ) ? $request->input( 'vDealerFax' ) : "";
        */
        $vDealerName = $request->input( 'vDealerName' ) ? $request->input( 'vDealerName' ) : "";
        $vDealerNameE = $request->input( 'vDealerNameE' ) ? $request->input( 'vDealerNameE' ) : "";
        $vUrlName = $request->input( 'vUrlName' ) ? $request->input( 'vUrlName' ) : "";
        //$vDealerImg = $request->input( 'vDealerImg' ) ? $request->input( 'vDealerImg' ) : "";
        $vDealerTel = $request->input( 'vDealerTel' ) ? $request->input( 'vDealerTel' ) : "";
        $vDealerEmail = $request->input( 'vDealerEmail' ) ? $request->input( 'vDealerEmail' ) : "";
        $vDealerAddr = $request->input( 'vDealerAddr' ) ? $request->input( 'vDealerAddr' ) : "";
        $bLink = $request->input( 'bLink' ) ? $request->input( 'bLink' ) : 0;
        $vDealerLink = $request->input( 'vDealerLink' ) ? $request->input( 'vDealerLink' ) : "";
        $vDealerColor = $request->input( 'vDealerColor' ) ? $request->input( 'vDealerColor' ) : "";
        $vDealerFax = $request->input( 'vDealerFax' ) ? $request->input( 'vDealerFax' ) : "";

        $DaoSysDealer = new SysDealer ();
        $DaoSysDealer->iType = 0;
        $DaoSysDealer->vDealerName = $vDealerName;
        $DaoSysDealer->vDealerNameE = $vDealerNameE;
        $DaoSysDealer->vUrlName = $vUrlName;
        //$DaoSysDealer->vDealerImg = $vDealerImg;
        $DaoSysDealer->vDealerTel = $vDealerTel;
        $DaoSysDealer->vDealerEmail = $vDealerEmail;
        $DaoSysDealer->vDealerAddr = $vDealerAddr;
        $DaoSysDealer->bLink = $bLink;
        $DaoSysDealer->vDealerLink = $vDealerLink;
        $DaoSysDealer->vDealerColor = $vDealerColor;
        $DaoSysDealer->vDealerFax = $vDealerFax;
        $DaoSysDealer->iCreateTime = $DaoSysDealer->iUpdateTime = time();
        $DaoSysDealer->iStatus = 1;
        $DaoSysDealer->bDel = 0;
        if ($DaoSysDealer->save()) {
            //Logs
            $this->_saveLogAction( $DaoSysDealer->getTable(), $DaoSysDealer->iId, 'add', json_encode( $DaoSysDealer ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['vDealerEmail'] = $vDealerEmail;
            $this->rtndata ['vDealerAddr'] = $vDealerAddr;
            $this->rtndata ['vDealerFax'] = $vDealerFax;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function edit ( Request $request )
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".edit" => url( 'web/' . $this->module . '/' . $this->action . '/edit' )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action . ".edit";
        $this->__initial();

        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoSysDealer = SysDealer::where( $map )->first();
        if ( !$DaoSysDealer) {
            $DaoSysDealer = new SysDealer();
        }

        $DaoSysDealer->vImage = $this->_getFilePathById($DaoSysDealer->vDealerImg);

        $this->view->with ( 'sysDealer', $DaoSysDealer );
        return $this->view;
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $iId = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoSysDealer = SysDealer::where( $map )->first();
        if ( !$DaoSysDealer) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'vDealerName' ) ) {
            $DaoSysDealer->vDealerName = $request->input( 'vDealerName' );
        }
        if ( $request->exists( 'vDealerNameE' ) ) {
            $DaoSysDealer->vDealerNameE = $request->input( 'vDealerNameE' );
        }
        if ( $request->exists( 'vUrlName' ) ) {
            $DaoSysDealer->vUrlName = $request->input( 'vUrlName' );
        }
        if ( $request->exists( 'vDealerImg' ) ) {
            $DaoSysDealer->vDealerImg = $request->input( 'vDealerImg' );
        }
        if ( $request->exists( 'vDealerTel' ) ) {
            $DaoSysDealer->vDealerTel = $request->input( 'vDealerTel' );
        }
        if ( $request->exists( 'vDealerEmail' ) ) {
            $DaoSysDealer->vDealerEmail = $request->input( 'vDealerEmail' );
        }
        if ( $request->exists( 'vDealerAddr' ) ) {
            $DaoSysDealer->vDealerAddr = $request->input( 'vDealerAddr' );
        }
        if ( $request->exists( 'bLink' ) ) {
            $DaoSysDealer->bLink = $request->input( 'bLink' );
        }
        if ( $request->exists( 'vDealerLink' ) ) {
            $DaoSysDealer->vDealerLink = $request->input( 'vDealerLink' );
        }
        if ( $request->exists( 'vDealerColor' ) ) {
            $DaoSysDealer->vDealerColor = $request->input( 'vDealerColor' );
        }
        if ( $request->exists( 'vDealerFax' ) ) {
            $DaoSysDealer->vDealerFax = $request->input( 'vDealerFax' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoSysDealer->iStatus = ( $DaoSysDealer->iStatus ) ? 0 : 1;
        }
        
        $DaoSysDealer->iUpdateTime = time();
        if ($DaoSysDealer->save()) {
            //Logs
            $this->_saveLogAction( $DaoSysDealer->getTable(), $DaoSysDealer->iId, 'edit', json_encode( $DaoSysDealer ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doDownloadQrcode() {
        $type = (Input::has ( 'type' )) ? Input::get ( 'type' ) : 1;
        $url = (Input::has ( 'url' )) ? Input::get ( 'url' ) : "";

        //$path = config ()->get ( 'config.path.userdata' ) . "/" . session ()->get ( 'usercode' ) . "/qrcode/";

        $path = env( 'UPLOAD_PATH', dirname( $_SERVER ['SCRIPT_FILENAME'] ) . '/' ) . config ()->get ( 'config.path.userdata' ) . session ()->get ( 'member.vUserCode' ) . "/qrcode/";

        if (! file_exists ( $path )) {
            mkdir ( $path, 0777, true );
        }
        $filename = md5 ( $url ) . '.png';
        if (file_exists ( $path . $filename )) {
            unlink ( $path . $filename );
        }
        if($type == 1) {
            $content = url ( '' ) . "/" . $url;
        } else {
            $content = url('') . "/dealer/web" . $url;
        }
        
        QrCode::encoding ( 'UTF-8' )->format ( 'png' )->errorCorrection ( 'H' )->size ( 300 )->generate ( $content, $path . $filename );
        
        return response ()->download ( $path . $filename, $filename );
    }
}
