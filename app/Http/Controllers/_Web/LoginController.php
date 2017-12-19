<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use App\SysMemberAccess;
use App\SysAgentAccess;
use App\SysMenu;
use App\SysMemberVerification;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public $vAgentCode = "PEN";

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
        $this->func = "_template_web.login";
        $this->view = View()->make( $this->func );

        return $this->view;
    }

    /*
     *
     */
    public function forgotpassword ()
    {
        $this->func = "_template_web.forgotpassword";
        $this->view = View()->make( $this->func );

        return $this->view;
    }

    /*
     *
     */
    public function doLogin ()
    {
        $vAccount = ( Input::has( 'vAccount' ) ) ? Input::get( 'vAccount' ) : "";
        $vPassword = ( Input::has( 'vPassword' ) ) ? Input::get( 'vPassword' ) : "";
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $mapMember )->first();
        if ( !$DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );

            return response()->json( $this->rtndata );
        }
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_password' );

            return response()->json( $this->rtndata );
        }
        if ($DaoMember->iAcType >= 999) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );

            return response()->json( $this->rtndata );
        }
        if ( !$DaoMember->iStatus || !$DaoMember->bActive) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = "您已被停權";

            return response()->json( $this->rtndata );
        }
        $DaoMember->vSessionId = session()->getId();
        $DaoMember->iLoginTime = time();
        $DaoMember->save();

        $DaoSysAgentAccessLV = $DaoMember->iAcType;
        // 選單列表
        $DaoSysMenu = SysMenu::get();

        // 會員選單權限
        $mapMemberAccess = [
            "iMemberId" => $DaoMember->iId,
            "bSet" => 0
        ];
        $DaoMemberAccessList = SysMemberAccess::where( $mapMemberAccess )->pluck( 'iMenuId' );
        $DaoMemberAccessList = json_decode( json_encode( $DaoMemberAccessList ), true );

        // 會員已存在特別功能權限
        $mapMemberAccess = [
            "iMemberId" => $DaoMember->iId,
            "bSet" => 1
        ];
        $DaoMemberAccessListSet = SysMemberAccess::where( $mapMemberAccess )->pluck( 'iMenuId' );
        $DaoMemberAccessListSet = json_decode( json_encode( $DaoMemberAccessListSet ), true );
        foreach ($DaoSysMenu as $key => $var) {
            if ( !in_array( $var->iId, $DaoMemberAccessListSet )) {
                $vAccess_arr = explode( ",", $var->vAccess );
                if ( !in_array( $var->iId, $DaoMemberAccessList )) {
                    $DaoAccess = new SysMemberAccess ();
                    $DaoAccess->iMemberId = $DaoMember->iId;
                    $DaoAccess->iMenuId = $var->iId;
                    $DaoAccess->bOpen = ( $DaoSysAgentAccessLV && in_array( $DaoSysAgentAccessLV, $vAccess_arr ) ) ? 1 : 0;
                    $DaoAccess->bSet = 0;
                    $DaoAccess->save();
                } else {
                    $mapMemberAccess2 = [
                        "iMemberId" => $DaoMember->iId,
                        "iMenuId" => $var->iId
                    ];
                    $DaoAccess2 = SysMemberAccess::where( $mapMemberAccess2 )->first();
                    $DaoAccess2->bOpen = ( $DaoSysAgentAccessLV && in_array( $DaoSysAgentAccessLV, $vAccess_arr ) ) ? 1 : 0;
                    $DaoAccess2->save();
                }
            }
        }
        // 取得會員已存在功能權限array
        $mapMemberAccess = [
            "iMemberId" => $DaoMember->iId
        ];
        $DaoMemberAccessArr = SysMemberAccess::where( $mapMemberAccess )->select( 'iMenuId', 'bOpen' )->get();
        foreach ($DaoMemberAccessArr as $key => $var) {
            session()->put( 'access.' . $var->iMenuId, $var->bOpen );
        }
        // Member
        session()->put( 'member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        $DaoMemberInfo = SysMemberInfo::find( $DaoMember->iId );
        session()->put( 'member.info', json_decode( json_encode( $DaoMemberInfo ), true ) );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'web/index' );

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function doResetPassword ()
    {
        $vVerification = ( Input::has( 'vVerification' ) ) ? Input::get( 'vVerification' ) : "";
        $vPassword = ( Input::has( 'vPassword' ) ) ? Input::get( 'vPassword' ) : "";

        $mapMemberVerification['vVerification'] = $vVerification;
        $mapMemberVerification['iStatus'] = 0;
        $DaoMemberVerification = SysMemberVerification::where( $mapMemberVerification )->find( session( 'verification.memberid' ) );
        if ( !$DaoMemberVerification) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.error' );

            return response()->json( $this->rtndata );
        }

        $DaoMember = SysMember::find( $DaoMemberVerification->iMemberId );
        if ( !$DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.error' );

            return response()->json( $this->rtndata );
        }
        $DaoMember->iUpdateTime = time();
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        if ($DaoMember->save()) {
            $DaoMemberVerification->iStatus = 1;
            $DaoMemberVerification->save();
            session()->flush();
            $this->rtndata ['status'] = 1;
            $this->rtndata ['rtnurl'] = url( 'web/login' );
            $this->rtndata ['message'] = trans( '_web_message.verification.success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.fail' );
        }

        return response()->json( $this->rtndata );
    }
}
