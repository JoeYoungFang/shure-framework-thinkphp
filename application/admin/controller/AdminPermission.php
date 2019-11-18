<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 19/9/17
 * Time: 15:45
 */

namespace app\admin\controller;


use app\common\bean\AdminPermissionBean;
use app\common\controller\AdminController;
use app\common\manage\AdminPermissionManage;
use app\common\manage\AdminRolePermissionManage;
use app\common\utils\ExitJsonUtil;
use think\Exception;

class AdminPermission extends AdminController
{
    /** 权限列表
     * @return mixed
     */
    public function permissionList(){
        list($permissionTree,$permissionCount) = AdminRolePermissionManage::getInstance()->getAllPermissionTree();
        $this->assign("permissionTree",json_encode($permissionTree));
        $this->assign("totalCount",$permissionCount);
        return $this->fetch();
    }

    /**添加顶级权限节点
     * @return mixed
     * @throws Exception
     */
    public function addTopPermission(){
        if(request()->isPost()){
            $adminPermission = new AdminPermissionBean();
            $adminPermission->setData($this->postParams);
            $result = AdminPermissionManage::getInstance()->add($adminPermission,true);
            ExitJsonUtil::getInstance()->exitData($result);
        }
        $this->assign("parentPermissionDetail",false);
        return $this->fetch("add_permission");
    }

    /**添加子权限节点
     * @return mixed
     * @throws Exception
     */
    public function addChildPermission(){
        $adminPermission = new AdminPermissionBean();
        $adminPermissionManage = AdminPermissionManage::getInstance();
        if(request()->isAjax() && request()->isPost()){
            $adminPermission->setData($this->postParams);
            $resdutl = $adminPermissionManage->add($adminPermission);
            ExitJsonUtil::getInstance()->exitData($resdutl);
        }
        $adminPermission->setData($this->getParams);
        $adminPermission = $adminPermissionManage->getInfo($adminPermission);
        $this->assign("parentPermissionDetail",$adminPermission->getData());
        return $this->fetch("add_permission");
    }

    /**
     * 编辑权限节点
     * @throws Exception
     */
    public function editPermission(){
        $adminPermissionBean = new AdminPermissionBean();
        $permissionManage = AdminPermissionManage::getInstance();
        if(request()->isAjax() && request()->isPost()){
            $adminPermissionBean->setData($this->postParams);
            $result = $permissionManage->edit($adminPermissionBean,!$adminPermissionBean->getParentId());
            ExitJsonUtil::getInstance()->exitData($result);
        }

        $adminPermissionBean->setData($this->getParams);
        $adminPermissionBean = $permissionManage->getInfo($adminPermissionBean);
        if($adminPermissionBean->getParentId()){
            $parentPermissionBean = new AdminPermissionBean();
            $parentPermissionBean->setId($adminPermissionBean->getParentId());
            $parentPermissionDetail = $permissionManage->getInfo($parentPermissionBean);
        }
        $this->assign("parentPermissionDetail",isset($parentPermissionDetail) ? $parentPermissionDetail->getData() : false);
        $this->assign("permissionDetail",$adminPermissionBean->getData());
        return $this->fetch();
    }

    /**
     * 删除权限节点
     * @throws Exception
     */
    public function delPermission(){
        $adminPermissionBean = new AdminPermissionBean();
        $adminPermissionBean->setData($this->postParams);
        $result = AdminPermissionManage::getInstance()->delete($adminPermissionBean);
        ExitJsonUtil::getInstance()->exitData($result);
    }
}