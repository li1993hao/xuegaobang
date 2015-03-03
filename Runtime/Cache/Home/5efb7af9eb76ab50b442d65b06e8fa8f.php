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
    <div data-role="header" data-position="fixed">
        <button onclick="javascript:history.back(-1);return false;" data-role="button" data-icon="arrow-l">返回</button>
        <h1>李浩的博客</h1>
    </div>
    <div data-role="content">
        <?php if(info.title_color == '#555' ): ?><h2 style="text-align: center" ><?php echo ($info["title"]); ?></h2>
            <?php else: ?>
            <h2  style="color:<?php echo ($info["title_color"]); ?>;text-align: center"><?php echo ($info["title"]); ?></h2><?php endif; ?>
        <div class="blog-post-tags">
            <span>发布时间:<?php echo (date('Y-m-d',$info["create_time"])); ?></span>
            <span>点击量:<?php echo ($info["view"]); ?></span>
        </div>
        <hr/>
        <section><?php echo (htmlspecialchars_decode($info["content"])); ?></section>
    </div>
</div>
</body>
</html>