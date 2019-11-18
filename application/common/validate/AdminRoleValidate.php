<?php
/*由bean脚本生成 powerBy--Joee*/

namespace app\common\validate;

use app\common\bean\AdminRoleBean;

class AdminRoleValidate extends BaseValidate
{
    static $all = 'all';
    static $add = 'add';
    static $edit = 'edit';
    static $pkId = 'id';

    public function __construct(array $rules = [], array $message = [], array $field = []) {
        parent::__construct($rules, $message, $field);

        $this->rule = [
            AdminRoleBean::$id => 'require', //
            AdminRoleBean::$name => 'require', //角色名称
            AdminRoleBean::$updatedAt => 'require', //
            AdminRoleBean::$createdAt => 'require', //
        ];
        $this->message = [
            AdminRoleBean::$id => 'id必须', //
            AdminRoleBean::$name => 'name必须', //角色名称
            AdminRoleBean::$updatedAt => 'updated_at必须', //
            AdminRoleBean::$createdAt => 'created_at必须', //
        ];
        $this->scene = [
            self::$all => [AdminRoleBean::$id, AdminRoleBean::$name, AdminRoleBean::$updatedAt, AdminRoleBean::$createdAt,],
            self::$add => [AdminRoleBean::$name],
            self::$edit => [AdminRoleBean::$id,AdminRoleBean::$name],
            self::$pkId => [AdminRoleBean::$id]
        ];
    }


}