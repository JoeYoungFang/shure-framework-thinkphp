<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-06-28
 * Time: 17:51
 */

namespace app\common\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];
}