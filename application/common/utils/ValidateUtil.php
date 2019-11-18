<?php
/**数据验证工具类  (备份保留)
 * Created by PhpStorm.
 * User: Administrator Reer
 * Date: 2018/9/7 0007
 * Time: 15:13
 */
namespace app\common\utils;

use think\Validate;

class ValidateUtil extends BaseUtil
{
    static $_self = null;
    static $rules = [];
    static $message = [];

    /**单例
     * @param bool $clear
     * @return ValidateUtil|null
     */
    public static function getInstance($clear = true){
        if(empty(self::$_self)){
            self::$_self = new ValidateUtil();
        }
        if($clear){
            self::setNull();
        }
        return self::$_self;
    }

    /**
     * 清空验证规则
     */
    protected static function setNull(){
        self::$rules = [];
        self::$message = [];
    }

    /**增加验证规则
     * @param $name
     * @param $rule
     * @return $this
     */
    public function appendRules($name,$rule = ''){
        if (is_array($name)) {
            self::$rules = array_merge(self::$rules, $name);
        } else {
            self::$rules[$name] = $rule;
        }
        return self::$_self;
    }

    /**获取验证规则
     * @return array
     */
    public function getRules(){
        return self::$rules;
    }

    /**增加规则提示
     * @param        $name
     * @param string $message
     * @return $this
     */
    public function appendMessage($name, $message = ''){
        if (is_array($name)) {
            self::$message = array_merge(self::$message, $name);
        } else {
            self::$message[$name] = $message;
        }
        return self::$_self;
    }

    /**获取规则提示
     * @return array
     */
    public function getMessage(){
        return self::$message;
    }

    /**进行数据验证
     * @param $data
     * @return array|bool
     */
    public function doCheck($data){
        $validate = new Validate(self::$rules,self::$message);
        if(!$validate->check($data)){
            $this->error = $validate->getError();
            return false;
        }
        return true;
    }

    /**直接根据 规则、提示信息 验证
     * @param array $rules
     * @param array $message
     * @param array $data
     * @return array|bool
     */
    public function directlyCheck($rules = [],$message = [],$data = []){
        self::setNull();
        $this->appendRules($rules);
        $this->appendMessage($message);
        return $this->doCheck($data);
    }
}