<?php
namespace Modules\BaiBang\Api;
/**
 * Class SampleApi
 * @package Modules\BaiBang\Api
 * @author  lihao
 */
class SampleApi {
    /**
     * 设置where查询条件sdadsa
     * @param  number  $category 分类ID
     * @param  number  $pos      推荐位
     * @param  integer $status   状态
     * @return array             查询条件
     */
    private static function listMap($category, $status = 1, $pos = null){
        /* 设置状态 */
        $map = array('status' => $status);

        /* 设置分类 */
        if(!empty($category)){
            if(is_numeric($category)){
                $map['category_id'] = $category;
            } else {
                $map['category_id'] = array('in', str2arr($category));
            }
        }

        $map['create_time'] = array('lt', NOW_TIME);
        $map['_string']     = 'deadline <= 0 OR deadline > ' . NOW_TIME;
        /* 设置推荐位 */
        if(is_numeric($pos)){
            $pos = $pos.',';
            $map[] = "position like '%{$pos}%'";
        }

        return $map;
    }

    /**
     * @param string|int $category 栏目名称或者id
     * @param int $page 页数
     * @param string $order 排序
     * @param int $status 状态
     * @return array|bool|mixed|string 结果
     */
    public static function lists($category,$page=1,$order = '`weight` DESC, `update_time` DESC', $status = 1){
        $map = DocumentApi::listMap($category, $status);
        $cat=  CategoryApi::get_category($category);
        $model_id = $cat['model_id'];

        if(empty($model_id)){//分类不存在或者被禁用
            return false;
        }
        $model_name = ModelApi::get_model_by_id($model_id,'name');
        if(empty($model_name)){//模型不存在或者被禁用
            return false;
        }
        $model = M($model_name)->field(true)->where($map)->order($order);
        if(is_numeric($page)){
            $model->page($page,$cat['list_num']);
        }else{
            $model->limit($page);
        }
        $result = $model->select();
        $result = content_url($result);
        return $result;
    }


    /**
     * 搜索
     * @param string $search 搜索的关键字
     * @param int $page 页码
     * @param int $page_num 分页大小
     * @param string $order 拍序
     * @param int $status 搜索的文章状态
     * @return array|mixed|string 搜索结果
     */
    public  static function  search($search,$page,$page_num,$order = '`weight` DESC, `update_time` DESC',$status=1){
        $map = DocumentApi::listMap(null, $status);
        $search_sql = arr2str($search,'%');
        $map[] ="BINARY `title` LIKE '%{$search_sql}%'";
        $model = M('article')->field(true)->where($map)->order($order);
        if(is_numeric($page)){
            $model->page($page,$page_num);
        }else{
            $model->limit($page);
        }
        $result = $model->select();
        $result = content_url($result);
        return $result;
    }

    /**
     * 搜索数量
     * @param string $search 搜索关键字
     * @param string $order 排序
     * @param int $status 状态
     * @return mixed 搜索数量
     */
    public  static function  searchCount($search,$order = '`weight` DESC, `update_time` DESC',$status=1){
        $map = DocumentApi::listMap(null, $status);
        $search_sql = arr2str($search,'%');
        $map[] ="BINARY `title` LIKE '%{$search_sql}%'";
        $count = M('article')->where($map)->order($order)->count();
        return $count;
    }



    /**
     * 计算列表总数
     * @param  number  $category 分类ID
     * @param  integer $status   状态
     * @return integer           总数
     */
    public static function listCount($category, $status = 1){
        $map = DocumentApi::listMap($category, $status);
        $model_id =  CategoryApi::get_category($category,'model_id');

        if(empty($model_id)){//分类不存在或者被禁用
            return false;
        }
        $model_name = ModelApi::get_model_by_id($model_id,'name');
        if(empty($model_name)){//模型不存在或者被禁用
            return false;
        }
        return M($model_name)->where($map)->count('id');
    }


