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

    
	<link rel="stylesheet" href="/xuegaobang/Public/vendor/codemirror/codemirror.css">
	<link rel="stylesheet" href="/xuegaobang/Public/vendor/codemirror/theme/<?php echo C('codemirror_theme');?>.css">
	<style>
		.CodeMirror,#preview_window{
			width:700px;
			height:500px;
		}
		#preview_window.loading{
			background: url('/xuegaobang/Public/vendor/thinkbox/skin/default/tips_loading.gif') no-repeat center;
		}

		#preview_window textarea{
			display: none;
		}
	</style>

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
                        
    插件快速创建

                    </h1>
                </div>
                <!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        
	<!-- 表单 -->
	<form id="form" action="<?php echo U('build');?>" method="post" class="form-horizontal doc-modal-form">
		<div class="form-group">
			<label class="item-label"><span class="must">*</span>标识名 <span class="check-tips">（请输入插件标识）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="info[name]" value="Example">
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">插件名<span class="check-tips">（请输入插件名）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="info[title]" value="示列">
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">版本<span class="check-tips">（请输入插件版本）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="info[version]" value="0.1">
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">作者<span class="check-tips">（请输入插件作者）</span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="info[author]" value="无名">
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">描述<span class="check-tips">（请输入描述）</span></label>
			<div class="controls">
				<label class="textarea input-large">
					<textarea name="info[description]">这是一个临时描述</textarea>
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">安装后是否启用</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="info[status]" value="1" checked />
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">是否需要配置</label>
			<div class="controls">
				<label class="checkbox"><input type="checkbox" id="has_config" name="has_config" value="1" /></label>
				<label class="textarea input-large has_config hidden">
					<textarea class="textarea" name="config">
