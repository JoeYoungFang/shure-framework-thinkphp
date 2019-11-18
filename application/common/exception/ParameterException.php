<?php


namespace app\common\exception;


class ParameterException  extends BaseException
{
    public $code = 400;
    public $msg = '参数管理异常';
    public $errorCode = 300000;
}