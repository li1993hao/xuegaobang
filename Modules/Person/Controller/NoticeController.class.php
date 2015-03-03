<?php
namespace Modules\Person\Controller;
use Common\Controller\ModuleController;
use Think\Controller;
use Think\Page;

/**企业通知中心
 * Class IndexController
 * @package Modules\Person\Controller
 */
class NoticeController extends ModuleController {
    /**
     * 通知中心
     */
    public function  index(){
        MK();
        /* 查询条件初始化 */
        $map  = array('status' => array('gt',-1),'uid'=>UID);
        $list = $this->p_lists('Notice',$map,'update_time');
        int_to_string($list, array('status'=>array
        (1=>'<span class="label label-success ">已读</span>',
            -1=>'删除',0=>'<span class="label label-danger ">未读</span>',
        )));
        $list = list_sort_by($list,'status');
        $this->assign('list', $list);
        $this->meta_title = '产品管理';
        $this->_display();
    }

    /**
     * 删除数据
     */
    public function  del(){
        parent::editRow('Notice',array('status'=>-1),array('uid'=>UID));
    }
    /**
     *标志为以读
     */
    public function read(){
        parent::editRow('Notice',array('status'=>1),array('uid'=>UID));
    }
}