<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/12 0012
 * Time: 9:55
 */

namespace app\common\widget;


use think\Controller;

class Common extends Controller
{
    /** 面包屑
     * @param $navArray
     * @return mixed
     */
    public function nav($navArray){
        $this->assign('navArray',$navArray);
        return $this->fetch('common@widget/common/nav');
    }

    /**
     * 复选框树
     * @param $treeData
     * @param string $commitUrl
     * @param array $param
     * @return mixed
     */
    public function checkboxTree($treeData,$commitUrl = '',$param = []){
        $url = $commitUrl."?".http_build_query($param);
        $this->assign('treeData',json_encode($treeData));
        $this->assign('url',$url);
        return $this->fetch('common@widget/common/checkbox_tree');
    }

    /**
     * 树修改
     */
    public function editTree(){}
}