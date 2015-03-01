<?php
return array(
//'配置项'=>'配置值'
    'HTML_CACHE_ON'     =>    true, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
//    'HTML_FILE_SUFFIX'  =>    '.html', // 设置静态缓存文件后缀
//    'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
//        'index:category'=>array('{cate}/p/{p}',0),
//        'index:content'=>array('{cate}/{id}',0),
//        'index:index'=>array('index',0)
//    ),
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__IMG__'    => __ROOT__ . '/Public/static/images',
        '__CSS__'    => __ROOT__ . '/Public/static/css',
        '__JS__'     => __ROOT__ . '/Public/static/js',
        '__UPLOADS__' => __ROOT__ . '/Uploads',
        '__UNIFY__' =>__ROOT__.'/public/vendor/unify',
        '__DEFAULT__'=>__ROOT__.'/public/static/images/default.jpeg' //默认显示的图片
    ),
    'TAGLIB_PRE_LOAD' => 'c',
    'AUTO_ENCRYPT_KEY'=>'dssasxer2d2da', //自动登陆加密钥
    'AUTO_COOKIE'=>'ASXOWJadasdmsaldnasdaasd', //自动登陆cookie key
    'AUTO_COOKIE_SIGN'=>'ASDAXZAZ2E2FDCDCASX'  //自动登陆签名
);