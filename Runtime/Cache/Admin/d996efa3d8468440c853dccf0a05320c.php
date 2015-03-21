<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
<title><?php echo ((isset($meta_title) && ($meta_title !== ""))?($meta_title):C('WEB_SITE_TITLE')); ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="renderer" content="webkit">
<!-- basic styles -->
<link href="/xuegaobang/Public/vendor/ace/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/font-awesome.min.css" />

<!--[if IE 7]>
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/font-awesome-ie7.min.css" />
<![endif]-->

<!-- page specific plugin styles -->
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/jquery.gritter.css" />
<!-- fonts -->

<!-- ace styles -->

<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/ace.min.css" />
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/ace-rtl.min.css" />
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/ace-skins.min.css" />

<link rel="stylesheet" href="/xuegaobang/Public/Admin/css/comm.css" />
<!--[if lte IE 8]>
<link rel="stylesheet" href="/xuegaobang/Public/vendor/ace/css/ace-ie.min.css" />
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery-2.0.3.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery-1.10.2.min.js"></script>
<![endif]-->

<!-- ace settings handler -->

<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/ace-extra.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/html5shiv.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/respond.min.js"></script>
<![endif]-->

    

    
</head>
<body class="navbar-fixed">
<div class="shade" style="display:none"></div>
<!-- 头部 -->
<div class="navbar navbar-default navbar-fixed-top">
<script type="text/javascript">
    try {
        ace.settings.check('navbar', 'fixed')
    } catch (e) {
    }
</script>
<div class="container-fluid">
    <div class="navbar-header">
        <button class="navbar-toggle collapsed" type="button" id="nav_top_main_bt" data-toggle="collapse" data-target="nav_top_main">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!--<a class="navbar-brand hidden-sm" href="http://www.bootcss.com">天津市体育局</a>-->
    </div>
    <div class="navbar-collapse collapse" id="nav_top_main">
        <ul class="nav navbar-nav">
            <li class="menu_hide menu_hide1">
                <span>您好:<?php echo session('user_auth.nickname');?></span>
            </li>
            <li class="menu_hide menu_hide2">
                <a href="<?php echo U('index/updatePassword');?>">
                    修改密码
                </a>
            </li>
            <li class="menu_hide menu_hide2">
                <a href="<?php echo U('index/updateNickname');?>">
                    修改昵称
                </a>
            </li>
            <li class="menu_hide menu_hide3">
                <a href="<?php echo U('public/logout');?>">
                    退出
                </a>
            </li>
            <li class="menu_hide" style="background-color: #fff;height:2px"></li>
            <li ><a  href="<?php echo U('index/index');?>" class="<?php echo ((isset($__INDEXCLASS__) && ($__INDEXCLASS__ !== ""))?($__INDEXCLASS__):''); ?>">首页</a></li>
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if(($menu["hide"]) == "0"): ?><li ><a  class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>" href="<?php echo U($menu['url']);?>"><?php echo ($menu["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <!--<li ><a  href="<?php echo (C("WEB_URL")); ?>"  target="_blank">主页</a></li>-->

        </ul>
        <ul class="user_menu_ul nav navbar-nav navbar-right ">
            <li >
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <i class="icon-user" style="font-size: 23px"></i>
                </a>
                <ul class="user-menu  dropdown-menu">
                    <li>
                        <span>您好:<?php echo session('user_auth.nickname');?></span>
                    </li>
                    <li class="menu_hide menu_hide2">
                        <a href="<?php echo U('index/updatePassword');?>">
                            修改密码
                        </a>
                    </li>
                    <li class="menu_hide menu_hide2">
                        <a href="<?php echo U('index/updateNickname');?>">
                            修改昵称
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('public/logout');?>">
                            退出
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /.ace-nav -->
</div>


<!-- /头部 -->

