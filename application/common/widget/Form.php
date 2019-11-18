<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/10 0010
 * Time: 10:57
 */

namespace app\common\widget;

use think\Controller;

class Form extends Controller
{
    public function header() {
        return $this->fetch('common@widget/form/header');
    }
    /*
     * 编辑器
     */
    public function uedit($label,$name,$value,$require,$disabled = false,$password = false){
        empty($require) ? $require = false : (is_bool($require) ? $require = 'required': '');
        $this->assign('label',$label);
        $this->assign('name',$name);
        $this->assign('value',$value);
        $this->assign('password',$password);
        $this->assign('disabled',$disabled);
        $this->assign('require',$require);
        return $this->fetch('common@widget/form/uedit');
    }
    /** input输入框
     * @param $label
     * @param $name
     * @param $value
     * @param $require
     * @param bool $disabled
     * @param bool $password
     * @return mixed
     */
    public function input($label,$name,$value,$require,$disabled = false,$password = false){
        empty($require) ? $require = false : (is_bool($require) ? $require = 'required': '');
        $this->assign('label',$label);
        $this->assign('name',$name);
        $this->assign('value',$value);
        $this->assign('password',$password);
        $this->assign('disabled',$disabled);
        $this->assign('require',$require);
        return $this->fetch('common@widget/form/input');
    }

    /** 一行两个输入框
     * @param $inputArray
     * @return mixed
     */
    public function manyInput($inputArray){
        foreach ($inputArray as &$value){
            empty($value['require']) ? $value['require'] = false : (is_bool($value['require']) ? $value['require'] = 'required': '');
            isset($value['disabled']) ?: $value['disabled'] = false;
        }
        $this->assign('manyInput',$inputArray);
        return $this->fetch('common@widget/form/manyInput');
    }

    /** select选择
     * @param $label
     * @param $name
     * @param $value
     * @param $options
     * @return mixed
     */
    public function select($label,$name, $value,$options){
        $this->assign("label",$label);
        $this->assign("name",$name);
        $this->assign("value",$value);
        $this->assign('options',$options);
        return $this->fetch("common@widget/form/select");
    }

    /**时间选择框
     * @param $label
     * @param $name
     * @param $value
     * @return mixed
     */
    public function time($label,$name, $value){
        $this->assign("label",$label);
        $this->assign("name",$name);
        $this->assign("value",$value);
        return $this->fetch("common@widget/form/time");
    }

    /** 文本框
     * @param $label
     * @param $name
     * @param $value
     * @param bool $require
     * @return mixed
     */
    public function textarea($label,$name, $value,$require = false,$disabled = false){
        $this->assign("label",$label);
        $this->assign("name",$name);
        $this->assign("value",$value);
        $this->assign('require',$require);
        $this->assign('disabled',$disabled);
        return $this->fetch("common@widget/form/textarea");
    }

    /**富文本
     * @param $label
     * @param $name
     * @param $value
     * @return mixed
     */
    public function richText($label,$name,$value){
        $this->assign("label",$label);
        $this->assign("name",$name);
        $this->assign("value",$value);
        return $this->fetch("common@widget/form/richText");
    }

    /** 文件上传
     * @param $label
     * @param $name
     * @param array $list
     * @param int $limit
     * @param int $width
     * @param int $height
     * @return mixed
     */

    public function upload($label,$name,$list = [],$limit = 1,$width = 16,$height = 9,$path='upload'){
        $this->assign(compact('label', 'name', 'list', 'limit', 'width', 'height', 'path'));
        return $this->fetch('common@widget/form/upload');
    }


    /**
     * 提交按钮
     */
    public function submit(){
        return $this->fetch('common@widget/form/submit');
    }
}

/**
 *  example
 *
 *  {{:widget('common/Form/input',['角色名','name','',true,false])}}
 *  {{:widget('common/Form/manyInput',[[['lable' => '数组1','name' => 'name1','value' => 11,'require' => true,'disabled' => true]]])}}
 *  {{:widget('common/Form/manyInput',[[['lable' => '数组2','name' => 'name2','value' => 22,'require' => true,'disabled' => true],['lable' => '数组3','name' => 'name3','value' => 22,'require' => true,'disabled' => false]]])}}
 *  {{:widget('common/Form/textarea',['文本段','name3','',false])}}
 *  {{:widget('common/Form/richText',['富文本','name4','<br>123123<h1>123123</h1>'])}}
 *  {{:widget('common/Form/time',['时间选择框','name5',''])}}
 *  {{:widget('common/Form/upload',['图片上传','name6',[],2])}}
 *  {{:widget('common/Form/upload',['图片上传','name7',[],3,1,1])}}
 *  {{:widget('common/Form/select',['select','name8',3,[2=>'是',3 => '否']])}}
 *  {{:widget('common/Form/submit')}}
 *  若存在富文本 提交数据时 data = appendEditorHtmlData(data); 调用获取富文本数据
 */