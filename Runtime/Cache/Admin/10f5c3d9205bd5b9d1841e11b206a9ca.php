<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title data-book="程序API文档(在线版)">程序API文档(在线版)</title>
    <link rel="stylesheet" href="/xuegaobang/Addons/ApiDoc/asset/css/layout.css">
    <link rel="stylesheet" href="/xuegaobang/Addons/ApiDoc/asset/css/style.css">
    <link rel="stylesheet" href="/xuegaobang/Addons/ApiDoc/asset/css/thinktreeStyle.css">
    <link rel="stylesheet" href="/xuegaobang/Addons/ApiDoc/asset/css/thinkeditorStyle.css">
    <link rel="stylesheet" href="/xuegaobang/Addons/ApiDoc/asset/css/prettify.css">
</head>
<body>
<header class="layout">
    <section class="header">
        <hgroup>
            <h1>程序API文档(在线版)</h1>
        </hgroup>
    </section>
</header>
<aside class="layout">
<nav>
    <ul>
        <li data-id="3" data-name="preface" class="active">
            <div><a class="apiDoc jdi-init-doc"  href="javascript:;">说明</a></div>
        </li>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$module): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($module['index']); ?>" data-name="<?php echo ($module['module']['title']); ?>" class="closed">
                <div><a href="javascript:;"><?php echo ($module['module']['title']); ?></a></div>
                <ul>
                    <?php if(is_array($module["apiClass"])): $i = 0; $__LIST__ = $module["apiClass"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apiClass): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($apiClass['index']); ?>" data-name="<?php echo ($apiClass['name']); ?>">
                            <div><a href="javascript:;"><?php echo ($apiClass['name']); ?></a></div>
                            <ul>
                                <?php if(is_array($apiClass["method"])): $i = 0; $__LIST__ = $apiClass["method"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><li data-name="<?php echo ($method["name"]); ?>">
                                        <div><a class="apiDoc" data-index="<?php echo ($method["index"]); ?>" href="javascript:;"><?php echo ($method["name"]); ?></a></div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</nav>
</aside>
<section class="layout">
    <div id="introduce">
        <h1>API说明文档</h1>
    </div>
    <div id="apiDetail" style="display: none">
        <h1 class="title" style="margin: 20px"></h1>
        <hr/>
        <div class="jdi-introduce"  style="margin: 20px"></div>
        <hr/>
        <div class="jdi-params"  style="margin: 20px">
        </div>
        <hr/>
        <div class="jdi-return"  style="margin: 20px">
        </div>
        <hr/>
        <div class="jdi-url"  style="margin: 20px">
        </div>
        <hr/>
        <div class="jdi-test" style="margin: 20px; margin-bottom: 100px">
            <h3>测试api</h3>
            url:<input type="text" style="width: 100%"  id="test-url"/><br/>
            参数:<input type="text" style="width: 100%"  id="test-param">
            <button id="test-button">测试</button>
            <h3>返回结果</h3>
            <div id="test-result" class="test-black"></div>
        </div>
    </div>
</section>
<footer class="layout">
    <p class="copyright">&copy;2013 <a href="http://www.tiptimes.com" target="_blank">时代科技</a></p>
</footer>
<div id="loading"></div>
<!--[if !IE]> -->

<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/jquery-2.0.3.min.js"></script>
<!-- <![endif]-->
<!--[if IE]>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/jquery-1.10.2.min.js"></script>
<![endif]-->

<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/jquery.thinktree.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/jquery.thinkkeyboard.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/prettify.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/lang-css.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/jquery.zclip.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/document.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/manage.js"></script>
<script type="text/javascript" src="/xuegaobang/Addons/ApiDoc/asset/js/sha1.min.js"></script>
<script type="text/javascript">Article.init();/* 初始文档对象 */
    var JDO_DOCUMENT = <?php echo json_encode($list);?>;
    var api_key  = "<?php echo C('API_PRIVATE_KEY');?>";
    var host_url = "<?php echo ($addons_config["url"]); ?>?";
</script>
</div>
</body>
</html>