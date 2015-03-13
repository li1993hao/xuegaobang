<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
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

    <link rel="stylesheet" href="/xuegaobang/Public/Admin/css/am.min.css" />
    <style>
        #captcha-img{
            cursor: pointer;
            width: 100%;
            height: 55px;
            border: 1px #d5d5d5 solid;
        }
        #login_btn{
            font-size: 16px;
            width: 100%;
            height: 40px;
        }
    </style>
</head>
<body class="login-layout blur-login">

<div class="main-container">
<div class="main-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="login-container">
<div class="center">
    <h1>
        <i class="ace-icon fa fa-leaf green"></i>

        <span class="white" id="id-text2">雪糕棒</span>
    </h1>
    <h4 class="blue" id="id-company-text">&copy; 佰邦科技</h4>
</div>

<div class="space-6"></div>

<div class="position-relative">
    <div id="main-box" class="visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header green lighter bigger">
                    <i class="ace-icon fa fa-users blue"></i>
                    重置密码
                </h4>

                <div class="space-6"></div>
                <form id="main_form">
                    <fieldset>
                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="密码" />
															<i class="icon-lock"></i>
														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="re_password" placeholder="确认密码" />
															<i class="icon-retweet"></i>
														</span>
                        </label>
                        <p id="main_error_tip" class="red"></p>
                        <input type="hidden" name="token" value="<?php echo ($token); ?>"/>
                        <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                <i class="icon-refresh"></i>
                                <span class="bigger-110">重置</span>
                            </button>

                            <button type="button" id="main_button" class="width-65 pull-right btn btn-sm btn-success">
                                <span class="bigger-110">确定</span>
                                <i class="icon-arrow-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.signup-box -->
</div><!-- /.position-relative -->

</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->
</div>
<!-- /.main-container -->

<!-- 底部 -->
<script  type="text/javascript">
    $("#main_button").click(function(){
        $(this).addClass("disabled");
        $.post("<?php echo U('resetPassword');?>", $("#main_form").serialize(),function(data){
            $("#main_button").removeClass("disabled");
            if(data.status){
                $("#main_error_tip").css('color',"green").empty().text(data.msg);
                setTimeout(function(){
                    location.href=data.url;
                },1000);
            }else{
                $("#main_error_tip").css('color',"red").empty().text(data.msg);
            }
            shake("#main_error_tip");
        },'json');
    });
    function shake(ele) {
        $(ele).addClass("shake");
        setTimeout(function() {
            $(ele).removeClass("shake");
        }, 1000);
    }
</script>
</body>
</html>