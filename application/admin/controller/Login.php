<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/10 0010
 * Time: 9:58
 */

namespace app\admin\controller;


use app\common\bean\AdminBean;
use app\common\exception\MyException;
use app\common\manage\LoginManage;
use app\common\utils\ExitJsonUtil;
use app\common\utils\VcodeUtil;
use think\Controller;

class Login extends Controller
{
    /** 登录界面
     * @return mixed
     */
    public function login(){
        return $this->fetch();
    }

    /**
     * 检测登录
     */
    public function checkLogin(){
        if(!VcodeUtil::getInstance()->checkCaptcha(request()->post("vcode"))){
            MyException::throwMyException("验证码错误");
        }
        try{
            $adminBean = new AdminBean();
            $adminBean->setData(request()->post());
            $result = LoginManage::getInstance()->adminLogin($adminBean);
            ExitJsonUtil::getInstance()->exitData($result);
        }catch (\Exception $exception){
            MyException::throwMyException("账户或密码错误");
        }
    }

    /**
     * 后台用户主动退出，清除保持登录cookie及后台身份session
     */
    public function loginOut(){
        session(null);
        ExitJsonUtil::getInstance()->exitData("登出成功");
    }

    /**获取验证码
     * @return \think\Response
     */
    public function getVcode(){
        return VcodeUtil::getInstance()->getCaptcha();
    }
}