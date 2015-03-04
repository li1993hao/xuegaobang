<?php
namespace Modules\BaiBang\Api;
/**
 * Class SampleApi
 * @package Modules\BaiBang\Api
 * @author  lihao
 */
class BaiBangApi {
    /**
     * 获取帖子<br/>
     * <hr/>
     * <h5>返回结果说明:</h5>
     * uid:通知用户<br/>
     * status:通知状态 0是已读 1是未读<br/>
     * title:通知标题<br/>
     * detail:通知详情<br/>
     * @param int $page 页数
     * @param int $page_size 页数
     * @param array $where 筛选条件
     * @param string $order 排序
     * @return array 结果
     */
    public static function TieZilists($page=1,$page_size=10,$where=array(),$order = '`update_time` DESC'){
        $map = array_merge($where,array('status'=>array('gt','0')));
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
     * 添加帖子
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
} 