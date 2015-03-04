<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/27
 * Time: 下午3:27
 */

namespace Modules\Person\Api;

class PersonApi {
    /**
     * 获得指定公司的资料
     * @param int $uid 用户id 不写则表示获得当前登录用户的资料
     * @return  array 企业信息
     */
    public static  function company($uid){
        if(!isset($uid)){
            if(defined(UID)){
              $uid = UID;
            }else{
                api_msg("没有指定uid而且用户尚未登录!");
                return false;
            }
        }
        $result = M('Company')->where(array('uid'=>$uid))->find();
        if($result){
            $result['logo'] = get_cover_path($result['logo']);
            return $result;
        }else{
            api_msg("企业资料还未填写!");
            return false;
        }
    }

    /**
     * 获取指定用户的通知信息<br/>
     * <hr/>
     * <h5>返回结果说明:</h5>
     * uid:通知用户<br/>
     * status:通知状态 0是已读 1是未读<br/>
     * title:通知标题<br/>
     * detail:通知详情<br/>
     * @param int $uid 用户id 不写则表示获得当前登录用户的通知信息
     * @return array 通知列表
     */
    public static  function notice($uid){
        if(!isset($uid)){
            if(defined(UID)){
                $uid = UID;
            }else{
                api_msg("没有指定uid而且用户尚未登录!");
                return false;
            }
        }
        $result = M('Notice')->where(array('uid'=>$uid,'status'=>array('gt',-1)))->select();
        if($result){
            return $result;
        }else{
            api_msg("暂无通知!");
            return false;
        }
    }

    /**
     * 把通知设为已读
     * @param int $id 通知id
     */
    public static function readNotice($id){
        if(!is_numeric($id)){
            api_msg('参数非法!');
            return false;
        }

        $_POST['status'] = 1;
        if(D('Notice')->update() !== false){
            api_msg("操作成功!");
            return true;
        }else{
            api_msg("操作失败!");
            return false;
        }
    }

    /**
     * 把通知删除
     * @param int $id 通知id
     */
    public static function deleteNotice($id){
        if(!is_numeric($id)){
            api_msg('参数非法!');
            return false;
        }

        $_POST['status'] = -1;
        if(D('Notice')->update() !== false){
            api_msg("操作成功!");
            return true;
        }else{
            api_msg("操作失败!");
            return false;
        }
    }
} 