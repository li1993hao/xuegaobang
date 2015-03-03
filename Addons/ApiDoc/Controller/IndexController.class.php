<?php

namespace Addons\ApiDoc\Controller;
use Common\Controller\AddonsController;

/**
 * Class ApiDocController
 * @package Addons\ApiDoc\Controller
 */
class IndexController extends AddonsController{
    static $tags = array('return','param','author','time');

     public function generate(){
         $names = (array)I('post.names');
         $modules = M('Module')->where(array('status'=>1,'name'=>array('in',$names)))->select();
         $this->get_list($modules);
         //$this->assign('list',$list);
     }

    /**
     * @param $ms
     * @return array
     */
    private function get_list($ms){
        $list = array();
        foreach($ms as $k=>$v){
            $result = $this->getModuleApiClass($v['name']);
            $api_module = array('module'=>$v,'apiClass'=>array(),'index'=>$k);
            foreach($result as $kk=>$cls){
                $reflect_class = new \ReflectionClass($cls['class']);
                $api_class = array();
                $class_comment = $reflect_class->getDocComment();
                preg_match('/@package(.+)\b/',$class_comment,$matchs);
                $api_class['package']=trim($matchs[1]); //包名
                preg_match('/@author(.+)\b/',$class_comment,$matchs);
                $api_class['author'] = trim($matchs[1]);//作者
                $api_class['name'] = $cls['name'];
                $api_class['index'] = $k.','.$kk;
                $methods = $reflect_class->getMethods();
                foreach($methods as $kkk=>$method){
                    if($method->isPublic() && $method->isStatic()){
                        $method_comment = $method->getDocComment();
                        $api_method = array();
                        $api_method['name'] = $method->getName();
                        preg_match_all('/@param(.+)[\n\r]/',$method_comment,$matchs);


                        if(!$this->isComment($method_comment)){//纯注释
                            $api_method['introduce'] = str_replace("*","",str_replace("*/","",str_replace("/**","",$method_comment)));
                        }else{
                            $api_method['introduce'] = str_replace("*","",str_replace('/**',"",str_replace(strstr($method_comment,"@"),"",$method_comment)));
                        }
                        foreach($matchs[1] as $param){
                            $items = preg_split('/\s+/',trim($param),3); //变量和注释
                            $api_method['param'][] = $items;
                        }
                        preg_match('/@return(.+)[\n\r]/',$method_comment,$matchs); //返回值
                        $api_method['return'] = preg_split('/\s+/',trim($matchs[1]),2);
                        preg_match('/@author(.+)\b/',$method_comment,$matchs); //作者
                        $api_method['author'] = trim($matchs[1]);
                        $api_method['index'] = $k.','.$kk.','.$kkk;
                        $M = $v['name'];
                        $C = substr($cls['name'],0,-3);
                        $A = $api_method['name'];
                        $api_method['url'] = "_R=Modules&_M=$M&_C=$C&_A=$A";
                        $api_class['method'][]=$api_method;
                    }
                }
                $api_module['apiClass'][] = $api_class;
            }
            $list[] = $api_module;
        }
        return $list;
    }

    private function isComment($comment){
        foreach(IndexController::$tags as $v){
            if(strstr($comment,'@'.$v)){
                return true;
            }
        }
        return false;
    }

    public function apiOnline(){
        $modules = M('Module')->where(array('status'=>1))->field('name,title')->select();
        $list =  $this->get_list($modules);
        $this->assign('list',$list);
        $this->display(T('Addons://ApiDoc@index/apiOnline'));
    }

    private function getModuleApiClass($module){
        $dir = JDICMS_MOUDLE_PATH.$module.'/Api/';
        $result = array();
        if(is_dir($dir)){
            $handler = opendir($dir);
            while (($filename = readdir($handler)) !== false) {
                if ($filename != "." && $filename != "..") {
                    if (is_file($dir . $filename)) {
                        $class_name= substr($filename,0,-10);
                        $result[] = array('path'=>$dir . $filename,'class'=>'Modules\\'.$module.'\\Api\\'.$class_name,'name'=>$class_name);
                    }
                }
            }
            closedir($handler);
        }
        return $result;
    }

    /*function api($array,$vars=array()){
        if(!is_array($array)){
            $array     = explode('/',$array);
        }

        $method    = array_pop($array);
        $classname = array_pop($array);
        $module    = $array? array_pop($array) : 'Common';

        $component = array_pop($array);
        if($component){ //扩展插件或者模块接口
            $module = $component.'\\'.$module;
        }

        $class = $module.'\\Api\\'.$classname.'Api';

        try{
            $reflect_class = new ReflectionClass($class);
            if($reflect_class->hasMethod($method)){
                $reflect_method = $reflect_class->getMethod($method);
                return $reflect_method->invokeArgs($reflect_class,$vars);
            }else{
                return -1;//请求的方法不错在
            }
        }catch (\ReflectionException $e){
            api_msg('请求方法不存在!错误代码:105');
        }
    }*/
}
