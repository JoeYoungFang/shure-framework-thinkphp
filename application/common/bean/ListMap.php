<?php
    /**存放list数据类
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018\6\13 0013
     * Time: 15:32
     */
namespace app\common\bean;

class ListMap extends BaseBean
{

    /**获取list数据
     * @return mixed
     */
    public function getList(){
        return $this->getParameter('list');
    }

    /**设置list数据
     * @param $list
     */
    public function setList($list){
        $this->setParameter('list',$list);
    }

    /**获取page分页标签
     * @return mixed
     */
    public function getPage(){
        return $this->getParameter('page');
    }

    /**获取page分页标签
     * @param $page
     */
    public function setPage($page){
        $this->setParameter('page',$page);
    }

    /**获取总条数
     * @return mixed
     */
    public function getTotalCount(){
        return $this->getParameter('totalCount');
    }

    /**设置总条数
     * @param $count
     */
    public function setTotalCount($count){
        $this->setParameter('totalCount', $count);
    }

    /**设置当前页数
     * @param $currentPage
     */
    public function setCurrentPage($currentPage){
        $this->setParameter('currentPage', $currentPage);
    }

    /**获取当前页数
     * @return mixed
     */
    public function getCurrentPage(){
        return $this->getParameter('currentPage');
    }

    /**
     * model field
     */
    public function getField(){
        return $this->getParameter('field');
    }

    public function setField($field){
        $this->setParameter('field', $field);
    }

    /**
     * model order
     */
    public function getOrder(){
        return $this->getParameter('order');
    }

    public function setOrder($order){
        $this->setParameter('order', $order);
    }

    /**
     * model join
     */
    public function getJoin(){
        return $this->getParameter('join');
    }

    public function setJoin($join){
        $this->setParameter('join', $join);
    }

    /**
     * model group
     */
    public function getGroup(){
        return $this->getParameter('group');
    }

    public function setGroup($group){
        $this->setParameter('group', $group);
    }

    /**
     * model with
     */
    public function getWith(){
        return $this->getParameter('with');
    }

    public function setWith($with){
        $this->setParameter('with', $with);
    }

}