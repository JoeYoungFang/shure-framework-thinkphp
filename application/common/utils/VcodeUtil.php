<?php
/** 验证码工具类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\12 0012
 * Time: 11:40
 */

namespace app\common\utils;

use think\captcha\Captcha;

class VcodeUtil extends BaseUtil
{
    static $_self = null;
    private $captcha = null;

    /**
     * VcodeUtil constructor.
     */
    protected function __construct(){
        parent::__construct();
        $config = [
            'fontSize' => 20,// 验证码字体大小
            'length' => 4,// 验证码位数
            'useCurve' => false,// 是否画混淆曲线
            'useNoise' => false,// 是否添加杂点
            'codeSet' => "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"
        ];
        $this->captcha = new Captcha($config);
    }

    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new VcodeUtil();
        }
        return self::$_self;
    }

    /**获取验证码  配置项--https://www.kancloud.cn/manual/thinkphp5/154295
     * @return \think\Response
     */
    public function getCaptcha(){
        ob_clean();
        return $this->captcha->entry();
    }

    /**验证验证码
     * @param $code
     * @return bool
     */
    public function checkCaptcha($code){
        return $this->captcha->check($code);
    }
}