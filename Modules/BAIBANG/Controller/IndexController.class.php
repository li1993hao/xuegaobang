<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ModuleController;
use Think\Controller;

/**产品管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class IndexController extends ModuleController {
    /**
     * 产品管理
     */
    public function  index(){

        $this->_display();
    }

    /**
     * 产品审核
     */
    public function verify(){

    }
}