<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\manage;

use app\common\bean\AdminBean;
use app\common\bean\AdminRoleBean;
use app\common\bean\BaseBean;
use app\common\bean\GlobalBean;
use app\common\bean\ListMap;
use app\common\exception\MyException;
use app\common\model\AdminModel;
use app\common\utils\TimeUtil;
use app\common\validate\AdminValidate;
use think\Exception;

class AdminManage extends BaseManage
{
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminManage();
		}
		return self::$_self;
	}

    /**获取分页数据
     * @param ListMap $listMap
     * @return mixed
     */
    public function getPaginatorList(ListMap $listMap) {
        // TODO: Implement getPaginatorList() method.
        $conditionMap = new ListMap();
        if($timeArray = TimeUtil::getInstance()->dealBetweenTime($listMap)){
            $conditionMap->setParameter(AdminBean::$alias.POINST.AdminBean::$createdAt,$timeArray);
        }
        !$this->getParamBool($listMap,"orderFieldName") ?: $conditionMap->setParameter('order',AdminBean::$alias.POINST.$listMap->getParameter('orderFieldName')." ".$listMap->getParameter('orderType'));
        $conditionMap->setParameter(AdminBean::$alias.POINST.AdminBean::$realname,['like','%'.$listMap->getParameter(AdminBean::$realname).'%']);
        $conditionMap->setParameter(AdminBean::$adminRoleId,$listMap->getParameter(AdminBean::$adminRoleId));
        $conditionMap->setField(AdminBean::$alias.POINST."*,".AdminRoleBean::$alias.POINST.AdminRoleBean::$name);
        $conditionMap->setAlias(AdminBean::$alias);
        $conditionMap->setJoin([AdminRoleBean::$tableName,AdminRoleBean::$alias,AdminRoleBean::$alias.POINST.AdminRoleBean::$id,AdminBean::$alias.POINST.AdminBean::$adminRoleId]);
        $userMap = AdminModel::getInstance()->getJoinList($conditionMap);
        $userMap ?: MyException::throwMyException("查询失败");
        return $userMap;
    }

    /**添加数据
     * @param AdminBean $adminBean
     * @return mixed
     * @throws Exception
     */
    public function add($adminBean) {
        // TODO: Implement add() method.
        AdminValidate::getInstance()->goCheck(AdminValidate::$add,$adminBean->getData());
        $adminBean->setCreatedAt(TimeUtil::getInstance()->getTimeNow());
        $adminBean->setPassword(md5($adminBean->getPassword()));
        $result = AdminModel::getInstance()->addDataGetInsertId($adminBean->getData());
        $result ?: MyException::throwMyException("插入用户失败");
        return $result;
    }

    /**编辑数据
     * @param AdminBean $adminBean
     * @param  bool     $self
     * @return mixed
     * @throws Exception
     */
    public function edit($adminBean,$self = false) {
        // TODO: Implement edit() method.
        AdminValidate::getInstance()->goCheck(AdminValidate::$edit,$adminBean->getData());
        !$adminBean->getPassword() ?: $adminBean->setPassword(md5($adminBean->getPassword()));
        if($adminBean->getId() == GlobalBean::$superAdminId && !$self){
            MyException::throwMyException("不可修改超级管理员");
        }
        $result = AdminModel::getInstance()->updatedData(array(AdminBean::$id => $adminBean->getId()),$adminBean->getData());
        $result !== false ?: MyException::throwMyException("修改失败");
        return $result;
    }

    /**删除数据
     * @param AdminBean $adminBean
     * @return mixed
     * @throws Exception
     */
    public function delete($adminBean) {
        // TODO: Implement delete() method.
        AdminValidate::getInstance()->goCheck(AdminValidate::$pkId,$adminBean->getData());
        if($adminBean->getId() == GlobalBean::$superAdminId){
            MyException::throwMyException("不可删除超级管理员");
        }
        $result = AdminModel::getInstance()->deleteData(array(AdminBean::$id => $adminBean->getId()));
        $result ?: MyException::throwMyException("删除失败");
        return $result;
    }

    /**根据主建获取数据
     * @param AdminBean $adminBean
     * @return mixed
     * @throws Exception
     */
    public function getInfo($adminBean) {
        // TODO: Implement getInfo() method.
        AdminValidate::getInstance()->goCheck(AdminValidate::$pkId,$adminBean->getData());
        $result = AdminModel::getInstance()->selectData(array(AdminBean::$id => $adminBean->getId()));
        $result ?: MyException::throwMyException("查询失败");
        $adminBean->setData($result);
        return $adminBean;
    }
}