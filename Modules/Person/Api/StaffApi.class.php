<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/27
 * Time: 下午3:27
 */

namespace Modules\Person\Api;

class StaffApi {
    /**
     * 获取当前用户的事务记录
     * @param string $topic_table   如果是企业的话为company,如果是产品为production,帖子为tiba
     * @param int $topic_id 记录id  如果是企业的话为企业资料的id(<span style="color:red">注意不是uid</span>),如果是产品为产品id,帖子的话为帖子id
     * @param string $action 事务类型
     * @param int $page 页数
     * @param int $page_size 页面大小
     * @param array $where 筛选条件
     * @param string $order 排序
     * @return bool true为成功 false为失败
     */
    static public function staffs($topic_table,$topic_id=-1,$action="collect",$page=1,$page_size=10,$where=array(),$order='create_time DESC'){
        $map['topic_table'] = $topic_table;
        $map['action'] = $action;
        if($topic_id != -1){
            $map['topic_id']  =$topic_id;
        }
        $map['uid'] = UID;
        if(is_string($where)){ //字符串查询
            $map["_string"] = $where;
        }else{
            $map = array_merge($map,$where);
        }

        $model  = D('UserStaff')->where($map)->field('topic_table,topic_id,id,create_time')->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if(!$result){
            api_msg("暂无数据!");
            return false;
        }else{
            for($i=0;$i<count($result);$i++){
               $res =  M($result[$i]['topic_table'])->where(array('id'=>$result[$i]['topic_id']))->field('name,picture')->find();
               $result[$i]['name'] = $res['name'];
               $result[$i]['picture'] = get_cover_path($result['picture']);
            }
            return $result;
        }
    }

    /**
     * 添加事务(<strong style="color:red">需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * topic_table 要收藏的表 如果是企业的话为company,如果是产品为production,帖子为tiba<br/>
     * topic_id 要收藏的记录id   如果是企业的话为企业资料的id(<span style="color:red">注意不是uid</span>),如果是产品为产品id,帖子的话为帖子id
     * action  collect为收藏事务,like为点赞事务
     * @return bool true为成功 false为失败
     */
    static public function addStaff(){
        $model = D('UserStaff');
        $_POST['uid']=UID;
        if($model->create() && $model->add()!==false){
            api_msg("操作成功!");
            return true;
        }else{
            api_msg($model->getError());
            return false;
        }
    }

    /**
     * 取消事务
     * @param int $id 删除事务
     * @return bool
     */
    static public function delStaff($id){
        $model = M('UserStaff');
        if($model->where(array("id"=>$id))->delete()!==false){
            api_msg("删除成功!");
            return true;
        }else{
            api_msg($model->getError());
            return false;
        }
    }

    /**
     * 是否含有某条记录
     * @param string $topic_table   如果是企业的话为company,如果是产品为production,帖子为tiba
     * @param int $topic_id 记录id  如果是企业的话为企业资料的id(<span style="color:red">注意不是uid</span>),如果是产品为产品id,帖子的话为帖子id
     * @param string $action  collect为收藏事务,like为点赞事务
     * @return string
     */
    static public function hasStaff($topic_table,$topic_id,$action='collect'){
        $map['topic_table'] = $topic_table;
        $map['topic_id'] = $topic_id;
        $map['action'] = $action;
        $map['uid']=UID;
        $result = M('UserStaff')->where($map)->count();
        if($result !== false){
            if($result>0){
                return "1";
            }else{
                return "0";
            }
        }else{
            api_msg("查询出错");
            return false;
        }
    }

    /**
     * 得到某个主题的事务数 <br/>
     * @param string $topic_table   如果是企业的话为company,如果是产品为production,帖子为tiba
     * @param int $topic_id 记录id 如果是企业的话为企业用户的uid,如果是产品为产品id,帖子的话为帖子id
     * @param string $action 事务类型
     * @param array|string where 筛选条件
     * @return mixed
     */
     static  public function staffNum($topic_table,$topic_id,$action='collect',$where=array()){
         $map['topic_table'] = $topic_table;
         $map['topic_id'] = $topic_id;
         $map['action'] = $action;
         if(is_string($where)){ //字符串查询
             $map["_string"] = $where;
         }else{
             $map = array_merge($map,$where);
         }
        return M('UserStaff')->where($map)->count();
    }
} 