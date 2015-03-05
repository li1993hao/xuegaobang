<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/28
 * Time: 下午3:33
 */

function check_company_status(){
    $res = M('Company')->where(array('uid'=>UID))->field('id,status')->find();
    if($res){
        return $res['status'];
    }else{
        return -1;//资料未填写
    }
}
function get_company_name(){
    $company = M("company")->where("uid=".UID)->field("name")->find();
    return $company['name'];
}