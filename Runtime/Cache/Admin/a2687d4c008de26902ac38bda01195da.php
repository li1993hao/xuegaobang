<<<<<<< HEAD
<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">产品信息</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 程序版本</div>
                            <div class="profile-info-value">
                                <span><?php echo (JDICMS_VERSION); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 服务器操作系统</div>
                            <div class="profile-info-value">
                                <span><?php echo (PHP_OS); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ThinkPHP版本</div>
                            <div class="profile-info-value">
                                <span><?php echo (THINK_VERSION); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 物理路径</div>
                            <div class="profile-info-value">
                                <span><?php echo dirname(THINK_PATH);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> MYSQL版本</div>
                            <div class="profile-info-value">
                         <span>
                     <?php $system_info_mysql = M()->query("select version() as v;"); ?>
                      <?php echo ($system_info_mysql["0"]["v"]); ?>
                        </span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 上传限制</div>
                            <div class="profile-info-value">
                                <span><?php echo ini_get('upload_max_filesize');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">开发团队</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 产品团队</div>

                            <div class="profile-info-value">
                                <span>tiptimes</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 技术支持 </div>

                            <div class="profile-info-value">
                                <span>tiptimes</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 联系方式 </div>

                            <div class="profile-info-value">
                                <span>lh@tiptimes.com</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 官网 </div>

                            <div class="profile-info-value">
                                <span>www.tiptimes.com</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 开发文档 </div>

                            <div class="profile-info-value">
                                <span>暂无</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> qq群 </div>

                            <div class="profile-info-value">
                                <span>暂无</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
=======
<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">产品信息</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 程序版本</div>
                            <div class="profile-info-value">
                                <span><?php echo (JDICMS_VERSION); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 服务器操作系统</div>
                            <div class="profile-info-value">
                                <span><?php echo (PHP_OS); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ThinkPHP版本</div>
                            <div class="profile-info-value">
                                <span><?php echo (THINK_VERSION); ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 物理路径</div>
                            <div class="profile-info-value">
                                <span><?php echo dirname(THINK_PATH);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> MYSQL版本</div>
                            <div class="profile-info-value">
                         <span>
                     <?php $system_info_mysql = M()->query("select version() as v;"); ?>
                      <?php echo ($system_info_mysql["0"]["v"]); ?>
                        </span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 上传限制</div>
                            <div class="profile-info-value">
                                <span><?php echo ini_get('upload_max_filesize');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">开发团队</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 产品团队</div>

                            <div class="profile-info-value">
                                <span>tiptimes</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 技术支持 </div>

                            <div class="profile-info-value">
                                <span>tiptimes</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 联系方式 </div>

                            <div class="profile-info-value">
                                <span>lh@tiptimes.com</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 官网 </div>

                            <div class="profile-info-value">
                                <span>www.tiptimes.com</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 开发文档 </div>

                            <div class="profile-info-value">
                                <span>暂无</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> qq群 </div>

                            <div class="profile-info-value">
                                <span>暂无</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
>>>>>>> origin/master
</div>