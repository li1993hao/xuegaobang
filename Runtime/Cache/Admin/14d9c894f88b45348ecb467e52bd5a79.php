<?php if (!defined('THINK_PATH')) exit();?><!-- 标签页导航 -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-16 tab-size-bigger tab-space-1">
        <?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li <?php if(($key) == "1"): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#tab<?php echo ($key); ?>"><?php echo ($group); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="tab-content no-border padding-24">
        <!-- 表单 -->
        <?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><div id="tab<?php echo ($key); ?>" class="tab-pane <?php if(($key) == "1"): ?>in active<?php endif; ?> tab<?php echo ($key); ?>">
            <div class="profile-user-info profile-user-info-striped">
                <?php if(is_array($fields[$key])): $i = 0; $__LIST__ = $fields[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if($field['is_show'] == 1 || $field['is_show'] == 3): ?><div class="profile-info-row">
                            <?php if($field['type'] == 'picture'): ?><div class="profile-info-name">
                                    <div picture="__title__-<?php echo ($field['name']); ?>"><?php echo ($field['title']); ?></div>
                                </div>
                                <?php else: ?>
                                <div class="profile-info-name">
                                    <?php echo ($field['title']); ?>
                                </div><?php endif; ?>
                            <div class="profile-info-value">
                                <?php switch($field["type"]): case "num": echo ($data[$field['name']]); break;?>
                                    <?php case "string": ?><div style="word-wrap: break-word;word-break:break-all;">
                                            <?php echo ($data[$field['name']]); ?>
                                        </div><?php break;?>
                                    <?php case "textarea": ?><div style="word-wrap: break-word;word-break:break-all;"> <?php echo ($data[$field['name']]); ?></div><?php break;?>
                                    <?php case "date": echo (date('Y-m-d',$data[$field['name']])); break;?>
                                    <?php case "datetime": echo (date('Y-m-d H:i',$data[$field['name']])); break;?>
                                    <?php case "date_view_4": echo (date('Y-m-d',$data[$field['name']])); break;?>
                                    <?php case "date_3": echo (date('Y-m',$data[$field['name']])); break;?>
                                    <?php case "bool": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($data[$field['name']]) == $key): echo ($vo); endif; endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "select": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($data[$field['name']]) == $key): echo ($vo); endif; endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "radio": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($data[$field['name']]) == $key): echo ($vo); endif; endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "checkbox": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox">
                                                <?php if(in_array(($key), is_array($data[$field['name']])?$data[$field['name']]:explode(',',$data[$field['name']]))): echo ($vo); endif; ?>
                                            </label><?php endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "editor": ?><section > <?php echo (htmlspecialchars_decode($data[$field['name']])); ?>
                                        </section><?php break;?>
                                    <?php case "picture": if(!empty($data[$field['name']])): ?><img style="max-height:200px;max-width:200px" picture="__picture__-<?php echo ($field['name']); ?>"  src="/xuegaobang<?php echo (get_cover($data[$field['name']],'path')); ?>"/><?php endif; break;?>
                                    <?php case "file": if(isset($data[$field['name']])): ?><div class="upload-pre-file"><i class="icon-paper-clip"></i><span><?php echo (get_table_field($data[$field['name']],'id','name','File')); ?></span>
                                            </div><?php endif; break;?>
                                    <?php case "color": ?><a><span class="btn-colorpicker btn-colorpicker-<?php echo ($field["name"]); ?>" style="background-color:<?php echo ($data[$field['name']]); ?>"></span></a><?php break;?>
                                    <?php case "simpleEditor": echo (htmlspecialchars_decode($data[$field['name']])); break;?>
                                    <?php case "place": ?><i class="icon-map-marker light-orange bigger-110"></i>
    <span>
        <?php echo ($data[$field['name']]); ?>
    </span><?php break;?>

                                    <?php default: ?>
                                    <?php echo ($data[$field['name']]); endswitch;?>
                            </div>
                        </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>