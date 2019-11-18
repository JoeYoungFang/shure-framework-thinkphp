<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 17:15
 */

namespace app\admin\controller;

use app\common\bean\AdminRolePermissionBean;
use app\common\bean\GlobalBean;
use app\common\exception\MyException;
use app\common\manage\AdminRolePermissionManage;
use think\Controller;
use think\App;

class Index extends Controller
{
    public function __construct(App $app = null){
        parent::__construct($app);
        session(GlobalBean::$super) ?:MyException::throwMyException(GlobalBean::$goLogin);
    }

    /** 主后台首页
     * @return mixed
     * @throws \Exception
     */
    public function index(){
        $adminRolePermissionBean = new AdminRolePermissionBean();
        $adminRolePermissionBean->setAdminRoleId(session(GlobalBean::$adminRoleId));
        $permissionTree = AdminRolePermissionManage::getInstance()->getAdminRolePermissionTree($adminRolePermissionBean);
        $this->assign('permissionTree',$permissionTree);
        return $this->fetch();
    }

    /** 欢迎页面
     * @return mixed
     */
    public function welcome(){
        return $this->fetch();
    }
}