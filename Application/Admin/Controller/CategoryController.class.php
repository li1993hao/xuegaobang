<?php
namespace Admin\Controller;
use Common\Controller\AdminController;

/**
 *
 *
 *
 * 栏目管理模块
 * Class CategoryController
 * @package Admin\Controller
 */
class CategoryController extends AdminController {

    public function index(){
        $map = array('status'=>array('gt',-1),'type'=>array('in','1,2,3'));

        $list = D('Category')->where($map)->select();
        int_to_string($list);
        //得到栏目树形结构
        $tree =list_to_tree($list,'id','pid','children');

        //得到树形结构的先序遍历集合
        $sortList= array();
        tree_to_list_first($tree,'children',$sortList);

        //判断节点是不是父亲节点的最后一个孩子
        //用于前台显示判断
        foreach($sortList as $key => $value){
            $children = &$sortList[$key]['children'];
            if(isset($children)){
                $count = count($children);
                foreach($sortList as $m_key => $m_value){
                    //当前孩子节点的ID等于父亲节点ID，则是最后一个节点
                    if($m_value['id'] == $children[$count-1]['id']){
                        $sortList[$m_key]['last'] = true;
                    }
                }
            }
        }
        $this->assign("nodeList",$sortList);
        $this->display();
    }

    /**添加或者编辑栏目
     * @param int $type 添加类型 1是栏目，2是单页面，3是外部链接
     * @param string $node
     */
    public function  add($type=1,$node=""){
        $Category = D('Category');
        //保存提交
        if(IS_POST){
            //更新或者是添加,由模型在底层根据是否由id进行判断
            if($Category->update()){
                $this->success("操作成功",U("index"));
            }else{
                $error = $Category->getError();
                $this->error(empty($error) ? '未知错误！' : $error);
            }
        }else{
            //用户选择指定节点添加子栏目
            if(!empty($node)){
                //用户选择指定节点添加子栏目
                $this->assign('node',$node);
                $this->assign('select_id',$node['pid']);
            }else{
                $this->assign('select_id',I('select_id'));
            }
            $this->assign('type',$type);
            if($type < 3){
                //栏目或者是单页面,得到系统模板,和所有模型
                 $this->assign("temp",get_all_temp());
                 $this->assign("model",M('Model')->where(array('type'=>0))->field('id,name')->select());
            }
            //所有的可被当做父栏目的栏目集合
            $map = array('status'=>array('gt',-1),'type'=>array('in','1,2,3'));
            $list = D('Category')->where($map)->select();
            $tree =list_to_tree($list,'id','pid','children');

            //得到树形结构的先序遍历集合
            $sortList= array();
            tree_to_list_first($tree,'children',$sortList,0,$node['id']);

            //判断节点是不是父亲节点的最后一个孩子
            //用于前台显示判断
            foreach($sortList as $key => $value){
                $children = &$sortList[$key]['children'];
                if(isset($children)){
                    $count = count($children);
                    foreach($sortList as $m_key => $m_value){
                        //当前孩子节点的ID等于父亲节点ID，则是最后一个节点
                        if($m_value['id'] == $children[$count-1]['id']){
                            $sortList[$m_key]['last'] = true;
                        }
                    }
                }
            }
            //前端现实优化
            foreach($sortList as $key => $value){
                for($i=0;$i<$value['level'];$i++){
                    if($i==$value['level']-1){
                        if($value['last']){
                            $sortList[$key]['name'] = ' |_'.$sortList[$key]['name'];
                        }else{
                            $sortList[$key]['name'] = ' |-'.$sortList[$key]['name'];
                        }
                    }else{
                        $sortList[$key]['name'] = ' '.$sortList[$key]['name'];
                    }
                }
            }

            $this->assign('pid',$sortList);
            //根据类型不同渲染不同模板
            $this->display($type==1?'addCategory':($type==2?'addPage':'addLink'));
        }
    }

    /**编辑
     * @param $type 类型
     * @param $id  要编辑的记录id
     */
    public function  edit($type,$id){
        if(is_numeric($type) && is_numeric($id)){
            $node = D('Category')->where(array('id'=>$id))->find();
            $this->add($type,$node);
        }else{
            $this->error("参数非法!");
        }

    }

    public function changeStatus($method=null){
        $id = I('id');
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['id'] =  $id;
        switch ( strtolower($method) ){
            case 'forbid':
                $this->forbid('node', $map );
                break;
            case 'resume':
                $this->resume('node', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    public function delete($id){
        if(is_numeric($id)){
            $model = D('Category');
            $node = $model->where(array('id'=>$id))->find();
            if($node){
                $data['status'] = -1;
                $model->where(array('id'=>$id))->save($data);
                $model->where(array('pid'=>$node['id']))->save(array('pid'=>$node['pid']));
                $this->success('删除成功!');
            }else{
                $this->error("删除栏目不存在!");
            }
        }else{
            $this->error("参数非法!");
        }
    }

    public function clearCache(){
        S('sys_category_list',null);
        $this->success('缓存更新成功!');
    }

    public function sort($id, $value){
        if(is_numeric($id) && is_numeric($value)){
            $data['sort']= $value;
            D('Category')->where(array('id'=>$id))->save($data);
            $this->success('设置成功');
        }else{
            $this->error("参数非法!");
        }
    }
    /**
     * 批量导入
     */
    public function import(){
        if(IS_POST){
            $tree = I('tree');
            if($tree){
                $array = preg_split('/[,;\r\n]+/', trim($tree, ",;\r\n"));
                $pre0 = 0; //前置根节点
                $pre1 = 0; //前置1级节点
                $pre2 = 0; //前置2级节点
                foreach($array as $str){
                    $level =  substr_count($str, '#');
                    $name = str_replace('#','',$str);
                    $info = str2arr($name,'|');
                    if(count($info)!=3){
                        $this->error("格式错误!");
                    }
                    $data['name'] = $info[0];
                    $data['symbol'] = $info[1];
                    $data['type'] = $info[2]?$info[2]:1;
                    $data['model_id'] = 20;//默认是文章
                    $data['status'] = 1;
                    $data['temp_category']= 'category.html';
                    $data['temp_list']= 'list.html';
                    $data['temp_content']= 'content.html';
                    $data['list_num'] = 10;
                    $data['create_time'] = time();
                    $data['update_time'] = time();
                    if($level==0){//根节点
                        $data['pid'] = 0;
                        $pre0 = D('Category')->add($data); //直接保存
                        $res = $pre0;
                    }elseif($level==1){//1级节点
                        $data['pid'] = $pre0;
                        $pre1 = D('Category')->add($data); //直接保存
                        $res = $pre1;
                    }elseif($level==2){//2级节点
                        $data['pid'] = $pre1;
                        $pre2 = D('Category')->add($data); //直接保存
                        $res = $pre2;
                    }else{//叶子节点
                        $data['pid'] = $pre2;
                        $res =  D('Category')->add($data); //直接保存
                    }

                    if(!$res){
                        $this->error('导入失败,请检查导入格式是否正确!');
                    }
                }
                $this->success('导入成功!');
            }else{
                $this->error('输入不能为空!');
            }
        }else{
            $this->display();
        }
    }

}