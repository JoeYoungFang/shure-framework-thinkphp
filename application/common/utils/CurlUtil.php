<?php


namespace app\common\utils;


class CurlUtil extends BaseUtil
{
    static $_self = null;
    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new CurlUtil();
        }
        return self::$_self;
    }

    /** curl请求
     * @param       $url
     * @param       $postData
     * @return bool|string
     */
    public function httpCurl($url, $postData,$header = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header ?: array('content-type:application/json'));
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $data = curl_exec($ch);
        if($data === false) {
            $this->error = curl_error($ch);
            return false;
        }
        curl_close($ch);
        return $data;
    }
}