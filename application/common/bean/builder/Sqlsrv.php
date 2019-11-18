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

class Sqlsrv extends TableBuilder
{
    static $_self = null;

    public static function getInstance()
    {
        if (empty(self::$_self)) {
            self::$_self = new Sqlsrv();
        }
        return self::$_self;
    }

    /**获取当前数据库的所有表名
     * @return BaseBean
     */
    public function getAllTable()
    {
        // TODO: Implement getAllTable() method.
//        $sqlName = config("database.database");
        $sql = "select * from sys.tables";
        dump($sql);
        try {
            $result = $this->query($sql);

        } catch (BindParamException $e) {
            dump($e->getMessage());
        } catch (PDOException $e) {
            dump($result);
        }
        if (empty($result)) {
            return '查询不到表结构';
        }
        $array = array();
        foreach ($result as $item) {
            array_push($array, $item["name"]);
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
//        $databaseName = config('database.database');
        $sql = "select * from information_schema.COLUMNS where table_name = '{$tableName}';";
        try {
            $columns = $this->query($sql);
            //转成大写
            foreach ($columns as &$value) {
                $value = array_change_key_case($value, CASE_UPPER);
            }
        } catch (BindParamException $e) {
        } catch (PDOException $e) {
        }
        $listMap = new ListMap();
        $listMap->setList($columns);
        return $listMap;
    }
}