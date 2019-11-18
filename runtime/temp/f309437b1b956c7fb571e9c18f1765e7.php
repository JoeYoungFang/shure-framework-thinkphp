<?php /*a:2:{s:92:"D:\Reer\myFrameRender\vueadmin\application\admin\view\admin_role\allocation_permissions.html";i:1570972386;s:87:"D:\Reer\myFrameRender\vueadmin\application\common\view\widget\common\checkbox_tree.html";i:1573992632;}*/ ?>
<link rel="stylesheet" type="text/css" href="/H-UI/lib/zTree/v3/css/metroStyle/metroStyle.css" />
<link rel="stylesheet" type="text/css" href="/H-UI/ztree.css" />

<script type="text/javascript" src="/H-UI/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/H-UI/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/H-UI/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>

<div class="mt-20">
    <div>
        <ul id="treeDemo" class="ztree">

        </ul>
    </div>
    <div id="log"></div>
</div>
<div class="row cl">
    <div style="position: fixed;bottom: 10px;left: 50%;margin-left: -34px;">
        <button type="button" class="layui-btn layui-btn-normal" onclick="changeRolePermission()">确认修改</button>
    </div>
</div>
<script>
    var permissionNode = <?php echo $permissionTree; ?>;
    var url = "<?php echo htmlentities($url); ?>";
    var index = layer.load(0, {
        shade: [1,'#fff'], //0.1透明度的白色背景
    });
    var setting = {
        view: {selectedMulti: false},
        edit: {enable:false,},
        check:{enable:true,chkboxType: { "Y": "ps", "N": "s" }},
        data: {
            key: {children: "children",name:'name'},
            simpleData: {enable: false,idKey: "id",pIdKey: "parent_id",}
        }
    };
    var treeNodes;
    $(document).ready(function(){
        treeNodes = permissionNode;
        $.fn.zTree.init($("#treeDemo"), setting, treeNodes);
        //$.fn.zTree.getZTreeObj("treeDemo").expandAll(true);
        layer.close(index)
    });

    /**
     * 提交修改
     */
    function changeRolePermission() {
        var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
        var nodes = treeObj.getCheckedNodes(true);
        var permissionIds = [];
        for(var i = 0;i < nodes.length;i++){
            permissionIds.push(nodes[i].id);
        }
        ajaxRequest(url,{ids:permissionIds},function (res) {
            layerMsg("修改成功");
            setTimeout(function () {
                parent.layer.closeAll();
            },1000)
        })
    }
</script>

