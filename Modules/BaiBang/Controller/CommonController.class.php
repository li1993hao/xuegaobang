<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ModuleController;

class CommonController extends ModuleController{
    /**
     * @param null $id
     * @param string $method
     */
    public function info($name=null){
        if(empty($name))
            $name = $this->isType();
        $_id= I('post.id');
        if (is_numeric($_id)) {
            //$user = M($name)->find($_id);
            parent::info($name, array('id' => $_id), '','public/info');//, 'public/info'
        } else {
            $this->error('param error!');
        }
    }
    /**
     * 删除数据
     */
    public function  del(){
        parent::editRow(__CURRENT_CONTROLLER__,array('status'=>-1),null);
    }
    /**
     * 禁用数据
     */
    public function  forbid(){
        parent::editRow(__CURRENT_CONTROLLER__,array('status'=>0),null);
    }
    /**
     * 恢复数据
     */
    public function resume(){
        parent::editRow(__CURRENT_CONTROLLER__,array('status'=>1),null);
    }

    /**
     * 置顶
     */
    public function  top(){
        $status = I("get.status");
        parent::editRow(__CURRENT_CONTROLLER__,array('is_top'=>$status),null);
    }

    /**
     * 推荐
     */
    public function recommend(){
        $status = I("get.status");
        parent::editRow(__CURRENT_CONTROLLER__,array('recommend'=>$status),null);
    }

    /**
     * 设精
     */
    public function excellent(){
        $status = I("get.status");
        parent::editRow(__CURRENT_CONTROLLER__,array('excellent'=>$status),null);
    }

    /**
     * 删除评论
     */
    public function delComment(){
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        $where = array('id' => array('in', $id ));
        if(M('Comment')->where($where)->delete() !== false){
            $this->success("删除成功!");
        }else{
            $this->success("删除失败!");
        }
    }

    /**
     * 查看相关评论
     */
    public function comment(){
        $table_name = I('get.table');
        $name = I('get.name');
        $id = I('get.id');
        $this->assign('meta_title',$name.'的相关评论');
        $map  = array('topic_table'=>$table_name,'topic_id'=>$id);
        $list = $this->p_lists('Comment',$map,'update_time');
        $this->assign('list',$list);
        $this->_display("common/comment");
    }
}