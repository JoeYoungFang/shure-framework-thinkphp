<?php
/** 主后台基础控制器，Session -> redis验证
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 15:27
 */

namespace app\common\controller;


use app\common\bean\AdminPermissionBean;
use app\common\bean\GlobalBean;
use app\common\exception\MyException;
use app\common\manage\AdminRolePermissionManage;
use app\common\utils\PermissionUtil;
use think\App;

class AdminController extends BaseController
{
    public function __construct(?App $app = null) {
        parent::__construct($app);
        session(GlobalBean::$super) ?:MyException::throwMyException(GlobalBean::$goLogin);
        if(!request()->isAjax()){
            $permissionStringArray = PermissionUtil::getInstance()->getSessionPermission(request()->module(),request()->controller());
            $this->assign('permissionStringArray',$permissionStringArray);
        }
        $this->checkActionPermission();
    }

    /**
     * 检测action权限
     */
    private function checkActionPermission(){
        if(session(GlobalBean::$adminRoleId) !== GlobalBean::$superAdminId){
            $adminPermissionBean = new AdminPermissionBean();
            $adminPermissionBean->setModel(request()->module());
            $adminPermissionBean->setController(request()->controller());
            $adminPermissionBean->setAction(request()->action());
            AdminRolePermissionManage::getInstance()->checkRolePermission(session(GlobalBean::$adminRoleId),$adminPermissionBean);
        }
    }

}