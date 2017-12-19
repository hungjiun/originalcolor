<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Member;

use App\Http\Controllers\_Web\_WebController;
use App\SysGroup;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberAccess;
use App\SysMemberInfo;
use App\SysSessions;
use Illuminate\Http\Request;

class _MemberController extends _WebController
{
    public $vAgentCode = "PEN";
    public $module = "member";
    public $action = "";
    public $iGroupType = 0;
    public $iAcType = 0;

    /*
     * $iGroupType : 1.employee 2.store 3.blogger 4.supplier
     * $iAcType : 31.employee 41.store 61.supplier
     */

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            "admin" => "#",
            "admin." . $this->module . "." . $this->action => url( 'web/admin/' . $this->module . '/' . $this->action )
        ];
        $this->func = "web.admin." . $this->module . "." . $this->action;
        $this->__initial();

        $mapGroup['iGroupType'] = $this->iGroupType;
        $mapGroup['iStatus'] = 1;
        $mapGroup['bDel'] = 0;
        $DaoGroup = SysGroup::where( $mapGroup )->get();
        $this->view->with( 'group', $DaoGroup );

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
            $var->iUserBirthday = date( 'Y/m/d', $var->iUserBirthday );
            $DaoGroup = SysGroupMember::join( 'sys_group', function( $join ) {
                $join->on( 'sys_group.iId', '=', 'sys_group_member.iGroupId' );
            } )->where( 'sys_group_member.iMemberId', $var->iId )->select( 'sys_group_member.iGroupId', 'sys_group.vGroupName' )->first();
            if ($DaoGroup) {
                $var->group = $DaoGroup;
            } else {
                $var->group = [ 'iGroupId' => 0, 'vGroupName' => "無" ];
            }
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $iGroupId = $request->exists( 'iGroupId' ) ? $request->input( 'iGroupId' ) : 0;
        $vUserName = $request->exists( 'vUserName' ) ? $request->input( 'vUserName' ) : "";
        $vAccount = $request->exists( 'vAccount' ) ? $request->input( 'vAccount' ) : "";
        $vPassword = $request->exists( 'vPassword' ) ? $request->input( 'vPassword' ) : "";
        if ($vAccount == "") {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );

            return response()->json( $this->rtndata );
        }
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
            $userid = rand( 1000000001, 1099999999 );
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
        $DaoMember->vCreateIP = $request->ip();
        $DaoMember->bActive = 0;
        $DaoMember->iStatus = 1;
        if ($DaoMember->save()) {
            //Logs
            $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'add', json_encode( $DaoMember ) );
            $DaoMemberInfo = new SysMemberInfo();
            $DaoMemberInfo->iMemberId = $DaoMember->iId;
            $DaoMemberInfo->vUserImage = "/images/empty.jpg";
            $DaoMemberInfo->vUserName = $vUserName;
            $DaoMemberInfo->vUserEmail = "";
            $DaoMemberInfo->vUserContact = "";
            $DaoMemberInfo->save();
            //Logs
            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'add', json_encode( $DaoMemberInfo ) );
            if ($iGroupId > 0) {
                $DaoGroupMember = new SysGroupMember();
                $DaoGroupMember->iGroupId = $iGroupId;
                $DaoGroupMember->iMemberId = $DaoMember->iId;
                $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
                $DaoGroupMember->iStatus = 1;
                $DaoGroupMember->save();
                //Logs
                $this->_saveLogAction( $DaoGroupMember->getTable(), $DaoGroupMember->iMemberId, 'add', json_encode( $DaoGroupMember ) );
            }
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.register.success' );
            $this->rtndata ['rtnurl'] = url( 'web/admin/' . $this->module . '/' . $this->action );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
      *
      */
    public function doSave ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
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
        if ($request->exists( 'bActive' )) {
            $Dao->bActive = ( $Dao->bActive ) ? 0 : 1;
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
            $DaoMemberInfo = SysMemberInfo::find( $id );
            if ($request->exists( 'vUserName' )) {
                $DaoMemberInfo->vUserName = $request->input( 'vUserName' );
            }
            if ($request->exists( 'vUserNameE' )) {
                $DaoMemberInfo->vUserNameE = $request->input( 'vUserNameE' );
            }
            if ($request->exists( 'vUserTitle' )) {
                $DaoMemberInfo->vUserTitle = $request->input( 'vUserTitle' );
            }
            if ($request->exists( 'vUserID' )) {
                $DaoMemberInfo->vUserID = $request->input( 'vUserID' );
            }
            if ($request->exists( 'iUserBirthday' )) {
                $DaoMemberInfo->iUserBirthday = strtotime( $request->input( 'iUserBirthday' ) );
            }
            if ($request->exists( 'vUserEmail' )) {
                $DaoMemberInfo->vUserEmail = $request->input( 'vUserEmail' );
            }
            if ($request->exists( 'vUserContact' )) {
                $DaoMemberInfo->vUserContact = $request->input( 'vUserContact' );
            }
            if ($request->exists( 'vUserZipCode' )) {
                $DaoMemberInfo->vUserZipCode = $request->input( 'vUserZipCode' );
            }
            if ($request->exists( 'vUserCity' )) {
                $DaoMemberInfo->vUserCity = $request->input( 'vUserCity' );
            }
            if ($request->exists( 'vUserArea' )) {
                $DaoMemberInfo->vUserArea = $request->input( 'vUserArea' );
            }
            if ($request->exists( 'vUserAddress' )) {
                $DaoMemberInfo->vUserAddress = $request->input( 'vUserAddress' );
            }
            $DaoMemberInfo->save();
            //Logs
            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'edit', json_encode( $DaoMemberInfo ) );
            $iGroupId = ( $request->exists( 'iGroupId' ) ) ? $request->input( 'iGroupId' ) : 0;
            if ($iGroupId > 0) {
                $mapGroupMember['iMemberId'] = $id;
                $DaoGroupMember = SysGroupMember::where( $mapGroupMember )->first();
                if ( !$DaoGroupMember) {
                    $DaoGroupMember = new SysGroupMember();
                    $DaoGroupMember->iGroupId = $iGroupId;
                    $DaoGroupMember->iMemberId = $id;
                    $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
                    $DaoGroupMember->iStatus = 1;
                    $DaoGroupMember->save();
                    //Logs
                    $this->_saveLogAction( $DaoGroupMember->getTable(), $DaoGroupMember->iId, 'add', json_encode( $DaoGroupMember ) );
                } else {
                    $DaoGroupMember->iGroupId = $iGroupId;
                    $DaoGroupMember->iUpdateTime = time();
                    $DaoGroupMember->save();
                    //Logs
                    $this->_saveLogAction( $DaoGroupMember->getTable(), $DaoGroupMember->iId, 'edit', json_encode( $DaoGroupMember ) );
                }
            }
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
    public function access ( $id )
    {
        $this->breadcrumb = [
            "admin" => "#",
            "admin." . $this->module . "." . $this->action => url( 'web/admin/' . $this->module . '/' . $this->action ),
            "admin." . $this->module . "." . $this->action . ".access" => url( 'web/admin/' . $this->module . '/' . $this->action . '/access' )
        ];
        $this->func = "web.admin." . $this->module . "." . $this->action . ".access";
        $this->__initial();

        $mapAccess['iMemberId'] = $id;
        $DaoAccess = SysMemberAccess::join( 'sys_menu', function( $join ) {
            $join->on( 'sys_menu.iId', '=', 'sys_member_access.iMenuId' );
            //$join->where( 'sys_menu.iId', '>', 999 );
            $join->where( 'sys_menu.bOpen', 1 );
        } )->where( $mapAccess )->select( 'sys_menu.iId as iMenuId', 'sys_menu.vName', 'sys_menu.bSubMenu', 'sys_menu.iParentId', 'sys_member_access.iId', 'sys_member_access.bOpen', 'sys_member_access.bSet'
        )->get();
        $this->view->with( 'access', $DaoAccess );

        return $this->view;
    }

    /*
     *
     */
    public function doSaveAccess ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = SysMemberAccess::find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'bOpen' )) {
            $Dao->bOpen = ( $Dao->bOpen ) ? 0 : 1;
        }
        $Dao->bSet = 1;
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

            //踢人
            $DaoMember = SysMember::find( $Dao->iMemberId );
            if ($DaoMember->vSessionId) {
                SysSessions::where( 'id', $DaoMember->vSessionId )->delete();
            }
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
