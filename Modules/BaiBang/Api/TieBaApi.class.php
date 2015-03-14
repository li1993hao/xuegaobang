<?php
namespace Modules\BaiBang\Api;
use Modules\Person\Api\CommentApi;
use Modules\Person\Api\StaffApi;

/**
 * 帖子接口
 * @package Modules\BaiBang\Api
 * @author zl
 * @time 2015-03-07 09:54:29
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
    public static function TieZilists($page=1,$page_size=10,$where=array(),$order = '`is_top` DESC,`update_time` DESC'){
        $map['status'] = array('gt','0');
        if(is_string($where)){
            $map["_string"] = $where;
        }else{
            $map = array_merge($where,$map);
        }
        $model = M('Tieba')->field(true)->where($map)->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if($result){
            for($i=0;$i<count($result);$i++){
                $user = get_user_filed($result[$i]['uid']);
                $result[$i]['user_head'] = get_cover_path($user['head']);
                $result[$i]['user_nickname'] = $user['nickname'];
                if($result[$i]['comment_num'] > 10){
                    $result[$i]['is_hot'] = 1;
                }else{
                    $result[$i]['is_hot'] = 0;
                }
                if($result[$i]['create_time'] > (NOW_TIME-(60*60*24*30))){
                    $result[$i]['is_new'] = 1;
                }else{
                    $result[$i]['is_new'] = 0;
                }
                $result[$i]['create_time'] = formatTime($result[$i]['create_time']);
            }
        }

        if(!$result){
            api_msg("暂无帖子!");
            return false;
        }else{
            return $result;
        }
    }




    public static function  getTezi($id){
        $result = M('Tieba')->field(true)->where(array('id'=>$id))->find();
        $user = get_user_filed($result['uid']);
        $result['user_head'] = get_cover_path($user['head']);
        $result['user_nickname'] = $user['nickname'];
        $result['collect_num'] = StaffApi::staffNum("tieba",$result['id']);
        $result['like_num'] = StaffApi::staffNum("tieba",$result['id'],"like");
        $result['commentNum'] = CommentApi::commentNum("tieba",$result['id']);

        return $result;
    }

    /**
     * 添加帖子(<strong>需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * uid:发布者 <br/>
     * name:名称 <br/>
     * content:内容 <br/>
     */
    public static function addTiezi(){
        $Model  =   checkAttr(D('Tieba'),"Tieba");
        if($Model->create()){
            $result = $Model->add();
            if($result){
                return $result;
            }else{
                return false;
            }
        } else {
            api_msg($Model->getError());
            return false;
        }
    }

    /**
     * 编辑帖子
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
     * @return mixed
     */
    public static function delTiezi($id=-1) {
        return $result = M("tieba")->where("id=".$id)->delete();
    }
}