<?php


namespace app\common\utils;

use Exception;

class RASUtil extends BaseUtil
{
    private $privateKey;
    private $publicKey;

    /**
     * RASUtil constructor.
     * @param $privateKey
     * @param $publicKey
     */
    protected function __construct($privateKey, $publicKey) {
        parent::__construct();
        $this->privateKey = $this->splitPriveteKey($privateKey);
        $this->publicKey = $this->splitPublicKey($publicKey);
    }

    static $_self = null;
    public static function getInstance($privateKey = "",$publicKey = ""){
        if(empty(self::$_self)){
            $privateKey ?: $privateKey = config('project.TOKEN.PRIVATEKEY');
            $publicKey ?: $publicKey = config('project.TOKEN.PUBLICKEY');
            self::$_self = new RASUtil($privateKey, $publicKey);
        }
        return self::$_self;
    }

    /** 加密数据
     * @param $data
     * @return string
     */
    public function encrupt($data){
        try{
            $encrypted = "";
            $pi_key = openssl_pkey_get_private($this->privateKey);
            openssl_private_encrypt($data,$encrypted,$pi_key);//私钥加密
            $encrypted = base64_encode($encrypted);
            return $encrypted;
        }catch (Exception $exception){
            $this->error = $exception->getMessage();
            return false;
        }
    }

    /** 解密数据
     * @param $encrypted
     * @return mixed
     */
    public function decrypt($encrypted){
        try{
            $decrypted = "";
            $pu_key = openssl_pkey_get_public($this->publicKey);//这个函数可用来判断公钥是否是可用的
            openssl_public_decrypt(base64_decode($encrypted),$decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来
            return $decrypted;
        }catch (Exception $exception){
            $this->error = $exception->getMessage();
            return false;
        }
    }

    /** 切割字符串秘钥
     * @param     $privateKey
     * @param int $length
     * @return string
     */
    public function splitPriveteKey($privateKey,$length = 64){
        $temp = "";
        $begin = "-----BEGIN RSA PRIVATE KEY-----\n";
        $temp .= $begin;
        $index = 0;
        while ($substr = substr($privateKey,$length * $index,$length)){
            $temp .= $substr."\n";
            $index++;
        }
        $end = "-----END RSA PRIVATE KEY-----";
        $temp .= $end;
        return $temp;
    }

    /** 切割字符串公钥
     * @param     $publicKey
     * @param int $length
     * @return string
     */
    public function splitPublicKey($publicKey,$length = 64){
        $temp = "";
        $begin = "-----BEGIN PUBLIC KEY-----\n";
        $temp .= $begin;
        $index = 0;
        while ($substr = substr($publicKey,$length * $index,$length)){
            $temp .= $substr."\n";
            $index++;
        }
        $end = "-----END PUBLIC KEY-----";
        $temp .= $end;
        return $temp;
    }
}