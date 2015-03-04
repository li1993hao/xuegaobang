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
     * id:产品id <br/>
     * cover:产品封面 <br/>
     * update_time:更新时间 <br/>
     * status:状态 <br/>
     * collect:收藏数量 <br/>
     * like:点赞数量 <br/>
     * name:产品名称 <br/>
     * vender:厂家 <br/>
     * introduce:产品介绍 <br/>
     * uid:产品发布者 <br/>
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