<!-- 主体 -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        
            <div class="sidebar sidebar-fixed" id="sidebar">
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <ul class="nav nav-list">
                    <?php if(!empty($_extra_menu)): ?>
                        <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                    <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                        <?php if(!empty($sub_menu)): if(empty($key)): if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>">
                                        <a href="<?php echo _U($menu['url']);?>">
                                            <span class="menu-text"><?php echo ($menu["title"]); ?></span>
                                        </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php else: ?>
                                <?php $group_class = $__MENU__['group_class'][$key]; ?>
                                <li class="<?php echo ($group_class); ?>">
                                    <a href="#" class="dropdown-toggle">
                                        <span class="menu-text"><?php echo ($key); ?></span>
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                                    <ul class="submenu">
                                        <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>">
                                                <a href="<?php echo _U($menu['url']);?>"><?php echo ($menu["title"]); ?></a>
                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </li><?php endif; endif; ?>
                        <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <!-- /.nav-list -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-right" data-icon1="icon-double-angle-left"
                       data-icon2="icon-double-angle-right"></i>
                </div>
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
            </div>
        

        <div class="main-content">

            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-header-title">
                        
    <?php echo ($meta_title); ?>

                    </h1>
                </div>
                <!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        
<script type="text/javascript" src="/xuegaobang/Public/vendor/uploadify/jquery.uploadify.min.js"></script>
    <!-- 标签页导航 -->
