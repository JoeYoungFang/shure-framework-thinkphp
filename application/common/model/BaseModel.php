<?php
/**底层模型类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\12 0012
 * Time: 11:12
 */

namespace app\common\model;

use app\common\bean\ListMap;
use Exception;
use think\Collection;
use think\facade\Log;
use think\Model;

/**
 * @property mixed id
 */
abstract class BaseModel extends Model
{
    protected $pageCount;//默认分页条数
    protected $field = true;

    public function __construct($data = []) {
        parent::__construct($data);
        (request()->param("pageCount") && request()->param("pageCount") > 100) ? $this->pageCount = request()->param("pageCount") : $this->pageCount = 10;
    }

    /** 根据指定字段获取数据-单表
     * @param       $field
     * @param       $value
     * @param bool  $select
     * @param array $map
     * @return array|false|
     */
    public function getMessage($field, $value, $select = false, $map = []) {
        $map[$field] = $value;
        try {
            if ($select) {
                $result = $this->where($map)->select();
            } else {
                $result = $this->where($map)->find();
            }
            if ($result == null)
                $result = false;
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            $result = false;
        }
        return !$result instanceof Collection ? $result : $result->toArray();
    }

    /** 获取单表数据列表
     * @param ListMap $listMap
     * @param bool    $select
     * @return ListMap|bool
     */
    public function getList(ListMap $listMap, $select = false) {
        try {
            $field = $listMap->getField() ?: true;
            if (is_array($field)) {
                $fieldStr = '';
                foreach ($field as $item) {
                    $fieldStr .= $item.",";
                }
                $field = rtrim($fieldStr, ',');
            }
            $order = $listMap->getOrder();
            if (is_array($order)) {
                $orderStr = '';
                foreach ($order as $item) {
                    $orderStr .= $item.",";
                }
                $order = rtrim($orderStr, ',');
            }
            $where = [];//tp5.1 查询新规则
            foreach ($listMap->getData() as $key => $value) {
                if (!in_array($key, ['field', 'order', 'alias', 'join', 'group', 'with'])) {
                    if (is_array($value)) {
                        array_unshift($value, $key);
                        $where[] = $value;
                    } else if (!empty($value)) {
                        $where[] = [$key, '=', $value];
                    }
                }
            }
            if ($select) {
                $result = $this->field($field)->with($listMap->getWith())->where($where)->group(trim($listMap->getGroup()))->order(trim($order))->select();
                return !$result instanceof Collection ? $result : $result->toArray();
            } else {
                $result = $this->field($field)->with($listMap->getWith())->where($where)->group(trim($listMap->getGroup()))->order(trim($order))->paginate($this->pageCount);
            }
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            $result = false;
        }
        if ($result === false) {
            return false;
        }
        $newListMap = new ListMap();
        $newListMap->setList($result->getCollection()->toArray());
        $newListMap->setCurrentPage($result->currentPage());
        $newListMap->setTotalCount($result->total());
        return $newListMap;
    }

    /** 获取连表数据  join = [表 表别名,条件,连表方式]  or  join = [[表 表别名,条件,连表方式],[表 表别名,条件,连表方式]]
     * @param ListMap $listMap
     * @param bool    $select
     * @param bool    $find
     * @return ListMap|array|bool
     */
    public function getJoinList(ListMap $listMap, $select = false, $find = false) {
        try {
            $field = $listMap->getField() ?: true;
            if (is_array($field)) {
                $fieldStr = '';
                foreach ($field as $item) {
                    $fieldStr .= $item.",";
                }
                $field = rtrim($fieldStr, ',');
            }
            $order = $listMap->getOrder();
            if (is_array($order)) {
                $orderStr = '';
                foreach ($order as $item) {
                    $orderStr .= $item.",";
                }
                $order = rtrim($orderStr, ',');
            }
            $join = $listMap->getJoin();
            $where = [];//tp5.1 查询新规则
            foreach ($listMap->getData() as $key => $value) {
                if (!in_array($key, ['field', 'order', 'alias', 'join', 'group', 'with'])) {
                    if (is_array($value)) {
                        array_unshift($value, $key);
                        $where[] = $value;
                    } else if (!empty($value)) {
                        $where[] = [$key, '=', $value];
                    }
                }
            }
            $temp = $this->alias($listMap->getAlias())->field($field)->with($listMap->getWith())->where($where)->group(trim($listMap->getGroup()))->order(trim($order));
            foreach ($join as $key => $value) {
                if (is_array($value)) {
                    $temp->join($value[0]." ".$value[1], $value[2]." = ".$value[3], $value[4] ?? 'INNER');
                } else {
                    $temp->join($join[0]." ".$join[1], $join[2]." = ".$join[3], $join[4] ?? 'INNER');
                    break;
                }
            }
            if ($find) {
                $result = $temp->find();
                return !$result instanceof Collection ? $result : $result->toArray();
            }
            if ($select) {
                $result = $temp->select();
                return !$result instanceof Collection ? $result : $result->toArray();
            } else {
                $result = $temp->paginate($this->pageCount);
            }
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            $result = false;
        }
        if ($result === false) {
            return false;
        }
        $newListMap = new ListMap();
        $newListMap->setList($result->getCollection()->toArray());
        $newListMap->setCurrentPage($result->currentPage());
        $newListMap->setTotalCount($result->total());
        return $newListMap;
    }

