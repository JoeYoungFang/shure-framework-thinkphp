<?php
/**基础工具类
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2018\7\11 0011
 * Time: 10:54
 */
namespace app\common\utils;

class BaseUtil
{
    protected $error = '';

    protected function __construct() { }

    public function getError(){
        return $this->error;
    }
}