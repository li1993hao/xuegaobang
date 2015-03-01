<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Common\Api;
class CategoryApi {
    /**
     * 获取分类信息并缓存分类
     * @param  integer $id    分类ID
     * @param  string  $field 要获取的字段名
     * @return string         分类信息
     */
    public static function get_category($id, $field = null){
        static $list;

        /* 非法分类ID */
        if(empty($id)){
            return '';
        }

        /* 读取缓存数据 */
        if(empty($list)){
            $list = S('sys_category_list');
        }

        /* 获取分类名称 */
        if(!isset($list[$id])){
            $map = array('status'=>1,'type'=>array('in','1,2,3'));
            if(is_numeric($id)){
                $map['id']=$id;
            }else{
                $map['symbol']=$id;
            }
            $cate = M('node')->where($map)->find();
            if(!$cate || 1 != $cate['status']){ //不存在分类，或分类被禁用
                return '';
            }
            $cate = list_url($cate);
            $list[$id] = $cate;
            S('sys_category_list', $list); //更新缓存
        }
        return empty($field) ? $list[$id] : $list[$id][$field];
    }

    /* 根据ID获取分类名称 */
    public static function get_category_name($id){
        return get_category($id, 'name');
    }

    /**获得指定栏目的子类
     * @param $cid
     * @return bool|mixed|string|\栏目列表
     */
    public static function get_children_category($cid){
        if(empty($cid)){
            return false;
        }
        $pid = self::get_category($cid,'id');
        $result =  M('node')->where(array('status'=>1,'pid'=>$pid,'type'=>array('in','1,2,3')))->order('sort')->select();
        $result = list_url($result);
        return $result;
    }

    /**获得子级分类数量
     * @param $cid
     * @return bool
     */
    public static function get_children_count($cid,$map=array()){
        if(empty($cid)){
            return false;
        }
        $pid = self::get_category($cid,'id');
        $map = array_merge(array('pid'=>$pid,'status'=>1,'type'=>array('in','1,2,3')),$map);
        $result =  M('node')->where($map)->count();

        return $result;
    }

    /**
     * 获得顶级分类
     * @return mixed
     */
    public static function get_top_category($map=array()){
        $map = array_merge($map,array('status'=>1,'type'=>array('in','1,2,3'),'pid'=>0));
        $list = M('node')->where($map)->order('sort')->select();
        return list_url($list);
    }

    /**
     * 获取参数的所有父级分类
     * @param int $cid 分类id
     * @return array 参数分类和父类的信息集合
     */
    public static function get_parent_category($cid){
        if(empty($cid)){
            return false;
        }
        $cid = self::get_category($cid,'id');
        $cates  =   M('node')->where(array('status'=>1,'type'=>array('in','1,2,3')))->field('id,name,pid')->order('sort')->select();
        $child  =   get_category($cid);	//获取参数分类的信息
        $pid    =   $child['pid'];
        $res[]  =   $child;
        while(true){
            foreach ($cates as $key=>$cate){
                if($cate['id'] == $pid){
                    $pid = $cate['pid'];
                    array_unshift($res, $cate);	//将父分类插入到数组第一个元素前
                }
            }
            if($pid == 0){
                break;
            }
        }
        $res = list_url($res);
        return $res;
    }
}