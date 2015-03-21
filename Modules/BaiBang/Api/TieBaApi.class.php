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
            self::parseTezi($result);
        }

        if(!$result){
            if($page == 1){
                api_msg("暂时还没有帖子,快来发布一个把!");
            }else{
                api_msg("没有更多帖子!");
            }
            return false;
        }else{
            return $result;
        }
    }
    
    private static function parseTezi(&$list){
        for($i=0;$i<count($list);$i++){
            $user = get_user_filed($list[$i]['uid']);
            if(!empty($list[$i]['pictures'])){
                $list[$i]['pictures'] = str2arr( $list[$i]['pictures']);
                $paths = array();
                foreach($list[$i]['pictures'] as $v){
                    $path = get_cover_path($v);
                    $paths[]  = $path;
                    $list[$i]['pictures_thumb'][] = thumb($path,100,120);
                }
                $list[$i]['pictures'] = $paths;
            }else{
                unset($list[$i]['pictures']);
            }
            $list[$i]['user_head'] = get_cover_path($user['head']);
            $list[$i]['user_nickname'] = $user['nickname'];
            if($list[$i]['comment_num'] > 10){
                $list[$i]['is_hot'] = 1;
            }else{
                $list[$i]['is_hot'] = 0;
            }
            if($list[$i]['create_time'] > (NOW_TIME-(60*60*24))){
                $list[$i]['is_new'] = 1;
            }else{
                $list[$i]['is_new'] = 0;
            }
            $list[$i]['create_time'] = formatTime($list[$i]['create_time']);
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
        $has_image = false;
        if(!empty($_FILES)){
            $has_image = true;
            $images = upload_image();
            if($images['status'] == 0){// 图片上次失败
                api_msg($images['msg']);
                return false;
            }
        }
        if($Model->create()){
            $result = $Model->add();
            if($has_image){
                $data['id'] = $result;
                $imagesData = $images['data'];
                $ids = array_column($imagesData,"id");
                $data['pictures'] =   arr2str($ids);
                D('Tieba')->save($data); //保存上传的图片
            }
            if($result){
                $addData =  $Model->where(array('id'=>$result))->select();
                self::parseTezi($addData);
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