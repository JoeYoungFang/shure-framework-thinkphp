<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/10 0010
 * Time: 11:18
 */

namespace app\common\widget;

use think\Controller;

class SearchForm extends Controller
{

    /** 渲染 form 列表搜索表单
     * @param array  $time
     * @param array  $keywords
     * @param array  $selects
     * @param string $append
     * @return mixed
     */
    public function listSearchFrom(Array $time,Array $keywords,Array $selects,$append = ""){
        /*if(count($time) && (!isset($time['name']) || !isset($time['benginTime']) || !isset($time['endTime']))){
            MyException::throwMyException("时间格式错误['name' => '','benginTime' => '','endTime' => '']");
        }
        foreach ($keywords as $key => $value){
            if(is_array($value)){
                if(!isset($value['name']) || !isset($value['key']) || !isset($value['value'])){
                    MyException::throwMyException("关键字格式错误[['name' => '','key' => '','value' => ''],['name' => '','key' => '','value' => '']]");
                }
            }else{
                if(!isset($keywords['name']) || !isset($keywords['key']) || !isset($keywords['value'])){
                    MyException::throwMyException("关键字格式错误['name' => '','key' => '','value' => '']");
                }
                break;
            }
        }
        foreach ($selects as $key => $value){
            if(is_array($value)){
                if(!isset($value['name']) || !isset($value['key']) || !isset($value['value']) || !isset($value['options'])){
                    MyException::throwMyException("下拉框格式错误[['name' => '','key' => '','value' => '','options' => [[key => ,value => ],[key => ,value => ]]],['name' => '','key' => '','value' => '','options' => [[key => ,value => ],[key => ,value => ]]]]");
                }
            }else{
                if(!isset($selects['name']) || !isset($selects['key']) || !isset($selects['value']) || !isset($selects['options'])){
                    MyException::throwMyException("下拉框格式错误['name' => '','key' => '','value' => '','options' => [[key => ,value => ],[key => ,value => ]]]");
                }
                break;
            }
        }*/
        $this->assign('time',$time);
        $this->assign('keywords',$keywords);
        $this->assign('selects',$selects);
        $this->assign('append',$append);
        return $this->fetch('common@widget/search_form/list_search_from');
    }
}