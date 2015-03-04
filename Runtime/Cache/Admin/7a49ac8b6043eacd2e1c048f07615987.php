<?php if (!defined('THINK_PATH')) exit();?><div class="btn-group">
    <a class="btn btn-sm btn-primary" onclick="$('#form').submit();">生成离线Api文档</a>
    <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo addons_url('ApiDoc://index/apiOnline');?>">在线浏览</a>
</div>
<div class="table-responsive">
    <form id="form" action="<?php echo addons_url('ApiDoc://index/generate');?>" method="post">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>

                <th class="center">
                    <label>
                        <input type="checkbox" class="ace check-all">
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>名称</th>
                <th>标识</th>
                <th>描述</th>
                <th>状态</th>
                <th>作者</th>
                <th>版本</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td class="center">
                            <label>
                                <input type="checkbox" class="ids ace" name="names[]" value="<?php echo ($vo["name"]); ?>">
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["description"]); ?></td>
                        <td><?php echo ((isset($vo["status_text"]) && ($vo["status_text"] !== ""))?($vo["status_text"]):"未安装"); ?></td>
                        <td><?php echo ($vo["author"]); ?></a></td>
                        <td><?php echo ($vo["version"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <td colspan="6" class="text-center"> aOh! 暂时还没有内容!</td><?php endif; ?>
            </tbody>
        </table>

    </form>
</div>