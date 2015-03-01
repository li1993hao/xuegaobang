<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
class ToolController extends AdminController {
    /**
     * 获取关键词
     * @param string $title 标题
     * @param string $content 内容
     * @return string 图片URL
     */
    public function getKeyword($title, $content = '')
    {
        $data= \Org\Util\Http::doGet('http://keyword.discuz.com/related_kw.html?ics=utf-8&ocs=utf-8&title='.urlencode($title).'&content='.urlencode($content),10);
        if(empty($data)){
            return;
        }
        preg_match_all("/<kw>(.*)A\[(.*)\]\](.*)><\/kw>/",$data, $list, PREG_SET_ORDER);
        if(empty($list)){
            return;
        }
        $keywords = array();
        foreach ($list as $value) {
            $keywords[] = $value[2];
        }
        $ky = arr2str($keywords);
        if(empty($ky)){
            $this->J_J(0,'','获取关键词失败!');
        }else{
            $this->J_J(1,$ky,'获取关键词成功!');
        }
    }
}