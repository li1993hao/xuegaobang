<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Common\Controller\AdminController;
use Common\Model\MemberModel;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class PublicController extends \Think\Controller {
    public function index(){
        $this->display();
    }
    /**
     * 后台用户登录
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
            /* 检测验证码 TODO: */
            if(!check_verify($verify)){
                $this->error("验证码输入错误");
            }

            $Member = D('Member');
            $uid = $Member->checkLogin($username, $password,1,false);
            if(0 < $uid){
                /* 登录用户 */
                if($Member->login($uid)){ //登录用户
                    //TODO:跳转到登录前页面
                    $this->success("登录成功!");
                } else {
                    $this->error("登录失败！");
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                $this->display();
            }
        }
    }

    /**
     * 企业用户注册
     */
    public function register($email,$username,$nickname,$password,$re_password){
         if($email && $username && $nickname && $password && $re_password){
             if(!regex($email,'email')){
                 $this->error("email格式不正确！");
             }
             /* 检测密码 */
             if($password != $re_password){
                 $this->error('密码和重复密码不一致！');
             }
             $member = D('Member');
             $uid    =   $member->register($username, $password,$nickname,1,$status=1,$email); //添加企业
             if(0 < $uid){ //注册成功
                 D('AuthGroup')->addToGroup($uid,13);//添加分组权限
                 if($member->login($uid)){ //登录
                     //TODO:跳转到登录前页面
                     $this->success("注册成功!");
                 } else {
                     $this->error("注册成功!请人工登录");
                 }
             } else { //注册失败，显示错误信息
                 $this->error(MemberModel::showRegError($uid));
             }
         }else{
             $this->error("填写信息不全!");
         }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            D('Member')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }
//
//
//    function text(){
//        echo user_encrypt('123456');
//    }
}
