<?php
namespace Modules\BaiBang\Controller;

use Common\Controller\ModuleController;
use Think\Controller;

/**
 *论坛发帖
 * @package Modules\BaiBang\Controller
 */
class TieBaController extends ModuleController
{
    public function  index()
    {
        $this->_display();
    }
}