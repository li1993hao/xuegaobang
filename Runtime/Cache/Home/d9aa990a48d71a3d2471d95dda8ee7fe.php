<?php if (!defined('THINK_PATH')) exit();?>    <div class="media" id="comment_body">
        <h3>评论</h3><span style="font-size: 12px;color: #909090"><?php echo ($comment_tip); ?></span>
        <hr/>
        <div class="media-body" >
            <?php if(!empty($comment_list)): if(is_array($comment_list)): $i = 0; $__LIST__ = $comment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><h5 class="media-heading"></h5>
                    <p class="comment_content"><?php echo ($comment["content"]); ?></p>
                    <div class="comment_footer">
                        <span title="评论时间:<?php echo (date('Y-m-d H:i',$comment["create_time"])); ?>"><?php echo ($comment["create_time_text"]); ?></span> by <?php echo ($comment["uid_text"]); ?><a class="comment_reply" data-reply="<?php echo (url_encode($comment['id'])); ?>"  data-user="<?php echo ($comment["uid_text"]); ?>" onclick="commentReply(this)" href="javascript:;">回复</a></div>
                    <hr><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
                <h3 style="color:#000000" class="text-center">暂无评论！</h3><?php endif; ?>
        </div>
    </div>
    <div class="post-comment">
        <h3>发布评论</h3>
        <hr/>
            <div class="row margin-bottom-20">
                <div class="col-md-11 col-md-offset-0">
                    <textarea  class="form-control" id="comment_content" rows="8"></textarea>
                </div>
            </div>
            <p><button class="btn-u"  onclick="comment(this)" id="comment_btn">提交</button></p>
    </div>
    <?php echo ($comment_page); ?>