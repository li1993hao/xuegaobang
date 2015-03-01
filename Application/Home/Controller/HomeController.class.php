<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Common\Controller\BaseController;
use Think\Controller;

/**
 * 前台公共控制器
 */
class HomeController extends BaseController {

	/* 空操作，用于输出404页面 */
	public function _empty(){
		echo '404';
	}

    protected function _initialize(){
        parent::_initialize();
        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
        C('VIEW_PATH',temp_path().'/');
        C('TMPL_PARSE_STRING.__THEME__', __ROOT__.substr(C('TEMP_PATH'),1).'/'.C('JDI_THEME').'/asset');
    }

    /**下载
     * @param $id
     * @return bool
     */
    protected  function download($id){
        $info = D('File')->find($id);
        if(empty($info)){
            return false;
        }
        $File = D('File');
        $root = C('DOWNLOAD_UPLOAD.rootPath');
        if(false === $File->download($root, $info['file_id'])){
             $this->error($File->getError());
        }
    }
}
