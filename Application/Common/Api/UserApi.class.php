<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Common\Api;
use Common\Model\MemberModel;

class UserApi {
    /**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     */
    public static function is_login(){
        if(APP_MODE == 'api'){
            return UID;
        }
        $user = session('user_auth');
        if (empty($user)) {
            return 0;
        } else {
            return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
        }
    }

    /**
     * 获取当前用户的信息
     * @param string $field 字段
     * @return string 用户信息
     */
    public static function user_field($field){
        if(APP_MODE == 'api'){
            if(UID){
                $User = M('Member')->field($field)->find(UID);
                return $User[$field];
            }else{
                api_msg('用户未定义!');
                return false;
            }
        }
        $user = session('user_auth');
        if (empty($user)) {
            return 0;
        } else {
            return session('user_auth_sign') == data_auth_sign($user) ? $user[$field] : 0;
        }
    }

    /**
     * @param int $uid 用户id
     * @return boolean true-管理员，false-非管理员
     */
    public static function is_administrator($uid = null){
        $uid = is_null($uid) ? self::is_login() : $uid;
        return $uid && (intval($uid) === C('USER_ADMINISTRATOR'));
    }

    /**
     * 根据用户ID获取用户名
     * @param  integer $uid 用户ID
     * @return string       用户名
     */
    public static function get_username($uid = 0){
        return UserApi::get_user_field($uid,'username');
    }

    /**
     * 获得指定用户的信息
     * @param int $uid 用户id
     * @param string $field 字段可不写
     * @return array|mixed 用户信息
     */
    public static function get_user_field($uid=0,$field){
        static $list;
        if(!($uid && is_numeric($uid))){ //获取当前登录用户名
            $uid = UID;
        }

        /* 获取缓存数据 */
        if(empty($list)){
            $list = array();
        }

        /* 查找用户信息 */
        $key = "u{$uid}";
        if(isset($list[$key])){ //已缓存，直接使用
            $User = $list[$key];
        } else { //调用接口获取用户信息
            $User = M('Member')->where(array('id'=>$uid))->find();
            if($User){
                $list[$key] = $User;
            } else {
                $User = array();
            }
        }
        return !empty($field)?$User[$field]:$User;
    }


    /**
     * 根据用户ID获取用户昵称
     * @param  integer $uid 用户ID
     * @return string       用户昵称
     */
    public static function get_nickname($uid = 0){
       return UserApi::get_user_field($uid,'nickname');
    }


    /**
     * 登陆
     * <hr/>
     * <h5>返回结果说明:</h5>
     * uid:用户id<br/>
     * nickname:用户昵称<br/>
     * username:用户名<br/>
     * type:用户类型,0为管理员,1为企业,2为普通用户<br/>
     * head:用户头像,没有则返回空字符串<br/>
     * sid:用户登陆key,相当于浏览器的session标识,请求时会用到,代表当前登陆用户
     * @param string $u 用户名
     * @param string $p 密码
     * @retrun array
     */
    public static  function login($u,$p){
        $result = D('Member')->apiLogin($u,$p);
        if(is_array($result)){//登陆成功返回accesskey
            $data['sid'] =  think_encrypt($result['id'],C('UID_KEY'));
            $data['nickname'] = $result['nickname'];
            $data['username'] = $result['username'];
            $data['type'] = $result['type'];
            $data['uid'] = $result['id'];
            $data['head'] = get_cover_path($result['head']);
            api_msg("登陆成功!");
            return $data;
        }else{
            switch($result){
                case 0:
                    $msg = '参数错误!';
                    break;
                case -1:
                    $msg = '用户不存在或被禁用!';
                    break;
                case -2:
                    $msg = '密码错误!';
                    break;
                case -3:
                    $msg = '没有登陆权限!';
                    break;
                default:
                    $msg= '未知错误!';
            }
            api_msg($msg);
            return false;
        }
    }

    /**
     *等出只是简单的销毁session,如果是用sid方式,则不做任何事情.<br/>
     * 这时候登陆登出由客户端自己控制
     */
    public static function loginOut(){
        session('[destroy]');
        return true;
    }

    /**
     * 企业用户注册
     * @param string $email 邮箱
     * @param string $username 用户名
     * @param string $nickname 昵称
     * @param string $password 密码
     * @param string $re_password 重复密码
     * @return string 结果
     */
    public static  function register($email,$username,$nickname,$password,$re_password){
        if($email && $username && $nickname && $password && $re_password){
            if(!regex($email,'email')){
                api_msg('邮箱格式不正确！');
                return false;
            }
            /* 检测密码 */
            if($password != $re_password){
                api_msg('密码和重复密码不一致！');
                return false;
            }
            $member = D('Member');
            $uid    =   $member->register($username, $password,$nickname,1,$status=1,$email); //添加企业
            if(0 < $uid){ //注册成功
                D('AuthGroup')->addToGroup($uid,13);//添加分组权限
                if($member->login($uid)){ //登录
                    //TODO:跳转到登录前页面
                    api_msg('注册成功！');
                    return false;
                } else {
                    api_msg('注册成功！');
                    return false;
                }
            } else { //注册失败，显示错误信息
                api_msg(MemberModel::showRegError($uid));
                return false;
            }
        }else{
            api_msg("填写信息不全");
            return false;
        }
    }
}