&lt;?php
return array(
	'random'=>array(//配置在表单中的键名 ,这个会是config[random]
		'title'=>'是否开启随机:',//表单的文字
		'type'=>'radio',		 //表单的类型：text、textarea、checkbox、radio、select等
		'options'=>array(		 //select 和radion、checkbox的子选项
			'1'=>'开启',		 //值=>文字
			'0'=>'关闭',
		),
		'value'=>'1',			 //表单的默认值
	),
);
					</textarea>
				</label>
				<input type="text" style="display: block;margin-left: 10px" class="text input-large has_config hidden" name="custom_config">
				<div class="check-tips has_config hidden">自定义模板,注意：自定义模板里的表单name必须为config[name]这种，获取保存后配置的值用$data.config.name</div>
			</div>
		</div>
		<div class="form-group">
			<div class="controls">
				<label class="item-label">是否需要外部访问</label>
				<input type="checkbox" class="checkbox" name="has_outurl" value="1" />
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">实现的钩子方法</label>
			<div class="controls">
				<select class="select" name="hook[]" size="10" multiple required>
					<?php if(is_array($Hooks)): $i = 0; $__LIST__ = $Hooks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>" title="<?php echo ($vo["description"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="item-label">是否需要后台列表</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="has_adminlist" name="has_adminlist" value="1" />勾选，扩展里已装插件后台列表会出现插件名的列表菜单，如系统的附件
				</label>
				<label class="textarea input-large has_adminlist hidden">
					<textarea name="admin_list" style="margin-left: 10px">
'model'=>'Example',		//要查的表
			'fields'=>'*',			//要查的字段
			'map'=>'',				//查询条件, 如果需要可以再插件类的构造方法里动态重置这个属性
			'order'=>'id desc',		//排序,
			'list_grid'=>array( 		//这里定义的是除了id序号外的表格里字段显示的表头名和模型一样支持函数和链接
                'cover_id|preview_pic:封面',
                'title:书名',
                'description:描述',
                'link_id|get_link:外链',
                'update_time|time_format:更新时间',
                'id:操作:[EDIT]|编辑,[DELETE]|删除'
            ),
					</textarea>
				</label>
				<input type="text" style="display: block;margin-left: 10px" class="text has_adminlist hidden" name="custom_adminlist">
				<div class="check-tips block has_adminlist hidden">自定义模板,注意：自定义模板里的列表变量为$_list这种,遍历后可以用listkey可以控制表头显示,也可以完全手写，分页变量用$_page</div>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-sm btn-primary" type="button" id="preview">预 览</button>
			<button class="btn btn-sm btn-primary ajax-post_custom submit-btn" target-form="form-horizontal" id="submit">确 定</button>
			<button class="btn btn-sm" onclick="javascript:history.back(-1);return false;">返 回</button>
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




	<script type="text/javascript" src="/xuegaobang/Public/vendor/codemirror/codemirror.js"></script>
	<script type="text/javascript" src="/xuegaobang/Public/vendor/codemirror/xml.js"></script>
	<script type="text/javascript" src="/xuegaobang/Public/vendor/codemirror/javascript.js"></script>
	<script type="text/javascript" src="/xuegaobang/Public/vendor/codemirror/clike.js"></script>
	<script type="text/javascript" src="/xuegaobang/Public/vendor/codemirror/php.js"></script>

	<script type="text/javascript" src="/xuegaobang/Public/Admin/js/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
		function bindShow(radio_bind, selectors){
			$(radio_bind).click(function(){
				$(selectors).toggleClass('hidden');
			})
		}
		//配置的动态
		bindShow('#has_config','.has_config');
		bindShow('#has_adminlist','.has_adminlist');

		$('#preview').click(function(){
			var preview_url = '<?php echo U("preview");?>';
			$.post(preview_url, $('#form').serialize(),function(data){
				$.thinkbox('<div id="preview_window" class="loading"><textarea></textarea></div>',{
					afterShow:function(){
						var codemirror_option = {
							lineNumbers   :true,
							matchBrackets :true,
							mode          :"application/x-httpd-php",
							indentUnit    :4,
							gutter        :true,
							fixedGutter   :true,
							indentWithTabs:true,
							readOnly	  :true,
							lineWrapping  :true,
							height		  :500,
							enterMode     :"keep",
							tabMode       :"shift",
							theme: "<?php echo C('CODEMIRROR_THEME');?>"
						};
						var preview_window = $("#preview_window").removeClass(".loading").find("textarea");
						var editor = CodeMirror.fromTextArea(preview_window[0], codemirror_option);
						editor.setValue(data);
						$(window).resize();
					},

					title:'预览插件主文件',
					unload: true,
					actions:['close'],
					drag:true
				});
			});
			return false;
		});

		$('.ajax-post_custom').click(function(){
	        var target,query,form;
	        var target_form = $(this).attr('target-form');
	        var check_url = '<?php echo U('checkForm');?>';
			$.ajax({
			   type: "POST",
			   url: check_url,
			   dataType: 'json',
			   async: false,
			   data: $('#form').serialize(),
			   success: function(data){
			    	if(data.status){
    			        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
				            form = $('.'+target_form);
				            if ( form.get(0).nodeName=='FORM' ){
				                target = form.get(0).action;
				                query = form.serialize();
				            }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
				                query = form.serialize();
				            }else{
				                query = form.find('input,select,textarea').serialize();
				            }
				            $.post(target,query).success(function(data){
				                if (data.status==1) {
				                    if (data.url) {
				                        okAlert(data.msg + ' 页面即将自动跳转~');
				                    }else{
                                        okAlert(data.msg + ' 页面即将自动刷新~');
				                    }
				                    setTimeout(function(){
				                        if (data.url) {
				                            location.href=data.url;
				                        }else{
				                        	location.reload();
				                        }
				                    },1500);
				                }else{
				                    updateAlert(data.info);
				                }
				            });
				        }
			    	}else{
			    		errorAlert(data.msg);
					}
			   }
			});

	        return false;
	    });
	</script>

</body>
</html>