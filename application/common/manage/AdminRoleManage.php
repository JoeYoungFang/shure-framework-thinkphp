<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\manage;

use app\common\bean\AdminBean;
use app\common\bean\AdminRoleBean;
use app\common\bean\GlobalBean;
use app\common\bean\ListMap;
use app\common\exception\MyException;
use app\common\model\AdminModel;
use app\common\model\AdminRoleModel;
use app\common\utils\TimeUtil;
use app\common\validate\AdminRoleValidate;
use think\Exception;

class AdminRoleManage extends BaseManage
{
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminRoleManage();
		}
		return self::$_self;
	}

    /**获取分页数据
     * @param ListMap $listMap
     * @return mixed
     */
    public function getPaginatorList(ListMap $listMap) {
        $conditionMap = new ListMap();
        if($timeArray = TimeUtil::getInstance()->dealBetweenTime($listMap)){
            $conditionMap->setParameter(AdminRoleBean::$alias.POINST.AdminRoleBean::$createdAt,$timeArray);
        }
        !$this->getParamBool($listMap,"orderFieldName") ?: $conditionMap->setParameter('order',AdminRoleBean::$alias.POINST.$listMap->getParameter('orderFieldName')." ".$listMap->getParameter('orderType'));
        $conditionMap->setParameter(AdminRoleBean::$alias.POINST.AdminRoleBean::$name,array("like" ,'%'.$listMap->getParameter(AdminRoleBean::$name).'%'));
        $conditionMap->setAlias(AdminRoleBean::$alias);
        $conditionMap->setField(AdminRoleBean::$alias.POINST."*,count(".AdminBean::$alias.POINST.AdminBean::$id.") as user_count");
        $conditionMap->setJoin(array(AdminBean::$tableName,AdminBean::$alias,AdminRoleBean::$alias.POINST.AdminRoleBean::$id,AdminBean::$alias.POINST.AdminBean::$adminRoleId,'left'));
        $conditionMap->setGroup(AdminRoleBean::$alias.POINST.AdminRoleBean::$id);
        $roleMap = AdminRoleModel::getInstance()->getJoinList($conditionMap);
        $roleMap ?:MyException::throwMyException("查询数据失败");
        return $roleMap;
    }

    /**添加数据
     * @param AdminRoleBean $adminRoleBean
     * @return mixed
     * @throws Exception
     */
    public function add($adminRoleBean) {
        // TODO: Implement add() method.
        AdminRoleValidate::getInstance()->goCheck(AdminRoleValidate::$add,$adminRoleBean->getData());
        $adminRoleBean->setCreatedAt(TimeUtil::getInstance()->getTimeNow());
        $result = AdminRoleModel::getInstance()->addDataGetInsertId($adminRoleBean->getData());
        $result ?: MyException::throwMyException("插入数据失败");
        return $result;
    }

    /**编辑数据
     * @param AdminRoleBean $adminRoleBean
     * @return mixed
     * @throws Exception
     */
    public function edit($adminRoleBean) {
        // TODO: Implement edit() method.
        AdminRoleValidate::getInstance()->goCheck(AdminRoleValidate::$edit,$adminRoleBean->getData());
        $result = AdminRoleModel::getInstance()->updatedData(array(AdminRoleBean::$id => $adminRoleBean->getId()),$adminRoleBean->getData());
        $result ?: MyException::throwMyException("更新失败");
        return $result;
    }

    /**删除数据
     * @param AdminRoleBean $adminRoleBean
     * @return mixed
     * @throws Exception
     */
    public function delete($adminRoleBean) {
        // TODO: Implement delete() method.
        AdminRoleValidate::getInstance()->goCheck(AdminRoleValidate::$edit,$adminRoleBean->getData());
        if($adminRoleBean->getId() == GlobalBean::$superRoleId){
            MyException::throwMyException("不可删除超级管理角色");
        }
        $userCount = AdminModel::getInstance()->getCount(array(AdminBean::$adminRoleId => $adminRoleBean->getId()));
        !$userCount ?: MyException::throwMyException("请先删除该角色用户");
        $result = AdminRoleModel::getInstance()->deleteData(array(AdminRoleBean::$id => $adminRoleBean->getId()));
        $result ?: MyException::throwMyException("删除角色失败");
        return true;
    }

    /**根据主建获取数据
     * @param AdminRoleBean $adminRoleBean
     * @return mixed
     * @throws Exception
     */
    public function getInfo($adminRoleBean) {
        // TODO: Implement getInfo() method.
        AdminRoleValidate::getInstance()->goCheck(AdminRoleValidate::$edit,$adminRoleBean->getData());
        $result = AdminRoleModel::getInstance()->selectData(array(AdminRoleBean::$id => $adminRoleBean->getId()));
        $result ?:MyException::throwMyException("获取角色信息失败");
        $adminRoleBean->setData($result);
        return $adminRoleBean;
    }

    /** 获取
     * @return array
     */
    public function getAdminRoleSelect(){
        $allAdminRole = AdminRoleModel::getInstance()->selectData(array(),true);
        $adminRoleSelect = $this->modelToInputSelect($allAdminRole,AdminRoleBean::$id,AdminRoleBean::$name);
        return $adminRoleSelect;
    }

}