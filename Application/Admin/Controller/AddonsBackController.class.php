<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Common\Controller\AdminController;
/**
 * 插件后台管理页面
 */
class AddonsBackController extends AdminController {

    public function _initialize(){
        $this->assign('_extra_menu',array(
            'ext'=>array('已装插件'=>$this->getAdminList()),
            'group'=>'已装插件'
        ));
        parent::_initialize();
    }

    /**
     * 获取插件的后台列表
     */
    private  function getAdminList(){
        $admin = array();
        $db_addons =  D('Addons')->where("status=1 AND has_adminlist=1")->field('title,name')->select();
        if($db_addons){
            $flag = false;
            foreach ($db_addons as $value) {
                if(I('name') == $value['name']){
                    $class = 'active';
                    $flag = true;
                }else{
                    $class = "";
                }
                $admin[] = array('title'=>$value['title'],'url'=>"AddonsBack/adminList?name={$value['name']}",
                    'class'=>$class,'name'=>$value['name']);
            }
            if(!$flag && count($db_addons) >0){
                $admin[0]['class']='active';
                $_GET['name'] =$admin[0]['name'];
            }
        }else{
            $this->error('您还未安装带有后台的插件!');
        }
        return $admin;
    }

    /**
     * 插件后台显示页面
     * @param string $name 插件名
     */
    public function adminList($name){
        MK();
        $this->assign('name', $name);
        $class = get_addon_class($name);
        if(!class_exists($class))
            $this->error('插件不存在');
        $addon = new $class();
        $this->assign('addon', $addon);
        $param = $addon->admin_list;
        if($param){
            extract($param);
            $this->assign($param);
        }
        $this->meta_title = $addon->info['title'];
        $this->assign('title', $addon->info['title']);
        if(!isset($fields))
            $fields = '*';
        if(!isset($search_key))
            $key = 'title';
        else
            $key = $search_key;

        if(isset($_REQUEST[$key])){
            $map[$key] = array('like', '%'.$_GET[$key].'%');
            unset($_REQUEST[$key]);
        }

        if(isset($model)){
            $model  =   D("Addons://{$name}/{$model}");

            if(!$map){
                // 条件搜索
                $map    =   array();
                foreach($_REQUEST as $name=>$val){
                    if($fields == '*'){
                        $fields = $model->getDbFields();
                    }
                    if(in_array($name, $fields)){
                        $map[$name] = $val;
                    }
                }
            }

            if(!isset($order))  $order = '';
            $list = $this->lists($model->field($fields),$map,$order);
            $fields = array();
            foreach ($list_grid as &$value) {
                // 字段:标题:链接
                $val = explode(':', $value);
                // 支持多个字段显示
                $field = explode(',', $val[0]);
                $value = array('field' => $field, 'title' => $val[1]);
                if(isset($val[2])){
                    // 链接信息
                    $value['href'] = $val[2];
                    // 搜索链接信息中的字段信息
                    preg_replace_callback('/\[([a-z_]+)\]/', function($match) use(&$fields){$fields[]=$match[1];}, $value['href']);
                }
                if(strpos($val[1],'|')){
                    // 显示格式定义
                    list($value['title'],$value['format']) = explode('|',$val[1]);
                }
                foreach($field as $val){
                    $array = explode('|',$val);
                    $fields[] = $array[0];
                }
            }
            $this->assign('model', $model->model);
            $this->assign('list_grid', $list_grid);
        }
        if(method_exists($addon,'admin_before')){
            $addon->admin_before($this->view); //
        }
        $this->assign('_list', $list);
        if($addon->custom_adminlist)
            $this->assign('custom_adminlist', $this->fetch($addon->addon_path.$addon->custom_adminlist));
        $this->display('adminlist');
    }

    /**编辑
     * @param $name
     * @param int $id
     */
    public function edit($name, $id = 0){
        $this->assign('name', $name);
        $class = get_addon_class($name);
        if(!class_exists($class))
            $this->error('插件不存在');
        $addon = new $class();
        $this->assign('addon', $addon);
        $param = $addon->admin_list;
        if(!$param)
            $this->error('插件列表信息不正确');
        extract($param);
        $this->assign('title', $addon->info['title']);
        if(isset($model)){
            $addonModel = D("Addons://{$name}/{$model}");
            if(!$addonModel)
                $this->error('模型无法实列化');
            $model = $addonModel->model;
            $this->assign('model', $model);
        }
        if($id){
            $data = $addonModel->find($id);
            $data || $this->error('数据不存在！');
            $this->assign('data', $data);
        }

        if(IS_POST){
            // 获取模型的字段信息
            if(!$addonModel->create())
                $this->error($addonModel->getError());

            if($id){
                $flag = $addonModel->save();
                if($flag !== false)
                    $this->success("编辑{$model['title']}成功！", LK());
                else
                    $this->error($addonModel->getError());
            }else{
                $flag = $addonModel->add();
                if($flag)
                    $this->success("添加{$model['title']}成功！", Lk());
            }
            $this->error($addonModel->getError());
        } else {
            $fields = $addonModel->_fields;
            $this->assign('fields', $fields);
            $this->meta_title = $id? '编辑'.$model['title']:'新增'.$model['title'];
            if($id){
                if($model['template_edit']){
                    $this->assign('temp', $this->fetch($addon->addon_path.$model['template_edit']));
                }else{
                    $this->display('edit.html');
                }
                $template = $model['template_edit']? $model['template_edit']: 'edit.html';
            }else{
                $template = $model['template_add']? $model['template_add']: 'add.html';
            }

            $this->display();
        }
    }

    /**删除
     * @param $name
     */
    public function del($name){
        $ids = array_unique((array)I('ids',0));

        if ( empty($ids) ) {
            $this->error('请选择要操作的数据!');
        }

        $class = get_addon_class($name);
        if(!class_exists($class))
            $this->error('插件不存在');
        $addon = new $class();
        $param = $addon->admin_list;
        if(!$param)
            $this->error('插件列表信息不正确');
        extract($param);
        if(isset($model)){
            $addonModel = D("Addons://{$name}/{$model}");
            if(!$addonModel)
                $this->error('模型无法实列化');
        }

        $map = array('id' => array('in', $ids) );
        if($addonModel->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}
