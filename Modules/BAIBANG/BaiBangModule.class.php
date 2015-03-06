<?php

namespace Modules\BaiBang;
use Common\Controller\Module;

/**
 *
 */
class BaiBangModule extends Module{
    public $info = array(
        'name'=>'BaiBang',
        'title'=>'佰帮',
        'description'=>'雪糕棒管理模块',
        'status'=>1,
        'author'=>'tp',
        'version'=>'0.1'
    );
    public $enter_controller = "Production"; //入口控制器
    public $enter_action = "index";//入口方法

    public function install(){
        return true;
    }

    public function uninstall(){
        return true;
    }

    public function update(){

    }
}