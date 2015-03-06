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
                $_POST['status'] = 2;//更改信息,企业资质变为未审核
                parent::edit("company",$res['id'],$success="修改成功!等待审核");
            }else{
                $_POST['uid'] = UID;
                parent::add("company");
            }
        }else{
            $res = M('Company')->where(array('uid'=>UID))->field('id,status')->find();
            if($res){ //有基本信息了
                $method = I('method');
                if($method == 'edit'){
                    parent::edit("company",$res['id'],'修改企业资料');
                }else{
                    MK();
                    $this->assign('_extend',' <a  href="'._U('index?method=edit').'" class="tooltip-success" data-placement="right" data-rel="tooltip"  data-original-title="点我可进行编辑,编辑成功后需要再次审核！"><i style="color:#6c9842" class="icon-edit icon-animated-vertical bigger-100"></i></a>');
                    if($res['status'] == 2){
                        parent::info("company",$res['id'],'企业资料(待审核)');
                    }elseif($res['status'] == 3){
                        parent::info("company",$res['id'],'企业资料(审核未通过)');
                    }else{
                        parent::info("company",$res['id'],'企业资料(正常)');
                    }
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