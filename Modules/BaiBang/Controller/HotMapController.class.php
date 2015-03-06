<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ModuleController;


/**
 * 焦点图模块
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class HotMapController extends ModuleController
{
    /**
     * 属性列表
     * @author huajie <banhuajie@163.com>
     */
    public function index(){
        $group = I('get.group',-1);
        $map['status'] = array('gt',-1);
        if($group>-1){
            $map['group']= $group;
            $this->assign('current_group', $group);
        }
        $this->assign('groups', C('LINK_GROUP'));
        $list = $this->p_lists('Link',$map);
        int_to_string($list);
        // 记录当前列表页的cookie
        MK();
        $this->assign('list', $list);
        $this->meta_title = '链接管理';
        $this->_display();
    }

    /**
     * 新增链接
     */
    public function add(){
        if(IS_POST){
            $Link = D('Link');
            $data = $Link->create();
            if($data){
                $id = $Link->add();
                if($id){
                    S('sys_link_list', null);
                    $this->success('新增成功', LK());
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Link->getError());
            }
        } else {
            $this->assign('groups', C('LINK_GROUP'));
            $this->_display('edit');
        }
    }

    public function edit($id = 0){
        if(IS_POST){
            $Menu = D('Link');
            $data = $Menu->create();
            if($data){
                if($Menu->save()!== false){
                    S('sys_link_list', null);
                    $this->success('更新成功',LK());
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $info = D('Link')->where(array('id'=>$id))->find();
            if(false === $info){
                $this->error('获取链焦点图息错误');
            }
            if($info['picture_id']){
                $info['path'] = get_cover_path($info['picture_id']);
            }

            $this->assign('groups', C('LINK_GROUP'));
            $this->assign('info', $info);
            $this->_display();
        }
    }

    /**
     * 链接状态修改
     * @author 朱亚杰 <zhuyajie@topthink.net>
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('ids',0));
        $id = is_array($id) ? implode(',',$id) : $id;

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['id'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbid':
                $this->forbid('Link', $map );
                break;
            case 'resume':
                $this->resume('Link', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    /**
     * 删除链接
     */
    public function del(){
        $id = array_unique((array)I('ids',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Link')->where($map)->delete()){
            S('sys_link_list', null);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }



    /**
     * 链接排序
     * @author huajie <banhuajie@163.com>
     */
    public function sort(){
        if(IS_GET){
            $ids = I('get.ids');
            $map['id'] = array(in,$ids);
            $list = M('Link')->where($map)->field('id,name')->order('sort asc,id asc')->select();
            $this->assign('list', $list);
            $this->meta_title = '焦点图排序';
            $this->_display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = M('Link')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                S('sys_link_list', null);
                $this->success('排序成功！');
            }else{
                $this->eorror('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
}