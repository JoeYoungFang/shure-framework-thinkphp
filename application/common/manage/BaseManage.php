<?php
    /**基础管理里类
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018\6\12 0012
     * Time: 19:15
     */
namespace app\common\manage;

use app\common\bean\ListMap;
use app\common\exception\MyException;
use think\Model;

abstract class BaseManage implements IBaseManage
{
    protected $error = "";

    /**单例，防止new 对象
     * final防止子类重写
     * BaseManage constructor.
     */
    final protected function __construct() {

    }

    /** 获取搜索的参数是否参与/存在
     * @param ListMap $listMap
     * @param         $param
     * @return bool
     */
    public function getParamBool(ListMap $listMap,$param){
        $data = $listMap->getData();
        if(!isset($data[$param]) || $data[$param] == ''){
            return false;
        }
        return true;
    }

    /**把获取的null值置空''数据表不予许null字段
     * @param $array
     */
    public function setEmptyValue(&$array){
        foreach ($array as $key => $value){
            if($value === null){
                $array[$key] = '';
            }
        }
    }

    /**
     * 检测客户的数据操作权限
     * @param $Field
     * @param $Id
     * @param $model Model
     * @param $idField
     * @param $id
     * @return bool
     */
    public function checkDataPermssion($Field,$Id,$model,$idField,$id){
        if(empty($Id)){//无数据时默认通过
           return true;
        }
        $condition[$Field] = intval($Id);
        $condition[$idField] = intval($id);
        try {
            if (!$result = $model->where($condition)->find()) {
                throw MyException::throwMyException("无权限操作该数据");
            }
        } catch (\Exception $e) {
            throw MyException::throwMyException($e->getMessage());
        }
        return $result;
    }

    /** 组装获取select数据
     * @param $modelList
     * @param $fieldId
     * @param $fieldName
     * @return array
     */
    public function modelToInputSelect($modelList,$fieldId,$fieldName){
        $select = array();
        foreach ($modelList as $value){
            $select[$value[$fieldId]] = $value[$fieldName];
        }
        return $select;
    }

    /** 组装获取select数据
     * @param $modelList
     * @param $fieldId
     * @param $fieldName
     * @return array
     */
    public function modelToSearchSelect($modelList,$fieldId,$fieldName){
        $select = array();
        foreach ($modelList as $key => $value){
            $select[$key] = ['value' => $value[$fieldId],'key' => $value[$fieldName]];
        }
        return $select;
    }

    /**获取错误信息
     * @return string
     */
    public function getError(){
        return $this->error;
    }
}