<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

use App\Http\Controllers\_Web\_WebController;
use App\SysMember;
use App\SysMemberInfo;
use App\SysAgentAccess;
use App\SysDealer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class DealerController extends _WebController
{
    public $vAgentCode = "PEN";
    public $iAcType = 41;
    public $module = "admin";
    public $action = "member";
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
            $this->module . "." . $this->action . ".dealer" => url( 'web/' . $this->module . '/' . $this->action . '/dealer' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer";
        $this->__initial();

        $map['bDel'] = 0;    
        $DaoSysDealer = SysDealer::where($map)->get();

        $this->view->with ( 'dealer', $DaoSysDealer );
        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $data_arr = SysMember::join( 'sys_member_info', function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_member.iId' );
        } )->where( 'iAcType', $this->iAcType )->select( 'sys_member.*', 'sys_member_info.*' )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUserBirthday = $var->iUserBirthday ? date( 'Y/m/d', $var->iUserBirthday ) : "";

            if($var->iDealerId) {
                $mapDealer['iId'] = $var->iDealerId;
                $mapDealer['bDel'] = 0;    
                $DaoSysDealer = SysDealer::where($mapDealer)->first();
                $var->vDealerName = $DaoSysDealer->vDealerName;
            } else {
                $var->vDealerName = "";
            }

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
            $this->module . "." . $this->action . ".dealer.add" => url( 'web/' . $this->module . '/' . $this->action . '/dealer/add' )
        ];

        $this->title = $this->module . "." . $this->action . ".dealer.add";

        $this->func = "web." . $this->module . "." . $this->action . ".dealer.add";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function doAdd ()
    {
        $vUserName = ( Input::has( 'vUserName' ) ) ? Input::get( 'vUserName' ) : "";
        $vAccount = ( Input::has( 'vAccount' ) ) ? Input::get( 'vAccount' ) : "";
        $vPassword = ( Input::has( 'vPassword' ) ) ? Input::get( 'vPassword' ) : "";
        /*
        if ( !$this->_isValidEmail( $vAccount )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );

            return response()->json( $this->rtndata );
        }
        */
        $map ['vAgentCode'] = $this->vAgentCode;
        $map ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $map )->first();
        if ($DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.account_not_empty' );

            return response()->json( $this->rtndata );
        }
        $str = md5( uniqid( mt_rand(), true ) );
        $uuid = substr( $str, 0, 8 ) . '-';
        $uuid .= substr( $str, 8, 4 ) . '-';
        $uuid .= substr( $str, 12, 4 ) . '-';
        $uuid .= substr( $str, 16, 4 ) . '-';
        $uuid .= substr( $str, 20, 12 );
        do {
            $userid = rand( 1000000001, 1999999999 );
            $check = SysMember::where( "iUserId", $userid )->first();
        } while ($check);
        $DaoMember = new SysMember ();
        $DaoMember->iUserId = $userid;
        $DaoMember->vUserCode = $uuid;
        $DaoMember->vAgentCode = $this->vAgentCode;
        $DaoMember->iAcType = $this->iAcType;
        $DaoMember->vAccount = $vAccount;
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        $DaoMember->iCreateTime = $DaoMember->iUpdateTime = time();
        $DaoMember->vCreateIP = Request::ip();
        $DaoMember->bActive = 0;
        $DaoMember->iStatus = 1;
        if ($DaoMember->save()) {
            //Logs
            $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'add', json_encode( $DaoMember ) );
            $DaoMemberInfo = new SysMemberInfo ();
            $DaoMemberInfo->iMemberId = $DaoMember->iId;
            $DaoMemberInfo->vUserImage = "/images/empty.jpg";
            $DaoMemberInfo->vUserName = $vUserName;
            $DaoMemberInfo->vUserEmail = "";
            $DaoMemberInfo->vUserContact = "";
            $DaoMemberInfo->save();
            //Logs
            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'add', json_encode( $DaoMemberInfo ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.register.success' );
            $this->rtndata ['rtnurl'] = url( 'web/admin/member/customer' );

        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doSave ()
    {
        $id = ( Input::has( 'iId' ) ) ? Input::get( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = SysMember::where( 'iAcType', $this->iAcType )->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if (Input::has( 'iDealerId' )) {
            $Dao->iDealerId = Input::get( 'iDealerId' );
        }
        if (Input::has( 'bActive' )) {
            $Dao->bActive = ( $Dao->bActive ) ? 0 : 1;
        }
        if (Input::has( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );


            $map['iMemberId'] = $id;
            $DaoMemberInfo = SysMemberInfo::where($map)->first();
            if (Input::has( 'vUserName' )) {
                $DaoMemberInfo->vUserName = Input::get( 'vUserName' );
            }
            if (Input::has( 'vUserNameE' )) {
                $DaoMemberInfo->vUserNameE = Input::get( 'vUserNameE' );
            }
            if (Input::has( 'vUserTitle' )) {
                $DaoMemberInfo->vUserTitle = Input::get( 'vUserTitle' );
            }
            if (Input::has( 'vUserID' )) {
                $DaoMemberInfo->vUserID = Input::get( 'vUserID' );
            }
            if (Input::has( 'iUserBirthday' )) {
                $DaoMemberInfo->iUserBirthday = strtotime( Input::get( 'iUserBirthday' ) );
            }
            if (Input::has( 'vUserEmail' )) {
                $DaoMemberInfo->vUserEmail = Input::get( 'vUserEmail' );
            }
            if (Input::has( 'vUserContact' )) {
                $DaoMemberInfo->vUserContact = Input::get( 'vUserContact' );
            }
            if (Input::has( 'vUserZipCode' )) {
                $DaoMemberInfo->vUserZipCode = Input::get( 'vUserZipCode' );
            }
            if (Input::has( 'vUserCity' )) {
                $DaoMemberInfo->vUserCity = Input::get( 'vUserCity' );
            }
            if (Input::has( 'vUserArea' )) {
                $DaoMemberInfo->vUserArea = Input::get( 'vUserArea' );
            }
            if (Input::has( 'vUserAddress' )) {
                $DaoMemberInfo->vUserAddress = Input::get( 'vUserAddress' );
            }
            $DaoMemberInfo->save();
            //Logs
            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'edit', json_encode( $DaoMemberInfo ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
