/**
 * 处理后台抛出的异常
 * @param res
 */
function dealException(res) {
    /*console.log(res)
    let reg = /<pre.+?>(.+)<\/pre>/g;//<pre>过滤pre标签</pre>
    let result = res.responseText.match(reg);
    res.responseText = RegExp.$1;*/
    try {
        let data = JSON.parse(res.responseText);
        layerMsg(data.errorMsg);
    } catch (e) {
        layerMsg('系统异常');
    }
}

/**
 * layer信息框提示
 * @param message
 */
function layerMsg(message) {
    layer.msg(message,{time:1000});
}

/**
 * 打开弹出框（ajax请求为判断有无权限）  todo 优化
 * @param title
 * @param url
 * @param area
 * @param type
 */
function layerOpen(title,url,area = ['80%', '80%'],type = 2) {
    /*$.ajax({
        url:url,
        type:'get',
        data:{checkPermission:'checkPermission'},
        async:false,
        success:function () {
            return layer.open({
                type: type,
                title: title,
                shadeClose: true,
                shade: 0.5,
                maxmin: true, //开启最大化最小化按钮
                area: area,
                content: url
            });
        },
        error:function (res) {
            let data = JSON.parse(res.responseText);
            layerMsg(data.errorMsg);
            return false;
        }
    });*/
    return layer.open({
        type: type,
        title: title,
        shadeClose: true,
        shade: 0.5,
        maxmin: true, //开启最大化最小化按钮
        area: area,
        content: url
    });
}

/**
 * 检测是否有权限
 * @param url
 * @param noPrompt
 */
function checkPermission(url,noPrompt = '') {
    var result = false;
    $.ajax({
        url:url,
        type:'get',
        data:{checkPermission:'checkPermission'},
        async:false,
        success:function () {
            result = true;
        },
        error:function (res) {
            debugger
            if(noPrompt){
                return false;
            }
            let data = JSON.parse(res.responseText);
            layerMsg(data.errorMsg);
            return false;
        }
    });
    return result;
}

/**ajax请求
 * @param requestUrl
 * @param data
 * @param successF
 * @param errorF
 * @param method
 * @param dataType
 */
function ajaxRequest(requestUrl,data = {},successF,errorF,method = 'post',dataType = 'json') {
    //debugger
    var index = layer.load();
    $.ajax({
        url:requestUrl,
        dataType:dataType,
        type:method,
        data:data,
        success:successF ? successF : function (res) {
            if(res.code == 200){
                xadmin.close();//关闭当前frame
                xadmin.father_reload(); // 可以对父窗口进行刷新
            }else{
                layerMsg(res.other)
            }
        },
        error:errorF ? errorF : dealException,
        complete:function () {
            layer.close(index);
        }
    })
}

/**
 * 关闭所有字窗口
 */
function closeIframe() {
    parent.layer.closeAll();
}

/**
 * 获取富文本框html
 * @param data
 * @returns {*}
 */
function appendEditorHtmlData(data){
    $("iframe").each(function (index, value){
        if($(this).attr('textarea')){
            //eval("data.field." + $(this).attr('textarea') + "= '';" ); //$(this).contents().find("body").html()
            Object.defineProperty(data.field, $(this).attr('textarea'), {
                value : $(this).contents().find("body").html(),
                writable : true,
                enumerable : true,
                configurable : true
            });
        }
    })
    return data;
}

/**
 * 根据form表单id获取对应对象
 * @param formId
 */
function getFormObjectValue(formId,$) {
    var params = ($("#" + formId).serializeArray())
    var values = {};
    for(var x in params){
        values[params[x].name] = params[x].value;
    }
    return values;
}

/**
 * 渲染分页
 * @param laypage
 * @param $
 * @param url
 * @param laypageId
 * @param searchFormId
 * @param limit
 * @param totalCount
 * @param currentPage
 */
function laypageRender(laypage,$,url,laypageId,searchFormId,limit,totalCount,currentPage) {
    laypage.render({
        elem: laypageId //注意，这里的 test1 是 ID，不用加 # 号
        ,limits:[limit, 1, 2, 3, 4]
        ,limit:limit
        ,count: totalCount //数据总数，从服务端得到
        ,layout: ['count', 'prev', 'page', 'next', 'skip','refresh','limit']
        ,groups:5
        ,curr:currentPage
        ,jump:function (res,first) {
            var search = getFormObjectValue(searchFormId,$);
            search.page = res.curr;
            search.pageCount = res.limit;
            if(!first){
                location.href = url + '?' + $.param(search)
            }
        }
    });
}

