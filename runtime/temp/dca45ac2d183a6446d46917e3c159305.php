<?php /*a:2:{s:74:"D:\Reer\myFrameRender\vueadmin\application\admin\view\admin\user_list.html";i:1570972386;s:80:"D:\Reer\myFrameRender\vueadmin\application\common\view\layout\_meta_x-admin.html";i:1573736235;}*/ ?>
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
<?php echo widget('common/Common/nav',[array('管理员管理','用户列表')]); ?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <?php echo widget('common/SearchForm/listSearchFrom',[['beginTime' => app('request')->get('beginTime'),'endTime' => app('request')->get('endTime')],
                ['key' => 'realname','value' => app('request')->get('realname'),'name' => '真实姓名'],['key' => 'admin_role_id','name' => '角色','value' => app('request')->get('admin_role_id'),'options' => $adminRoleSelect]]); ?>

                <div class="layui-card-header">
                    <?php echo widget('common/Button/addButton',['添加用户','addUser',[],$permissionStringArray,null,null]); ?>
                    <span style="float: right">共有数据：<strong id="totalCount"><?php echo htmlentities($totalCount); ?></strong> 条</span>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th onclick="clickTableTitle('id','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="id">ID</th>
                            <th onclick="clickTableTitle('username','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="username">登录名</th>
                            <th onclick="clickTableTitle('realname','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="realname">真实姓名</th>
                            <th onclick="clickTableTitle('email','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="email">邮箱</th>
                            <th>角色名</th>
                            <th onclick="clickTableTitle('ip','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="ip">最后登录ip</th>
                            <th onclick="clickTableTitle('login_at','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="login_at">最后登录时间</th>
                            <th onclick="clickTableTitle('created_at','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="created_at">创建时间</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        <?php if(is_array($roleList) || $roleList instanceof \think\Collection || $roleList instanceof \think\Paginator): $i = 0; $__LIST__ = $roleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo htmlentities($vo['id']); ?></td>
                            <td><?php echo htmlentities($vo['username']); ?></td>
                            <td><?php echo htmlentities($vo['realname']); ?></td>
                            <td><?php echo htmlentities($vo['email']); ?></td>
                            <td><?php echo htmlentities($vo['name']); ?></td>
                            <td><?php echo htmlentities($vo['ip']); ?></td>
                            <td><?php echo htmlentities($vo['login_at']); ?></td>
                            <td><?php echo htmlentities($vo['created_at']); ?></td>
                            <td class="td-manage">
                                <?php echo widget('common/Button/edit',['editUser',['id' => $vo['id']],$permissionStringArray,null,null]); ?>
                                <?php echo widget('common/Button/delete',['delUser',['id' => $vo['id']],$permissionStringArray]); ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <div id = "page">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    playOrderIcon("<?php echo htmlentities(app('request')->get('orderFieldName')); ?>","<?php echo htmlentities(app('request')->get('orderType')); ?>");//显示排序图标，注意id为对应列名 onclick="clickTableTitle('id','<?php echo app('request')->get('orderType')=='desc'?'asc' : 'desc'; ?>')" id="列名"

    var currentPage = "<?php echo htmlentities($currentPage); ?>"
    var limit = "<?php echo app('request')->get('pageCount')?app('request')->get('pageCount') : 10; ?>"
    layui.use(['laydate','laypage','jquery','form'], function(){
        var form = layui.form;
        var laydate = layui.laydate;
        var laypage = layui.laypage;
        var layer = layui.layer;
        var $ = layui.jquery;
        var totalCount = $("#totalCount").text()
        laypageRender(laypage,$,"",'page','searchForm',limit,totalCount,currentPage);
        laydateRender(laydate,'start');
        laydateRender(laydate,'end');

    });
</script>
