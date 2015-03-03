<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>jdicms内容管理框架</title>

<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit">
<!-- CSS Global Compulsory-->
<link rel="stylesheet" href="/jdicms/public/vendor/unify/plugins/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/jdicms/public/vendor/unify/css/style.css">
<link rel="stylesheet" href="/jdicms/public/vendor/unify/css/headers/header1.css">
<link rel="stylesheet" href="/jdicms/public/vendor/unify/css/responsive.css">
<!--<link rel="shortcut icon" href="favicon.ico">        -->
<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="/jdicms/public/vendor/unify/plugins/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/jdicms/public/vendor/unify/plugins/flexslider/flexslider.css">
<link rel="stylesheet" href="/jdicms/public/vendor/unify/plugins/parallax-slider/css/parallax-slider.css">
<!-- CSS Theme -->
<link rel="stylesheet" href="/jdicms/public/vendor/unify/css/themes/default.css" id="style_color">
<link rel="stylesheet" href="/jdicms/public/vendor/unify/css/plugins.css" >
<link rel="stylesheet" href="/jdicms/Public/Home/default/css/am.min.css" />
<link rel="stylesheet" href="/jdicms/Public/Home/default/css/home.css" />
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/jquery-1.10.2.min.js"></script>

    
    <link rel="stylesheet" href="/jdicms/public/vendor/unify/css/pages/page_search.css" >

    <style>
        /*扩展*/
        div.tab-red li.active a{
            border-top: solid 2px #e74c3c;
        }
        div.tab-yellow li.active a{
            border-top: solid 2px #f1c40f;
        }
        div.panel-orange li.active a{
            border-top: solid 2px #e67e22;
        }

        div.tab-blue li.active a{
            border-top: solid 2px #3498db;
        }
        #menu a:hover{
            text-decoration:none;
        }
        #menu ul a:hover{
            background-color:#72c02c;
        }
     </style>