    /**单表更新指定字段的值
     * @param $field
     * @param $value
     * @param $updateField
     * @param $updateValue
     * @return bool
     */
    public function updateColumn($field, $value, $updateField, $updateValue) {
        $map[$field] = $value;
        $data[$updateField] = $updateValue;
        try {
            $resutl = $this->where($map)->update($data);
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            $resutl = false;
        }
        if ($resutl === false) {
            return false;
        }
        return true;
    }

    /** 获取数据
     * @param        $where
     * @param bool   $select
     * @param string $order
     * @param string $with
     * @param string $field
     * @return array|bool|false||string|\think\Collection|Model
     */
    public function selectData($where, $select = false, $order = '', $with = '', $field = "*") {
        try {
            if (is_array($field)) {
                $fieldStr = '';
                foreach ($field as $item) {
                    $fieldStr .= $item.",";
                }
                $field = rtrim($fieldStr, ',');
            }
            if (is_array($order)) {
                $orderStr = '';
                foreach ($order as $item) {
                    $orderStr .= $item.",";
                }
                $order = rtrim($orderStr, ',');
            }
            if ($select) {
                $result = $this->field($field)->with($with)->order($order)->where($where)->select();
            } else {
                $result = $this->field($field)->with($with)->order($order)->where($where)->find();
            }
            if ($result == null)
                $result = false;
            if ($result == null && $select)
                $result = [];
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            $result = false;
        }
        return !$result instanceof Collection ? $result : $result->toArray();
    }

    /** 更新数据
     * @param $where
     * @param $data
     * @return bool
     */
    public function updatedData($where, $data) {
        try {
            $field = $this->getTableFields();
            foreach ($data as $key => $value) {
                if (!in_array($key, $field)) {
                    unset($data[$key]);
                }
            }
            $resutl = $this->where($where)->update($data);
            if ($resutl === false) {
                return false;
            }
        } catch (Exception $exception) {
            return false;
        }
        return $resutl;
    }

    /** 添加数据并且返回新增的id
     * @param $data
     * @return bool|int|string
     */
    public function addDataGetInsertId($data) {
        $result = $this->allowField(true)->save($data);
        if (!$result) {
            return false;
        }
        return $this->getData($this->getPk());
    }

    /** 删除数据
     * @param $where
     * @return int
     */
    public function deleteData($where) {
        try {
            return $this->where($where)->delete();
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            return false;
        }
    }

    /** 获取所有数据
     * @param string $order
     * @return bool|false||string|\think\Collection
     */
    public function getAllData($order = 'created_at') {
        try {
            $result = $this->order($order)->select();
            return !$result instanceof Collection ? $result : $result->toArray();
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            return false;
        }
    }

    /** 获取数据总数
     * @param $where
     * @return bool|int|string
     */
    public function getCount($where) {
        try {
            return $this->where($where)->count();
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            return false;
        }
    }

    /*
     * 执行sql语句
     */
    public function querySql($sql) {
        try {
            return $this->query($sql);
        } catch (Exception $exception) {
            Log::record("BaseModel Exception:".$exception->getMessage(), 'error');
            Log::record("BaseModel LastSql:".$this->getLastSql(), 'error');
            return false;
        }
    }
}