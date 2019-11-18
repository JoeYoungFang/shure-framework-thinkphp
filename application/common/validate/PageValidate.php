<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-09-25
 * Time: 14:03
 */

namespace app\common\validate;


class PageValidate extends BaseValidate
{
    protected $rule = [
        'page' => 'require',
        'pageSize' => 'require',
    ];
    protected $message = [
        'page.require' => 'page必须有',
        'pageSize.require' => 'pageSize必须有',
    ];
    protected $scene = [

    ];
}