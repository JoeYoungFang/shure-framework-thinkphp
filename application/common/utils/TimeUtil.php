<?php

/**
 * 时间工具类
 */
namespace app\common\utils;

use app\common\bean\ListMap;

class TimeUtil extends BaseUtil
{
    static $_self = null;

    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new TimeUtil();
        }
        return self::$_self;
    }

    /** 获取时间
     * @param string $format
     * @return false|string
     */
    public function getTimeNow($format = "Y-m-d H:i:s"){
        return date($format);
    }

    /** 处理后台搜索时间间隔
     * @param ListMap $listMap
     * @return array|bool
     */
    public function dealBetweenTime(ListMap $listMap){
        if($this->getParamBool($listMap,"beginTime")){
            if($this->getParamBool($listMap,"endTime")){
                $timeArray = array("between time",[$listMap->getParameter("beginTime"),$listMap->getParameter("endTime")]);
            }else{
                $timeArray = array(">",$listMap->getParameter("beginTime"));
            }
        }else{
            if($this->getParamBool($listMap,"endTime")){
                $timeArray = array("<",$listMap->getParameter("endTime"));
            }
        }
        if(isset($timeArray)){
            //array_unshift($timeArray,$field);
            return $timeArray;
        }
        return false;
    }

    /** 获取搜索的参数是否参与/存在
     * @param ListMap $listMap
     * @param         $param
     * @return bool
     */
    private function getParamBool(ListMap $listMap,$param){
        $data = $listMap->getData();
        if(!isset($data[$param]) || $data[$param] == ''){
            return false;
        }
        return true;
    }
}