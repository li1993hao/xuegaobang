<?php
namespace Modules\BaiBang\Controller;

use Common\Controller\ModuleController;
use Think\Controller;

/**用户管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class UserController extends ModuleController
{
    public function index(){
        $nickname       =   I('nickname');
        $map['status']  =   array('egt',0);
        $map['type'] = array('gt',0);
        if(is_numeric($nickname)){
            $map['id']=   array('id'=>$nickname);
        }else if(isset($nickname)){
            $map['nickname']    =   array('like', '%'.(string)$nickname.'%');
        }
        $model =D('Member');
        $list   = $this->p_lists($model, $map,'id asc');
        int_to_string($list);
        $this->assign('group',$group);
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->_display();
    }
    public function verify(){

    }
}