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
class LinkApi {
    /**
     * 获得外部链接
     * @param string $group 组别
     * @param  mix $what 如果是数字则取组别下面的纪录,如果是’count‘则取组别的链接数量
     * @return int|string 链接集合
     */
    public static function get_link($group,$what){
        static $list;

        /* 非法分类ID */
        if(empty($group)){
            return '';
        }

        /* 读取缓存数据 */
        if(!empty($list)){
            $list = S('sys_link_list');
        }

        if(empty($list[$group])){
            $link = M('Link')->where(array('status'=>1,'group'=>$group))->order('sort asc,id asc')->select();

            if(empty($link)){//不存在该组别
                return '';
            }

            $list[$group] =array();
            $link = link_url($link);

            foreach($link as $v){
                $list[$group][$v['id']]=$v;
            }
            S('sys_link_list', $list); //更新缓存
        }
        if(isset($what)){
            if($what=='count'){
                return count($list[$group]);
            }else{
                return $list[$group][$what];
            }
        }else{
            return $list[$group];
        }
    }
}