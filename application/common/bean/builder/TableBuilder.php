<?php
/**z自动生成bean脚本工具
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\30 0030
 * Time: 14:35
 */

namespace app\common\bean\builder;

use app\common\bean\BaseBean;
use app\common\bean\ListMap;
use think\Config;
use think\db\exception\BindParamException;
use think\exception\PDOException;
use think\Model;

abstract class TableBuilder extends Model
{
    private $tableName = '';

    /**获取表名
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**设置表名
     * @param string $tableName
     * @return Model|void
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**获取当前数据库的所有表名
     * @return BaseBean
     */
    public abstract function getAllTable();

    /**获取表的所有字段
     * @param $tableName
     * @return ListMap
     */
    public abstract function getTableColumn($tableName);
}