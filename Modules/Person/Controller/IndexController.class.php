<?php
namespace Modules\Person\Controller;
use Common\Controller\ModuleController;
use Think\Controller;
use Think\Page;

/**企业信息
 * Class IndexController
 * @package Modules\Person\Controller
 */
class IndexController extends ModuleController {
    /**
     * 企业资料
     */
    public function  index(){
        if(IS_POST){
            $res = M(parse_name("company",true))->where(array('uid'=>UID))->field('id')->find();
            if($res){//有基本信息了
                parent::edit("company",$res['id']);
            }else{
                $_POST['uid'] = UID;
                parent::add("company");
            }
        }else{
            MK();
            $res = M(parse_name("company",true))->where(array('uid'=>UID))->field('id')->find();
            if($res){ //有基本信息了
                $method = I('method');
                if($method == 'edit'){
                    parent::edit("company",$res['id'],'修改企业资料');
                }else{
                    $this->assign('_extend',' <a  href="'._U('index?method=edit').'" class="tooltip-success" data-placement="right" data-rel="tooltip"  data-original-title="点我可进行编辑哦"><i style="color:#6c9842" class="icon-edit icon-animated-vertical bigger-100"></i></a>');
                    parent::info("company",$res['id'],'企业资料');
                }
            }else{
                parent::add("company",'完善企业资料(您还未填写过企业资料,请尽快完善)');
            }
        }
    }

    public function comment(){
        $this->assign('meta_title','企业的相关评论');
        $map  = array('topic_table'=>'member','topic_id'=>UID);
        $list = $this->p_lists('Comment',$map,'update_time');
        $this->assign('list',$list);
        $this->_display();
    }
}