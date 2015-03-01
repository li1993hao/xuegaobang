<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */

/**获得栏目
 * 两个参数都不写则获得顶级栏目
 * 写了$cid可以选择是获得此分类的详细信息还是获得
 * 其子栏目信息
 * @param $cid
 * @param bool $children
 * @return mixed
 */
function cat($cid='',$children=false,$root_nav=0,$activeClass='active'){
    if(empty($cid)){//获得顶级分类
        $result = api('Category/get_top_category',array('map'=>array('index_show'=>1)));
        foreach($result as $k =>$v){
            $result[$k]['has_child'] =api('Category/get_children_count',array('cid'=>$v['id'],'map'=>array('map'=>array('index_show'=>1))));
            $result[$k]['class'] =($result[$k]['id']==$root_nav?$activeClass:'');
        }
        return $result;
    }else{
        if($children){//获得指定分类的子分类
            return api('Category/get_children_category',array('id'=>$cid));
        }else{//获得指定分类
            return api('Category/get_category',array('id'=>$cid));
        }
    }
}

/**获得栏目特定字段
 * @param $cid
 * @param $field
 * @return Api|mixed
 */
function cat_field($cid,$field){
    $result = api('Category/get_category',array('id'=>$cid));
    return empty($field)?$result:$result[$field];
}

/**获得某栏目下的新闻
 * @param $cid 栏目id
 * @param string $limit 如果输入0,10类似则返回指定区间内的数据,如果是数字则返回指定页面,页面大小
 * 由栏目设置决定
 * @return bool|mixed
 */
function lists($cid,$limit='0,10'){
     if(is_numeric($cid)){
         return api('Document/lists',array('category'=>$cid,'page'=>$limit));
     }else{
         return false;
     }
}

/**获得推荐位置信息
 * @param $pos 推荐位id
 * @param $limit 取的范围
 * @param null $category 取指定栏目下的推荐位
 * @return bool|mixed
 */
function position($pos,$limit='0,5',$category=null){
    if(is_numeric($pos)){
        $result = api('Document/position',array('pos'=>'3','category'=>$category,
            'limit'=>$limit));
        return $result;
    }else{
        return false;
    }
}

/**获取莫个分组下的链接
 * @param $group  分组名称
 * @param $start  起始下标
 * @param $length 长度
 * @return Api|array|mixed
 */
function get_link($group,$start,$length){
    $result = api('Link/get_link',array('group'=>$group));
    if(isset($start)){
       return array_slice($result,$start,$length);
    }else{
        return $result;
    }
}


