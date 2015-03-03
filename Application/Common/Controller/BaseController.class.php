<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Common\Controller;
use Think\Controller;

/**
*所有控制器都要继承他
*/
class BaseController extends Controller{
    protected   function _initialize(){
        /* 读取数据库中的配置 */
        $config = S('DB_CONFIG_DATA');
        if(!$config){
            $config = api('Config/lists');
            S('DB_CONFIG_DATA',$config);
        }
        C($config); //添加配置
    }

    protected function  J_J($status,$data,$msg){
        $datas['status'] = $status;
        $datas['data'] = $data;
        $datas['msg'] = $msg;
        $this->ajaxReturn($datas);
    }
}
