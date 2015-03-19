<?php
namespace Modules\BaiBang\Controller;

use Think\Controller;

/**
 *论坛发帖
 * @package Modules\BaiBang\Controller
 */
class TiebaController extends CommonController{
    /**
     * @param null $id
     * @param string $method
     */
    public function info(){
        $id= I('post.id');
        if (is_numeric($id)) {
            $user = M('tieba')->find($id);
            parent::info("tieba", array('id' => $id), '','public/info');//, 'public/info'
        } else {
            $this->error('参数不合法!');
        }
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
                if($kk[1] == "nickname"){
                    $result = M('Member')->where(array('_string'=>"BINARY `nickname` LIKE '%{$v}%'"))->field('id')->select();
                    if($result){
                        $map['uid'] = array('in',arr2str(array_column($result,"id")));
                    }else{
                        $map['uid'] = -1;
                    }
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



    /**
     * shouye
     */
    public function index(){
        MK();
        $map = $this->searc_parse();
        $map['status']  =  array('gt',-1);
        $list = $this->p_lists('tieba',$map,'is_top desc,create_time desc');
        if($list){
            int_to_string($list);
        }
        $this->assign('list', $list);
        $this->meta_title = '贴子列表';
        $this->_display();
    }


    /**
     * 添加或者修改
     */
    public function  add(){
        if(IS_POST){
            $_POST['uid']=UID;//用户id
            parent::add('tieba');
        }else{
            parent::add('tieba',"添加贴子");
        }
    }
}