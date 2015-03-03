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

    
   <style>
       .rule_check,.child_row{
           margin:10px 0 10px 20px;

       }
       .child_row label{
           display: inline-block;
           margin-right: 10px;
       }


       .checkmod{
           border:#ebebeb 1px solid;
       }

       .checkmod .hd{
            background-color: #ECECEC;
           line-height: 30px;
           margin-bottom: 10px;
           padding-left: 10px;

       }
       .auth_rules{
           margin-right: 5px;
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
                        
    访问授权

                    </h1>
                </div>
                <!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        
	<div>
        <!-- 访问授权 -->
            <form action="<?php echo U('AuthManager/writeGroup');?>" enctype="application/x-www-form-urlencoded" method="POST" class="form-horizontal auth-form">
                <?php if(is_array($node_list)): $i = 0; $__LIST__ = $node_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><dl class="checkmod">
                        <dt class="hd dd-item">
                            <label>
                               <input class="auth_rules rules_all ace" type="checkbox" name="rules[]" value="<?php echo $main_rules[$node['url']] ?>">
                                <span class="lbl"><?php echo ($node["title"]); ?>管理</span>
                            </label>
                        </dt>
                        <dd class="bd">
                            <?php if(isset($node['child'])): if(is_array($node['child'])): $i = 0; $__LIST__ = $node['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="rule_check">
                                    <div class="dd-item">
                                        <label>
                                       <input class="auth_rules rules_row ace" type="checkbox" name="rules[]" value="<?php echo $auth_rules[$child['url']] ?>"/>

                                            <?php if(!empty($child['tip'])): ?><span class="lbl" data-rel="tooltip"  data-original-title="<?php echo ($child["tip"]); ?>"><?php echo ($child["title"]); ?></span>
                                            <?php else: ?>
                                                <span class="lbl"><?php echo ($child["title"]); ?></span><?php endif; ?>
                                        </label>
                                    </div>
                                   <?php if(!empty($child['operator'])): ?><div class="child_row">
                                           <?php if(is_array($child['operator'])): $i = 0; $__LIST__ = $child['operator'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op): $mod = ($i % 2 );++$i;?><label>
                                                   <input class="auth_rules rules_col ace" type="checkbox" name="rules[]"
                                                   value="<?php echo $auth_rules[$op['url']] ?>"/>
                                                   <?php if(!empty($op['tip'])): ?><span class="lbl" data-rel="tooltip"  data-original-title="<?php echo ($op["tip"]); ?>"><?php echo ($op["title"]); ?></span>
                                                       <?php else: ?>
                                                       <span class="lbl"><?php echo ($op["title"]); ?></span><?php endif; ?>
                                               </label><?php endforeach; endif; else: echo "" ;endif; ?>
                                       </div><?php endif; ?>
                                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </dd>
                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>

                <input type="hidden" name="id" value="<?php echo ($this_group["id"]); ?>" />
                <button type="submit" class="btn btn-sm btn-primary ajax-post" target-form="auth-form">确 定</button>
                <button class="btn btn-sm " onclick="javascript:history.back(-1);return false;">返 回</button>
            </form>
	</div>


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




<script type="text/javascript" charset="utf-8">
    $('[data-rel=tooltip]').tooltip();
    +function($){
        var rules = [<?php echo ($this_group["rules"]); ?>];
        $('.auth_rules').each(function(){
            if( $.inArray( parseInt(this.value,10),rules )>-1 ){
                $(this).prop('checked',true);
            }
            if(this.value==''){
                $(this).closest('span').remove();
            }
        }).on('change',function(){
            if($(this).hasClass("rules_row")){
                if(this.checked){
                   $(this).parents('dl').find('.rules_all').prop('checked',true);
                }
            }else if($(this).hasClass("rules_col")){
                if(this.checked){
                    $(this).parents('.rule_check').find('.rules_row').prop('checked',true);
                    $(this).parents('dl').find('.rules_all').prop('checked',true);
                }
            }
        });

        //全选节点
        $('.rules_all').on('change',function(){
            $(this).closest('dl').find('dd').find('input').prop('checked',this.checked);
        });
        $('.rules_row').on('change',function(){
            $(this).closest('.rule_check').find('.child_row').find('input').prop('checked',this.checked);
        });



        $('.checkbox').each(function(){
            $(this).qtip({
                content: {
                    text: $(this).attr('title'),
                    title: $(this).text()
                },
                position: {
                    my: 'bottom center',
                    at: 'top center',
                    target: $(this)
                },
                style: {
                    classes: 'qtip-dark',
                    tip: {
                        corner: true,
                        mimic: false,
                        width: 10,
                        height: 10
                    }
                }
            });
        });

        $('select[name=group]').change(function(){
			location.href = this.value;
        });
    }(jQuery);
</script>

</body>
</html>