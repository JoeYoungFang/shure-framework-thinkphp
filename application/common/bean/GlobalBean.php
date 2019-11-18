<?php
/** 后台全局session配置
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 17:55
 */

namespace app\common\bean;


class GlobalBean extends BaseBean
{
    static $super = 'super';//主后台超级管理员标识
    static $superAdminId = 1;//超级管理员id
    static $superRoleId = 1;//超级管理员角色id
    static $adminRoleId = 'admin_role_id';//主后台角色id
    static $adminUserId = 'admin_user_id';//主后台用户id

    static $username = 'username';//后台登录用户名
    static $goLogin = '请登录';//未登录时中文异常信息
    static $permissionList = 'permission_list';//角色拥有的权限列表
    static $loginErrorCount = 5;//累计密码超过5次

    static $expireTime = 'expire_time';//令牌过期key
}