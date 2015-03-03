<?php if (!defined('THINK_PATH')) exit();?><table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>序号</th>
			<?php if(is_array($listKey)): $i = 0; $__LIST__ = $listKey;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
			 <th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($_list)): $vo = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lv): $mod = ($vo % 2 );++$vo;?><tr>
			<td><?php echo ($lv["id"]); ?></td>
			<?php if(is_array($listKey)): $i = 0; $__LIST__ = $listKey;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lk): $mod = ($i % 2 );++$i;?><td>
					<?php switch($key): case "ip": echo ($lv["$key"]); break;?>
<?php case "visit_time": echo (date("Y-m-d h:m:s",$lv["$key"])); break;?>
<?php case "visit_url": echo ($lv["$key"]); break;?>
<?php case "city": echo ($lv["$key"]); break;?>
<?php case "isp": echo ($lv["$key"]); break; endswitch;?>



					</td><?php endforeach; endif; else: echo "" ;endif; ?>
			<td>
				 <a class="update" href="javascript:;" data-id="<?php echo ($lv["id"]); ?>">删除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<script type="text/javascript">
	 var ajaxUrl = "<?php echo addons_url('IPlistener://IPlistener/deleIp');?>";

	$(function(){
		$('a.update').click(function(){




			var id = $(this).data('id'); //data() 获得被选元素的 data-id数据

			//alert(ajaxUrl);
			//alert(inputs[2].value);


			 //执行ajax请求
            $.ajax({
                type: "POST",
                url: ajaxUrl,
                 data: "id="+id,
                success: function(msg){

					alert(msg);
					window.location.reload();


                },
                error: function(){
                    alert("服务器异步请求失败");

                }
            });



		});
	})
</script>