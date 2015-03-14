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
                        
    <?php echo isset($info['id'])?'编辑':'新增';?>后台菜单

                    </h1>
                </div>
                <!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        
    <form action="<?php echo U();?>" method="post" class="form-horizontal normal-form" >
        <div class="form-group">
            <label>标题<span class="check-tips">（用于后台显示的配置标题）</span></label>
            <div>
                <input type="text" class="text input-large" name="title" value="<?php echo ((isset($info["title"]) && ($info["title"] !== ""))?($info["title"]):''); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>排序<span class="check-tips">（用于分组显示的顺序）</span></label>
            <div >
                <input type="text" class="text input-small" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>">
            </div>
        </div>


        <div class="form-group">
            <label>链接<span class="check-tips">（U函数解析的URL或者外链,主:如果是主菜单下有二级菜单,请添Public/index代表动态菜单）</span></label>
            <div>
                <input type="text" class="text input-large" name="url" value="<?php echo ((isset($info["url"]) && ($info["url"] !== ""))?($info["url"]):''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label>上级菜单<span class="check-tips">（所属的上级菜单）</span></label>
            <div >
                <select name="pid">
                    <?php if(is_array($Menus)): $i = 0; $__LIST__ = $Menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menu["id"]); ?>"><?php echo ($menu["title_show"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  >分组<span class="check-tips">（用于左侧分组二级菜单）</span></label>
            <div>
                <input type="text" class="text input-large" name="group" value="<?php echo ((isset($info["group"]) && ($info["group"] !== ""))?($info["group"]):''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label>是否隐藏<span class="check-tips"></span></label>
            <div class="radio">
                <label>
                    <input name="hide" type="radio" class="ace" value="1">
                    <span class="lbl">是</span>
                </label>
                <label>
                    <input name="hide" type="radio" class="ace" value="0">
                    <span class="lbl">否</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label  >仅开发者模式可见<span class="check-tips"></span></label>
            <div class="radio">
                <label>
                    <input name="is_dev" type="radio" class="ace" value="1">
                    <span class="lbl">是</span>
                </label>
                <label>
                    <input name="is_dev" type="radio" class="ace" value="0">
                    <span class="lbl">否</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label  >说明<span class="check-tips">（菜单详细说明）</span></label>
            <div>
                <input type="text" class="text input-large" name="tip" value="<?php echo ((isset($info["tip"]) && ($info["tip"] !== ""))?($info["tip"]):''); ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
            <button class="btn btn-primary btn-sm ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
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




    <script type="text/javascript">
        Think.setValue("pid", <?php echo ((isset($info["pid"]) && ($info["pid"] !== ""))?($info["pid"]): 0); ?>);
        Think.setValue("hide", <?php echo ((isset($info["hide"]) && ($info["hide"] !== ""))?($info["hide"]): 0); ?>);
        Think.setValue("is_dev", <?php echo ((isset($info["is_dev"]) && ($info["is_dev"] !== ""))?($info["is_dev"]): 0); ?>);
    </script>

</body>
</html>