</head>
<body>
<!-- 头部 -->
<!--=== Header ===-->
<div class="header">
    <div class="navbar navbar-default equinav" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown <?php echo ($index_style); ?>">
                        <a href="<?php echo U('index/index');?>">
                            首页
                        </a>
                    </li>
                    <?php $__NAV__=cat('',false,$rootNav,'active'); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i; if($cat['has_child'] != 0): ?><li class="dropdown <?php echo ($cat["class"]); ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
                                    <?php echo ($cat['name']); ?>
                                    <i class="icon-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php $_result=cat($cat['id'],true);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat_child): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($cat_child['url']); ?>"><?php echo ($cat_child['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="<?php echo ($cat["class"]); ?>">
                                <a href="<?php echo ($cat['url']); ?>">
                                    <?php echo ($cat['name']); ?>
                                </a>
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <li class="hidden-sm"><a class="search"><i class="search-btn icon-search"></i></a></li>
               </ul>
                <div class="search-open" style="display: none;">
                    <div class="input-group">
                            <input type="text" id="search_text" name="search" required class="form-control" placeholder="搜索">
                            <span class="input-group-btn">
                            <button class="btn-u" id="search_btn" type="button">确定</button>
                             </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>
</div><!--/header-->



<!-- /头部 -->

<!-- 主体 -->

    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb">
                <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$av): $mod = ($i % 2 );++$i; if($i == count($nav)): ?><li class="active"><?php echo ($av["name"]); ?></li>
                     <?php else: ?>
                        <li><a href="<?php echo ($av["url"]); ?>"><?php echo ($av["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- Begin Content -->
                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i; if(isset($info["cover_path"])): ?><div class="row <?php if(($info["is_up"]) == "1"): ?>search-blocks search-blocks-left-orange<?php else: ?>search-blocks search-blocks-left-green<?php endif; ?> ">
                                <div class="col-md-4">
                                    <a href="<?php echo ($info["url"]); ?>"><img class="img-responsive" src="<?php echo ($info['cover_path']); ?>" alt="<?php echo ($info["title"]); ?>"/></a>
                                    <h4></h4>
                                    <ul class="list-unstyled list-inline">
                                        <li><i class="icon-calendar"></i><?php echo (date('Y-m-d H:i',$info["create_time"])); ?></li>
                                        <li><i class="icon-eye-open"></i> <a href="#"><?php echo ($info["view"]); ?></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-8">
                                    <h4><a href="<?php echo ($info["url"]); ?>" data-color="<?php echo ($info["list_color"]); ?>"><?php echo ($info["title"]); ?></a></h4>
                                    <p><?php echo (msubstr($info["description"],0,120)); ?></p>
                                    <p><a class="btn-u btn-u-small" href="<?php echo ($info["url"]); ?>">详情</a></p>
                                </div>
                            </div>

                            <?php else: ?>
                            <div class="row <?php if(($info["is_up"]) == "1"): ?>search-blocks search-blocks-left-orange<?php else: ?>search-blocks search-blocks-left-green<?php endif; ?> ">
                                <h4><a href="<?php echo ($info["url"]); ?>" data-color="<?php echo ($info["list_color"]); ?>"><?php echo ($info["title"]); ?></a></h4>
                                <div>
                                    <ul class="list-unstyled list-inline">
                                        <li><i class="icon-calendar"></i><?php echo (date('Y-m-d H:i',$info["create_time"])); ?></li>
                                        <li><i class="icon-pencil"></i><?php echo get_nickname($info['uid']);?></li>
                                        <li><i class="icon-eye-open"></i> <a href="#"><?php echo ($info["view"]); ?></a></li>
                                        <?php if(!empty($info["keyword"])): ?><li>
                                                <i class="icon-tags"></i>
                                                <span><?php echo ($info["keyword"]); ?></span>
                                            </li><?php endif; ?>

                                    </ul>
                                </div>
                                <p><?php echo ($info["description"]); ?></p>
                                <p><a class="btn-u btn-u-small" href="<?php echo ($info["url"]); ?>">详情</a></p>
                            </div><?php endif; ?>
                        <hr/><?php endforeach; endif; else: echo "" ;endif; ?>

                    <?php echo ($page); ?>

                    <?php else: ?>
                        <h1 class="text-center"><?php echo ((isset($tip) && ($tip !== ""))?($tip):'暂时还没有新闻哦~~'); ?></h1><?php endif; ?>
        </div>
    </div>
    <!--/container-->
    <!-- End Content Part -->

<!-- /主体 -->

<!-- 底部 -->
<div class="margin-bottom-40"></div>
<!-- JS Global Compulsory -->
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/hover-dropdown.min.js"></script>
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/back-to-top.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/parallax-slider/js/modernizr.js"></script>
<script type="text/javascript" src="/jdicms/public/vendor/unify/plugins/parallax-slider/js/jquery.cslider.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="/jdicms/public/vendor/unify/js/app.js"></script>
<script type="text/javascript" src="/jdicms/public/vendor/unify/js/pages/index.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initSliders();
        Index.initParallaxSlider();
    });

    $('.carousel').carousel({
        interval: 4000 // in milliseconds
    });

    $("#search_text").keyup(function(e) {
        if (e.keyCode === 13) {
            $('#search_btn').click();
        }
    });

    $('#search_btn').click(function(){
        var text = $("#search_text").val();
        text = text.trim();
        if(!text){
            shake($('#search_text').parent());
            $('#search_text').prop('placeholder','写点什么吧..');
        }else{
            var url = "<?php echo U('Index/search?search=PLACEHOLDER');?>";
            location.href= url.replace('PLACEHOLDER',text);
        }
    });

    $('a').each(function(){
        var color = $(this).data('color');
        if(color && color!='#555'){
            $(this).css('color',color);
        }
    });
</script>

<!--[if lt IE 9]>
<script src="/jdicms/public/vendor/unify/plugins/respond.js"></script>
<![endif]-->


</body>
</html>