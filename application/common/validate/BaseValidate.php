<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-06-28
 * Time: 17:45
 */

namespace app\common\validate;


use app\common\exception\ParameterException;
use think\Validate;
use think\Exception;

/**
 * Class BaseValidate
 * 验证类的基类
 */
class BaseValidate extends Validate
{
    protected static $_self = null;
    static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new BaseValidate();
        }
        return self::$_self;
    }

    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用
     * @param string $sence
     * @param array  $data
     * @return true
     * @throws Exception
     */
    public function goCheck($sence = '', $data = []) {
        $params = $data ?: request()->param();
        if (!empty($sence)) {
            $this->scene($sence);
        }
        if (!$this->check($params)) {
            throw new ParameterException(['msg' => is_array($this->error) ? implode(';', $this->error) : $this->error]);
        }
        return true;
    }

    /**
     * @param array $arrays 通常传入request.post变量数组
     * @return array 按照规则key过滤后的变量数组
     * @throws ParameterException
     */
    public function getDataByRule($arrays) {
        if (array_key_exists('user_id', $arrays) | array_key_exists('uid', $arrays)) {
            // 不允许包含user_id或者uid，防止恶意覆盖user_id外键
            throw new ParameterException([
                'msg' => '参数中包含有非法的参数名user_id或者uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

    /**
     * @param        $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool|string
     */
    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '') {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field.'必须是正整数';
    }

    /**
     * @param        $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool|string
     */
    protected function isNotEmpty($value, $rule = '', $data = '', $field = '') {
        if (empty($value)) {
            return $field.'不允许为空';
        } else {
            return true;
        }
    }

    /** 没有使用TP的正则验证，集中在一处方便以后修改
     * 不推荐使用正则，因为复用性太差
     * 手机号的验证规则
     * @param $value
     * @return bool
     */
    protected function isMobile($value) {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}