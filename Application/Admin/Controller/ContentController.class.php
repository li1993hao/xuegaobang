<?php
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Common\Controller\ThinkController;
/**内容管理模块
 * Class ContentController
 * @package Admin\Controller
 */
class ContentController extends ThinkController {
    /**
     * 检测需要动态判断的栏目｀有关的权限
     *
     * @return boolean|null
     *      返回true则表示当前访问有权限
     *      返回false则表示当前访问无权限
     *      返回null，则会进入checkRule根据节点授权判断权限
     *
     */
    protected function checkDynamic(){
        if(IS_ROOT){
            return true;//管理员允许访问任何页面
        }
        $cates = AuthGroupModel::getAuthCategories(UID);
        switch(strtolower(ACTION_NAME)){
            case 'index':
            case 'news':    //查看新闻列表
            case 'edit':    //编辑
            case 'add':   //增加
            case 'del': //删除
            $cate_id =  I('category_id');
            break;
        }
        if(!$cate_id){
            return null;//不明,需checkRule
        }elseif( !is_array($cate_id) && in_array($cate_id,$cates) ) {
            return true;//有权限
        }elseif( is_array($cate_id) && $cate_id==array_intersect($cate_id,$cates) ){
            return true;//有权限
        }else{
            return false;//无权限
        }
        return null;//不明,需checkRule
    }


    public function index(){
        //得到栏目的树形结构
        $map = array('status'=>array('gt',-1),'type'=>array('in','1,2,3'));
        if(!is_administrator()){//得到该用户的授权管理菜单
            $auth =  AuthGroupModel::getAuthCategories(UID);
            if(!$auth){
                $this->error('未授权访问');
            }else{
                $map['id']= array('in',$auth);
            }
        }

        $tree =list_to_tree(D('Category')->where($map)->select(),'id','pid','children');

        //得到栏目的先序遍历集合
        $sortList= array();
        tree_to_list_first($tree,'children',$sortList);

        foreach($sortList as $key => $value){
            $children = &$sortList[$key]['children'];
            if(isset($children)){
                $count = count($children);
                foreach($sortList as $m_key => $m_value){
                    if($m_value['id'] == $children[$count-1]['id']){
                        $sortList[$m_key]['last'] = true;
                    }
                }
            }
        }
        MK();
        $this->assign("nodeList",$sortList);
        $this->display();
    }


    /**查看某个栏目下的新闻列表
     * @param $catid
     * @param int $p
     */
    public function news(){
        $p = I('p');
        $page = intval($p);
        $page = $page ? $page : 1; //默认显示第一页数据

        $catid = I('category_id');
        $model = get_model_by_catid($catid);
        $cat = D('Category')->where(array('id'=>$catid))->field('name')->find();

        // 关键字搜索
        $map	=	array('status'=>array('gt','-1'));
        $map['category_id'] = $catid;
        if(isset($_REQUEST['title'])){
            $map[] ="BINARY `title` LIKE '%{$_GET['title']}%'";
            unset($_REQUEST['title']);
        }

        $row    = empty($model['list_row']) ? 10 : $model['list_row'];



        $name = parse_name(get_table_name($model['id']), true);
        $data = M($name)
            ->field('id,title,view,create_time,status,is_up')
            // 查询条件
            ->where($map)
            /* 默认通过id,和置顶逆序排列 */
            ->order('is_up DESC,update_time DESC')
            /* 数据分页 */
            ->page($page, $row)
            /* 执行查询 */
            ->select();
        MK();
        /* 查询记录总数 */
        $count = M($name)->where($map)->count();

        //分页
        if($count > $row){
            $page = new \Think\Page($count, $row);
            $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $this->assign('_page', $page->show());
        }

        $data   = parseDocumentList($data,$model['id']);
        int_to_string($data);
        $this->assign('category_id', $catid);
        $this->assign('list_data', $data);
        $this->meta_title = $cat['name'].'[列表]';
        $this->display('lists');
    }

    /**
     * 添加或者修改某条新闻
     */
    public function  add(){
        if(IS_POST){
            $_POST['uid']=UID;//用户id
            $category_id = I('post.category_id');
            $cat = D('Category')->getById($category_id);
            parent::add($cat['model_id']);
        }else{
            $catid = I('get.category_id');
            $model = get_model_by_catid($catid);
            $cat = D('Category')->where(array('id'=>$catid))->field('name')->find();
            $this->assign('category_id',$catid);
            parent::add($model['id'],$cat['name']."[添加]");
        }
    }

    public function edit(){
        if(IS_POST){
            $category_id = I('post.category_id');
            $id = I('post.id');
            $cat = D('Category')->getById($category_id);
//            if($cat['verify']){ //如果栏目需要审核,则在添加的时候把数据状态变为未审核
//                $_POST['status'] = 2;
//            }
            parent::edit($cat['model_id'],$id);
        }else{
            $category_id = I('get.category_id');
            $model = get_model_by_catid($category_id);
            $cat = D('Category')->where(array('id'=>$category_id))->field('name,type')->find();
            $this->assign('category_id',$category_id);
            if($cat['type'] == 2){//单页面
                $res= M($model['name'])->where(array('category_id'=>$category_id))->find();
                if($res){ //编辑单页面
                    parent::edit($model['id'],$res['id'],$cat['name'].'[修改]');
                }else{//新增单页面
                    $_POST['uid']=UID;//用户id
                    parent::add($model['id'],'修改'.$cat['name']);
                }
            }else{
                $id = I('get.id');
                parent::edit($model['id'],$id,$cat['name']."[编辑]");
            }
        }
    }

    /**
     * 数据状态修改
     * @author 朱亚杰 <zhuyajie@topthink.net>
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $category_id = I('get.category_id');
        $cat = D('Category')->getById($category_id);
        $model= get_model_by_id($cat['model_id'],'name');

        $map['id'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbid':
                $this->forbid($model, $map );
                break;
            case 'resume':
                $this->resume($model, $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    public function up(){
        $category_id = I('get.category_id');
        $id = I('get.id');
        $value = I('get.value');

        if(is_numeric($category_id) && is_numeric($id) && is_numeric($value)){
            $cat = D('Category')->getById($category_id);
            $model= get_model_by_id($cat['model_id'],'name');
            $data['is_up'] = $value;
            $data['id'] = $id;
            $res = M($model)->save($data);
            if($res === false){
                $this->error('操作失败,可能是操作数据已经不存在了..');
            }else{
                $this->success('操作成功');
            }
        }else{
            $this->error('参数有误!');
        }
    }

    public  function  del(){
        $category_id = I('get.category_id');
        $cat = D('Category')->getById($category_id);
        parent::del($cat['model_id']);
    }

}