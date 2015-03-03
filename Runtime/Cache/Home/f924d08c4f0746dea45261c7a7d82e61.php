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
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/plugins/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/css/style.css">
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/css/headers/header1.css">
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/css/responsive.css">
<!--<link rel="shortcut icon" href="favicon.ico">        -->
<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/plugins/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/plugins/flexslider/flexslider.css">
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/plugins/parallax-slider/css/parallax-slider.css">
<!-- CSS Theme -->
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/css/themes/default.css" id="style_color">
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/unify/css/plugins.css" >
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/css/am.min.css" />
<link rel="stylesheet" href="/xuegaobang/Template/default/asset/css/home.css" />
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/jquery-1.10.2.min.js"></script>

    
    
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

<!--=== Content Part ===-->
<div class="container">
<div class="row magazine-page" style="margin-top: 10px">
    <!--Magazine Slider-->
    <div class="col-md-7 carousel-wapper">
        <div class="carousel  slide carousel-v1 margin-bottom-20" id="myCarousel-1">
            <div class="carousel-inner">
                <?php $_result=position(3);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item <?php if(($i) == "1"): ?>active<?php endif; ?>">
                        <?php if(isset($vo["cover_path"])): ?><a href="<?php echo ($vo["url"]); ?>"><img style="height: 215px;width:100%" alt="<?php echo ($vo["title"]); ?>" src="<?php echo ($vo["cover_path"]); ?>"></a>
                            <?php else: ?>
                            <a href="<?php echo ($vo["url"]); ?>"> <img style="height: 215px;width:100%" alt="<?php echo ($vo["title"]); ?>" src="/xuegaobang/public/static/images/default.jpeg"/></a><?php endif; ?>
                        <div class="carousel-caption">
                            <p><a href="<?php echo ($vo["url"]); ?>" style="color: #ffffff"><?php echo ($vo["title"]); ?></a></p>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="carousel-arrow">
                <a data-slide="prev" href="#myCarousel-1" class="left carousel-control">
                    <i class="icon-angle-left"></i>
                </a>
                <a data-slide="next" href="#myCarousel-1" class="right carousel-control">
                    <i class="icon-angle-right"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="col-md-5">
        <div class="tab-v1">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#messages"  data-toggle="tab">文章排行</a></li>
            </ul>
            <div class="tab-content">
                </div>
                <div class="tab-pane active" id="messages">
                    <ul class="list-unstyled">
                        <?php $__HOTLIST__=api('Document/hot_list',array('cate'=>null, 'limit'=>8)); if(is_array($__HOTLIST__)): $i = 0; $__LIST__ = $__HOTLIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($info['url']); ?>" data-color="<?php echo ($info["list_color"]); ?>"> <?php echo (msubstr($info['title'],0,20)); ?></a>
                                <div class="pull-right"><?php echo (date('Y-m-d',$info["create_time"])); ?></div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                     </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!--/container-->
<!-- End Content Part -->

<!-- /主体 -->

<!-- 底部 -->
<div class="margin-bottom-40"></div>
<!-- JS Global Compulsory -->
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/hover-dropdown.min.js"></script>
<!--<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/back-to-top.js"></script>-->
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/parallax-slider/js/modernizr.js"></script>
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/plugins/parallax-slider/js/jquery.cslider.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/js/app.js"></script>
<script type="text/javascript" src="/xuegaobang/Template/default/asset/unify/js/pages/index.js"></script>
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
<script src="/xuegaobang/Template/default/asset/unify/plugins/respond.js"></script>
<![endif]-->
<?php echo hook('pageFooter');?>


</body>
</html>