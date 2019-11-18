<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 19/10/7
 * Time: 16:32
 */

namespace app\common\enum;

interface BaseEnum
{
    /**根据类型获取对应名称
     * @param $type
     * @return mixed
     */
    public static function getName($type);

    /**获取类型、名称数组
     * @return mixed
     */
    public static function getArrayName();
}