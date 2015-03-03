<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/jdicms/Public/phonegap/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="/jdicms/Public/phonegap/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<div data-role="page" id="pageone">
<div data-role="header">
    <button onclick="javascript:history.back(-1);return false;" data-role="button" data-icon="arrow-l">返回</button>
    <h1>李浩的博客</h1>
</div>
<div data-role="content">
    <?php if(!empty($list)): ?><ul data-role="listview" data-inset="true">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i; if(isset($info["cover_path"])): ?><li>
                        <a href="<?php echo ($info["url"]); ?>" data-transition="slide">
                            <img src="<?php echo (thumb($info['cover_path'],100,120)); ?>">
                            <h2><?php echo ($info["title"]); ?></h2>
                            <p><?php echo (msubstr($info["description"],0,120)); ?></p>
                        </a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a href="<?php echo ($info["url"]); ?>" data-transition="slide">
                            <h2><?php echo ($info["title"]); ?></h2>
                            <p><?php echo ($info["description"]); ?></p>
                        </a>
                    </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php echo ($page); ?>
        <?php else: ?>
        <h1 class="text-center"><?php echo ((isset($tip) && ($tip !== ""))?($tip):'暂时还没有新闻哦~~'); ?></h1><?php endif; ?>
</div>
</div>
</body>
</html>