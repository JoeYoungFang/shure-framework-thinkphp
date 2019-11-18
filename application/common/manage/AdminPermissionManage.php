<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\manage;

use app\common\bean\AdminPermissionBean;
use app\common\bean\AdminRolePermissionBean;
use app\common\bean\GlobalBean;
use app\common\bean\ListMap;
use app\common\exception\MyException;
use app\common\model\AdminPermissionModel;
use app\common\model\AdminRolePermissionModel;
use app\common\validate\AdminPermissionValidate;
use think\Exception;

class AdminPermissionManage extends BaseManage
{
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminPermissionManage();
		}
		return self::$_self;
	}

    /**获取分页数据 权限非分页获取
     * @param ListMap $listMap
     * @return mixed
     */
    public function getPaginatorList(ListMap $listMap) {
        // TODO: Implement getPaginatorList() method.
        return true;
    }

    /**添加数据
     * @param AdminPermissionBean $adminPermissionBean
     * @param bool                $topPermission
     * @return mixed
     * @throws Exception
     */
    public function add($adminPermissionBean,$topPermission = false) {
        // TODO: Implement add() method.
        if($topPermission){
            AdminPermissionValidate::getInstance()->goCheck(AdminPermissionValidate::$addParent,$adminPermissionBean->getData());
        }else{
            AdminPermissionValidate::getInstance()->goCheck(AdminPermissionValidate::$addChild,$adminPermissionBean->getData());
        }
        $result = AdminPermissionModel::getInstance()->addDataGetInsertId($adminPermissionBean->getData());
        $result ?: MyException::throwMyException("添加权限失败");
        $adminRolePermissioBean = new AdminRolePermissionBean();
        $adminRolePermissioBean->setAdminRoleId(GlobalBean::$superAdminId);
        $adminRolePermissioBean->setAdminPermissionId($result);
        AdminRolePermissionModel::getInstance()->addDataGetInsertId($adminRolePermissioBean->getData());
        return true;
    }

    /**编辑数据
     * @param AdminPermissionBean $adminPermissionBean
     * @param bool $topPermission
     * @return mixed
     * @throws Exception
     */
    public function edit($adminPermissionBean,$topPermission = false) {
        // TODO: Implement edit() method.
        if($topPermission){
            AdminPermissionValidate::getInstance()->goCheck(AdminPermissionValidate::$editParent,$adminPermissionBean->getData());
        }else{
            AdminPermissionValidate::getInstance()->goCheck(AdminPermissionValidate::$editChild,$adminPermissionBean->getData());
        }
        $result = AdminPermissionModel::getInstance()->updatedData(array(AdminPermissionBean::$id => $adminPermissionBean->getId()),$adminPermissionBean->getData());
        $result ?:MyException::throwMyException("更新权限失败");
        return $result;
    }

    /**删除数据
     * @param AdminPermissionBean $adminPermissionBean
     * @return mixed
     * @throws Exception
     */
    public function delete($adminPermissionBean) {
        // TODO: Implement delete() method.
        AdminPermissionValidate::getInstance()->goCheck(AdminPermissionValidate::$pkId,$adminPermissionBean->getData());
        $childCount = AdminPermissionModel::getInstance()->getCount(array(AdminPermissionBean::$parentId => $adminPermissionBean->getId()));
        if($childCount === false || $childCount != 0){
            MyException::throwMyException("请先删除子权限/查询出错");
        }
        $result = AdminPermissionModel::getInstance()->deleteData(array(AdminPermissionBean::$id => $adminPermissionBean->getId()));
        $result ?: MyException::throwMyException("删除出错");
        AdminRolePermissionModel::getInstance()->deleteData(array(AdminRolePermissionBean::$adminPermissionId => $adminPermissionBean->getId()));
        return $result;
    }

    /**根据主建获取数据
     * @param AdminPermissionBean $adminPermissionBean
     * @return AdminPermissionBean
     * @throws Exception
     */
    public function getInfo($adminPermissionBean) {
        // TODO: Implement getInfo() method.
        AdminPermissionValidate::getInstance()->goCheck(AdminPermissionValidate::$pkId,$adminPermissionBean->getData());
        $result = AdminPermissionModel::getInstance()->selectData(array(AdminPermissionBean::$id => $adminPermissionBean->getId()));
        $result ?:MyException::throwMyException("查询权限失败");
        $adminPermissionBean->setData($result);
        return $adminPermissionBean;
    }
}