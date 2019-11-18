<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/12 0012
 * Time: 10:00
 */

namespace app\common\widget;


use think\Controller;

class Button extends Controller
{
    /** 添加按钮
     * @param        $name
     * @param        $url
     * @param        $params
     * @param        $stringArray
     * @param string $width
     * @param string $height
     * @return mixed
     */
    public function addButton($name,$url,$params,$stringArray,$width = '600',$height = '400'){
        $temp = explode('/',$url);
        if(in_array(end($temp),$stringArray)){
            $this->assign('name',$name);
            $this->assign('url',$url);
            $this->assign('params', http_build_query($params));
            $this->assign('width',$width);
            $this->assign('height',$height);
            return $this->fetch("common@widget/button/add_button");
        }
        return null;
    }

    /** 编辑按钮
     * @param        $url
     * @param        $params
     * @param        $stringArray
     * @param string $width
     * @param string $height
     * @param string $icon
     * @return mixed
     */
    public function edit($url,$params,$stringArray,$width = '600',$height = '400',$icon = "&#xe642;"){
        $temp = explode('/',$url);
        if(in_array(end($temp),$stringArray)) {
            $this->assign('url', $url);
            $this->assign('params', http_build_query($params));
            $this->assign('width',$width);
            $this->assign('height',$height);
            $this->assign('icon',$icon);
            return $this->fetch("common@widget/button/edit");
        }
        return null;
    }

    /** 删除按钮
     * @param $url
     * @param $params
     * @param $stringArray
     * @return mixed
     */
    public function delete($url,$params,$stringArray){
        $temp = explode('/',$url);
        if(in_array(end($temp),$stringArray)) {
            $this->assign('url',$url);
            $this->assign('params',http_build_query($params));
            return $this->fetch("common@widget/button/delete");
        }
        return null;
    }
}