<?php
namespace Modules\BaiBang\Model;
use Think\Model;
/**
 * 权限规则模型
 * @author 朱亚杰 <zhuyajie@topthink.net>
 */
class MemberModel extends Model{

    protected $_validate = array(
        array('username','require','用户名必须！'),
        array('email','','邮箱已经存在！',0,'unique',1),
        array('repassword','password','确认密码不正确',0,'confirm'),
    );

}
