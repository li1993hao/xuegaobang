<?php

namespace Modules\Goods;
use Common\Controller\Module;

/**
 *
 */
class GoodsModule extends Module{
    public $info = array(
        'name'=>'Goods',
        'title'=>'商品管理',
        'description'=>'商品管理',
        'status'=>1,
        'author'=>'tp',
        'version'=>'0.1'
    );

    public function install(){
        return true;
    }

    public function uninstall(){
        return true;
    }

    public function update(){

    }
}