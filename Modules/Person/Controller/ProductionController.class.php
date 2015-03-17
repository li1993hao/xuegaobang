<?php
namespace Modules\Person\Controller;
use Common\Controller\ModuleController;
use Modules\Person\Api\CommentApi;
use Modules\Person\Api\StaffApi;
use Think\Controller;
use Think\Page;

/**我的产品页面
 * Class ProductionController
 * @package Modules\Person\Controller
 */
class ProductionController extends ModuleController {

    public function _initialize(){
        parent::_initialize();
        $status = check_company_status();
        if($status == -1){//未填写资料
            $this->error('您尚未填写企业资料,不能使用改功能!');
        }elseif($status == 2){ //未审核
            $this->error('您的企业资料尚未通过审核,不能使用该功能!');
        }
    }

    public function  index(){
        MK();
        $map  = array('status' => array('gt',-1),'uid'=>UID);
        $list = $this->p_lists('Production',$map,'update_time');
        int_to_string($list);
        $list = list_sort_by($list,'status');
        if($list){
            for($i=0;$i<count($list);$i++){
                $list[$i]["collect_num"] = StaffApi::staffNum("production",$list[$i]['id']);
                $list[$i]["comment_num"] =CommentApi::commentNum("production",$list[$i]['id']);
                $list[$i]["like_num"] = StaffApi::staffNum("production",$list[$i]['id'],'like');
            }
        }
        $this->assign('list', $list);
        $this->meta_title = '产品列表';
        $this->_display();
    }

    /**
     * 删除数据
     */
    public function  del(){
        parent::editRow('Production',array('status'=>-1),array('uid'=>UID));
    }

    /**
     * 禁用数据
     */
    public function  forbid(){
        parent::editRow('Production',array('status'=>0),array('uid'=>UID));
    }

    /**
     * 恢复数据
     */
    public function  resume(){
        parent::editRow('Production',array('status'=>1),array('uid'=>UID));
    }


    /**
     * 添加或者修改
     */
    public function  add(){
        if(IS_POST){
            $_POST['uid']=UID;//用户id
            parent::add('production');
        }else{
            parent::add('production',"添加产品");
        }
    }

    public function edit(){
        if(IS_POST){
            $id = I('post.id');
            $_POST['status'] = 2;//状态改变为未审核
            parent::edit('Production',$id);
        }else{
            $id = I('get.id');
            $data = M('Production')->where(array('id'=>$id,'uid'=>UID))->find();
            if($data){
                parent::edit('Production',$id,$data['name'].'[修改](产品信息修改后需要重新审核)');
            }else{
                $this->error("编辑数据非法!");
            }
        }
    }

    /**
     * 查看产品相关评论
     */
    public function comment(){
        $id = I('get.id');
        $data = M('Production')->where(array('id'=>$id,'uid'=>UID))->field('name')->find();
        if($data){
            $this->assign('meta_title',$data['name'].'的相关评论');
            $map  = array('topic_table'=>'production','topic_id'=>$id);
            $list = $this->p_lists('Comment',$map,'update_time');
            $this->assign('list',$list);
            $this->_display();
        }else{
            $this->error('未找到相关产品！');
        }
    }
}