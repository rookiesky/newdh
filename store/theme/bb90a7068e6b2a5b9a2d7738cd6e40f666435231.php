<?php $__env->startSection('content'); ?>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a>
          <cite>链接列表</cite></a>
      </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <div class="layui-row">
            <form class="layui-form layui-col-md12 x-so">
                <input type="text" name="title"  placeholder="请输入链接名称" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加链接','/submer/links_add/sortid/<?php echo e($sortid); ?>',600,400)"><i class="layui-icon"></i>添加</button>
            <span class="x-right" style="line-height:40px"></span>
        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>ID</th>
                <th>名称</th>
                <th>链接</th>
                <th>来源数</th>
                <th>管理Email</th>
                <th>分类</th>
                <th>类型</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo e($value->id); ?>'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td><?php echo e($value->id); ?></td>
                <td><?php echo e($value->title); ?></td>
                <td><?php echo e($value->link); ?></td>
                <td><?php echo e($value->source); ?></td>
                <td><?php echo e($value->email); ?></td>
                <td><?php echo e($value->sort_id); ?></td>
                <td>
                    <?php if($value->type == 1): ?>
                        推荐
                        <?php else: ?>
                        正常
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($value->status == 1): ?>
                        锁定
                        <?php elseif($value->status == 2): ?>
                        黑名单
                        <?php else: ?>
                        正常
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo e(date('Y-m-d H:i:s',$value->addtime)); ?>

                </td>
                <td class="td-manage">
                    <a title="编辑"  onclick="x_admin_show('编辑','/submer/links_add/sortid/<?php echo e($value->sort_id); ?>/id/<?php echo e($value->id); ?>',600,400)" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'<?php echo e($value->id); ?>')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
    <script>
        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.post("/submerApi/delLinks", { id: id },function(e){
                        if (e.status == 'success') {
                              $(obj).parents("tr").remove();
                          }
                     layer.msg(e.msg,{icon:1,time:1000});
                 });
            });
        }
        function delAll (argument) {
            var data = tableCheck.getData();
            layer.confirm('确认要删除吗？'+data,function(index){
                $.post("/submerApi/delLinks", { id: data },function(e){
                    if (e.status == 'success') {
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                    }
                    layer.msg(e.msg,{icon:1,time:1000});
                });
            });
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>