<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/27
 * Time: 下午3:27
 */

namespace Modules\Person\Api;
/**
 * 评论接口文档
 * @package Modules\Person\Api
 * @author lh
 * @time 2015-03-07 09:49:10
 */
class CommentApi {
    /**
     * 获取评论
     * @param string $topic_table  评论表 如果是评论企业的话为company,如果是产品为production,帖子为tiba
     * @param int $topic_id 评论记录id 如果是评论企业的话为企业资料的id,如果是产品为产品id,帖子的话为帖子id
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
                $user = get_user_filed($result[$i]['uid']);
                $result[$i]['user_name'] = $user['nickname'];
                $result[$i]['user_head'] = get_cover_path($user['head']);
                $result[$i]['create_time'] = formatTime($result[$i]['create_time']);
            }
            return $result;
        }
    }

    /**
     * 添加评论(<strong style="color:red">需要传递参数!</strong>)<br/>
     * 需要传递的参数:<br/>
     * topic_table 要评论的表 如果是评论企业的话为company,如果是产品为production,帖子为tiba<br/>
     * topic_id 要评论的记录id  如果是评论企业的话为企业资料的id,如果是产品为产品id,帖子的话为帖子id<br/>
     * uid 评论人的id<br/>
     * content 评论内容<br/>
     * @return bool true为成功 false为失败
     */
    static public function addComment(){
        if(UID <= 0){
            api_msg("用户尚未登录!");
            return false;
        }
        $model = D('Comment');
        $_POST['uid'] = UID;
        if($model->create()){
            $result = $model->add();
            if($result){
                api_msg("评论成功!");
                M($_POST['topic_table'])->where(array('id'=>$_POST['topic_id']))->setInc('comment_num');
                return $result;
            }else{
                return false;
            }
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
        if(UID <= 0){
            api_msg("用户尚未登录!");
            return false;
        }
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
     * @param string $topic_table  评论表 如果是评论企业的话为company,如果是产品为production,帖子为tiba
     * @param int $topic_id 评论记录id 如果是评论企业的话为企业资料的id,如果是产品为产品id,帖子的话为帖子id
     * @return mixed
     */
     static  public function commentNum($topic_table,$topic_id){
         if(empty($topic_id)){
             return 0;
         }
        $map['topic_table'] = $topic_table;
        $map['topic_id'] = $topic_id;
        return D('Comment')->where($map)->count(); //评论数量,不包括回复数量
    }
} 