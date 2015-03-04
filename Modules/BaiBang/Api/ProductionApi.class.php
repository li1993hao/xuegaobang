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
     * 产品封面 [cover]
     *创建时间 [create_time]
     *更新时间 [update_time]
     *状态 [status]
     *收藏数量 [collect]
     *点赞数量 [like]
     *产品名称 [name]
     *厂家 [vender]
     *产品介绍 [introduce]
     *产品发布者 [uid]
     * @param int $page 页数
     * @param int $page_size 页数
     * @param array $where 筛选条件
     * @param string $order 排序
     * @return array 结果
     */
    public static function lists($page=1,$page_size=10,$where=array(),$order = '`update_time` DESC'){
        $map = array_merge($where,array('status'=>array('gt','0')));
        $model = M('Production')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if(!$result){
            api_msg("没有产品!");
            return false;
        }else{
            return $result;
        }
    }

    /**
     * 添加产品(<strong>需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     *产品封面 [cover]
     *创建时间 [create_time]
     *状态 [status]
     *收藏数量 [collect]
     *点赞数量 [like]
     *产品名称 [name]
     *厂家 [vender]
     *产品介绍 [introduce]
     *产品发布者 [uid]
     */
    public static function add(){
        $Model  =   checkAttr(D('production'),"production");
        if($Model->create() && $Model->add()!==false){
            return true;
        } else {
            api_msg($Model->getError());
            return false;
        }
    }

    /**
     * 修改产品(<strong>需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * 产品id [id]
     *产品封面 [cover]
     *更新时间 [update_time]
     *状态 [status]
     *收藏数量 [collect]
     *点赞数量 [like]
     *产品名称 [name]
     *厂家 [vender]
     *产品介绍 [introduce]
     *产品发布者 [uid]
     */
    public static function edit(){
        $Model  =   checkAttr(D('production'),"Tieba");
        if($Model->create() && $Model->save()!==false){
            return true;
        } else {
            api_msg($Model->getError());
            return false;
        }
    }

    /**
     * 删除产品
     * @param int $id 产品id
     * @return mixed 返回结果 false：操作失败；1：成功； 0：删除失败
     */
    public static function del($id=-1) {
        return $result = M("production")->where("id=".$id)->delete();
    }
}