<?php
/*由bean脚本生成 powerBy--Joee*/

namespace app\common\validate;

use app\common\bean\AdminPermissionBean;

class AdminPermissionValidate extends BaseValidate
{
    static $all = 'all';
    static $addParent = 'add_parent';
    static $addChild = 'add_child';
    static $editParent = 'edit_parent';
    static $editChild = 'edit_child';
    static $pkId = 'id';

    public function __construct(array $rules = [], array $message = [], array $field = []) {
        parent::__construct($rules, $message, $field);

        $this->rule = [
            AdminPermissionBean::$id => 'require', //
            AdminPermissionBean::$name => 'require', //权限名称
            AdminPermissionBean::$parentId => 'require', //父级id 0为模块
            AdminPermissionBean::$model => 'require', //模块名
            AdminPermissionBean::$controller => 'require', //控制器名
            AdminPermissionBean::$action => 'require', //f方法名
            AdminPermissionBean::$icon => 'require', //图标
            AdminPermissionBean::$isPlay => 'require', //是否菜单显示 0否，1显示
            AdminPermissionBean::$sort => 'require', //排序
            AdminPermissionBean::$createdAt => 'require', //创建时间
        ];
        $this->message = [
            AdminPermissionBean::$id => 'id必须', //
            AdminPermissionBean::$name => 'name必须', //权限名称
            AdminPermissionBean::$parentId => 'parent_id必须', //父级id 0为模块
            AdminPermissionBean::$model => 'model必须', //模块名
            AdminPermissionBean::$controller => 'controller必须', //控制器名
            AdminPermissionBean::$action => 'action必须', //f方法名
            AdminPermissionBean::$icon => 'icon必须', //图标
            AdminPermissionBean::$isPlay => 'is_play必须', //是否菜单显示 0否，1显示
            AdminPermissionBean::$sort => 'sort必须', //排序
            AdminPermissionBean::$createdAt => 'created_at必须', //创建时间
        ];
        $this->scene = [
            self::$all => [AdminPermissionBean::$id, AdminPermissionBean::$name, AdminPermissionBean::$parentId, AdminPermissionBean::$model, AdminPermissionBean::$controller, AdminPermissionBean::$action, AdminPermissionBean::$icon, AdminPermissionBean::$isPlay, AdminPermissionBean::$sort, AdminPermissionBean::$createdAt,],
            self::$addParent => [AdminPermissionBean::$name,AdminPermissionBean::$model],
            self::$addChild => [AdminPermissionBean::$name,AdminPermissionBean::$model,AdminPermissionBean::$parentId,AdminPermissionBean::$controller,AdminPermissionBean::$action],
            self::$editParent => [AdminPermissionBean::$id,AdminPermissionBean::$name,AdminPermissionBean::$model],
            self::$editChild => [AdminPermissionBean::$id,AdminPermissionBean::$name,AdminPermissionBean::$model,AdminPermissionBean::$parentId,AdminPermissionBean::$controller,AdminPermissionBean::$action],
            self::$pkId =>[AdminPermissionBean::$id]
        ];
    }


}