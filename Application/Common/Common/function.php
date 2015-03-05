<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 14/12/16
 * Time: 下午12:45
 */
const JDICMS_VERSION    = '1.1.141101'; //程序版本
const JDICMS_ADDON_PATH = './Addons/'; //插件目录
const ONETHINK_ADDON_PATH = './Addons/'; //兼容ONETHINK插件目录
const JDICMS_MOUDLE_PATH = './Modules/'; //模板目录

/**********************************安全用户相关****************************************************/

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_encrypt($data, $key = '', $expire = 0) {
    $key  = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data = base64_encode($data);
    $x    = 0;
    $len  = strlen($data);
    $l    = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time():0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
    }
    return str_replace(array('+','/','='),array('-','_',''),base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key  加密密钥
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_decrypt($data, $key = ''){
    $key    = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data   = str_replace(array('-','_'),array('+','/'),$data);
    $mod4   = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $data   = base64_decode($data);
    $expire = substr($data,0,10);
    $data   = substr($data,10);

    if($expire > 0 && $expire < time()) {
        return '';
    }
    $x      = 0;
    $len    = strlen($data);
    $l      = strlen($key);
    $char   = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

/**用户密码加密方法
 * @param $p
 * @return string
 */
function user_encrypt($p){
    return sha1(md5($p.C('ENCRYPT_KEY')));
}

/**验证码检测
 * @param $code
 * @param int $id
 * @return bool
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}


/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function is_login(){
    return api('User/is_login');
}

/**
 * 检测当前用户是否为管理员
 * @return boolean true-管理员，false-非管理员
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function is_administrator($uid = null){
    $uid = is_null($uid) ? is_login() : $uid;
    return $uid && (intval($uid) === C('USER_ADMINISTRATOR'));
}

/**
 * @param $field 获取用户字段
 * @return mix
 */
function user_field($field){
    return api('User/user_field',array('field'=>$field));
}

/**获取指定用户字段
 * @param $uid
 * @param $field
 * @return mixed
 */
function get_user_filed($uid,$field=''){
    return api('User/get_user_field',array('uid'=>$uid,'field'=>$field));
}
/**获得制定id的用户昵称
 * @param $uid
 * @return mixed
 */
function get_nickname($uid){
    return api('User/get_nickname',array('uid'=>$uid));
}


function get_user_image($uid){
    $result = get_user_filed($uid,'head');
    return $result?$result:C('TMPL_PARSE_STRING.__DEFAULT_PERSON_IMAGE__');
}


/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @param  sort
 * @return string       签名
 */
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

/**api数据签名认证
 * @param $data
 * @param $key
 * @return string
 */
function api_auth_sign($data,$key){
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    $str = "";
    foreach($data  as $k=>$v){
        $str .="$k=$v&";
    }
    $str = substr($str,0,-1); //去除末尾&符号
    $sign = sha1($str.$key); //生成签名
    return $sign;
}



/**url加密
 * @param $num
 * @return string
 */
function url_encode($num){
    return think_encrypt($num,C('URL_KEY'));
}

/**url揭秘
 * @param $num
 * @return string
 */
function url_decode($num){
    return think_decrypt($num,C('URL_KEY'));
}
/**********************************安全用户相关****************************************************/

/**********************************工具相关****************************************************/
/**
 * 当前url做标记
 */
function MK(){
    trace($_SERVER['REQUEST_URI']);
    Cookie('__forward__',$_SERVER['REQUEST_URI']);
}

/**获取之前做标记的url
 * @return mixed|null
 */
function LK(){
    return Cookie('__forward__');
}
/**客户端重定向
 * @param $url
 */
function  JDIRedirect($url){
    header("location: ".$url);
    exit;
}

/**
 * 发送通知
 * @param $uid 通知用户
 * @param $title 通知标题
 * @param $detail 通知详情
 */
function notice($uid,$title,$detail=''){
    $data['uid'] = $uid;
    $data['title'] = $title;
    $data['detail'] = $detail;
    return D('Notice')->update($data);
}
/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data, $map = array('status' => array
    (1 => '<span class="label label-success ">正常</span>',
        -1 => '删除', 0 => '<span class="label label-danger ">禁用</span>',
        2 => '<span class="label label-warning">未审核</span>', 3 => '<span class="label">草稿</span>')))
{
    if ($data === false || $data === null) {
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row) {
        foreach ($map as $col => $pair) {
            if (isset($row[$col]) && isset($pair[$row[$col]])) {
                $data[$key][$col . '_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}


/**
 * 列表转化成树形结构
 * @param $list
 * @param $pk
 * @param $pid
 * @param string $childKey
 * @param int $root
 * @return array
 */
function list_to_tree($list, $pk, $pid, $child_key ='children', $root = 0,$fun){
    $tree = array();
    if(is_array($list)){
        //主键引用
        $refer = array();
        foreach ($list as $key=>$value){
            $refer[$value[$pk]] = &$list[$key];
            if(!empty($fun)){
                $fun($list[$key]);
            }
        }

        foreach($list as $key=>$value){
            $parent_id = $value[$pid];
            if($parent_id == $root){
                $tree[] = &$list[$key];
            }else{
                //父节点是否存在
                if(isset($refer[$parent_id])){
                    //加到父节点孩子集合中
                    $refer[$parent_id][$child_key][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}


/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array()){
    if(is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if(isset($reffer[$child])){
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby='asc');
    }
    return $list;
}

/**返回树的先序遍历集合
 * @param $tree 树
 * @param $childkey 子树对应的key值
 * @param array $list 转换后的线性集合
 * @param int $level 当前遍历节点的嵌套等级
 * @param int $remove 要删除的节点
 * @author lihao <953445224@qq.com>
 */
function tree_to_list_first($tree,$child_key,&$list=array(),$level=0,$remove=0){
    if(is_array($tree)){
        foreach($tree as $key=>$value){
            if($remove == $value['id']){
                unset($tree[$key]);
                continue;
            }
            $value['level'] = $level;
            $list[]= $value;
            tree_to_list_first($value[$child_key],$child_key,$list,$level+1,$remove);
        }
    }
}
/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function str2arr($str, $glue = ',',$pos,$default=0){
    if(isset($pos)){
        $array =  explode($glue, $str);
        if(!empty($array[$pos])){
            return $array[$pos];
        }else{
            return $default;
        }
    }else{
        return explode($glue, $str);
    }
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function arr2str($arr, $glue = ','){
    return implode($glue, $arr);
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $suffix=false,$charset="utf-8") {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return (mb_strlen($str,$charset)==mb_strlen($slice,$charset))?$slice:($suffix ? $slice.'...' : $slice);
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list,$field, $sortby='asc') {
    if(is_array($list)){
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc':// 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ( $refer as $key=> $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}

/**获得文件夹大小
 * @param $path 文件夹路径
 * @return mixed
 */
function getDirectorySize($path)
{
    $totalsize = 0;
    $totalcount = 0;
    $dircount = 0;
    if ($handle = opendir ($path))
    {
        while (false !== ($file = readdir($handle)))
        {
            $nextpath = $path . '/' . $file;
            if ($file != '.' && $file != '..' && !is_link ($nextpath))
            {
                if (is_dir ($nextpath))
                {
                    $dircount++;
                    $result = getDirectorySize($nextpath);
                    $totalsize += $result['size'];
                    $totalcount += $result['count'];
                    $dircount += $result['dircount'];
                }
                elseif (is_file ($nextpath))
                {
                    $totalsize += filesize ($nextpath);
                    $totalcount++;
                }
            }
        }
    }
    closedir ($handle);
    $total['size'] = $totalsize;
    $total['count'] = $totalcount;
    $total['dircount'] = $dircount;
    return $total;
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}
/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author huajie <banhuajie@163.com>
 */
function time_format($time = NULL,$format='Y-m-d H:i',$default='-'){
    if($time<=0){
        return $default;
    }
    $time = $time === NULL ? NOW_TIME : intval($time);
    return date($format, $time);
}

/**人性化时间提示
 * @param $time 时间戳
 * @return string
 */
function formatTime($time)
{
    $t = NOW_TIME - $time;
    $f = array(
        '31536000' => '年',
        '2592000' => '个月',
        '604800' => '星期',
        '86400' => '天',
        '3600' => '小时',
        '60' => '分钟',
        '1' => '秒'
    );
    if($t<30){
        return '刚刚';
    }
    foreach ($f as $k => $v) {

        if (0 != $c = floor($t / (int)$k)) {
            return $c.$v.'前';
        }
    }
}

/**图片剪裁
 * @param $path 图片地址
 * @param $width 剪裁后的宽
 * @param $height 剪裁后的高
 * @param int $type 剪裁类型 详情见Image类
 * @return string
 */
function thumb($path, $width, $height, $type = 3){
    $root = false;
    if($width<=0 || $height<=0){
        return $path;
    }
    if(strpos($path,__ROOT__.'/')==0){//去除根目录
        $root = true;
        $path = substr($path,strlen(__ROOT__.'/'));
    }
    if(!is_file($path)){
        return $path;
    }
    $imgInfo = pathinfo($path);
    $newImg = $imgInfo['dirname'].'/thum_'.$width.'_'.$height.'_'.$imgInfo["basename"];
    $newImgDir = $newImg;
    if(!is_file($newImgDir)){
        $image = new \Think\Image();
        $image->open($path);
        $image->thumb($width, $height,$type)->save($newImgDir);
    }
    if($root){ //还原根目录
        return __ROOT__.'/'.$newImg;
    }
    return $newImg;
}

/**
 * 从编辑器内容中提取指定图片
 * @param string $content 内容
 * @param int $num 第N张图片
 * @return string 图片URL
 */
function getImage($content, $num = 1){
    $content = htmlspecialchars_decode($content);
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    $num = $num -1;
    $img = $matches[1][$num];
    return $img;
}

/**
 * 获取文档封面图片
 * @param int $cover_id
 * @param string $field
 * @return 完整的数据  或者  指定的$field字段值
 * @author huajie <banhuajie@163.com>
 */
function get_cover($cover_id, $field = null){
    if(empty($cover_id)){
        return false;
    }
    $picture = M('Picture')->where(array('status'=>1))->getById($cover_id);
    return empty($field) ? $picture : $picture[$field];
}

/**获得完整的图片地址
 * @param $cover_id
 * @return bool|string
 */
function get_cover_path($cover_id){
    if(empty($cover_id)){
        return "";
    }
    return __ROOT__.get_cover($cover_id,'path');
}

/**是否为手机访问
 * @return bool
 */
function is_mobile(){
    if(session('tempMobile')){ //设置访问手机版
        return true;
    }else{
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($agent,"NetFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS")){
            return true;
        }else{
            return false;
        }
    }
}

/**模板路径
 * @return string
 */
function temp_path(){
    if(is_mobile()){
        return C('TEMP_PATH').'/'.C('MOBILE_THEME');
    }else{
        return C('TEMP_PATH').'/'.C('JDI_THEME');
    }
}

/**********************************工具相关****************************************************/



/**********************************系统功能相关****************************************************/
/**
* 处理插件钩子
* @param string $hook   钩子名称
* @param mixed $params 传入参数
* @return void
*/
function hook($hook,$params=array()){
    \Think\Hook::listen($hook,$params);
}

function get_module_class($name){
    $class = "Modules\\{$name}\\{$name}Module";
    return $class;
}

/**调用插件
 * @param $name
 * @param null $params
 * @param string $action
 * @return mixed
 */
function plugin($name,&$params=NULL) {
    $class = "Addons\\{$name}\\{$name}Addon";
    if(class_exists($class)){
        $addon = new $class;
        if(!check_addons($name)){
            return '';
        }
        return $addon->$name($params);
    }else{
        return '';
    }
}

/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_addon_class($name){
    $class = "Addons\\{$name}\\{$name}Addon";
    return $class;
}
/**
 * 获取插件类的配置文件数组
 * @param string $name 插件名
 */
function get_addon_config($name){
    $class = get_addon_class($name);
    if(class_exists($class)) {
        $addon = new $class();
        return $addon->getConfig();
    }else {
        return array();
    }
}

/**检测插件是否存在并且可用
 * @param $name
 * @return bool
 */
function check_addons($name){
    static $addons_status = array();
    //检测插件是否已经安装并且启用
    if(!isset($addons_status['$name'])){
        $result = M('Addons')->where(array('name'=>$name))->find();
        if($result['status'] == 1){
            $addons_status['$name']  = 1;
        }else{
            $addons_status['$name'] = 0;
        }
    }
    if($addons_status['$name'] !== 1 ){
        return false;
    }else{
        return true;
    }
}

/**智能判断是否是模块内url访问
 * @return mixed|string
 */
function _U($url, $param = array()){
    if(defined("__CURRENT_MODULE__") && !strpos($url,"#")){ //模块内访问
        if(!strpos($url,'/')){//当前控制器
            $url = __CURRENT_CONTROLLER__.'/'.$url;
        }
        $url = __CURRENT_MODULE__.'://'.$url;
        $url        = parse_url($url);
        $case       = C('URL_CASE_INSENSITIVE');
        $module     = $case ? parse_name($url['scheme']) : $url['scheme'];
        $controller = $case ? parse_name($url['host']) : $url['host'];
        $action     = trim($case ? strtolower($url['path']) : $url['path'], '/');

        /* 解析URL带的参数 */
        if(isset($url['query'])){
            parse_str($url['query'], $query);
            $param = array_merge($query, $param);
        }

        /* 基础参数 */
        $params = array(
            '_module'     => $module,
            '_controller' => $controller,
            '_action'     => $action,
        );
        $params = array_merge($params, $param); //添加额外参数
        return U('dispatch/execute_module', $params);
    }else{
        return U($url,$param);
    }
}

/**只能判断U函数
 * @param $url
 */
function UU($url,$param=array()){
    //扩展U函数
    if(ACTION_NAME == "execute_module"){
      return  _U($url,$param=array());
    }else{
      return  U($url,$param);
    }
}

function checkAttr($Model,$model_name){
    $fields     =   get_model_attribute($model_name,false);
    $validate   =   $auto   =   array();
    foreach($fields as $key=>$attr){
        if($attr['is_must']){// 必填字段
            $validate[]  =  array($attr['name'],'require',$attr['title'].'必须!');
        }
        // 自动验证规则
        if(!empty($attr['validate_rule'])) {
            $validate[]  =  array($attr['name'],$attr['validate_rule'],$attr['error_info']?$attr['error_info']:$attr['title'].'验证错误',$attr['validate_condition'],$attr['validate_type'],$attr['validate_time']);
        }
        // 自动完成规则
        if(!empty($attr['auto_rule'])) {
            $auto[]  =  array($attr['name'],$attr['auto_rule'],$attr['auto_time'],$attr['auto_type']);
        }elseif('checkbox'==$attr['type']){ // 多选型
            $auto[] =   array($attr['name'],'arr2str',3,'function');
        }elseif(preg_match("/^date.*/",$attr['type'])){ // 日期型
            $auto[] =   array($attr['name'],'strtotime',3,'function');
        }
    }
    return $Model->validate($validate)->auto($auto);
}

/**
 * 插件显示内容里生成访问插件的url
 * @param string $url url
 * @param array $param 参数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function addons_url($url, $param = array()){
    $url        = parse_url($url);
    $case       = C('URL_CASE_INSENSITIVE');
    $addons     = $case ? parse_name($url['scheme']) : $url['scheme'];
    $controller = $case ? parse_name($url['host']) : $url['host'];
    $action     = trim($case ? strtolower($url['path']) : $url['path'], '/');

    /* 解析URL带的参数 */
    if(isset($url['query'])){
        parse_str($url['query'], $query);
        $param = array_merge($query, $param);
    }

    /* 基础参数 */
    $params = array(
        '_addons'     => $addons,
        '_controller' => $controller,
        '_action'     => $action,
    );
    $params = array_merge($params, $param); //添加额外参数

    return U('dispatch/execute_addons', $params);
}

/* 解析插件数据列表定义规则*/

function get_addonlist_field($data, $grid,$addon){
    // 获取当前字段数据
    foreach($grid['field'] as $field){
        $array  =   explode('|',$field);
        $temp  =    $data[$array[0]];
        // 函数支持
        if(isset($array[1])){
            $temp = call_user_func($array[1], $temp);
        }
        $data2[$array[0]]    =   $temp;
    }
    if(!empty($grid['format'])){
        $value  =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data2){return $data2[$match[1]];}, $grid['format']);
    }else{
        $value  =   implode(' ',$data2);
    }

    // 链接支持
    if(!empty($grid['href'])){
        $links  =   explode(',',$grid['href']);
        foreach($links as $link){
            $array  =   explode('|',$link);
            $href   =   $array[0];
            if(preg_match('/^\[([a-z_]+)\]$/',$href,$matches)){
                $val[]  =   $data2[$matches[1]];
            }else{
                $show   =   isset($array[1])?$array[1]:$value;
                // 替换系统特殊字符串
                $href   =   str_replace(
                    array('[DELETE]','[EDIT]','[ADDON]'),
                    array('del?ids=[id]&name=[ADDON]','edit?id=[id]&name=[ADDON]',$addon),
                    $href);

                // 替换数据变量
                $href   =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data){return $data[$match[1]];}, $href);

                $val[]  =   '<a href="'.U($href).'">'.$show.'</a>';
            }
        }
        $value  =   implode(' ',$val);
    }
    return $value;
}


/**
 * 记录行为日志，并执行该行为的规则
 * @param string $action 行为标识
 * @param string $model 触发行为的模型名
 * @param int $record_id 触发行为的记录id
 * @param int $user_id 执行行为的用户id
 * @return boolean
 * @author huajie <banhuajie@163.com>
 */
function action_log($action = null, $model = null, $record_id = null, $user_id = null){

    //参数检查
    if(empty($action) || empty($model) || empty($record_id)){
        return '参数不能为空';
    }
    if(empty($user_id)){
        $user_id = is_login();
    }

    //查询行为,判断是否执行
    $action_info = M('Action')->getByName($action);
    if($action_info['status'] != 1){
        return '该行为被禁用或删除';
    }

    //插入行为日志
    $data['action_id']      =   $action_info['id'];
    $data['user_id']        =   $user_id;
    $data['action_ip']      =   ip2long(get_client_ip());
    $data['model']          =   $model;
    $data['record_id']      =   $record_id;
    $data['create_time']    =   NOW_TIME;

    //解析日志规则,生成日志备注
    if(!empty($action_info['log'])){
        if(preg_match_all('/\[(\S+?)\]/', $action_info['log'], $match)){
            $log['user']    =   $user_id;
            $log['record']  =   $record_id;
            $log['model']   =   $model;
            $log['time']    =   NOW_TIME;
            $log['data']    =   array('user'=>$user_id,'model'=>$model,'record'=>$record_id,'time'=>NOW_TIME);
            foreach ($match[1] as $value){
                $param = explode('|', $value);
                if(isset($param[1])){
                    $replace[] = call_user_func($param[1],$log[$param[0]]);
                }else{
                    $replace[] = $log[$param[0]];
                }
            }
            $data['remark'] =   str_replace($match[0], $replace, $action_info['log']);
        }else{
            $data['remark'] =   $action_info['log'];
        }
    }else{
        //未定义日志规则，记录操作url
        $data['remark']     =   '操作url：'.$_SERVER['REQUEST_URI'];
    }

    M('ActionLog')->add($data);

    if(!empty($action_info['rule'])){
        //解析行为
        $rules = parse_action($action, $user_id);
        //执行行为
        $res = execute_action($rules, $action_info['id'], $user_id);
    }
}

/**
 * 解析行为规则
 * 规则定义  table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
 * 规则字段解释：table->要操作的数据表，不需要加表前缀；
 *              field->要操作的字段；
 *              condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
 *              rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
 *              cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
 *              max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
 * 单个行为后可加 ； 连接其他规则
 * @param string $action 行为id或者name
 * @param int $self 替换规则里的变量为执行用户的id
 * @return boolean|array: false解析出错 ， 成功返回规则数组
 * @author huajie <banhuajie@163.com>
 */
function parse_action($action = null, $self){
    if(empty($action)){
        return false;
    }

    //参数支持id或者name
    if(is_numeric($action)){
        $map = array('id'=>$action);
    }else{
        $map = array('name'=>$action);
    }

    //查询行为信息
    $info = M('Action')->where($map)->find();
    if(!$info || $info['status'] != 1){
        return false;
    }

    //解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
    $rules = $info['rule'];
    $rules = str_replace('{$self}', $self, $rules);
    $rules = explode(';', $rules);
    $return = array();
    foreach ($rules as $key=>&$rule){
        $rule = explode('|', $rule);
        foreach ($rule as $k=>$fields){
            $field = empty($fields) ? array() : explode(':', $fields);
            if(!empty($field)){
                $return[$key][$field[0]] = $field[1];
            }
        }
        //cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
        if(!array_key_exists('cycle', $return[$key]) || !array_key_exists('max', $return[$key])){
            unset($return[$key]['cycle'],$return[$key]['max']);
        }
    }

    return $return;
}

/**
 * 执行行为
 * @param array $rules 解析后的规则数组
 * @param int $action_id 行为id
 * @param array $user_id 执行的用户id
 * @return boolean false 失败 ， true 成功
 * @author huajie <banhuajie@163.com>
 */
function execute_action($rules = false, $action_id = null, $user_id = null){
    if(!$rules || empty($action_id) || empty($user_id)){
        return false;
    }

    $return = true;
    foreach ($rules as $rule){

        //检查执行周期
        $map = array('action_id'=>$action_id, 'user_id'=>$user_id);
        $map['create_time'] = array('gt', NOW_TIME - intval($rule['cycle']) * 3600);
        $exec_count = M('ActionLog')->where($map)->count();
        if($exec_count > $rule['max']){
            continue;
        }

        //执行数据库操作
        $Model = M(ucfirst($rule['table']));
        $field = $rule['field'];
        $res = $Model->where($rule['condition'])->setField($field, array('exp', $rule['rule']));

        if(!$res){
            $return = false;
        }
    }
    return $return;
}
/**
 * 获取行为类型
 * @param intger $type 类型
 * @param bool $all 是否返回全部类型
 * @author huajie <banhuajie@163.com>
 */
function get_action_type($type, $all = false){
    $list = array(
        1=>'系统',
        2=>'用户',
    );
    if($all){
        return $list;
    }
    return $list[$type];
}



if(!function_exists('array_column')){
    function array_column(array $input, $columnKey, $indexKey = null) {
        $result = array();
        if (null === $indexKey) {
            if (null === $columnKey) {
                $result = array_values($input);
            } else {
                foreach ($input as $row) {
                    $result[] = $row[$columnKey];
                }
            }
        } else {
            if (null === $columnKey) {
                foreach ($input as $row) {
                    $result[$row[$indexKey]] = $row;
                }
            } else {
                foreach ($input as $row) {
                    $result[$row[$indexKey]] = $row[$columnKey];
                }
            }
        }
        return $result;
    }
}

/**
 * 获取表名（不含表前缀）
 * @param string $model_id
 * @return string 表名
 * @author huajie <banhuajie@163.com>
 */
function get_table_name($model_id = null){
    if(empty($model_id)){
        return false;
    }
    $Model = M('Model');
    $name = '';
    $info = $Model->getById($model_id);
    $name .= $info['name'];
    return $name;
}

/**
 * 获取属性信息并缓存
 * @param  integer $id    属性ID
 * @param  string  $field 要获取的字段名
 * @return string         属性信息
 */
function get_model_attribute($model_id, $group = true){
    static $list;
    if(!is_numeric($model_id)){
        $model_id = M('Model')->getFieldByName($model_id,'id');
    }

    /* 非法ID */
    if(empty($model_id) || !is_numeric($model_id)){
        return '';
    }


    /* 读取缓存数据 */
    if(empty($list)){
        $list = S('attribute_list');
    }

    /* 获取属性 */
    if(!isset($list[$model_id])){
        $map = array('model_id'=>$model_id);
        $extend = M('Model')->getFieldById($model_id,'extend');

        if($extend){
            $map = array('model_id'=> array("in", array($model_id, $extend)));
        }
        $info = M('Attribute')->where($map)->select();
        $list[$model_id] = $info;
        //S('attribute_list', $list); //更新缓存
    }

    $attr = array();
    foreach ($list[$model_id] as $value) {
        $attr[$value['id']] = $value;
    }

    if($group){
        $sort  = M('Model')->getFieldById($model_id,'field_sort');

        if(empty($sort)){	//未排序
            $group = array(1=>array_merge($attr));
        }else{
            $group = json_decode($sort, true);

            $keys  = array_keys($group);
            foreach ($group as &$value) {
                foreach ($value as $key => $val) {
                    $value[$key] = $attr[$val];
                    unset($attr[$val]);
                }
            }

            if(!empty($attr)){
                $group[$keys[0]] = array_merge($group[$keys[0]], $attr);
            }
        }
        $attr = $group;
    }
    return $attr;
}

/**
 * 调用系统的API接口方法（静态方法，也可以调用插件和模块接口，不指明的话则调用common下的系统接口）
 * api('User/getName','id=5'); 调用公共模块的User接口的getName方法
 * api('Admin/User/getName','id=5');  调用Admin模块的User接口
 * @param  string  $name 格式 [模块名]/接口名/方法名
 * @param  array|string  $vars 参数
 */
function api($array,$vars=array()){
    if(!is_array($array)){
        $array     = explode('/',$array);
    }

    $method    = array_pop($array);
    $class_name = array_pop($array);
    $module    = $array? array_pop($array) : 'Common';

    $component = array_pop($array);
    if($component){ //扩展插件或者模块接口
        $module = $component.'\\'.$module;
    }

    $class = $module.'\\Api\\'.$class_name.'Api';

    try{
        $reflect_class = new ReflectionClass($class);
        if($reflect_class->hasMethod($method)){
            $reflect_method = $reflect_class->getMethod($method);
            $params =  $reflect_method->getParameters();
            $real_vars = array();
            foreach ($params as $param){
                $name = $param->getName();
                if(isset($vars[$name])){
                    $real_vars[] = $vars[$name];
                }elseif($param->isDefaultValueAvailable()){
                    $real_vars[] = $param->getDefaultValue();
                }else{
                    api_msg("参数".$param->getName()."必须填写");
                    return false;
                }
            }
            return $reflect_method->invokeArgs($reflect_class,$real_vars);
        }else{
            api_msg("请求方法不存在!错误代码:107");
            return false;
        }
    }catch (\ReflectionException $e){
        api_msg('请求类不存在!错误代码:106');
        return false;
    }
}

/**
 * 调用api时的输出信息
 */
function api_msg($msg=''){
    static $message;
    if(!empty($msg)){
        $message = $msg;
    }else{
        return $message;
    }
}

/**
 * 根据条件字段获取指定表的数据
 * @param mixed $value 条件，可用常量或者数组
 * @param string $condition 条件字段
 * @param string $field 需要返回的字段，不传则返回整个数据
 * @param string $table 需要查询的表
 * @author huajie <banhuajie@163.com>
 */
function get_table_field($value = null, $condition = 'id', $field = null, $table = null){
    if(empty($value) || empty($table)){
        return false;
    }

    //拼接参数
    $map[$condition] = $value;
    $info = M(ucfirst($table))->where($map);
    if(empty($field)){
        $info = $info->field(true)->find();
    }else{
        $info = $info->getField($field);
    }
    return $info;
}



/**url组装
 * @param $list  栏目列表
 */
function list_url($list){
    if(APP_MODE != 'api'){
        if(!isset($list['id'])){
            foreach($list as $k=>$v){

                $list[$k]['url'] = U('index/category?cate='.$v['symbol'].'&p=1');
            }
        }else{
            $list['url']= U('index/category?cate='.$list['symbol'].'&p=1');
        }
    }
    return $list;
}

/**内容页url组装
 * @param $list
 * @param $fun 回调函数
 * @return mixed
 */
function content_url($list,$fun=null){
    if(!isset($list['id'])){//代表是二维数组
        foreach((array)$list as $k=>$v){
            if($v['cover']>0){//封面图片
                $list[$k]['cover_path'] = get_cover_path($v['cover']);
            }elseif($v['auto_image']>0){//自动提取图片
                $imagePath =  getImage($v['content'],$v['auto_image']);
                if($imagePath){
                    $list[$k]['cover_path'] = $imagePath;
                }
            }elseif(!empty($v['picture'])){//图片模型
                $picture = json_decode(htmlspecialchars_decode($list[$k]['picture']),true);
                foreach($picture as $item){
                    if($item['cover']){
                        $list[$k]['cover_path'] = get_cover_path($item['id']);
                        $flag = true;
                        break;
                    }
                }
                if(!$flag && !empty($picture)){//默认第一张为封面
                    $list[$k]['cover_path'] = get_cover_path($picture[0]['id']);
                }
            }

            if(!empty($v['link'])){ //外链
                if('http://' === substr($v['link'], 0, 7)){
                    $list[$k]['url'] = $v['url'];
                }else if('www' === substr($v['link'], 0, 3)){
                    $list[$k]['url'] = ('http://'.$v['link']);
                }else{
                    if(APP_MODE != 'api'){
                        $list[$k]['url'] = U($v['link']);
                    }else{
                        $list[$k]['url'] = 'function';
                    }
                }
            }else{
                if(APP_MODE != 'api'){
                    $cate = api('Category/get_category',array('id'=>$list[$k]['category_id'],'field'=>'symbol'));
                    $list[$k]['url'] = U('index/content?cate='.$cate.'&id='.$list[$k]['id']);
                }
            }
            if($fun instanceof Closure){
                $fun($list[$k]);
            }
        }
    }else{
        if($list['cover']>0){//封面图片
            $list['cover_path'] = get_cover_path($list['cover']);
        }elseif($list['auto_image']>0){
            $imagePath =  getImage($list['content'],$list['auto_image']);
            if($imagePath){
                $list['cover_path'] = $imagePath;
            }
        }elseif(!empty($v['picture'])){//图片模型
            $picture = json_decode(htmlspecialchars_decode($list['picture']),true);
            foreach($picture as $item){
                if($item['cover']){
                    $list['cover_path'] = get_cover_path($item['id']);
                    $flag = true;
                    break;
                }
            }
            if(!$flag && !empty($picture)){//默认第一张为封面
                $list['cover_path'] = get_cover_path($picture[0]['id']);
            }
        }

        if(!empty($list['link'])){ //外链
            if('http://' === substr($list['url'], 0, 7)){
                $list['url'] = $list['link'];
            }else if('www' === substr($list['link'], 0, 3)){
                $list['url'] = ('http://'.$list['link']);
            }else{
                if(APP_MODE != 'api'){
                    $list['url'] = U($list['link']);
                }else{
                    $list['url'] = "function";
                }
            }
        }else{
            if(APP_MODE != 'api'){
                $cate = api('Category/get_category',array('id'=>$list['category_id'],'field'=>'symbol'));
                $list['url'] = U('index/content?cate='.$cate.'&id='.$list['id']);
            }
        }
        if($fun instanceof Closure){ //回调函数
            $fun($list);
        }
    }
    return $list;
}

/**正则匹配
 * @param $value
 * @param $rule
 * @return bool
 */
function regex($value,$rule) {
    $validate = array(
        'require'   =>  '/\S+/',
        'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
        'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
        'currency'  =>  '/^\d+(\.\d+)?$/',
        'number'    =>  '/^\d+$/',
        'zip'       =>  '/^\d{6}$/',
        'integer'   =>  '/^[-\+]?\d+$/',
        'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
        'english'   =>  '/^[A-Za-z]+$/',
    );
    // 检查是否有内置的正则表达式
    if(isset($validate[strtolower($rule)]))
        $rule       =   $validate[strtolower($rule)];
    return preg_match($rule,$value)===1;
}

/**链接解析
 * @param $list
 * @return mixed
 */
function link_url($list){
    if(!isset($list['url'])){//数组
        foreach($list as $k=>$v){
            if('http://' === substr($v['url'], 0, 7)){
                $list[$k]['url'] = $v['url'];
            }else if('www' === substr($v['url'], 0, 3)){
                $list[$k]['url'] = ('http://'.$v['url']);
            }else{
                if(APP_MODE != 'api'){
                    $list[$k]['url'] = U($v['url']);
                }else{
                    $list[$k]['url'] = 'function'; //表明时功能节点,不是新闻
                }
            }

            if($list[$k]['picture_id']>0){
                $list[$k]['picture'] = get_cover_path($list[$k]['picture_id']);
            }else{
                $list[$k]['picture'] = C('TMPL_PARSE_STRING.__DEFAULT__');
            }
        }
    }else{
        if('http://' === substr($list['url'], 0, 7)){
            $list['url'] = $list['url'];
        }else if('www' === substr($list['url'], 0, 3)){
            $list['url'] = ('http://'.$list['url']);
        }else{
            if(APP_MODE != 'api'){
                $list['url'] = U($list['url']);
            }else{
                $list['url'] = 'function';
            }
        }
        if($list['picture_id]']>0){
            $list['picture'] = get_cover_path($list['picture_id]']);
        }else{
            $list['picture'] = C('TMPL_PARSE_STRING.__DEFAULT__');
        }
    }

    return $list;
}
/**********************************系统功能相关****************************************************/