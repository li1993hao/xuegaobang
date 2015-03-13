<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="/xuegaobang/Template/phonegap/asset/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="/xuegaobang/Template/phonegap/asset/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>

<div data-role="page" id="pageone">
    <div data-role="header">
        <h1>李浩的博客</h1>
    </div>

    <div data-role="content">
        <div data-role="navbar">
            <ul>
                <?php $__NAV__=cat('',false,$rootNav,'active'); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><li class="<?php echo ($cat["class"]); ?>">
                        <a href="<?php echo ($cat['url']); ?>">
                            <?php echo ($cat['name']); ?>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>