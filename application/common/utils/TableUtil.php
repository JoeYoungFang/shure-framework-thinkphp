<?php
/**z自动生成bean脚本工具
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\30 0030
 * Time: 14:35
 */
namespace app\common\utils;

use app\common\bean\BaseBean;
use app\common\bean\ListMap;
use think\Config;
use think\db\exception\BindParamException;
use think\exception\PDOException;
use think\Model;

class TableUtil extends Model
{
    private $tableName = '';
    static $_self = null;

    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new TableBuilder();
        }
        return self::$_self;
    }

    /**获取表名
     * @return string
     */
    public function getTableName(){
        return $this->tableName;
    }

    /**设置表名
     * @param string $tableName
     * @return Model|void
     */
    public function setTableName($tableName){
        $this->tableName = $tableName;
    }

    /**获取当前数据库的所有表名
     * @return BaseBean
     */
    public function getAllTable(){
        $sqlName = config("database.database");
        $sql = "SELECT TABLE_NAME from information_schema.`TABLES` where TABLE_SCHEMA = '{$sqlName}'";
        try {
            $result = $this->query($sql);
        } catch (BindParamException $e) {
        } catch (PDOException $e) {
        }
        if(!empty($result)){
            $array = array();
            foreach ($result as $item){
                array_push($array,$item["TABLE_NAME"]);
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
    public function getTableColumn($tableName){
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