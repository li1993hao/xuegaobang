<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
<title></title>
<link href="/jdicms/Template/tiptimes/asset/css/home.css" rel="stylesheet"/>
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
    
</head>
<body>
<!-- 头部 -->
<div class="header">
    <div class="header-top">
        <div class="welcome">欢迎您的光临！</div>
        <img class="icon-phone" src="/jdicms/Template/tiptimes/asset/images/phone.png"/>
        <div class="phone">010-2223256</div>
    </div>
    <div class="navbar">
        <div class="nav-logo"><img src="/jdicms/Template/tiptimes/asset/images/LOGO.png"/></div>
        <div class="menu">
            <ul>
                <li>
                    <a href="<?php echo U('index/index');?>">
                        首页
                    </a>
                </li>
                <?php $__NAV__=cat('',false,$rootNav,'active'); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo ($cat['url']); ?>">
                            <?php echo ($cat['name']); ?>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- /头部 -->

<!-- 主体 -->
<div class="body">
    
    

</div>

<!-- /主体 -->

<!-- 底部 -->
<div class="footer">
    <div class="footer-top"></div>
    <div class="footer-bottom">
        <div class="company">
            <div>© 2013 tiptimes. All rights reserved.Collect from 时代科技 津ICP备13005790号-1</div>
            <div>电话：022-83951188 传真:022-83951199    </div>
            <div>联系地址：天津市西青区天津工业大学创业园B505    </div>
        </div>
    </div>
</div>


</body>
</html>