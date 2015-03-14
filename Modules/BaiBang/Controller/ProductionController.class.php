<?php
namespace Modules\BaiBang\Controller;
use Common\Controller\ThinkController;
use Modules\Person\Api\CommentApi;
use Modules\Person\Api\StaffApi;

/**产品管理页面
 * Class ProductionController
 * @package Modules\BaiBang\Controller
 */
class ProductionController extends CommonController {
    private function searc_parse(){
        $map = array();
        $team_map = array(); //模版赋值
        foreach($_REQUEST as $k => $v){
            $kk = str2arr($k,'_');
            if($kk[0] == 'query'){ //查询字段

                if(trim($_REQUEST[$k]) === ""){
                    continue;
                }
                if($kk[1] == 'name'){//模糊查询
                    $map[] = "BINARY `name` LIKE '%{$v}%'";
                    $team_map[$k] = $v;
                    continue;
                }
                if($kk[1] == "company"){
                    $map[] = "company LIKE '%{$v}%'";
                    $team_map[$k] = $v;
                    continue;
                }
                if($v == '__whatever__'){ //不限
                    continue;
                }
                $map[$kk[1]] = $v;
                $team_map[$k] = $v;
            }else{
                unset($map[$k]);
            }
        }
        if(I('r')){
            $team_map['r']= I('r');
        }
        $this->assign('where',$team_map);
        return $map;
    }
    public function info(){
        $company_name = I("company");
        $id = I("id");
        $name = "production";
        if(!empty($company_name)){
            $name = 'company';
            $company = M("company")->where("name = '$company_name'")->find();
            $id = $company['id'];
        }
        ThinkController::info($name, $id, '','public/info');
    }

    /**
     * 产品管理
     */
    public function  index(){
        MK();
        $map = $this->searc_parse();
        $map['status']  = array('gt',-1);
        $list = $this->p_lists('Production',$map,'is_top desc,create_time desc');
        int_to_string($list);
        $list = list_sort_by($list,'status');
        for($i=0;$i<count($list);$i++){
            $list[$i]["collect_num"] = StaffApi::staffNum("production",$list[$i]['id']);
            $list[$i]["comment_num"] =CommentApi::commentNum("production",$list[$i]['id']);
            $list[$i]["like_num"] = StaffApi::staffNum("production",$list[$i]['id'],'like');
        }

        $this->assign('list', $list);
        $this->meta_title = '产品列表';
        $this->_display();
    }
}