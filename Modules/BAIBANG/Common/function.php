<?php
/**
 * Created by PhpStorm.
 * User: haoli
 * Date: 15/1/28
 * Time: 下午3:33
 */

function get_company_id($uid){
    $company = M("company")->where("uid=".$uid)->field("id")->find();
    return $company['id'];
}

