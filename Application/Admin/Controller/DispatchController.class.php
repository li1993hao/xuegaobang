<?php
namespace Admin\Controller;
use Common\Controller\BaseController;
use Think\Controller;

/**调度控制器
 * 用于插件和扩展模块的安全访问
 * Class IndexController
 * @package Admin\Controller
 */
class DispatchController extends Controller {
    /**执行插件方法
     * @param null $_addons
     * @param null $_controller
     * @param null $_action
     */
    public function execute_addons($_addons = null, $_controller = null, $_action = null){
        if(C('URL_CASE_INSENSITIVE')){
            $_addons = ucfirst(parse_name($_addons, 1));
            $_controller = parse_name($_controller,1);
        }
        $TMPL_PARSE_STRING = C('TMPL_PARSE_STRING');
        $TMPL_PARSE_STRING['__ADDONROOT__'] = __ROOT__ . "/Addons/{$_addons}";

        C('TMPL_PARSE_STRING', $TMPL_PARSE_STRING);

        if(!empty($_addons) && !empty($_controller) && !empty($_action)){
            if(check_addons($_addons)){
                A("Addons://{$_addons}/{$_controller}")->$_action();

            }else{
                $this->error('插件未安装或者被禁用');
            }
        } else {
            $this->error('没有指定插件名称，控制器或操作！');
        }
    }

    /**执行模块方法
     * @param null $_module
     * @param null $_controller
     * @param null $_action
     */
    public function execute_module($_module = null, $_controller = null, $_action = null){
        if(C('URL_CASE_INSENSITIVE')){
            $_module = ucfirst(parse_name($_module, 1));
            $_controller = parse_name($_controller,1);
        }
        $TMPL_PARSE_STRING = C('TMPL_PARSE_STRING');
        $TMPL_PARSE_STRING['__MODULEROOT__'] = __ROOT__ . "/Module/{$_module}";

        C('TMPL_PARSE_STRING', $TMPL_PARSE_STRING);

        if(!empty($_module) && !empty($_controller) && !empty($_action)){
            $file   = JDICMS_MOUDLE_PATH.$_module.'/Common/function.php'; //自动加载模块函数裤

            if(is_file($file)) include $file;
            define("__CURRENT_MODULE__",$_module);
            define("__CURRENT_CONTROLLER__",$_controller);
            define("__CURRENT_ACTION__",$_action);
            $class = A("Modules://{$_module}/{$_controller}");
            if($class){
                $class->$_action();
            }else{
                $this->error('访问地址不存在!');
            }
        } else {
            $this->error('没有指定模块名称，控制器或操作！');
        }

    }
}