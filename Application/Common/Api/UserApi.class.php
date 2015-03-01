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
     * 检测当前用户是否为管理员
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
        UserApi::get_user_field($uid,'username');
    }

    public static function get_user_field($uid,$field){
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
            $User = M('Member')->find($uid);
            if($User && $User[$field]){
                $list[$key] = $User;
            } else {
                $User = array();
            }
        }
        return (isset($field)?$User[$field]:$User);
    }


    /**
     * 根据用户ID获取用户昵称
     * @param  integer $uid 用户ID
     * @return string       用户昵称
     */
    public static function get_nickname($uid = 0){
        UserApi::get_user_field($uid,'nickname');
    }
}