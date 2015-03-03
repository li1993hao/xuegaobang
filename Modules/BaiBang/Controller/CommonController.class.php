<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ModuleController;

class CommonController extends ModuleController{
    /**
     * @param null $id
     * @param string $method
     */
    public function info($name=null){
        $name = empty($name)? __CURRENT_CONTROLLER__ : $name;

        $id= I('post.id');
        if (is_numeric($id)) {
            $user = M($name)->find($id);
            parent::info($name, array('id' => $id), '','public/info');//, 'public/info'
        } else {
            $this->error('参数不合法!');
        }
    }
    /**
     * 删除数据
     */
    public function  del(){
        parent::editRow('member',array('status'=>-1),null);
    }

    /**
     * 禁用数据
     */
    public function  forbid(){
        parent::editRow('member',array('status'=>0),null);
    }

    /**
     * 恢复数据
     */
    public function  resume(){
        parent::editRow('member',array('status'=>1),null);
    }

}