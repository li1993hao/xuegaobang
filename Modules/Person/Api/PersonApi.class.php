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
     * 公司列表
     * @param int $page 页码
     * @param int $page_size 页面大小
     * @param array $where
     * @param string $order
     * @return bool
     */
    public static function companylist($page=1,$page_size=10,$where=array(),$order = ''){
        $map['status'] = 1;
        if(is_string($where)){
            $map["_string"] = $where;
        }else{
            $map = array_merge($where,$map);
        }
        $model = M('Company')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();

        for($i=0;$i<count($result);$i++){
            $result[$i]['logo'] = get_cover_path($result[$i]['logo']);
        }

        if(!$result){
            api_msg("暂无结果!!");
            return false;
        }else{
            return $result;
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
     * @param int $id 通知id、
     * @return bool
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
     * @return bool
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

    /**
     * 获得所有产品类别
     * @return array  类似{"1":"xxx","2":"xx","3":"xx"} 客户端根据自身语言特性转化为特定的对象
     */
    public static function getProductionCategory(){
        return C("PRODUCTION_CATEGORY");
    }

    /**
     * 获得所有公司类别
     * @return array 类似{"1":"xxx","2":"xx","3":"xx"} 客户端根据自身语言特性转化为特定的对象
     */
    public static function getCompanyCategory(){
        return C("COMPANY_CATEGORY");
    }
} 