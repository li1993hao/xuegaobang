<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
<title><?php echo ((isset($meta_title) && ($meta_title !== ""))?($meta_title):'jdicms内容管理框架'); ?></title>
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
                        
    插件配置 [ <?php echo ($data["title"]); ?> ]

                    </h1>
                </div>
                <!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        
	<script type="text/javascript" src="/xuegaobang/Public/vendor/uploadify/jquery.uploadify.min.js"></script>
	<form action="<?php echo U('saveConfig');?>" class="form-horizontal" method="post">
		<?php if(empty($custom_config)): if(is_array($data['config'])): foreach($data['config'] as $o_key=>$form): ?><div class="form-group cf">
					<label class="item-label">
						<?php echo ((isset($form["title"]) && ($form["title"] !== ""))?($form["title"]):''); ?>
						<?php if(isset($form["tip"])): ?><span class="check-tips"><?php echo ($form["tip"]); ?></span><?php endif; ?>
					</label>
						<?php switch($form["type"]): case "text": ?><div class="controls">
								<input type="text" name="config[<?php echo ($o_key); ?>]" class="text input-large" value="<?php echo ($form["value"]); ?>">
							</div><?php break;?>
							<?php case "password": ?><div class="controls">
								<input type="password" name="config[<?php echo ($o_key); ?>]" class="text input-large" value="<?php echo ($form["value"]); ?>">
							</div><?php break;?>
							<?php case "hidden": ?><input type="hidden" name="config[<?php echo ($o_key); ?>]" value="<?php echo ($form["value"]); ?>"><?php break;?>
							<?php case "radio": ?><div class="controls">
								<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><label class="radio">
										<input type="radio" name="config[<?php echo ($o_key); ?>]" value="<?php echo ($opt_k); ?>" <?php if(($form["value"]) == $opt_k): ?>checked<?php endif; ?>><?php echo ($opt); ?>
									</label><?php endforeach; endif; ?>
							</div><?php break;?>
							<?php case "checkbox": ?><div class="controls">
								<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><label class="checkbox">
										<?php is_null($form["value"]) && $form["value"] = array(); ?>
										<input type="checkbox" name="config[<?php echo ($o_key); ?>][]" value="<?php echo ($opt_k); ?>" <?php if(in_array(($opt_k), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?>><?php echo ($opt); ?>
									</label><?php endforeach; endif; ?>
							</div><?php break;?>
							<?php case "select": ?><div class="controls">
								<select name="config[<?php echo ($o_key); ?>]">
									<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><option value="<?php echo ($opt_k); ?>" <?php if(($form["value"]) == $opt_k): ?>selected<?php endif; ?>><?php echo ($opt); ?></option><?php endforeach; endif; ?>
								</select>
							</div><?php break;?>
							<?php case "textarea": ?><div class="controls">
								<label class="textarea input-large">
									<textarea name="config[<?php echo ($o_key); ?>]"><?php echo ($form["value"]); ?></textarea>
								</label>
							</div><?php break;?>
							<?php case "picture_union": ?><div class="controls">
								<input type="file" id="upload_picture_<?php echo ($o_key); ?>">
								<input type="hidden" name="config[<?php echo ($o_key); ?>]" id="cover_id_<?php echo ($o_key); ?>" value="<?php echo ($form["value"]); ?>"/>
								<div class="upload-img-box">
									<?php if(!empty($form['value'])): $mulimages = explode(",", $form["value"]); ?>
									<?php if(is_array($mulimages)): foreach($mulimages as $key=>$one): ?><div class="upload-pre-item" val="<?php echo ($one); ?>">
											<img src="<?php echo (get_cover($one,'path')); ?>"  ondblclick="removePicture<?php echo ($o_key); ?>(this)"/>
										</div><?php endforeach; endif; endif; ?>
								</div>
								</div>
								<script type="text/javascript">
									//上传图片
									/* 初始化上传插件 */
									$("#upload_picture_<?php echo ($o_key); ?>").uploadify({
										"height"          : 30,
										"swf"             : "__VEDDOR__/uploadify/uploadify.swf",
										"fileObjName"     : "download",
										"buttonText"      : "上传图片",
										"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
										"width"           : 120,
										'removeTimeout'   : 1,
										'fileTypeExts'    : '*.jpg; *.png; *.gif;',
										"onUploadSuccess" : uploadPicture<?php echo ($o_key); ?>,
										'onFallback' : function() {
								            alert('未检测到兼容版本的Flash.');
								        }
									});

									function uploadPicture<?php echo ($o_key); ?>(file, data){
										var data = $.parseJSON(data);
										var src = '';
										if(data.status){
											src = data.url || '/xuegaobang' + data.path
											$("#cover_id_<?php echo ($o_key); ?>").parent().find('.upload-img-box').append(
												'<div class="upload-pre-item" val="' + data.id + '"><img src="/xuegaobang' + src + '" ondblclick="removePicture<?php echo ($o_key); ?>(this)"/></div>'
											);
											setPictureIds<?php echo ($o_key); ?>();
										} else {
											errorAlert(data.msg);
											setTimeout(function(){
												$('#top-alert').find('button').click();
												$(that).removeClass('disabled').prop('disabled',false);
											},1500);
										}
									}
									function removePicture<?php echo ($o_key); ?>(o){
										var p = $(o).parent().parent();
										$(o).parent().remove();
										setPictureIds<?php echo ($o_key); ?>();
									}
									function setPictureIds<?php echo ($o_key); ?>(){
										var ids = [];
										$("#cover_id_<?php echo ($o_key); ?>").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
											ids.push($(this).attr('val'));
										});
										if(ids.length > 0)
											$("#cover_id_<?php echo ($o_key); ?>").val(ids.join(','));
										else
											$("#cover_id_<?php echo ($o_key); ?>").val('');
									}
								</script><?php break;?>
							<?php case "group": ?><div class="tab-wrap">
                                    <ul class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
                                        <?php if(is_array($form["options"])): $i = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li <?php if(($i) == "1"): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#tab<?php echo ($key); ?>"><?php echo ($li["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
								<div class="tab-content">
								<?php if(is_array($form["options"])): $i = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><div id="tab<?php echo ($key); ?>" class="tab-pane <?php if(($i) == "1"): ?>in active<?php endif; ?> tab<?php echo ($key); ?>">
										<?php if(is_array($tab['options'])): foreach($tab['options'] as $o_tab_key=>$tab_form): ?><label class="item-label">
											<?php echo ((isset($tab_form["title"]) && ($tab_form["title"] !== ""))?($tab_form["title"]):''); ?>
											<?php if(isset($tab_form["tip"])): ?><span class="check-tips"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
										</label>
										<div class="controls">
											<?php switch($tab_form["type"]): case "text": ?><input type="text" name="config[<?php echo ($o_tab_key); ?>]" class="text input-large" value="<?php echo ($tab_form["value"]); ?>"><?php break;?>
												<?php case "password": ?><input type="password" name="config[<?php echo ($o_tab_key); ?>]" class="text input-large" value="<?php echo ($tab_form["value"]); ?>"><?php break;?>
												<?php case "hidden": ?><input type="hidden" name="config[<?php echo ($o_tab_key); ?>]" value="<?php echo ($tab_form["value"]); ?>"><?php break;?>
												<?php case "radio": if(is_array($tab_form["options"])): foreach($tab_form["options"] as $opt_k=>$opt): ?><label class="radio">
															<input type="radio" name="config[<?php echo ($o_tab_key); ?>]" value="<?php echo ($opt_k); ?>" <?php if(($tab_form["value"]) == $opt_k): ?>checked<?php endif; ?>><?php echo ($opt); ?>
														</label><?php endforeach; endif; break;?>
												<?php case "checkbox": if(is_array($tab_form["options"])): foreach($tab_form["options"] as $opt_k=>$opt): ?><label class="checkbox">
															<?php is_null($tab_form["value"]) && $tab_form["value"] = array(); ?>
															<input type="checkbox" name="config[<?php echo ($o_tab_key); ?>][]" value="<?php echo ($opt_k); ?>" <?php if(in_array(($opt_k), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?>><?php echo ($opt); ?>
														</label><?php endforeach; endif; break;?>
												<?php case "select": ?><select name="config[<?php echo ($o_tab_key); ?>]">
														<?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $opt_k=>$opt): ?><option value="<?php echo ($opt_k); ?>" <?php if(($tab_form["value"]) == $opt_k): ?>selected<?php endif; ?>><?php echo ($opt); ?></option><?php endforeach; endif; ?>
													</select><?php break;?>
												<?php case "textarea": ?><label class="textarea input-large">
														<textarea name="config[<?php echo ($o_tab_key); ?>]"><?php echo ($tab_form["value"]); ?></textarea>
													</label><?php break;?>
												<?php case "picture_union": ?><div class="controls">
													<input type="file" id="upload_picture_<?php echo ($o_tab_key); ?>">
													<input type="hidden" name="config[<?php echo ($o_tab_key); ?>]" id="cover_id_<?php echo ($o_tab_key); ?>" value="<?php echo ($tab_form["value"]); ?>"/>
													<div class="upload-img-box">
														<?php if(!empty($tab_form['value'])): $mulimages = explode(",", $tab_form["value"]); ?>
														<?php if(is_array($mulimages)): foreach($mulimages as $key=>$one): ?><div class="upload-pre-item" val="<?php echo ($one); ?>">
																<img src="<?php echo (get_cover($one,'path')); ?>"  ondblclick="removePicture<?php echo ($o_tab_key); ?>(this)"/>
															</div><?php endforeach; endif; endif; ?>
													</div>
													</div>
													<script type="text/javascript">
														//上传图片
														/* 初始化上传插件 */
														$("#upload_picture_<?php echo ($o_tab_key); ?>").uploadify({
															"height"          : 30,
															"swf"             : "__VEDDOR__/uploadify/uploadify.swf",
															"fileObjName"     : "download",
															"buttonText"      : "上传图片",
															"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
															"width"           : 120,
															'removeTimeout'   : 1,
															'fileTypeExts'    : '*.jpg; *.png; *.gif;',
															"onUploadSuccess" : uploadPicture<?php echo ($o_tab_key); ?>,
															'onFallback' : function() {
													            alert('未检测到兼容版本的Flash.');
													        }
														});

														function uploadPicture<?php echo ($o_tab_key); ?>(file, data){
															var data = $.parseJSON(data);
															var src = '';
															if(data.status){
																src = data.url || '/xuegaobang' + data.path
																$("#cover_id_<?php echo ($o_tab_key); ?>").parent().find('.upload-img-box').append(
																	'<div class="upload-pre-item" val="' + data.id + '"><img src="/xuegaobang' + src + '" ondblclick="removePicture<?php echo ($o_tab_key); ?>(this)"/></div>'
																);
																setPictureIds<?php echo ($o_tab_key); ?>();
															} else {
																updateAlert(data.info);
																setTimeout(function(){
																	$('#top-alert').find('button').click();
																	$(that).removeClass('disabled').prop('disabled',false);
																},1500);
															}
														}
														function removePicture<?php echo ($o_tab_key); ?>(o){
															var p = $(o).parent().parent();
															$(o).parent().remove();
															setPictureIds<?php echo ($o_tab_key); ?>();
														}
														function setPictureIds<?php echo ($o_tab_key); ?>(){
															var ids = [];
															$("#cover_id_<?php echo ($o_tab_key); ?>").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
																ids.push($(this).attr('val'));
															});
															if(ids.length > 0)
																$("#cover_id_<?php echo ($o_tab_key); ?>").val(ids.join(','));
															else
																$("#cover_id_<?php echo ($o_tab_key); ?>").val('');
														}
													</script><?php break; endswitch;?>
											</div><?php endforeach; endif; ?>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</div><?php break; endswitch;?>

					</div><?php endforeach; endif; ?>
		<?php else: ?>
			<?php if(isset($custom_config)): echo ($custom_config); endif; endif; ?>
		<input type="hidden" name="id" value="<?php echo I('id');?>" readonly>
		<button type="submit" class="btn btn-sm btn-primary ajax-post" target-form="form-horizontal">确 定</button>
		<button class="btn btn-sm" onclick="javascript:history.back(-1);return false;">返 回</button>
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
            "APP"    : "/xuegaobang/index.php?s=", //当前项目地址
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





</body>
</html>