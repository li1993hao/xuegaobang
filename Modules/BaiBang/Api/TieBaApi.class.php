<?php
namespace Modules\BaiBang\Api;
/**
 * Class SampleApi
 * @package Modules\BaiBang\Api
 * @author  lihao
 */
class TieBaApi {
    /**
     * 获取帖子<br/>
     * <hr/>
     * <h5>返回结果说明:</h5>
     * uid:用户<br/>
     * status:状态 0禁用；1正常<br/>
     * name:贴子标题<br/>
     * content:内容<br/>
     * @param int $page 页数
     * @param int $page_size 页数
     * @param array $where 筛选条件
     * @param string $order 排序
     * @return array 结果
     */
    public static function TieZilists($page=1,$page_size=10,$where=array(),$order = '`update_time` DESC'){
        $map['status'] = array('gt','0');
        if(is_string($where)){
            $map["_string"] = $where;
        }else{
            $map = array_merge($where,$map);
        }
        $model = M('Tieba')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if(!$result){
            api_msg("暂无帖子!");
            return false;
        }else{
            return $result;
        }
    }

    /**
     * 添加帖子(<strong>需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * status:状态 <br/>
     * uid:发布者 <br/>
     * create_time:创建时间 <br/>
     * name:名称 <br/>
     * content:内容 <br/>
     */
    public static function addTiezi(){
        $Model  =   checkAttr(D('Tieba'),"Tieba");
        if($Model->create() && $Model->add()!==false){
            return true;
        } else {
            api_msg($Model->getError());
            return false;
        }
    }

    /**
     * 添加帖子
     */
    public static function editTiezi(){
        $Model  =   checkAttr(D('Tieba'),"Tieba");
        if($Model->create() && $Model->save()!==false){
            return true;
        } else {
            api_msg($Model->getError());
            return false;
        }
    }

    /**
     * 删除贴子
     * @param int $id 贴子id
     * @return mixed 返回结果 false：操作失败；1：成功； 0：删除失败
     */
    public static function delTiezi($id=-1) {
        return $result = M("tieba")->where("id=".$id)->delete();
    }
//
//    public static function getComment($id=-1,$page=1,$page_size=10,$order = '`update_time` DESC'){
//        $result = M('Comment')
//            ->field(true)
//            ->where(array('topic_table'=>'tieba',"topic_id",$id))
//            ->order($order)
//            ->page($page,$page_size)
//            ->select();
//        return $result;
//    }
}