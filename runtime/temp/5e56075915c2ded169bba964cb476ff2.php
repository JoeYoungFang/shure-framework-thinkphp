<?php /*a:1:{s:63:"D:\shure\shure-thinkphp\application\admin\view\login\login.html";i:1574076360;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>后台登录</title>
    <meta name="author" content="DeathGhost">
    <link rel="stylesheet" type="text/css" href="/H-UI/login.css" tppabs="css/style.css">
    <script type="text/javascript" src="/H-UI/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/H-UI/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/H-UI/my.js" ></script>
    <script src="/H-UI/Particleground.js" tppabs="js/Particleground.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
        });
        function submitForm() {
            var userName = $("#userName").val();
            var password = $("#password").val();
            var vcode = $(".vcode").val();
            if (vcode == '') {
                layerMsg('验证码不可为空');
                return;
            }
            if (userName == '' || password == '') {
                layerMsg('账户或密码不能为空');
                return;
            }
            var index = layer.load(1, {
                shade: [0.5,'#fff'], //0.1透明度的白色背景
            });
            ajaxRequest("checkLogin",{vcode:vcode,username:userName,password:password},function (res) {
                top.location.href = '/admin/Index/index';
            },function (res) {
                try {
                    $("img").click();
                    var data = JSON.parse(res.responseText);
                    layer.closeAll();
                    layerMsg(data.errorMsg);
                }catch (e) {
                    layerMsg('系统异常');
                }
            })
        }
        $(document).keypress(function(e) {
            if(e.which == 13) {
                submitForm();
            }
        });
    </script>
</head>
<body>
<canvas class="pg-canvas" width="1278" height="917"></canvas><canvas class="pg-canvas" width="1920" height="917"></canvas>
<dl class="admin_login">
    <dt>
        <strong> 后台管理</strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="账号" id="userName" class="login_txtbx" maxlength="20">
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" class="login_txtbx" id="password" maxlength="20">
    </dd>
    <dd class="val_icon">
        <div class="checkcode">
            <input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx vcode">
            <img class="J_codeimg" src="<?php echo url('admin/Login/getVcode'); ?>" title="看不清？点击换一张" onclick="this.src=this.src+'?rnd='+Math.random()" height=40 style="cursor: pointer" width=165>
        </div>
    </dd>
    <dd>
        <input type="button" value="立即登陆" class="submit_btn" onclick="submitForm();">
    </dd>
    <dd>
        <p>© Reer 版权所有</p>
        <p>技术支持--Reer</p>
    </dd>
</dl>
</body>
</html>