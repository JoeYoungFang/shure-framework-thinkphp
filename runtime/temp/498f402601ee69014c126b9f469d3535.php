<?php /*a:2:{s:91:"D:\Reer\myFrameRender\vueadmin\application\admin\view\admin_permission\permission_list.html";i:1570972386;s:80:"D:\Reer\myFrameRender\vueadmin\application\common\view\layout\_meta_x-admin.html";i:1573736235;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/H-UI/lib/zTree/v3/css/metroStyle/metroStyle.css" />
<link rel="stylesheet" type="text/css" href="/H-UI/ztree.css" />
<body>
<?php echo widget('common/Common/nav',[array('权限管理','权限列表')]); ?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">
                    <?php echo widget('common/Button/addButton',['添加顶级权限','addTopPermission',[],$permissionStringArray,null,null]); ?>
                    <span style="float: right">共有数据：<strong id="totalCount"><?php echo htmlentities($totalCount); ?></strong> 条</span>
                </div>
                <div class="layui-card-body ">
                    <div>
                        <ul id="treeDemo" class="ztree">

                        </ul>
                    </div>
                    <div id="log"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript" src="/H-UI/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/H-UI/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript">
    <!--
    var permissionNode = <?php echo $permissionTree; ?>;
    var addChildPermission = "<?php echo in_array('addChildPermission',$permissionStringArray); ?>";
    var editPermission = "<?php echo in_array('editPermission',$permissionStringArray); ?>";
    var delPermission = "<?php echo in_array('delPermission',$permissionStringArray); ?>";
    var index = layer.load(0, {
        shade: [1,'#fff'], //0.1透明度的白色背景
    });
    var setting = {
        view: {
            addHoverDom: addHoverDom,
            removeHoverDom: removeHoverDom,
            selectedMulti: false
        },
        edit: {
            enable:true,
            editNameSelectAll: true,
            showRemoveBtn: showRemoveBtn,
            showRenameBtn: showRenameBtn,
            removeTitle:'删除',
            renameTitle:'修改',
        },
        data: {
            key: {
                children: "children",
                name:'name'
            },
            simpleData: {
                enable: false,
                idKey: "id",
                pIdKey: "parent_id",
            }
        },
        callback: {
            beforeDrag: beforeDrag,
            beforeEditName: beforeEditName,
            beforeRemove: beforeRemove,
            onRemove: onRemove,
        }
    };
    function beforeDrag(treeId, treeNodes) {
        return false;
    }
    function beforeEditName(treeId, treeNode) {//编辑时先触发
        index = layerOpen('编辑权限',"editPermission?id="+treeNode.id);
        return false;
    }
    function beforeRemove(treeId, treeNode) {//删除前触发
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.selectNode(treeNode);
        return removeNode(treeNode);
    }
    function onRemove(e, treeId, treeNode) {//删除后触发

    }
    function showRemoveBtn(treeId, treeNode) {//显示删除按钮
        return !treeNode.isParent && delPermission;
    }
    function showRenameBtn(treeId, treeNode) {//显示重命名按钮
        return editPermission;
    }
    function addHoverDom(treeId, treeNode) {//鼠标放置触发的node节点 添加子节点
        if(!addChildPermission){
            return false;
        }
        var sObj = $("#" + treeNode.tId + "_span");
        if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
            + "' title='添加子权限' onfocus='this.blur();'></span>";
        sObj.after(addStr);
        var btn = $("#addBtn_"+treeNode.tId);
        if (btn) btn.bind("click", function(){
            index = layerOpen( '添加子权限',"addChildPermission?id="+treeNode.id);
        });
    };
    function removeHoverDom(treeId, treeNode) {//鼠标离开触发
        $("#addBtn_"+treeNode.tId).unbind().remove();
    };
    var treeNodes;
    $(document).ready(function(){
        treeNodes = permissionNode;
        $.fn.zTree.init($("#treeDemo"), setting, treeNodes);
        //$.fn.zTree.getZTreeObj("treeDemo").expandAll(true);
        layer.close(index)
    });
    //删除节点
    function removeNode(treeNode) {
        var index = layer.load();
        var message = false;
        $.ajax({
            async : false,
            type: 'POST',
            dataType : "json",
            url: "delPermission",//请求的action路径
            data:{id:treeNode.id},
            success:function(res){ //请求成功后处理函数。
                $("#totalCount").text(parseInt($("#totalCount").text())-1)
                layerMsg("删除成功");
                message = true;
            },
            error:function (res) {
                try {
                    let data = JSON.parse(res.responseText);
                    layerMsg(data.errorMsg);
                    message = false;
                } catch (e) {
                    layerMsg('系统异常');
                }
            },
            complete:function () {
                layer.close(index);
            }
        });
        return message;
    }
    //-->
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>