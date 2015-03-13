<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/27
 * Time: 下午3:27
 */

namespace Modules\Person\Api;

/**
 * 此文档提供功能:
 * 1.获得公司资料<br/>
 * 2.获得公司列表<br/>
 * 3.获得用户通知,以及删除和标置为已读<br/>
 * 4.获取产品类别<br/>
 * 5.获取公司类别<br/>
 * @package Modules\Person\Api
 * @author lh
 * @time 2015-03-07 09:52:02
 */
class PersonApi {
    /**
     * 获得指定公司的资料
     * @param int $uid 用户id 不写则表示获得当前登录用户的资料
     * @param string $type 方式 uid则表示uid获取,id则表示id获取
     * @return  array 企业信息
     */
    public static  function company($uid,$type="uid"){
        if(!isset($uid)){
            if(defined(UID)){
              $uid = UID;
            }else{
                api_msg("没有指定uid而且用户尚未登录!");
                return false;
            }
        }
        $result = M('Company')->where(array($type=>$uid))->find();
        if($result){
            $result['picture'] = get_cover_path($result['picture']);
            $result['comment_num'] = CommentApi::commentNum("company",$result['id']);
            $result['detail_banner'] = get_cover_path($result['detail_banner']);
            $result['is_collect'] = StaffApi::hasStaff("company",$result['id']);
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
     * @param int $width  图片压缩宽度 只有当width 和 height都不为0时才进行压缩
     * @param int $height 图片压缩高度
     * @return bool
     */
    public static function companyLists($page=1,$page_size=10,$where=array(),$order = '',$width=200,$height=100){
        $map['status'] = 1;
        if(is_string($where)){
            $map["_string"] = $where;
        }else{
            $map = array_merge($where,$map);
        }
        $model = M('Company')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if(!$result){
            api_msg("暂无结果!!");
            return false;
        }else{
            for($i=0;$i<count($result);$i++){
                $result[$i]['picture_id'] = $result[$i]['picture'];
                if($width !=0 && $height!=0){
                    $result[$i]['picture'] = thumb(get_cover_path($result[$i]['picture']),$width,$height);
                }else{
                    $result[$i]['picture'] = get_cover_path($result[$i]['picture']);
                }
                $result[$i]['detail_banner'] = get_cover_path($result[$i]['detail_banner']);
                $result[$i]['is_collect'] = StaffApi::hasStaff("company",$result[$i]['id']);
            }
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
     * @return array 通知列表
     */
    public static  function notice(){
        $uid = UID;
        if($uid<=0){
            api_msg("没有指定uid而且用户尚未登录!");
            return false;
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
     * 获取未读通知
     * @return bool|int
     */
    public static function getUnReadNotice(){
        $uid = UID;
        if($uid<=0){
            api_msg("没有指定uid而且用户尚未登录!");
            return false;
        }
        $result = M('Notice')->where(array('uid'=>$uid,'status'=>0))->count();
        if($result){
            return $result;
        }else{
            api_msg("暂无通知!");
            return 0;
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
        $result = C("PRODUCTION_CATEGORY");
        $array = array();
        foreach($result as $k=>$v){
            $array[] = array("category_key"=>$k."","category_name"=>$v);
        }
        return $array;
    }

    /**
     * 获得所有公司类别
     * @return array 类似{"1":"xxx","2":"xx","3":"xx"} 客户端根据自身语言特性转化为特定的对象
     */
    public static function getCompanyCategory(){
        $result = C("COMPANY_CATEGORY");
        $array = array();
        foreach($result as $k=>$v){
            $array[] = array("category_key"=>$k."","category_name"=>$v);
        }
        return $array;
    }

    /**
     * 获得图片 不压缩
     * @param int $id 图片id
     * @return bool|string
     */
    public  static  function  getPicture($id){
        return  get_cover_path($id);
    }
} 