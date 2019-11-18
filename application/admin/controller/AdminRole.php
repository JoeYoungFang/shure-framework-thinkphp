<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/12 0012
 * Time: 9:52
 */

namespace app\admin\controller;

use app\common\bean\AdminRoleBean;
use app\common\bean\AdminRolePermissionBean;
use app\common\bean\ListMap;
use app\common\controller\AdminController;
use app\common\manage\AdminRoleManage;
use app\common\manage\AdminRolePermissionManage;
use app\common\utils\ExitJsonUtil;
use think\Exception;

class AdminRole extends AdminController
{
    /** 获取角色列表
     * @return mixed
     */
    public function roleList(){
        $listMap = new ListMap();
        $listMap->setData($this->getParams);
        $roleListMap = AdminRoleManage::getInstance()->getPaginatorList($listMap);
        $this->assign("roleList",$roleListMap->getList());
        $this->assign("currentPage",$roleListMap->getCurrentPage());
        $this->assign("totalCount",$roleListMap->getTotalCount());
        return $this->fetch();
    }

    /**
     * 添加角色
     * @throws Exception
     */
    public function addRole(){
        if(request()->isPost()){
           $adminRoleBean = new AdminRoleBean();
           $adminRoleBean->setData($this->postParams);
           $result = AdminRoleManage::getInstance()->add($adminRoleBean);
           ExitJsonUtil::getInstance()->exitData($result);
        }
        return $this->fetch();
    }

    /**
     * 修改角色
     * @throws Exception
     */
    public function editRole(){
        $adminRoleBean = new AdminRoleBean();
        $adminRoleBean->setData($this->getParams);
        if(request()->isPost()){
            $adminRoleBean->setData($this->postParams);
            $result = AdminRoleManage::getInstance()->edit($adminRoleBean);
            ExitJsonUtil::getInstance()->exitData($result);
        }
        $adminRoleBean = AdminRoleManage::getInstance()->getInfo($adminRoleBean);
        $this->assign('adminRole',$adminRoleBean->getData());
        return $this->fetch();
    }

    /**
     * 删除角色
     * @throws Exception
     */
    public function delRole(){
        $adminRoleBean= new AdminRoleBean();
        $adminRoleBean->setData($this->getParams);
        $result = AdminRoleManage::getInstance()->delete($adminRoleBean);
        ExitJsonUtil::getInstance()->exitData($result);
    }

    /** 分配主后台角色权限
     * @return mixed
     * @throws \Exception
     */
    public function allocationPermissions(){
        $admimRolePermissionBean = new AdminRolePermissionBean();
        $admimRolePermissionBean->setData($this->getParams);
        if(request()->isPost()){
            $permissionIds = $this->postParams['ids'] ?? [];
            $result = AdminRolePermissionManage::getInstance()->allocationPermissions($admimRolePermissionBean,$permissionIds);
            ExitJsonUtil::getInstance()->exitData($result);
        }
        $permissionTree = AdminRolePermissionManage::getInstance()->getAdminRoleHavePermissionTree($admimRolePermissionBean);
        $this->assign('permissionTree',json_encode($permissionTree));
        return $this->fetch();
    }
}