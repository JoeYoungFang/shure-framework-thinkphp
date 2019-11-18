<?php /*a:1:{s:77:"D:\Reer\myFrameRender\vueadmin\application\common\view\widget\common\nav.html";i:1571188068;}*/ ?>
<div class="x-nav" style="cursor: pointer;">
          <span class="layui-breadcrumb">
              <?php if(is_array($navArray) || $navArray instanceof \think\Collection || $navArray instanceof \think\Paginator): $i = 0; $__LIST__ = $navArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo)): ?>
              <a href="<?php echo htmlentities($vo[0]); ?>"><?php echo $vo[1]; ?></a>
              <?php else: ?>
              <a ><?php echo $vo; ?></a>
              <?php endif; ?>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            <!--<a>
              <cite>导航元素</cite></a>-->
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="layer.load();location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>