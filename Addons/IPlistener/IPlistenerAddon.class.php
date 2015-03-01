<?php

namespace Addons\IPlistener;
use Common\Controller\Addon;

/**
 * 来访记录插件
 * @author 吴文付
 */

    class IPlistenerAddon extends Addon{

        public $info = array(
            'name'=>'IPlistener',
            'title'=>'来访记录',
            'description'=>'记录来访者的IP等信息',
            'status'=>1,
            'author'=>'tp',
            'version'=>'0.1'
        );
        
        //后台的列表
        public $admin_list = array(
		'listKey' => array(
			'ip'=>'IP地址',
        	'visit_time'=>'访问时间',
        	'visit_url'=>'访问页面',
			'city'=>'地理位置',
			'isp'=>'运营商'
			
		),
		'model'=>'iplistener',//这里注意小写
		'order'=>'id desc'
	);
        public $custom_adminlist = 'adminlist.html';

        public function install(){
        	//需要建表
           //获得前缀+表
            $tbName = c('DB_PREFIX').'iplistener';
        	
        	$sql = M();
        	$sql->execute("
CREATE TABLE IF NOT EXISTS $tbName (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(64) NOT NULL COMMENT 'ip地址',
  `visit_time` varchar(16) NOT NULL COMMENT '访问时间',
  `visit_url` varchar(256) NOT NULL COMMENT '访问地址',
  `city` varchar(32) NOT NULL COMMENT '地理位置',
  `isp` varchar(16) NOT NULL COMMENT '运营商',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;
        	");
        	
        	//清理cookie
        	cookie('isIp',null);
        	
            return true;
        }

        public function uninstall(){
        	
        	//需要删除表 
        	$sql = M();

            //获得前缀+表
            $tbName = c('DB_PREFIX').'iplistener';
        	$sql->execute("truncate TABLE $tbName");
        	
        	
        	//清理cookie
        	cookie('isIp',null);
        	
            return true;
        }

        public function pageFooter(){
        	
        	$config = $this->getConfig();
        	
        	$this->assign('addons_iplistener_config',$config);
        	
        	$this->display(T('Addons://IPlistener@first/Home/content'));

        }

    }