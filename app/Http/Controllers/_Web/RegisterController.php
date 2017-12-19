<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use App\SysMember;
use App\SysMemberInfo;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class RegisterController extends Controller
{
    public $vAgentCode = "PTW10001";

    /*
     *
     */
    public function __construct()
    {
    }

    /*
     *
     */
    public function index()
    {
        $this->func = "_template_web.register";
        $this->view = View()->make($this->func);
        return $this->view;
    }

    /*
     *
     */
    public function doRegister()
    {
        $vUserName = (Input::has('vUserName')) ? Input::get('vUserName') : "";
        $vAccount = (Input::has('vAccount')) ? Input::get('vAccount') : "";
        $vPassword = (Input::has('vPassword')) ? Input::get('vPassword') : "";
        if (!$this->_isValidEmail($vAccount)) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans('_web_message.register.error_account');
            return response()->json($this->rtndata);
        }
        $map ['vAgentCode'] = $this->vAgentCode;
        $map ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where($map)->first();
        if ($DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans('_web_message.register.account_not_empty');
            return response()->json($this->rtndata);
        }
        $str = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8) . '-';
        $uuid .= substr($str, 8, 4) . '-';
        $uuid .= substr($str, 12, 4) . '-';
        $uuid .= substr($str, 16, 4) . '-';
        $uuid .= substr($str, 20, 12);
        do {
            $userid = rand(1000000001, 1999999999);
            $check = SysMember::where("iUserId", $userid)->first();
        } while ($check);
        $DaoMember = new SysMember ();
        $DaoMember->iUserId = $userid;
        $DaoMember->vUserCode = $uuid;
        $DaoMember->vAgentCode = $this->vAgentCode;
        $DaoMember->iAcType = 9; //
        $DaoMember->vAccount = $vAccount;
        $DaoMember->vPassword = hash('sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode);
        $DaoMember->iCreateTime = $DaoMember->iUpdateTime = time();
        $DaoMember->vCreateIP = Request::ip();
        $DaoMember->bActive = 0;
        $DaoMember->iStatus = 1;
        if ($DaoMember->save()) {
            $DaoMemberInfo = new SysMemberInfo ();
            $DaoMemberInfo->iMemberId = $DaoMember->iId;
            $DaoMemberInfo->vUserImage = "/images/empty.jpg";
            $DaoMemberInfo->vUserName = $vUserName;
            $DaoMemberInfo->vUserEmail = $vAccount;
            $DaoMemberInfo->vUserContact = "";
            $DaoMemberInfo->save();
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans('_web_message.register.success');
            $this->rtndata ['rtnurl'] = (session()->has('rtnurl')) ? session()->pull('rtnurl') : url('web/login');
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans('_web_message.register.fail');
        }
        return response()->json($this->rtndata);
    }
}