    /**
     * 获取详情页数据
     * @param  integer $id 文档ID
     * @return array       详细数据
     */
    public static  function detail($category,$id){
        $model_id =  CategoryApi::get_category($category,'model_id');
        $map = DocumentApi::listMap($category, 1);
        if(empty($model_id)){//分类不存在或者被禁用
            return false;
        }

        $model_name = ModelApi::get_model_by_id($model_id,'name');
        if(empty($model_name)){//模型不存在或者被禁用
            return false;
        }

        if(isset($id)){
            $map['id']=$id;
        }
        $result =  M($model_name)->where($map)->find();
        if($result){
            M($model_name)->where($map)->setInc('view'); //浏览数量＋1
        }
        $result = content_url($result);
        return $result;
    }

    /**
     * 找到对应模型下的某条记录
     * 一定要确保表市继承字基本内容模型的
     * 这里不做判断,调用者自行决定
     * 慎用！
     */
    public static function record($category,$modelName,$id){

        $map = DocumentApi::listMap($category, 1);
        if(isset($id)){
            $map['id']=$id;
        }
        $result =  M($modelName)->where($map)->find();
        if($result){
            M($modelName)->where($map)->setInc('view'); //浏览数量＋1
        }

        $result = content_url($result);
        return $result;
    }

    /**
     * 返回前一篇文档信息
     * @param  array $info 当前文档信息
     * @return array 前一个文档
     */
    public static function prev($info){
        $map = array(
            'id'          => array('gt',$info['id']),
            'category_id' => $info['category_id'],
            'status'      => 1,
            'create_time' => array('lt', NOW_TIME),
            '_string'     => 'deadline <= 0 OR deadline > ' . NOW_TIME,
        );
        $model_id =  CategoryApi::get_category($info['category_id'],'model_id');

        if(empty($model_id)){//分类不存在或者被禁用
            return false;
        }
        $model_name = ModelApi::get_model_by_id($model_id,'name');

        if(empty($model_name)){//模型不存在或者被禁用
            return false;
        }
        $result = M($model_name)->field(true)->where($map)->order('`id` asc')->find();

        $result = content_url($result);
        return $result;
    }

    /**
     * 获取下一篇文档基本信息
     * @param  array    $info 当前文档信息
     * @return array  下条新闻
     */
    public static function next($info){
        $map = array(
            'id'          => array('lt', $info['id']),
            'category_id' => $info['category_id'],
            'status'      => 1,
            'create_time' => array('lt', NOW_TIME),
            '_string'     => 'deadline <= 0 OR deadline > ' . NOW_TIME,
        );
        $model_id =  CategoryApi::get_category($info['category_id'],'model_id');
        if(empty($model_id)){//分类不存在或者被禁用
            return false;
        }
        $model_name = ModelApi::get_model_by_id($model_id,'name');
        if(empty($model_name)){//模型不存在或者被禁用
            return false;
        }
        $result = M($model_name)->field('content',true)->where($map)->order('`id` Desc')->find();

        $result = content_url($result);
        return $result;
    }

    /**
     * 获取推荐位数据列表,紧紧是文章的推荐位置
     * @param  number  $pos      推荐位 1:列表页推荐 2:频道页推荐 3:网站首页推荐
     * @param  number  $category 分类ID
     * @param  number  $limit    列表行数
     * @param  boolean $filed    查询字段
     * @return array             数据列表
     */
    public static  function position($pos, $category = null, $limit = null, $field = true){
        $map = DocumentApi::listMap($category, 1, $pos);
        $model = M('article');
        /* 设置列表数量 */
        is_numeric($limit) && $model->limit($limit);
        $result =  $model->field($field)->where($map)->select();
        $result = content_url($result);
        return $result;
    }

    /**
     * 获取热点新闻
     * @param int|string $cate 栏目
     * @param int|string $limit 数量
     * @param string $order 排序
     * @param bool $field 要取的字段
     * @return array|mixed|string  热点新闻
     */
    public static function hot_list($cate='',$limit=8,$order='`view` DESC, `is_up` DESC',$field = true){
        $map = DocumentApi::listMap($cate, 1);
        $model = M('article');
        /* 设置列表数量 */
        is_numeric($limit) && $model->limit($limit);
        $result =  $model->field($field)->where($map)->order($order)->select();
        $result = content_url($result);
        return $result;
    }
} 