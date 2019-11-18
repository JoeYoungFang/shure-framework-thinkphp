<?php /*a:2:{s:72:"D:\Reer\myFrameRender\vueadmin\application\admin\view\index\welcome.html";i:1570972386;s:80:"D:\Reer\myFrameRender\vueadmin\application\common\view\layout\_meta_x-admin.html";i:1573736235;}*/ ?>
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
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote">欢迎管理员：
                                <span class="x-red"><?php echo htmlentities(app('session')->get('username')); ?></span>！当前时间:<?php echo date('Y-m-d H:i:s'); ?>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>文章数</h3>
                                        <p>
                                            <cite>66</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>会员数</h3>
                                        <p>
                                            <cite>12</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>回复数</h3>
                                        <p>
                                            <cite>99</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>商品数</h3>
                                        <p>
                                            <cite>67</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>文章数</h3>
                                        <p>
                                            <cite>67</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6 ">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>文章数</h3>
                                        <p>
                                            <cite>6766</cite></p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body  ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">系统信息</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>版本</th>
                                        <td>1.0.0</td></tr>
                                    <tr>
                                        <th>服务器地址</th>
                                        <td><?php echo htmlentities(app('request')->server('HTTP_HOST')); ?></td></tr>
                                    <tr>
                                        <th>操作系统</th>
                                        <td><?php echo htmlentities(app('request')->server('HTTP_USER_AGENT')); ?></td></tr>
                                    <tr>
                                        <th>运行环境</th>
                                        <td><?php echo htmlentities(app('request')->server('SERVER_SOFTWARE')); ?></td></tr>
                                    <tr>
                                        <th>PHP版本</th>
                                        <td><?php echo htmlentities(PHP_VERSION); ?></td></tr>
                                    <tr>
                                        <th>PHP运行方式</th>
                                        <td><?php echo php_sapi_name(); ?></td></tr>
                                    <tr>
                                        <th>ThinkPHP</th>
                                        <td><?php echo htmlentities(app()->version()); ?></td></tr>
                                    <tr>
                                        <th>上传附件限制</th>
                                        <td><?php echo ini_get("upload_max_filesize"); ?></td></tr>
                                    <tr>
                                        <th>执行时间限制</th>
                                        <td><?php echo ini_get("max_execution_time"); ?>s</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">开发团队</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>版权所有</th>
                                        <td>Reer
                                            <a href="http://www.php110.top/" target="_blank">访问官网</a></td>
                                    </tr>
                                    <tr>
                                        <th>开发者</th>
                                        <td>Reer(1101585768@qq.com)</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm"> Reer 提供技术支持。</blockquote></div>
            </div>
        </div>
    </body>
<style>
    .layui-card{
        min-height: unset;
    }
</style>
