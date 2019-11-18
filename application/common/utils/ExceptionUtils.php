<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-11-09
 * Time: 0:44
 */

namespace app\common\utils;


use app\common\exception\BaseException;
use think\Exception;

class ExceptionUtils
{

    /**抛出异常
     * @param $message
     */
    public static function throwMyException(BaseException $exception)
    {
        throw new $exception;
    }
}