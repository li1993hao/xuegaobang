<?php if (!defined('THINK_PATH')) exit();?><div class="tabbable">
    <ul class="nav nav-tabs padding-16 tab-size-bigger tab-space-1">
        <li class="active">
            <a data-toggle="tab" href="#">用户</a>
        </li>
    </ul>
    <div class="tab-content no-border padding-24">
        <!-- 表单 -->

        <div id="tab" class="tab-panein active">
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name">用户名：</div>
                    <div class="profile-info-value">
                        <div style="word-wrap: break-word;word-break:break-all;"><?php echo ($user["username"]); ?></div>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">昵称：</div>
                    <div class="profile-info-value">
                        <div style="word-wrap: break-word;word-break:break-all;"><?php echo ($user["nickname"]); ?></div>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">注册时间：</div>
                    <div class="profile-info-value">
                        <div style="word-wrap: break-word;word-break:break-all;"><?php echo (date("Y-m-d h:i",$user["reg_time"])); ?></div>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">最后登录时间：</div>
                    <div class="profile-info-value">
                        <div style="word-wrap: break-word;word-break:break-all;"><?php echo (date("Y-m-d h:i",$user["last_login_time"])); ?></div>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">最后登录IP：</div>
                    <div class="profile-info-value">
                        <div style="word-wrap: break-word;word-break:break-all;"><?php echo long2ip($user.last_login_ip);?></div>
                    </div>
                </div>
                <div class="profile-info-row">

                    <div class="profile-info-name">类型：</div>
                    <div class="profile-info-value">
                        <div style="word-wrap: break-word;word-break:break-all;"><?php echo ($user["type_text"]); ?></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>