<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/27
 * Time: 下午3:27
 */

namespace Modules\Person\Api;

class CommentApi {
    /**
     * 获取评论
     * @param string $topic_table  评论表 如果是评论企业的话为member,如果是产品为production,帖子为tiba
     * @param int $topic_id 评论记录id 如果是评论企业的话为企业用户的uid,如果是产品为产品id,帖子的话为帖子id
     * @param int $page 页数
     * @param int $page_size 页面大小
     * @param array $where 筛选条件
     * @param string $order 排序
     * @return bool true为成功 false为失败
     */
    static public function comments($topic_table,$topic_id,$page=1,$page_size=10,$where=array(),$order='create_time DESC'){
        $map['topic_table'] = $topic_table;
        $map['topic_id']  =$topic_id;
        if(is_string($where)){ //字符串查询
            $map["_string"] = $where;
        }else{
            $map = array_merge($map,$where);
        }

        $model  = D('Comment')->where($map)->field('content,uid,id,create_time')->order($order);
        $model->page($page,$page_size);
        $result = $model->select();
        if(!$result){
            api_msg("暂无数据!");
            return false;
        }else{
            for($i=0;$i<count($result);$i++){
                $user = get_user_filed($result['uid']);
                $result[$i]['user_name'] = $user['username'];
                $result[$i]['user_head'] = get_cover_path($user['head']);
            }
            return $result;
        }
    }

    /**
     * 添加评论(<strong style="color:red">需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * topic_table 要评论的表 如果是评论企业的话为member,如果是产品为production,帖子为tiba<br/>
     * topic_id 要评论的记录id  如果是评论企业的话为企业用户的uid,如果是产品为产品id,帖子的话为帖子id<br/>
     * uid 评论人的id<br/>
     * content 评论内容<br/>
     * @return bool true为成功 false为失败
     */
    static public function addComment(){
        $model = D('Comment');
        if($model->create() && $model->add()!==false){
            api_msg("评论成功!");
            return true;
        }else{
            api_msg($model->getError());
            return false;
        }
    }

    /**
     * 修改评论(<strong style="color:red">需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * id 修改的记录id
     * 其他参数可选 详情见addComment接口说明
     * @return bool true为成功 false为失败
     */
    static public function editComment(){
        $model = D('Comment');
        if($model->create() && $model->save()!==false){
            api_msg("修改成功!");
            return true;
        }else{
            api_msg($model->getError());
            return false;
        }
    }

    /**
     * 得到某个主题的评论数 <br/>
     * topic_table 评论表 如果是评论企业的话为member,如果是产品为production,帖子为tiba<br/>
     * topic_id 评论记录id  如果是评论企业的话为企业用户的uid,如果是产品为产品id,帖子的话为帖子id<br/>
     * @param $table
     * @param $topic_id
     * @return mixed
     */
    public function commentNum($table,$topic_id){
        $map['topic_table'] = $table;
        $map['topic_id'] = $topic_id;
        return D('Comment')->where($map)->count(); //评论数量,不包括回复数量
    }
} 