<?php /*a:2:{s:92:"D:\Reer\myFrameRender\vueadmin\application\admin\view\admin_role\allocation_permissions.html";i:1570972386;s:80:"D:\Reer\myFrameRender\vueadmin\application\common\view\layout\_meta_x-admin.html";i:1573736235;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>projectDemo--Reer</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="/H-UI/images/ico.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/X-Admin/css/font.css">
    <link rel="stylesheet" href="/X-Admin/css/xadmin.css">
    <!-- <link rel="stylesheet" href="/X-Admin/css/theme5.css"> -->
    <script type="text/javascript" src="/H-UI/lib/jquery/1.9.1/jquery.min.js"></script>
    <script src="/X-Admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/X-Admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/js/cropperv1.4.1.js"></script>
    <script type="text/javascript" src="/H-UI/my.js" ></script>
    <link rel="stylesheet" href="/X-Admin/my.css" >
    <link rel="stylesheet" href="/static/css/cropperv1.4.1.css" >
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
         var is_remember = false;
    </script>
</head>
<body>
<div class="layui-fluid">

    <?php echo widget('common/Common/checkboxTree',[$permissionTree,'allocationPermissions',['admin_role_id' => app('request')->get('admin_role_id')]]); ?>

</div>
</body>
