<?php if (!defined('THINK_PATH')) exit();?><div class="center">
    <span class="btn btn-app btn-sm btn-pink  no-hover">
        <span class="line-height-1 bigger-170 "> <?php echo ($info["company"]); ?> </span>
        <br>
        <span class="line-height-1 smaller-90"> 企业用户 </span>
    </span>
    <span class="btn btn-app btn-sm  btn-success no-hover">
        <span class="line-height-1 bigger-170"> <?php echo ($info["user"]); ?> </span>
        <br>
        <span class="line-height-1 smaller-90"> 普通用户 </span>
    </span>

    <span class="btn btn-app btn-sm   btn-light no-hover">
        <span class="line-height-1 bigger-170"> <?php echo ($info["company_verify"]); ?> </span>
        <br>
        <span class="line-height-1 smaller-90"> <a href="#"> 待审核用户</a> </span>
    </span>

    <span class="btn btn-app btn-sm btn-yellow no-hover">
        <span class="line-height-1 bigger-170"> <?php echo ($info["production"]); ?> </span>
        <br>
        <span class="line-height-1 smaller-90"> 产品数量 </span>
    </span>
</div>
<div class="space-6"></div>
<hr/>