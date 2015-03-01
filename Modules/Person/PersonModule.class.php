<?php

namespace Modules\Person;
use Common\Controller\Module;

/**
 *
 */
class PersonModule extends Module{
    public $info = array(
        'name'=>'Person',
        'title'=>'企业中心',
        'description'=>'企业用户的个人中心',
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