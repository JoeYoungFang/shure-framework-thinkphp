<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 13:41
 */

namespace app\common\utils;


class CommonUtil extends BaseUtil
{
    static $_self = null;
    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new CommonUtil();
        }
        return self::$_self;
    }

    /** 获取唯一订单号
     * @param string $fix
     * @param int $count
     * @return string
     */
    public function getUnique($fix = "",$count = 5){
        $orderNumber = $fix.date("YmdHis");
        for($i = 0;$i < $count;$i++){
            $orderNumber .= rand(0,9);
        }
        return $orderNumber;
    }

    /** 获取客户ip
     * @return mixed
     */
    public function getCentIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipaddress;
    }
}