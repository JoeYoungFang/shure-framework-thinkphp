<?php /*a:2:{s:91:"D:\Reer\myFrameRender\vueadmin\application\admin\view\admin_permission\edit_permission.html";i:1570980476;s:80:"D:\Reer\myFrameRender\vueadmin\application\common\view\layout\_meta_x-admin.html";i:1573736235;}*/ ?>
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
    <div class="layui-row">
        <form class="layui-form">
            <input type="hidden" name="id" value="<?php echo htmlentities($permissionDetail['id']); ?>">
            <?php if($parentPermissionDetail): ?>
            <?php echo widget('common/Form/input',['父级权限','',$parentPermissionDetail['name'],true,true]); ?>
            <input type="hidden" name="parent_id" value="<?php echo htmlentities($parentPermissionDetail['id']); ?>">
            <?php echo widget('common/Form/input',['权限节点名','name',$permissionDetail['name'],true]); ?>
            <?php echo widget('common/Form/input',['模块名','model',$permissionDetail['model'],true,true]); ?>
            <?php echo widget('common/Form/input',['控制器名','controller',$permissionDetail['controller'],true]); ?>
            <?php echo widget('common/Form/input',['方法名','action',$permissionDetail['action'],true]); else: ?>
            <?php echo widget('common/Form/input',['权限节点名','name',$permissionDetail['name'],true]); ?>
            <?php echo widget('common/Form/input',['模块名','model',$permissionDetail['model'],true,true]); ?>
            <?php echo widget('common/Form/input',['控制器名','controller',$permissionDetail['controller'],false]); ?>
            <?php echo widget('common/Form/input',['方法名','action',$permissionDetail['action'],false]); ?>
            <?php endif; ?>
            <?php echo widget('common/Form/input',['图标','icon',$permissionDetail['icon'],false]); ?>
            <?php echo widget('common/Form/select',['菜单显示','is_play',$permissionDetail['is_play'],array(0 => '不显示',1 => '显示')]); ?>
            <?php echo widget('common/Form/submit'); ?>
        </form>
    </div>
</div>
</body>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">

    layui.use(['form','jquery'], function(){
        var form = layui.form;
        var $ = layui.jquery;

        //监听提交
        form.on('submit(submitForm)', function(data){
            ajaxRequest('',data.field,function (res) {
                if(res.code == 200){
                    xadmin.close();//关闭当前frame
                    xadmin.father_reload(); // 可以对父窗口进行刷新
                }else{
                    layerMsg(res.msg)
                }
            })
            return false;
        });
    });
</script>
