<?php
namespace Modules\BaiBang\Controller;


/**用户管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class UserController extends CommonController
{
    public function index(){
        $nickname       =   I('nickname');
        $map['status']  =   array('egt',0);
        $map['type'] = array('gt',0);
        if(is_numeric($nickname)){
            $map['id']=   array('id'=>$nickname);
        }else if(isset($nickname)){
            $map['nickname']    =   array('like', '%'.(string)$nickname.'%');
        }
        $model =D('Member');
        $list   = $this->p_lists($model, $map,'id asc');
        int_to_string($list);

//        $this->assign('group',$group);
        $this->assign('list', $list);
        $this->meta_title = '用户信息';
        $this->_display();
    }

    public function info() {
        $id = I("id");
        if (is_numeric($id)) {
            $user = M("member")->find($id);
            switch($user['type']){
                case  0:
                $user['type_text'] = '<span class="label label-warning ">佰帮</span>';
                break;
                case  1:
                $user['type_text'] = '<span class="label label-warning ">企业用户</span>';
                break;
                case  2:
                $user['type_text'] = '<span class="label label-warning ">普通用户</span>';
                break;
            } 
            $this->assign("user", $user);
            $this->_display();
        } else {
            $this->error('参数不合法!');
        }
    }

    /**
     * 添加或者修改
     */
    public function save($username = '', $password = '', $nickname='' ,$repassword = '', $email = ''){
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
    /**
     * 搜索功能
     */
    public function search(){
        $map = $this->search_parse();
        $map[] = 'status > 0';
        $map[] = 'type > 0';
        $model =D('Member');
        $result = $this->p_lists($model, $map,'',array());
        int_to_string($result);

        $this->assign('type',1);
        $this->assign('list',$result);
        $this->_display('index');
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
                }if($kk[1] == 'status'){//模糊查询
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
    private function isType(){
        return I("controller")==''?'member' : I("controller");
    }
    /**
     * 删除数据
     */
    public function  del(){
        $str = $this->isType();
        parent::editRow($str,array('status'=>-1),null);
    }
    /**
     * 禁用数据
     */
    public function  forbid(){
        $str = $this->isType();
        parent::editRow($str,array('status'=>0),null);
    }
    /**
     * 恢复数据
     */
    public function resume(){
        $str = $this->isType();
        parent::editRow($str,array('status'=>1),null);
    }

    public function verify(){
        $map['status']  =   array('eq',2);

        $list   = $this->p_lists("Company", $map,'id asc');
        int_to_string($list);
        //        int_to_string($list,
//            array('status' => array
//                            (1 => '<span class="label label-success ">正常</span>',
//                             -1 => '删除', 0 => '<span class="label label-danger ">禁用</span>',
//                             2 => '<span class="label label-warning">未审核</span>', 3 => '<span class="label">草稿</span>'),
//            'category' => array
//                            (1 => '<span class="label label-success ">正常</span>',
//                                -1 => '删除', 0 => '<span class="label label-danger ">禁用</span>',
//                                2 => '<span class="label label-warning">未审核</span>', 3 => '<span class="label">草稿</span>'))
//        );
        $this->assign('list', $list);
        $this->meta_title = '用户信息';
        $this->_display();
    }
}