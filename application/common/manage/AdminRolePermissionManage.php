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
use app\common\utils\PermissionUtil;
use app\common\validate\AdminRolePermissionValidate;
use Exception;

class AdminRolePermissionManage
{
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminRolePermissionManage();
		}
		return self::$_self;
	}

    /** 获取主后台对应角色的权限树
     * @param AdminRolePermissionBean $adminRolePermissionBean
     * @return array
     * @throws Exception
     */
	public function getAdminRolePermissionTree(AdminRolePermissionBean $adminRolePermissionBean){
        $allAdminRolePermission = $this->getRolePermissionlist($adminRolePermissionBean);
        session(GlobalBean::$permissionList,$allAdminRolePermission);
        $permissionTree = PermissionUtil::getInstance()->getTreesData($allAdminRolePermission);
        return $permissionTree;
    }

    /** 获取角色拥有的权限列表
     * @param AdminRolePermissionBean $adminRolePermissionBean
     * @return ListMap|array|bool
     * @throws Exception
     */
    public function getRolePermissionlist(AdminRolePermissionBean $adminRolePermissionBean){
        AdminRolePermissionValidate::getInstance()->goCheck(AdminRolePermissionValidate::$id);
        $mixedMap = new ListMap();
        $mixedMap->setAlias(AdminRolePermissionBean::$alias);
        $mixedMap->setField(AdminPermissionBean::$alias.POINST.ALL_FIELD);
        $mixedMap->setOrder([AdminPermissionBean::$alias.POINST.AdminPermissionBean::$parentId,AdminPermissionBean::$alias.POINST.AdminPermissionBean::$sort]);
        $mixedMap->setJoin(array(AdminPermissionBean::$tableName,AdminPermissionBean::$alias,AdminPermissionBean::$alias.POINST.AdminPermissionBean::$id,AdminRolePermissionBean::$alias.POINST.AdminRolePermissionBean::$adminPermissionId));
        $mixedMap->setParameter(AdminRolePermissionBean::$alias.POINST.AdminRolePermissionBean::$adminRoleId,$adminRolePermissionBean->getAdminRoleId());
        $allAdminRolePermission = AdminRolePermissionModel::getInstance()->getJoinList($mixedMap,true);
        $allAdminRolePermission !== false ?:MyException::throwMyException("获取权限列表失败");
        return $allAdminRolePermission;
    }

    /** 获取角色权限树详情
     * @param AdminRolePermissionBean $adminRolePermissionBean
     * @return array|bool|false
     * @throws Exception
     */
    public function getAdminRoleHavePermissionTree(AdminRolePermissionBean $adminRolePermissionBean){
        $rolePermission = $this->getRolePermissionlist($adminRolePermissionBean);
        $allPermission = AdminPermissionModel::getInstance()->selectData(array(),true);
        $allPermission = PermissionUtil::getInstance()->twoPermiisionListCheck($allPermission,$rolePermission);
        $permissionTree = PermissionUtil::getInstance()->getTreesData($allPermission);
        return $permissionTree;
    }

    /** 获取全部的权限树、总数
     * @return array
     */
    public function getAllPermissionTree(){
        $allPermission = AdminPermissionModel::getInstance()->selectData(array(),true);
        $permissionTree = PermissionUtil::getInstance()->getTreesData($allPermission);
        return array($permissionTree,count($allPermission));
    }

    /** 分配修改角色权限
     * @param AdminRolePermissionBean $adminRolePermissionBean
     * @param $permissionIds
     * @return bool
     * @throws Exception
     */
    public function allocationPermissions(AdminRolePermissionBean $adminRolePermissionBean,$permissionIds){
        $adminRolePermissionBean->getAdminRoleId() != GlobalBean::$superAdminId ?: MyException::throwMyException("不可修改超级管理权限");
        $adminRolePermissionModel = AdminRolePermissionModel::getInstance();
        $adminRolePermissionModel->startTrans();
        try{
            $temp[AdminRolePermissionBean::$adminRoleId] = $adminRolePermissionBean->getAdminRoleId();
            $data = [];
            $result = $adminRolePermissionModel->deleteData(array(AdminRolePermissionBean::$adminRoleId => $adminRolePermissionBean->getAdminRoleId()));
            $result !== false ?:MyException::throwMyException("删除旧权限失败");
            foreach ($permissionIds as $value){
                $temp[AdminRolePermissionBean::$adminPermissionId] = $value;
                $data[] = $temp;
            }
            $adminRolePermissionModel->insertAll($data);
            $adminRolePermissionModel->commit();
        }catch (Exception $exception){
            $adminRolePermissionModel->rollback();
            MyException::throwMyException($exception->getMessage());
        }
        return true;
    }

    /** 检测是否有权限
     * @param $loginRoleId
     * @param AdminPermissionBean $adminPermissionBean
     * @return bool
     */
    public function checkRolePermission($loginRoleId,AdminPermissionBean $adminPermissionBean){
        $reuslt = AdminPermissionModel::getInstance()->getRolePermissionDetail($loginRoleId,$adminPermissionBean);
        return boolval($reuslt);
    }
}