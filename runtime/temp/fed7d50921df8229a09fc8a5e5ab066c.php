<?php /*a:2:{s:77:"D:\Reer\myFrameRender\vueadmin\application\common\view\widget\form\input.html";i:1570972390;s:78:"D:\Reer\myFrameRender\vueadmin\application\common\view\widget\form\select.html";i:1570972390;}*/ ?>
<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label"><?php echo htmlentities($label); ?></label>
        <div class="layui-input-inline">
            <select name="<?php echo htmlentities($name); ?>" lay-verify="required">
                <option value=""><?php echo htmlentities($label); ?></option>
                <?php if(is_array($options) || $options instanceof \think\Collection || $options instanceof \think\Paginator): $key = 0; $__LIST__ = $options;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
                <option value="<?php echo htmlentities($key-1); ?>" <?php echo $key - 1==$value ? "selected"  :  ""; ?>><?php echo htmlentities($vo); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
</div>