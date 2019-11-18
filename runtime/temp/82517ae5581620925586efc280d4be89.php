<?php /*a:1:{s:95:"D:\Reer\myFrameRender\vueadmin\application\common\view\widget\search_form\list_search_from.html";i:1572749944;}*/ ?>
<div class="layui-card-body ">
<form class="layui-form layui-col-space5" id="searchForm">
    <input type="hidden" name="orderFieldName" id="orderFieldName" value="<?php echo htmlentities(app('request')->get('orderFieldName')); ?>">
    <input type="hidden" name="orderType" id="orderType" value="<?php echo htmlentities(app('request')->get('orderType')); ?>">
    <?php if(count($time)): ?>
        <div class="layui-inline layui-show-xs-block">
            <input class="layui-input"  value="<?php echo htmlentities($time['beginTime']); ?>" autocomplete="off" placeholder="开始日" name="beginTime" id="start">
        </div>
        <div class="layui-inline layui-show-xs-block">
            <input class="layui-input"  value="<?php echo htmlentities($time['endTime']); ?>" autocomplete="off" placeholder="截止日" name="endTime" id="end">
        </div>
    <?php endif; if(is_array(current($keywords))): foreach($keywords as $key=>$vo): ?>
            <div class="layui-inline layui-show-xs-block">
                <input type="text" name="<?php echo htmlentities($vo['key']); ?>" value="<?php echo htmlentities($vo['value']); ?>" placeholder="<?php echo htmlentities($vo['name']); ?>" autocomplete="off" class="layui-input">
            </div>
        <?php endforeach; elseif(count($keywords)): ?>
        <div class="layui-inline layui-show-xs-block">
            <input type="text" name="<?php echo htmlentities($keywords['key']); ?>" value="<?php echo htmlentities($keywords['value']); ?>" placeholder="<?php echo htmlentities($keywords['name']); ?>" autocomplete="off" class="layui-input">
        </div>
    <?php endif; if(is_array(current($selects))): foreach($selects as $key=>$vo): ?>
            <div class="layui-inline layui-show-xs-block">
            <select name="<?php echo htmlentities($vo['key']); ?>">
                <option value=""><?php echo htmlentities($vo['name']); ?></option>
                <?php if(is_array($vo['options']) || $vo['options'] instanceof \think\Collection || $vo['options'] instanceof \think\Paginator): $k = 0; $__LIST__ = $vo['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                <option value="<?php echo htmlentities($k); ?>" <?php echo $vo['value']==($k) ? "selected"  :  ""; ?>><?php echo htmlentities($v); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </div>
        <?php endforeach; elseif(count($selects)): ?>
        <div class="layui-inline layui-show-xs-block">
            <select name="<?php echo htmlentities($selects['key']); ?>">
                <option value=""><?php echo htmlentities($selects['name']); ?></option>
                <?php if(is_array($selects['options']) || $selects['options'] instanceof \think\Collection || $selects['options'] instanceof \think\Paginator): $key = 0; $__LIST__ = $selects['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
                    <option value="<?php echo htmlentities($key - 1); ?>" <?php echo $selects['value']==($key - 1) ? "selected"  :  ""; ?>><?php echo htmlentities($vo); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    <?php endif; ?>
    <?php echo $append; ?>
    <div class="layui-inline layui-show-xs-block">
        <button class="layui-btn"  lay-submit="" lay-filter="sreach" onclick="layer.load();"><i class="layui-icon">&#xe615;</i></button>
    </div>
</form>
</div>