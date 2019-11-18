<?php
/**基础bean
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\12 0012
 * Time: 14:16
 */

namespace app\common\bean;

class BaseBean
{
    protected $data = array();

    /**获取单个数据
     * @param $filed
     * @return mixed
     */
    public function getParameter($filed) {
        return $this->data[$filed] ?? '';
    }

    /**设置单个数据
     * @param $filed
     * @param $value
     */
    public function setParameter($filed, $value) {
        if ($value === null || $value === '') {
            return;
        }
        $this->data[$filed] = $value;
    }

    /**移除某个字段
     * @param $filed
     * @param $value
     */
    public function removeField($filed) {
        if (!isset($this->data[$filed])) {
            return;
        }
        unset($this->data[$filed]);
    }

    /**数据获取
     * @return array|object
     */
    public function getData() {
        return $this->data;
    }

    /**数据设置
     * @param $data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**获取数据表别名
     * @return mixed
     */
    public function getAlias() {
        return $this->getParameter('alias');
    }

    /**设置数据表别名
     * @param $alias
     */
    public function setAlias($alias) {
        $this->setParameter('alias', $alias);
    }
}