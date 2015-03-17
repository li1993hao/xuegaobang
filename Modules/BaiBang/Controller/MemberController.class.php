<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ThinkController;


/**用户管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class MemberController extends CommonController
{
    public function index(){
        $map = $this->search_parse();
        $map['status'] = array('gt',-1);
        $map['type'] = array('gt',0);
        $model =D('Member');
        $list   = $this->p_lists($model, $map,'id asc');
        int_to_string($list);
        $this->assign('list', $list);
        $this->meta_title = '用户信息';
        $this->_display();
    }

    public function info() {
        $id = I("id");
        ThinkController::info('company',array("uid"=>$id),'','public/info');
    }
    /**
     * 添加或者修改
     */
    public function add($username = '', $password = '', $nickname='' ,$repassword = '', $email = ''){
        if(IS_POST){
            /* 检测密码 */
            if($password != $repassword){
                $this->error('密码和重复密码不一致！');
            }
            if($nickname === ''){
                $nickname = $username;
            }

            $member = D('Member');
            $uid    =   $member->register($username, $password,$nickname,0,$status=1); //后台用户模块添加默认是管理员
            if(0 < $uid){ //注册成功
                $this->success('用户添加成功！',U('index'));
            } else { //注册失败，显示错误信息
                $this->error(MemberModel::showRegError($uid));
            }
        } else {
            $this->meta_title = '新增用户';
            $this->_display("add");
        }
    }
    private function search_parse(){
        $map = array();
        $team_map = array(); //模版赋值
        foreach($_REQUEST as $k => $v){
            $kk = str2arr($k,'_');
            if($kk[0] == 'query'){ //查询字段

                if(trim($_REQUEST[$k]) === ""){
                    continue;
                }
                if($kk[1] == 'username'){//模糊查询
                    $map[] = "username LIKE '%{$v}%'";
                    $team_map[$k] = $v;
                    continue;
                }
                if($kk[1] == "nickname"){
                    $map[] = "nickname LIKE '%{$v}%'";
                    $team_map[$k] = $v;
                    continue;
                }if($kk[1] == 'status'){
                    $map['status'] = $v;
                    $team_map[$k] = $v;
                    continue;
                }
                if($kk[1] == "type"){
                    $map["type"] = $v;
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



}