/**
 * 渲染时间框
 * @param laydate
 * @param dateId
 */
function laydateRender(laydate,dateId) {
    laydate.render({
        elem: '#' + dateId //指定元素
        ,trigger:'click'
    });
}

/**通用列表删除
 * @param obj
 * @param url
 * @param id
 */
function listDelete(obj,url) {
    layer.confirm('确认要删除吗？',function(index){
        ajaxRequest(url,{},function (res) {
            $("#totalCount").html(parseInt($("#totalCount").html()) - 1);
            $(obj).parents("tr").remove();
            layerMsg('已删除!')
        })
    });
}

/**
 * 通用列表重置
 * @param obj
 * @param url
 */
function listReset(obj,url) {
    layer.confirm('确认要重置吗？',function(index){
        ajaxRequest(url,{},function (res) {
            $(obj).parents("tr").find(".td-reset").html('-');
            layerMsg('重置成功!')
        })
    });
}

/**
 * 通用启用、禁用
 * @param obj
 * @param url
 * @param status
 */
function changeStatus(obj,url,status){
    var msg = "确定禁用吗？";
    if(status){
        msg = '确定启用吗？';
    }
    layer.confirm(msg,function(index){
        ajaxRequest(url,{status:status != 0},function (res) {
            if(!status){
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');
                $(obj).attr('onclick',"changeStatus(this,'" + url + "',1)");
                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layerMsg('已停用!')
            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');
                $(obj).attr('onclick',"changeStatus(this,'" + url + "',0)");
                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layerMsg('已启用!')
            }
        })
    })
}


/**
 * 后台表格点击触发排序
 */
function clickTableTitle(orderFieldName,orderType) {
    layer.load();
    $("#orderFieldName").val(orderFieldName);
    $("#orderType").val(orderType);
    $("#searchForm").submit()
}
/**
 * 排序图标显示
 */
function playOrderIcon(orderFieldName,orderType) {
    if(orderFieldName !== ''){
        if(orderType === 'desc'){
            $("#"+orderFieldName).append('<i class="layui-icon" style="font-size: 10px;padding-left: 2px;">&#xe61a;</i>');
        }else{
            $("#"+orderFieldName).append('<i class="layui-icon" style="font-size: 10px;padding-left: 2px;">&#xe619;</i>');
        }
    }
}


/**
 * 数值转财务格式
 * @param s 数值
 * @param n 保留小数位
 * @returns
 */
function formatMoney(s, n)
{
    n = n > 0 && n <= 20 ? n : 2;
    s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
    var l = s.split(".")[0].split("").reverse(),
        r = s.split(".")[1];
    t = "";
    for(i = 0; i < l.length; i ++ )
    {
        t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
    }
    return t.split("").reverse().join("") + "." + r;
}

/**
 * 显示总额
 * */
function getTatolMoney(table) {
    var totalMoney = 0.00;
    var tableData = table.cache.userTable;
    $(tableData).each(function (index,value) {
        if(value.length != 0)
            totalMoney += parseFloat(value.pymydl_money);
    });
    $("#totalMoney").html(formatMoney(totalMoney,2));
    $("#totalMoney").attr("value",totalMoney);
}


//base64转file对象
function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, {type:mime});
}
$(document).on("click",".imgList > li > span",function(){
    $(this).parent().remove();
});

/**
 * 图片预览
 * @param obj
 */
function previewImg(obj) {
    var img = new Image();
    img.src = obj.src;
    // var height = img.height; // 原图片大小
    // var width = img.width; //原图片大小
    var imgHtml = "<img src='" + obj.src + "' width='100%' height='100%'/>";
    //弹出层
    layer.open({
        type: 1,
        shade: 0.8,
        offset: 'auto',
        area: '400px',  // area: [width + 'px',height+'px']  //原图显示
        shadeClose:true,
        scrollbar: false,
        title: "图片预览", //不显示标题
        content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
        cancel: function () {
            //layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', { time: 5000, icon: 6 });
        }
    });
}
