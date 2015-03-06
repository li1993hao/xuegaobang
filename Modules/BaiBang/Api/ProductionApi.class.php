<?php
namespace Modules\BaiBang\Api;
/**
 * Class SampleApi
 * @package Modules\BaiBang\Api
 * @author  lihao
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
     * @return array 结果
     */
    public static function lists($page=1,$page_size=10,$where=array(),$order = '`update_time` DESC'){
        $map['status'] = array('gt','0');
        if(is_string($where)){
            $map["_string"] = $where;
        }else{
            $map = array_merge($where,$map);
        }
        $model = M('Production')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();

        for($i=0;$i<count($result);$i++){
            $company = M('Company')->where(array('uid'=>$result[$i]['uid']))->field("logo,name,point")->find();
            $result[$i]['company_logo'] = get_cover_path($company['logo']);
            $result[$i]['company_name'] = $company['name'];
            $result[$i]['company_point'] = $company['point'];
        }

        if(!$result){
            api_msg("没有产品!");
            return false;
        }else{
            return $result;
        }
    }

}