<form class="form-horizontal normal-form" action="<?php echo UU(REAL_ACTION_NAME.'?model='.$model['name']);?>" method="post">
     <div class="tabbable">
    <ul class="nav nav-tabs padding-16 tab-size-bigger tab-space-1">
        <?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li <?php if(($key) == "1"): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#tab<?php echo ($key); ?>"><?php echo ($group); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="tab-content  padding-24">
        <!-- 表单 -->
        <?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><div id="tab<?php echo ($key); ?>" class="tab-pane <?php if(($key) == "1"): ?>in active<?php endif; ?> tab<?php echo ($key); ?>">
            <?php if(is_array($fields[$key])): $i = 0; $__LIST__ = $fields[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if($field['is_show'] == 1 || $field['is_show'] == 2): ?><div class="form-group">
                        <label class="item-label"><?php echo ($field['title']); ?>:<span class="check-tips"><?php if(!empty($field['remark'])): ?>（<?php echo ($field['remark']); ?>）<?php endif; ?></span></label>
                        <div class="controls">
                            <?php switch($field["type"]): case "num": ?><input type="text" class="text input-mid" name="<?php echo ($field["name"]); ?>" value="<?php echo ($field["value"]); ?>"><?php break;?>
                                <?php case "string": ?><input type="text" class="text input-large" name="<?php echo ($field["name"]); ?>" value="<?php echo ($field["value"]); ?>"><?php break;?>
                                <?php case "textarea": ?><label class="textarea input-large">
                                        <textarea name="<?php echo ($field["name"]); ?>"><?php echo ($field["value"]); ?></textarea>
                                    </label><?php break;?>
                                <?php case "date": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="text input-mid date" value="" placeholder="请选择日期" /><?php break;?>
                                <?php case "date_view_4": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="text input-mid date_view_4" value="" placeholder="请选择日期" /><?php break;?>
                                <?php case "date_3": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="text input-mid date_3" value="" placeholder="请选择日期" /><?php break;?>
                                <?php case "datetime": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="text input-mid time" value="" placeholder="请选择时间" /><?php break;?>
                                <?php case "bool": ?><select name="<?php echo ($field["name"]); ?>">
                                        <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select><?php break;?>
                                <?php case "select": ?><select name="<?php echo ($field["name"]); ?>">
                                        <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select><?php break;?>
                                <?php case "radio": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="radio" value="<?php echo ($key); ?>" name="<?php echo ($field["name"]); ?>"><?php echo ($vo); endforeach; endif; else: echo "" ;endif; break;?>
                                <?php case "checkbox": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" value="<?php echo ($key); ?>" name="<?php echo ($field["name"]); ?>[]"><?php echo ($vo); endforeach; endif; else: echo "" ;endif; break;?>
                                <?php case "editor": ?><div class="controls">
                                        <script id="<?php echo ($field["name"]); ?>" name="<?php echo ($field["name"]); ?>" type="text/plain">
                                                      <?php echo ($data[$field['name']]); ?>
                                        </script>
                                    </div>
                                    <script>
                                        $(function(){
                                            !function(){
                                                UE.getEditor('<?php echo ($field["name"]); ?>',{
                                                    serverUrl :"<?php echo U('File/ueditor');?>"
                                                });
                                            }();
                                        })
                                    </script><?php break;?>
                                <?php case "picture": ?><div class="controls">
                                        <div class="upload-img-box">
                                            <?php if(!empty($data[$field['name']])): ?><div class="upload-pre-item"><img style="max-height:200px;max-width:200px" src="<?php echo (get_cover($data[$field['name']],'path')); ?>"/></div><?php endif; ?>
                                        </div>
                                        <input type="file" id="upload_picture_<?php echo ($field["name"]); ?>">
                                        <input type="hidden" name="<?php echo ($field["name"]); ?>" id="cover_id_<?php echo ($field["name"]); ?>"/>
                                    </div>
                                    <script type="text/javascript">
                                        //上传图片
                                        /* 初始化上传插件 */
                                        $("#upload_picture_<?php echo ($field["name"]); ?>").uploadify({
                                            "height"          : 30,
                                            "swf"             : "/xuegaobang/Public/vendor/uploadify/uploadify.swf",
                                            "fileObjName"     : "download",
                                            "buttonText"      : "上传图片",
                                            "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                                            "width"           : 120,
                                            'removeTimeout'	  : 1,
                                            'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                            "onUploadSuccess" : uploadPicture<?php echo ($field["name"]); ?>,
                                             "fileSizeLimit"   :250,
                                                'sizeLimit' 	 : 250*1024,
                                        'onFallback' : function() {
                                            alert('未检测到兼容版本的Flash.');
                                        }
                                        });
                                        function uploadPicture<?php echo ($field["name"]); ?>(file, data){
                                            var data = $.parseJSON(data);
                                            var src = '';
                                            if(data.status){
                                                $("#cover_id_<?php echo ($field["name"]); ?>").val(data.id);
                                                src = data.url || '/xuegaobang' + data.path;
                                                $("#cover_id_<?php echo ($field["name"]); ?>").parent().find('.upload-img-box').html(
                                                        '<div class="upload-pre-item"><img style="max-height:200px;max-width:200px" src="' + src + '"/></div>'
                                                );
                                            } else {
                                                errorAlert(data.msg);
                                            }
                                        }
                                    </script><?php break;?>
                                <?php case "file": ?><div class="controls">
                                        <input type="file" id="upload_file_<?php echo ($field["name"]); ?>" >
                                        <input type="hidden" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"/>
                                        <div class="upload-box">
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        //上传文件
                                        /* 初始化上传插件 */
                                        $("#upload_file_<?php echo ($field["name"]); ?>").uploadify({
                                            "height"          : 30,
                                            "swf"             : "/xuegaobang/Public/vendor/uploadify/uploadify.swf",
                                            "fileObjName"     : "download",
                                            "buttonText"      : "上传附件",
                                            "uploader"        : "<?php echo U('File/upload',array('session_id'=>session_id()));?>",
                                            "width"           : 120,
                                            'removeTimeout'	  : 1,
                                            "onUploadSuccess" : uploadFile<?php echo ($field["name"]); ?>,
                                        'onFallback' : function() {
                                            alert('未检测到兼容版本的Flash.');
                                        }
                                        });
                                        function uploadFile<?php echo ($field["name"]); ?>(file, data){
                                            var data = $.parseJSON(data);
                                            if(data.status){
                                                var name = "<?php echo ($field["name"]); ?>";
                                                $("input[name="+name+"]").val(data.data);
                                                $("input[name="+name+"]").parent().find('.upload-box').html(
                                                        "<div class=\"upload-pre-file\"><i class=\"icon-paper-clip\"></i><span>" + data.msg + "</span></div>"
                                                );
                                            } else {
                                                errorAlert(data.msg);
                                            }
                                        }
                                    </script><?php break;?>
                                <?php case "color": ?><select id="colorpicker-<?php echo ($field["name"]); ?>" name="<?php echo ($field["name"]); ?>" class="hide" style="display: none;">
                                        <?php if(is_array(C("SYSTEM_COLOR"))): $i = 0; $__LIST__ = C("SYSTEM_COLOR");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cc); ?>"><?php echo ($cc); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>

                                    <div class="dropdown dropdown-colorpicker open">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span
                                            class="btn-colorpicker btn-colorpicker-<?php echo ($field["name"]); ?>" style="background-color:#555"></span></a>
                                        <ul class="dropdown-menu dropdown-caret">
                                            <?php if(is_array(C("SYSTEM_COLOR"))): $i = 0; $__LIST__ = C("SYSTEM_COLOR");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><li><a class="colorpick-btn colorpick-btn-<?php echo ($field["name"]); ?>" href="javascript:;" style="background-color:<?php echo ($cc); ?>;"
                                                   data-color="<?php echo ($cc); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('#simple-colorpicker-<?php echo ($field["name"]); ?>').ace_colorpicker();
                                            !function(){
                                                $('.colorpick-btn-<?php echo ($field["name"]); ?>').click(function(){
                                                    var color = $(this).data('color');
                                                    $('.colorpick-btn-<?php echo ($field["name"]); ?>').removeClass('selected');
                                                    $(this).addClass('selected');
                                                    $('#colorpicker-<?php echo ($field["name"]); ?>').val(color);
                                                    $('.btn-colorpicker-<?php echo ($field["name"]); ?>').css('background-color',color);
                                                });
                                            }();
                                        });
                                    </script><?php break;?>
                                <?php case "simpleEditor": ?><div class="widget-box">
                                        <div class="widget-header widget-header-small  header-color-blue">
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-body-inner" style="display: block;">
                                                <div class="widget-main">
                                                    <div class="wysiwyg-editor" data-name="<?php echo ($field["name"]); ?>"  id="editor-<?php echo ($field["name"]); ?>" contenteditable="true"></div>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('#editor-<?php echo ($field["name"]); ?>').css({'height':'200px'}).ace_wysiwyg({
                                                toolbar_place: function(toolbar) {
                                                    return $(this).closest('.widget-box').find('.widget-header').prepend(toolbar).children(0).addClass('inline');
                                                },
                                                toolbar:
                                                        [
                                                            'bold',
                                                            'strikethrough',
                                                            null,
                                                            'insertunorderedlist',
                                                            'insertorderedlist',
                                                            null,
                                                            'justifyleft',
                                                            'justifycenter',
                                                            'justifyright'
                                                        ],
                                                speech_button:false
                                            });
                                        });
                                      </script><?php break;?>
                                <?php case "place": ?><div id="city_china_val" data-name="<?php echo ($field["name"]); ?>" class="city_field">
                                            <select class="province cxselect" data-first-title="选择省"></select>
                                            <select class="city cxselect"  data-first-title="选择市" ></select>
                                            <select class="area cxselect"  data-first-title="选择地区" ></select>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $.cxSelect.defaults.url = '/xuegaobang/Public/Admin/cityData.min.json';
                                            $('#city_china').cxSelect({
                                                selects: ['province', 'city', 'area']
                                            });

                                            $('#city_china_val').cxSelect({
                                                selects: ['province', 'city', 'area'],
                                                nodata: 'none'
                                            });
                                        });
                                    </script><?php break;?>
                                <?php case "point": ?><input type="text" class="text" name="<?php echo ($field["name"]); ?>" value="">
                                    (<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">点击拾取坐标</a>,进入拾取坐标页面,输入您的地址点击百度一下,找到地图您公司的位置点击,复制右上角的坐标即可)<?php break;?>
                                <?php case "keyword": ?><div class="input-group col-xs-4"  style="padding:0">
                                        <input class="form-control " type="text" name="<?php echo ($field["name"]); ?>"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm keyword-<?php echo ($field["name"]); ?> btn-primary" type="button">
                                                提取
                                            </button>
                                        </span>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            !function(){
                                                $('.keyword-<?php echo ($field["name"]); ?>').click(function(){
                                                   var title = $("input[name='title']").val();
                                                   if(!title){
                                                       errorAlert('标题不能为空!');
                                                       return;
                                                   }
                                                   var des= $('#description').val();
                                                    if(!des){
                                                        errorAlert('描述不能为空!');
                                                        return;
                                                    }
                                                    $('.keyword-<?php echo ($field["name"]); ?>').addClass('disabled');
                                                    $.post("<?php echo U('tool/getKeyword');?>",{'title':title,'content':des},function(data){
                                                          if(data.status){
                                                              okAlert('获取成功!','',1500);
                                                              $("input[name=<?php echo ($field["name"]); ?>]").val(data.data);
                                                          }else{
                                                              errorAlert(data.msg,'',1500);
                                                          }
                                                        $('.keyword-<?php echo ($field["name"]); ?>').removeClass('disabled');
                                                    });
                                                });
                                            }();
                                        });
                                    </script><?php break;?>
                                <?php case "autoImage": ?><span style="position: relative;top:-9px;margin-left: 10px">提取第</span>
                                    <div class="ace-spinner" style="width: 70px;">
                                        <div class="input-group">
                                            <input type="text" class="input-mini" name="<?php echo ($field["name"]); ?>" value="0" id="<?php echo ($field["name"]); ?>" maxlength="2" />
                                        </div>
                                    </div>
                                    <span style="position: relative;top:-9px">张图片作为封面图片</span>
                                    <script type="text/javascript">
                                        $(function(){
                                            !function(){
                                                $('#<?php echo ($field["name"]); ?>').blur(function(){
                                                    var value = $(this).val();
                                                    if(!$.isNumeric(value)){
                                                        errorAlert('输入无效,必须是大于等于0的数字');
                                                        $(this).focus();
                                                    }
                                                });
                                            }();
                                        });
                                    </script><?php break;?>
                                <?php case "autoText": ?><label class="textarea input-large">
                                        <textarea name="<?php echo ($field["name"]); ?>" id="<?php echo ($field["name"]); ?>"></textarea>
                                    </label>
                                    <script type="text/javascript">
                                        $(function(){
                                            !function(){
                                                var ue=UE.getEditor('content');
                                                ue.addListener('blur',function(){
                                                    var content = ue.getPlainTxt();
                                                    $("#<?php echo ($field["name"]); ?>").val(content.substring(0,125));
                                                })
                                            }();
                                        });
                                    </script><?php break;?>
                                <?php case "multiPicture": ?><div class="controls">
                                        <div class="upload-img-box">
                                        </div>
                                        <input type="file" id="upload_picture_<?php echo ($field["name"]); ?>">
                                        <input type="hidden" name="<?php echo ($field["name"]); ?>" id="<?php echo ($field["name"]); ?>"/>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            var datas = multiInputDatas(true);
                                            //上传图片
                                            /* 初始化上传插件 */
                                            $("#upload_picture_<?php echo ($field["name"]); ?>").uploadify({
                                                "height"          : 30,
                                                "swf"             : "/xuegaobang/Public/vendor/uploadify/uploadify.swf",
                                                "fileObjName"     : "download",
                                                "buttonText"      : "上传图片",
                                                "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                                                "width"           : 120,
                                                'removeTimeout'	  : 1,
                                                'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                                "onUploadSuccess" : uploadPicture<?php echo ($field["name"]); ?>,
                                                "onFallback" : function() {
                                                    alert('未检测到兼容版本的Flash.');
                                                }});

                                            function eventInit(){
                                                $(".del").click(function(){
                                                    var id = $(this).parent().data('id');
                                                    console.info(id);
                                                    datas.remove(id);
                                                    $("#<?php echo ($field["name"]); ?>").val(datas.join());
                                                    $(this).parent().parent().detach();
                                                });
                                                $(".cover").click(function(){
                                                    var id = $(this).parent().data('id');
                                                    var ob = datas.get(id);
                                                    datas.setField('cover',false);
                                                    ob.cover = true;
                                                    $(".cover i").removeClass('red');
                                                    $(this).find('i').addClass('red');
                                                    $("#<?php echo ($field["name"]); ?>").val(datas.join());
                                                });

                                                $(".upload-pre-item ").hover(function(){
                                                    $(this).find('.tools').show();
                                                },function(){
                                                    $(this).find('.tools').hide()
                                                });
                                                $(".upload-pre-item textarea").blur(function(){
                                                    var id = $(this).parent().parent().find(".tools").data('id');
                                                    var text = $(this).val();
                                                    var ob = datas.get(id);
                                                    ob.text = text;
                                                    $("#<?php echo ($field["name"]); ?>").val(datas.join());
                                                });
                                            }
                                            function uploadPicture<?php echo ($field["name"]); ?>(file, data){
                                                var data = $.parseJSON(data);
                                                var src = '';
                                                if(data.status){
                                                    datas.put(data.id,{'id':data.id,'text':'','cover':false});
                                                    $("#<?php echo ($field["name"]); ?>").val(datas.join());
                                                    src = data.url || '/xuegaobang' + data.path;
                                                    $("#<?php echo ($field["name"]); ?>").parent().find('.upload-img-box').append(
                                                            '<div class="upload-pre-item"><div class="tools tools-top" data-id="' +data.id+ '"><a class="cover" href="javascript:;" title="设置为封面"><i class="icon-link white"></i></a><a class="del" href="javascript:;" title="删除"><i class="icon-remove red"></i></a></div><img style="height:200px;width:300px" src="' + src + '"/><div><textarea  placeholder="请输入图片的文字说明"></textarea></div></div>'
                                                    );
                                                    eventInit();
                                                } else {
                                                    errorAlert(data.msg);
                                                }
                                            }

                                        });

                                    </script><?php break;?>

                                <?php default: ?>
                                <input type="text" class="text" name="<?php echo ($field["name"]); ?>" value=""><?php endswitch;?>
                        </div>
                    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="form-group">
        <button class="btn btn-sm btn-primary  ajax-post " type="submit"  target-form="form-horizontal">确 定</button>
        <a class="btn btn-sm" onclick="javascript:history.back(-1);return false;">返 回</a>
    </div>
