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
    public function  index()
    {
        $this->_display();
    }
}