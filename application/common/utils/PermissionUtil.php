<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/11 0011
 * Time: 16:24
 */

namespace app\common\utils;


use app\common\bean\GlobalBean;
use think\Collection;

class PermissionUtil extends BaseUtil
{
    static $_self = null;

    public static function getInstance() {
        if (empty(self::$_self)) {
            self::$_self = new PermissionUtil();
        }
        return self::$_self;
    }

    /** 获取数组的tree数组(注意父级一定得排在前面)
     * @param mixed    $data
     * @param string $parentField
     * @param string $childName
     * @param string $idField
     * @return array
     */
    public function getTreesData($data, $parentField = 'parent_id', $childName = 'children', $idField = 'id') {
        $treesArray = [];
        while (count($data)) {
            foreach ($data as $key => $value) {
                if ($value[$parentField] == 0) {
                    $value['title'] = $value['name'];
                    $value[$childName] = [];
                    $treesArray[] = $value;
                } else {
                    $this->recursionPermission($treesArray, $value, $parentField, $childName, $idField);
                }
                unset($data[$key]);
            }
        }
        return $treesArray;
    }

    /**递归组装
     * @param $treesArray
     * @param $value
     * @param $parentField
     * @param $childName
     * @param $idField
     */
    private function recursionPermission(&$treesArray, $value, $parentField, $childName, $idField) {
        foreach ($treesArray as $k => &$v) {
            if (count($v[$childName])) {
                $this->recursionPermission($treesArray[$k][$childName], $value, $parentField, $childName, $idField);
            }
            if ($v[$idField] == $value[$parentField]) {
                $value['title'] = $value['name'];
                $value[$childName] = [];
                $v[$childName][] = $value;
            }
        }
    }

    /** 获取session中对应模块、控制器拥有的返回权限字符串数组
     * @param       $model
     * @param       $controller
     * @param array $data
     * @return array
     */
    public function getSessionPermission($model, $controller, $data = []) {
        $data = array_merge($data, session(GlobalBean::$permissionList) ?? []);
        $permissionStringArray = [];
        foreach ($data as $value) {
            if ($value['model'] == $model && $value['controller'] == $controller) {
                array_push($permissionStringArray, $value['action']);
            }
        }
        return $permissionStringArray;
    }

    /** 获取session的权限树
     * @return array
     */
    public function getSessionPermissionTree() {
        $allAdminRolePermission = session(GlobalBean::$permissionList);
        $permissionTree = $this->getTreesData($allAdminRolePermission);
        return $permissionTree;
    }

    /** 权限列表添加checked
     * @param $allPermision
     * @param $havaPermission
     * @return
     */
    public function twoPermiisionListCheck($allPermision, $havaPermission) {
        foreach ($havaPermission as $value) {
            foreach ($allPermision as &$v) {
                isset($v['checked']) ?: $v['checked'] = false;
                if ($value['id'] === $v['id']) {
                    $v['checked'] = true;
                    break;
                }
            }
        }
        return $allPermision;
    }


    /******************************joe**********************************/

    /**
     * 获取无限极分类数组（直接是树形结构的数组） 直接循环输出时用 这里暂时无用,
     * @param $data
     * @return array
     */
    public function getTreeArr($data) {
        //构造数据
        $items = array();
        //以分类的id为索引
        foreach ($data as $key => $value) {
            $items[$value['id']] = $value;
        }
        //第二部 遍历数据 生成树状结构
        $tree = array();
        foreach ($items as $key => $value) {
            if ($value['parent_id'] !== 0) {//不是顶级分类
                //把当前循环的value放入父节点下面
                $items[$value['parent_id']]['son'][] = &$items[$key];
                //引用传值  当items更改时，tree里面的items也会更改
            } else {
                $tree[] = &$items[$key];
            }
        }
        return $tree;
    }

    /**
     * 递归返回可使用格式的权限数组
     * 组装返回权限的数据
     * @param $data
     * @return array
     */
    public function executeTree($data) {
        $res = array();
        foreach ($data as $key => $value) {
            $arr = [
                'path' => $value['path'],
                'component' => $value['component'],
                'name' => $value['name'],
                'redirect' => $value['redirect'],
                'meta' => [
                    'title' => $value['title'],
                    'icon' => $value['icon']
                ],
                'hidden' => $value['hidden'] === 1 ? false : true,//1是显示，2是隐藏
            ];
            if (!empty($value['son'])) {
                $arr['children'] = self::executeTree($value['son']);
            }
            $res[$key] = $arr;
        }
        return $res;
    }

    /**
     * 递归返回可使用格式的权限节点
     * @param $data
     * @return array
     */
    public function executeTreeArr($data) {
        $res = array();
        foreach ($data as $key => $value) {
            $arr = [
                'id' => $value['id'],
                'label' => $value['title'],
            ];
            if (!empty($value['son'])) {
                $arr['children'] = self::executeTreeArr($value['son']);
            }
            $res[$key] = $arr;
        }
        return $res;
    }

    /**
     * 获取无限极分类数组一维
     */
    public function getTreeArrOne($data, $parent_id = 0, $level = 0, $parent_path = 'p') {
        static $tree = array();
        foreach ($data as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                foreach ($tree as $k => $v) {
                    if ($v['id'] == $parent_id) {
                        $tree[$k]['hasChild'] = true;
                        $tree[$k]['toggle'] = true;
                        break;
                    }
                }
                $value['show'] = $level === 0 ? true : false;
                $value['toggle'] = $level === 0 ? true : false;
                $value['hasChild'] = false;
                $value['level'] = $level;
                $value['parent_path'] = $parent_path."_".$value['id'];//记录分类路径
                $tree[] = $value;
                unset($data['key']);
                self::getTreeArrOne($data, $value['id'], $level + 1, $value['parent_path']);
            }
        }
        return $tree;
    }

    /**
     * 递归实现无限极分类列表
     * @param        $data
     * @param int    $parent_id
     * @param int    $level
     * @param string $parent_path
     * @return array
     */
    public static function getTree($data, $parent_id = 0, $level = 0, $parent_path = 'parent_path') {
        static $tree = array();
        foreach ($data as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $value['parent_path'] = $parent_path."_".$value['id'];//记录分类路径
                $value['title'] = str_repeat('——', $level * 2).$value['title'];
                $tree[] = $value;
                unset($data['key']);
                self::getTree($data, $value['id'], $level + 1, $value['parent_path']);
            }
        }
        return $tree;
    }
}