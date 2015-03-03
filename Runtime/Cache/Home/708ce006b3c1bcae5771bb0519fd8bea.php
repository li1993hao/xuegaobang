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

    
    <link rel="stylesheet" href="/jdicms/public/vendor/unify/css/pages/blog.css">

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
            <div class="blog-item">
                <div class="blog margin-bottom-40">
                    <?php if(info.title_color == '#555' ): ?><h2 class="text-center"><?php echo ($info["title"]); ?></h2>
                    <?php else: ?>
                        <h2 class="text-center" style="color:<?php echo ($info["title_color"]); ?>"><?php echo ($info["title"]); ?></h2><?php endif; ?>
                    <div class="blog-post-tags">
                        <ul class="list-unstyled list-inline">
                            <li><i class="icon-calendar"></i><?php echo (date('Y-m-d H:i',$info["create_time"])); ?></li>
                            <li><i class="icon-pencil"></i><?php echo get_nickname($info['uid']);?></li>
                            <li><i class="icon-eye-open"></i> <?php echo ($info["view"]); ?></li>
                            <?php if(!empty($info["keyword"])): ?><li>
                                    <i class="icon-tags"></i>
                                    <span><?php echo ($info["keyword"]); ?></span>
                                </li><?php endif; ?>
                            <div style="float:right" class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></a></div><script>window._bd_share_config={"common":{"bdSnsKey":{"tsina": "天津市体育局", "tqq": "天津市体育局", "t163": "天津市体育局", "tsohu": "天津市体育局"},"bdText":"<?php echo $info["title"];?>@天津市体育局","bdDesc":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                        </ul>
                    </div>
                    <section><?php echo (htmlspecialchars_decode($info["content"])); ?></section>
                    <?php $prev = api('Document/prev',array('info'=>$info))?>
<?php $next = api('Document/next',array('info'=>$info))?>
<hr/>
<div class="blog_footer clearfix">
    <div class="blog_prev">
        上一篇:
        <?php if(!empty($prev)): ?><a href="<?php echo ($prev["url"]); ?>" data-color="<?php echo ($prev["list_color"]); ?>"><?php echo (msubstr($prev["title"],0,20,true)); ?></a>
            <?php else: ?>
            没有了!<?php endif; ?>
    </div>
    <div class="blog_next">
        下一篇:
        <?php if(!empty($next)): ?><a href="<?php echo ($next["url"]); ?>" data-color="<?php echo ($next["list_color"]); ?>"><?php echo (msubstr($next["title"],0,20,true)); ?></a>
            <?php else: ?>
            没有了!<?php endif; ?>
    </div>
</div>
                </div>
                <hr/>
                <div id="comment_wraper">
                    <div id="comment_list" data-t="<?php echo ($t); ?>" data-id="<?php echo ($id); ?>">
                            <div class="media" id="comment_body">
        <h3>评论</h3><span style="font-size: 12px;color: #909090"><?php echo ($comment_tip); ?></span>
        <hr/>
        <div class="media-body" >
            <?php if(!empty($comment_list)): if(is_array($comment_list)): $i = 0; $__LIST__ = $comment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><h5 class="media-heading"></h5>
                    <p class="comment_content"><?php echo ($comment["content"]); ?></p>
                    <div class="comment_footer">
                        <span title="评论时间:<?php echo (date('Y-m-d H:i',$comment["create_time"])); ?>"><?php echo ($comment["create_time_text"]); ?></span> by <?php echo ($comment["uid_text"]); ?><a class="comment_reply" data-reply="<?php echo (url_encode($comment['id'])); ?>"  data-user="<?php echo ($comment["uid_text"]); ?>" onclick="commentReply(this)" href="javascript:;">回复</a></div>
                    <hr><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
                <h3 style="color:#000000" class="text-center">暂无评论！</h3><?php endif; ?>
        </div>
    </div>
    <div class="post-comment">
        <h3>发布评论</h3>
        <hr/>
            <div class="row margin-bottom-20">
                <div class="col-md-11 col-md-offset-0">
                    <textarea  class="form-control" id="comment_content" rows="8"></textarea>
                </div>
            </div>
            <p><button class="btn-u"  onclick="comment(this)" id="comment_btn">提交</button></p>
    </div>
    <?php echo ($comment_page); ?>

                    </div>
                </div>
            </div>
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

    <script type="text/javascript">
        var url =  "<?php echo U('getComments?t='.$t.'&id='.$id);?>";
        if(url){
            $.get(url,function(data){
                $("#comment_wraper").empty().html(data);
            });
        }

        function getComments(ele){
            var url = $(ele).attr('href');
            if(url){
                $.get(url,function(data){
                    $("#comment_wraper").empty().html(data);
                    var href = location.href.replace("#comment_body",'')+"#comment_body";
                    location.href = href;
                });
            }
        }
        function comment(ele){
            var data = {};
            var content = $("#comment_content").val();
            var id = $("#comment_list").data('id');
            var t = $("#comment_list").data('t');
            var reply = $(ele).data('reply');
            var pid = $(ele).data('pid');

            data.topic_table = t;
            data.topic_id = id;
            data.content = content;

            if(reply !== undefined){
                data.reply = reply;
            }
            $.post("<?php echo U('index/comment');?>",data,function(data){
                if(data.status){
                    alert("评论成功!");
                    var href = location.href.replace("#comment_body",'')+"#comment_body";
                    location.href = href;
                    location.reload();
                }else{
                    alert(data.msg);
                }
            });
        }

        function commentReply(ele){
            var reply = $(ele).data('reply');
            var pid  = $(ele).data('pid');
            var user = $(ele).data('user');
            var content = $($($(ele).parent()).prev()).html();
            $("#comment_btn").data('reply',reply);
            $("#comment_btn").data('pid',pid);
            content = '//@'+user+":"+content;
            $("#comment_content").val(content);
            $("#comment_content").focus();
            var t = document.getElementById('comment_content');
            if(t.setSelectionRange){
                t.setSelectionRange(0,0);
            }
            else if (t.createTextRange) {
                var range = t.createTextRange();
                range.collapse(true);
                range.moveEnd('character', 0);
                range.moveStart('character', 0);
                range.select();
            }
        }
    </script>

</body>
</html>