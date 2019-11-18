<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 19/9/18
 * Time: 09:30
 */

namespace app\admin\controller;


use app\common\bean\AdminBean;
use app\common\bean\ListMap;
use app\common\controller\AdminController;
use app\common\manage\AdminManage;
use app\common\manage\AdminRoleManage;
use app\common\utils\ExitJsonUtil;
use think\Exception;

class Admin extends AdminController
{
    /**
     * 管理员列表
     */
    public function userList(){
        $listMap = new ListMap();
        $listMap->setData($this->getParams);
        $userMap = AdminManage::getInstance()->getPaginatorList($listMap);
        $adminRoleSelect = AdminRoleManage::getInstance()->getAdminRoleSelect();
        $this->assign("roleList",$userMap->getList());
        $this->assign("currentPage",$userMap->getCurrentPage());
        $this->assign("totalCount",$userMap->getTotalCount());
        $this->assign('adminRoleSelect',$adminRoleSelect);
        return $this->fetch();
    }

    /**
     * 添加管理员
     * @throws Exception
     */
    public function addUser(){
        if(request()->isPost()){
            $adminBean = new AdminBean();
            $adminBean->setData($this->postParams);
            $result = AdminManage::getInstance()->add($adminBean);
            ExitJsonUtil::getInstance()->exitData($result);
        }
        $adminRoleSelect = AdminRoleManage::getInstance()->getAdminRoleSelect();
        $this->assign('adminRoleSelect',$adminRoleSelect);
        return $this->fetch();
    }

    /**
     * 修改管理员
     * @throws Exception
     */
    public function editUser(){
        $adminBean = new AdminBean();
        $adminBean->setData($this->getParams);
        if(request()->isPost()){
            $adminBean->setData($this->postParams);
            $result = AdminManage::getInstance()->edit($adminBean);
            ExitJsonUtil::getInstance()->exitData($result);
        }
        $adminBean = AdminManage::getInstance()->getInfo($adminBean);
        $adminRoleSelect = AdminRoleManage::getInstance()->getAdminRoleSelect();
        $this->assign('self',false);
        $this->assign('adminRoleSelect',$adminRoleSelect);
        $this->assign('admin',$adminBean->getData());
        return $this->fetch();
    }

    /**
     * 删除管理员
     * @throws Exception
     */
    public function delUser(){
        $adminBean = new AdminBean();
        $adminBean->setData($this->getParams);
        $result = AdminManage::getInstance()->delete($adminBean);
        ExitJsonUtil::getInstance()->exitData($result);
    }
}