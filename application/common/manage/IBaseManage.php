<?php


namespace app\common\manage;

use app\common\bean\ListMap;

interface IBaseManage
{
    /**获取分页数据
     * @param ListMap $listMap
     * @return mixed
     */
    public function getPaginatorList(ListMap $listMap);

    /**添加数据
     * @param $data
     * @return mixed
     */
    public function add($data);

    /**编辑数据
     * @param $data
     * @return mixed
     */
    public function edit($data);

    /**删除数据
     * @param $data
     * @return mixed
     */
    public function delete($data);

    /**根据主建获取数据
     * @param $data
     * @return mixed
     */
    public function getInfo($data);
}