</div>
</div>
</form>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.page-content -->
            </div>
            <!-- /.main-content -->
        </div>
    </div>
</div><!-- /.main-container -->



<!-- /主体 -->

<!-- 底部 -->

<script type="text/javascript">
    !function(){
        var str = "<script src='/xuegaobang/Public/vendor/ace/js/jquery.mobile.custom.min.js'>"+"<"+"script>";
        if("ontouchend" in document) document.write(str);
    }();
</script>
<script src="/xuegaobang/Public/vendor/ace/js/bootstrap.min.js"></script>
<script src="/xuegaobang/Public/vendor/ace/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/excanvas.min.js"></script>
<![endif]-->

<script type="text/javascript"  src="/xuegaobang/Public/vendor/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery.easy-pie-chart.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/flot/jquery.flot.resize.min.js"></script>

<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/bootbox.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery.gritter.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/bootstrap-wysiwyg.min.js"></script>

<!-- ace scripts -->

<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/ace-elements.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/ace.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ace/js/jquery.hotkeys.min.js"></script>
<script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/xuegaobang", //当前网站地址
            "APP"    : "/xuegaobang/index.php", //当前项目地址
            "PUBLIC" : "/xuegaobang/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
        $("#nav_top_main_bt").click(function(){
            $("#nav_top_main").toggle(200);
        })
    })();
</script>
<script type="text/javascript" src="/xuegaobang/Public/Admin/think.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/Admin/js/common.js"></script>




    <link href="/xuegaobang/Public/vendor/uploadify/uploadify.css" rel="stylesheet" type="text/css">
<link href="/xuegaobang/Public/vendor/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/xuegaobang/Public/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ueditor/ueditor.config.js" ></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Public/vendor/jquery.cxselect.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.date').datetimepicker({
            format: 'yyyy-mm-dd',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
        $('.date_view_4').datetimepicker({
            format: 'yyyy-mm-dd',
            language:"zh-CN",
            minView:2,
            startView:4,
            autoclose:true
        });

        $('.date_3').datetimepicker({
            format: 'yyyy-mm',
            language:"zh-CN",
            minView:3,
            startView:4,
            autoclose:true
        });

        $('.time').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
    });
</script>

</body>
</html>