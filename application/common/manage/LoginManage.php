<?php
/** 登录逻辑处理
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/11 0011
 * Time: 10:00
 */

namespace app\common\manage;


use app\common\bean\AdminBean;
use app\common\bean\GlobalBean;
use app\common\exception\MyException;
use app\common\model\AdminModel;
use app\common\utils\TimeUtil;
use app\common\validate\AdminValidate;

class LoginManage
{
    protected static $_self = null;
    static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new LoginManage();
        }
        return self::$_self;
    }

    /** 主后台登录验证
     * @param AdminBean $adminBean
     * @return bool
     * @throws \app\common\exception\ParameterException
     */
    public function adminLogin(AdminBean $adminBean){
        AdminValidate::getInstance()->goCheck(AdminValidate::$login);
        $result = AdminModel::getInstance()->selectData(array(AdminBean::$username => $adminBean->getUsername()));
        $result ?: MyException::throwMyException("无管理员信息");
        ($result[AdminBean::$password] == md5($adminBean->getPassword())) ?: MyException::throwMyException("密码错误");
        $adminBean->setData($result);
        session(GlobalBean::$super,true);//主后台用户
        session(GlobalBean::$username,$adminBean->getUsername());//用户名
        session(GlobalBean::$adminUserId,$adminBean->getId());//登录的用户id
        session(GlobalBean::$adminRoleId,$adminBean->getAdminRoleId());//登录的用户角色
        register_shutdown_function(function() use ($adminBean){
            AdminModel::getInstance()->updatedData(array(AdminBean::$id => $adminBean->getId()),array(AdminBean::$ip => request()->ip(),AdminBean::$loginAt => TimeUtil::getInstance()->getTimeNow()));
        });
        return true;
    }
}