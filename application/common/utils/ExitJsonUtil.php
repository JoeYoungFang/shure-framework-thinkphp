<?php
    /**json返回工具类
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018\6\12 0012
     * Time: 14:57
     */
namespace app\common\utils;

class ExitJsonUtil extends BaseUtil
{
    static $_self = null;
    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new ExitJsonUtil();
        }
        return self::$_self;
    }

    /**返回列表数据
     * @param     $data
     * @param int $code
     */
    public function exitList($data,$code = 200,$other = ''){
        $result['code'] = $code;
        $result['data']['list'] = $data['list'];
        $result['data']['nowPage'] = $data['nowPage'];
        $result['data']['totalPage'] = $data['totalPage'];
        $result['other'] = $other;
        exit(json_encode($result));
    }

    /**返回普通数据
     * @param        $data
     * @param int    $code
     * @param string $other
     */
    public function exitData($data,$code = 200,$other = ''){
        $result['data'] = $data;
        $result['code'] = $code;
        $result['other'] = $other;
        exit(json_encode($result));
    }
}