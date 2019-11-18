<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-11-12
 * Time: 19:22
 */

namespace app\common\bean\builder;


use app\common\bean\BaseBean;
use app\common\bean\ListMap;
use think\db\exception\BindParamException;
use think\exception\PDOException;

class Mysql extends TableBuilder
{
    static $_self = null;

    public static function getInstance()
    {
        if (empty(self::$_self)) {
            self::$_self = new Mysql();
        }
        return self::$_self;
    }

    /**获取当前数据库的所有表名
     * @return BaseBean
     */
    public function getAllTable()
    {
        // TODO: Implement getAllTable() method.
        $sqlName = config("database.database");
        $sql = "SELECT TABLE_NAME from information_schema.`TABLES` where TABLE_SCHEMA = '{$sqlName}'";
        try {
            $result = $this->query($sql);
        } catch (BindParamException $e) {
        } catch (PDOException $e) {
        }
        if (!empty($result)) {
            $array = array();
            foreach ($result as $item) {
                array_push($array, $item["TABLE_NAME"]);
            }
        }
        $baseBean = new BaseBean();
        $baseBean->setData($array);
        return $baseBean;
    }

    /**获取表的所有字段
     * @param $tableName
     * @return ListMap
     */
    public function getTableColumn($tableName)
    {
        $databaseName = config('database.database');
        $sql = "select * from information_schema.COLUMNS where TABLE_NAME = '{$tableName}' and TABLE_SCHEMA = '{$databaseName}'";
        try {
            $columns = $this->query($sql);
        } catch (BindParamException $e) {
        } catch (PDOException $e) {
        }
        $listMap = new ListMap();
        $listMap->setList($columns);
        return $listMap;
    }
}