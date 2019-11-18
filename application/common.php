<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/*
 * 将下标数组转为关联数组
 * $oldArray:二维数组
 */
if (!function_exists('array_index_by_value')) {
    function array_index_by_value($oldArray = array())
    {
        $newArray = array();
        foreach ($oldArray as $item) {
            $key = array_keys($item[0])[0];
            array_unshift($item, array($key => '全部'));
            $newArray[$key] = $item;
        }
        return $newArray;
    }
}


//支持get，post，delete
if (!function_exists('toIndexArr')) {
    //传入一个关联数组  返回一个索引数组
    function toIndexArr($arr, $keyIndex)
    {
        $newArr = array();
        $i = 0;
        foreach ($arr as $key => $value) {
            $newArr[$i] = $value[$keyIndex];
            $i++;
        }
        return $newArr;
    }

}