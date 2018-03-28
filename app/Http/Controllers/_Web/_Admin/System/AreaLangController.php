<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\System;

use App\Http\Controllers\_Web\_WebController;
use App\SysMember;
use App\SysAreaLang;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class AreaLangController extends _WebController
{
    public $module = "admin";
    public $action = "system";
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
            $this->module . "." . $this->action .  "." . "arealang" => url( 'web/' . $this->module . '/' . $this->action . '/arealang' )
        ];

        $this->title = $this->module . "." . $this->action .  "." . "arealang";

        $this->func = "web." . $this->module . "." . $this->action .  "." . "arealang";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $mapSysAreaLang['bDel'] = 0;
        $DaoSysAreaLang = SysAreaLang::where($mapSysAreaLang)->get();
        foreach ($DaoSysAreaLang as $key => $var) {
            $var->DT_RowId = $var->iId;
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $DaoSysAreaLang;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doAdd ()
    {
        $vAreaLangName = ( Input::has( 'vAreaLangName' ) ) ? Input::get( 'vAreaLangName' ) : "";

        $DaoSysAreaLang = new SysAreaLang ();
        $DaoSysAreaLang->vAreaLangName = $vAreaLangName;
        $DaoSysAreaLang->iCreateTime = $DaoSysAreaLang->iUpdateTime = time();
        $DaoSysAreaLang->iStatus = 1;
        $DaoSysAreaLang->bDel = 0;
        if ($DaoSysAreaLang->save()) {
            //Logs
            $this->_saveLogAction( $DaoSysAreaLang->getTable(), $DaoSysAreaLang->iId, 'add', json_encode( $DaoSysAreaLang ) );
            
            $this->rtndata ['status'] = 1;
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
    public function doSave ()
    {
        $iId = ( Input::has( 'iId' ) ) ? Input::get( 'iId' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $Dao = SysAreaLang::where($map)->first();
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if (Input::has( 'vAreaLangName' )) {
            $Dao->vAreaLangName = Input::get( 'vAreaLangName' );
        }
        if (Input::has( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

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
    public function doDel ()
    {
        $iId = ( Input::has( 'iId' ) ) ? Input::get( 'iId' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $Dao = SysAreaLang::where($map)->first();
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        
        $Dao->bDel = 1;
        
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'del', json_encode( $Dao ) );

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }    
}
