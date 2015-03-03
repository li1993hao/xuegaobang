<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------
namespace Addons\SiteStat;
use Common\Controller\Addon;

/**
 * 系统环境信息插件
 * @author thinkphp
 */
class SiteStatAddon extends Addon{

    public $info = array(
        'name'=>'SiteStat',
        'title'=>'站点统计信息',
        'description'=>'统计站点的基础信息',
        'status'=>1,
        'author'=>'thinkphp',
        'version'=>'0.1'
    );

    public function install(){
        return true;
    }

    public function uninstall(){
        return true;
    }

    public function SiteStat($param){
        $this->AdminIndex($param);
    }

    //实现的AdminIndex钩子方法
    public function AdminIndex($param){
        $config = $this->getConfig();
        $this->assign('addons_config', $config);
        if($config['display']){
            $type = session('user_auth.type');
            if($type == 1){ //企业用户
                $info['production'] = M('production')->where(array('uid'=>UID))->count();//产品数量
                $info['comment'] = M('comment')->where(array('topic_table'=>'member','topic_id'=>UID))->count();//企业评论数量
                $info['notice'] = M('notice')->where(array('uid'=>UID))->count();//通知
            }elseif($type == 0){//管理员
                $info['company']    =   M('Member')->where(array('type'=>1))->count(); //企业用户数量
                $info['user']		=	M('Member')->where(array('type'=>2))->count(); //普通用户数量
                $info['production'] =   M('production')->count(); //产品数量
                $info['company_verify'] =   M('company')->where(array('status'=>2))->count(); //待审核企业
                $this->assign('info',$info);
                $this->display('baibang');
            }

        }
    }
}