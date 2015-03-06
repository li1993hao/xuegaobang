<?php
namespace Common\Controller;
class BaseFileController extends BaseController {
    protected function _initialize(){
        parent::_initialize();
        // 获取当前用户ID
        define('UID',is_login());
        if( !UID ){// 还没登录 跳转到登录页面
            $this->redirect('Public/login');
        }
    }

    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
    /* 文件上传 */
    public function upload(){
        $this->ajaxReturn(upload_file());
    }

    /**
     * 上传图片
     * @author huajie <banhuajie@163.com>
     */
    public function uploadPicture(){
        /* 返回JSON数据 */
        $this->ajaxReturn(upload_image());
    }
}