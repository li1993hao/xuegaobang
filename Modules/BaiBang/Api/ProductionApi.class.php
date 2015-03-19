<?php
namespace Modules\BaiBang\Api;
use Modules\Person\Api\StaffApi;

/**
 * 产品接口
 * @package Modules\BaiBang\Api
 * @author zl
 * @time 2015-03-07 09:53:56
 */
class ProductionApi {
    /**
     * 获取产品<br/>
     * <hr/>
     * <h5>返回结果说明:</h5>
     * cover:产品封面
     * create_time:创建时间 <br/>
     * update_time:更新时间 <br/>
     * status:状态 <br/>
     * collect:收藏数量 <br/>
     * like:点赞数量 <br/>
     * name:产品名称 <br/>
     * vender:厂家 <br/>
     * introduce:产品介绍 <br/>
     * uid:产品发布者 <br/>
     * @param int $page 页数
     * @param int $page_size 页数
     * @param array $where 筛选条件
     * @param string $order 排序
     * @param int $width  图片压缩宽度 只有当width 和 height都不为0时才进行压缩
     * @param int $height 图片压缩高度
     * @return array 结果
     */
    public static function lists($page=1,$page_size=10,$where=array(),$order = '`update_time` DESC',$width=200,$height=100){
        $map['status'] = 1;

        if(is_string($where)){
            $map["_string"] = $where;
        }else{
            $map = array_merge($where,$map);
        }
        $model = M('Production')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if($result){
            for($i=0;$i<count($result);$i++){
//            $company = M('Company')->where(array('uid'=>$result[$i]['uid']))->field("picture,name,point")->find();
//            $result[$i]['company_picture'] =get_cover_path($company['picture']);
//            $result[$i]['company_name'] = $company['name'];
//            $result[$i]['company_point'] = $company['point'];
                $result[$i]['is_collect'] = StaffApi::hasStaff("production",$result[$i]['id']);
                $result[$i]['is_like'] = StaffApi::hasStaff("production",$result[$i]['id'],"like");

                $cover_path  = get_cover_path($result[$i]['picture']);
                $result[$i]['picture_no_thumb'] = $cover_path;

                if($width !=0 && $height!=0){
                    $result[$i]['picture'] = thumb($cover_path,$width,$height);
                }else{
                    $result[$i]['picture'] = get_cover_path($result[$i]['picture']);
                }
            }
        }


        if(!$result){
            api_msg("没有产品!");
            return false;
        }else{
            return $result;
        }
    }

    public static function getProduction($id,$key="id",$width=200,$height=100){
        $result = M('Production')->field(true)->where(array($key=>$id))->find();
        $result['collect_num'] = StaffApi::staffNum("production",$result['id']);
        $result['like_num'] = StaffApi::staffNum("production",$result['id'],"like");
        $result['is_collect'] = StaffApi::hasStaff("production",$result['id']);
        $result['is_like'] = StaffApi::hasStaff("production",$result['id'],"like");
        $cover_path  = get_cover_path($result['picture']);;
        $result['picture_no_thumb'] = $cover_path;
        if($width !=0 && $height!=0){
            $result['picture'] = thumb($cover_path,$width,$height);
        }else{
            $result['picture'] = get_cover_path($result['picture']);
        }
        return $result;
    }
}