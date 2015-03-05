<?php
namespace Modules\BaiBang\Controller;

/**产品管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class IndexController extends CommonController {

    /**
     * 搜索功能
     */
    public function search(){
        $map = $this->searc_parse();
        $result = $this->p_lists('Production',$map,'',array(),true);
        $this->assign('type',1);
        $this->assign('list',$result);
        $this->_display('index');
    }
    private function searc_parse(){
        $map = array();
        $team_map = array(); //模版赋值
        foreach($_REQUEST as $k => $v){
            $kk = str2arr($k,'_');
            if($kk[0] == 'query'){ //查询字段

                if(trim($_REQUEST[$k]) === ""){
                    continue;
                }
                if($kk[1] == 'name'){//模糊查询
                    $map[] = "BINARY `name` LIKE '%{$v}%'";
                    $team_map[$k] = $v;
                    continue;
                }
                if($kk[1] == "vender"){
                    $map[] = "vender LIKE '%{$v}%'";
                    $team_map[$k] = $v;
                    continue;
                }
                if($v == '__whatever__'){ //不限
                    continue;
                }
                $map[$kk[1]] = $v;
                $team_map[$k] = $v;
            }else{
                unset($map[$k]);
            }
        }
        if(I('r')){
            $team_map['r']= I('r');
        }
        $this->assign('where',$team_map);
        return $map;
    }
    public function info(){
        parent::info("Production", array('id' => I("id")), '','public/info');
    }

    /**
     * 产品管理
     */
    public function  index(){
        MK();
        $map  = array('status' => array('gt',-1));
        $list = $this->p_lists('Production',$map,'update_time');
        int_to_string($list);
        $list = list_sort_by($list,'status');
        $this->assign('list', $list);
        $this->meta_title = '产品列表';
        $this->_display();
    }

    /**
     * 产品审核
     */
    public function verify(){
        echo "verify";
//        $this->_display();
    }
}