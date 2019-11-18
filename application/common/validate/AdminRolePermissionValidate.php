<?php
/*由bean脚本生成 powerBy--Joee*/

namespace app\common\validate;

use app\common\bean\AdminRolePermissionBean;

class AdminRolePermissionValidate extends BaseValidate
{
    public static $all = 'all';
    public static $id = 'id';

    public function __construct(array $rules = [], array $message = [], array $field = []) {
        parent::__construct($rules, $message, $field);

        $this->rule = [
            AdminRolePermissionBean::$id => 'require', //
            AdminRolePermissionBean::$adminRoleId => 'require', //后台角色id、
            AdminRolePermissionBean::$adminPermissionId => 'require', //后台权限id
        ];
        $this->message = [
            AdminRolePermissionBean::$id => 'id必须', //
            AdminRolePermissionBean::$adminRoleId => 'admin_role_id必须', //后台角色id、
            AdminRolePermissionBean::$adminPermissionId => 'admin_permission_id必须', //后台权限id
        ];
        $this->scene = [
            AdminRolePermissionValidate::$all => [AdminRolePermissionBean::$id, AdminRolePermissionBean::$adminRoleId, AdminRolePermissionBean::$adminPermissionId,],
            AdminRolePermissionValidate::$id => [AdminRolePermissionBean::$id]
        ];
    }


}