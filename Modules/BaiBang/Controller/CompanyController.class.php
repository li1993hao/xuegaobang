<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ThinkController;


/**用户管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class CompanyController extends CommonController
{
    public function verify(){
        $map['status']  =   array('eq',2);
        $list   = $this->p_lists("Company", $map,'id asc');
        if($list){
            int_to_string($list);
        }
        $this->assign('list', $list);
        $this->meta_title = '用户信息';
        $this->_display();
    }


    /**
     * 审核不通过
     * @return mixed|null|string
     */
    public function verifyNot(){
        $uid = I("post.uid");
        $reason = I("post.reason");
        notice($uid,"企业资料未通过审核",$reason);
        parent::editRow("Company",array('status'=>3));
    }
}