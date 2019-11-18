<?php /*a:1:{s:77:"D:\Reer\myFrameRender\vueadmin\application\common\view\widget\form\input.html";i:1570972390;}*/ ?>
<div class="layui-form-item">
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo htmlentities($label); ?></label>
        <div class="layui-input-block">
            <input type="<?php echo !empty($password) ? 'password'  :  'text'; ?>" value="<?php echo htmlentities($value); ?>" name="<?php echo htmlentities($name); ?>" placeholder="<?php echo htmlentities($label); ?>" class="layui-input" <?php if($require): ?>required  lay-verify="<?php echo htmlentities($require); ?>"<?php endif; if($disabled): ?>disabled<?php endif; ?>>
        </div>
    </div>
</div>
