<?php
namespace Home\Controller;

use Think\Controller;
use Think\Crypt;

Vendor('phpQuery.phpQuery');

class IndexController extends Controller {
    public function index(){
        // TODO Common 目录怎么使用
        echo test();die;
        $key = '123456';
        $str = '[{"url":"http://www.baidu12341234132413241234.com"},{"url":"http://www.baidu12341234132413241234.com"}]';
        $cr = Crypt::encrypt($str, $key);
        echo strlen($cr);die;
        echo $cr;die;
        $date = new \Org\Util\Date();
        print_r($date);die;
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function sohu() {
        import("Org.Util.PHPQuery");
        $html = file_get_contents('https://m.sohu.com/a/216335910_660408/?pvid=000115_3w_a');
        $doc = \phpQuery::newDocumentHTML($html);
        // $h2 = $doc->find('h2[class="title-info"]')->text();

        // $content1 = $doc->find('div[class="display-content"]')->html();
        // $content2 = $doc->find('div[class="hidden-content hide"]')->html();
        // $content2 = $doc->find('section[id="articleContent"]')->remove('div[class="hidden-content"]')->html();
        $lookallbox = $doc->find('div[class="lookall-box"]')->html();
        $content2 = $doc->find('section[id="articleContent"]')->remove('div[class="lookall-box"]')->html();
        // $content2 = str_replace($lookallbox, '', $content2);
        print_r($content2);
    }

    public function sh() {

        $doc = \phpQuery::newDocumentFile('http://edu.zynews.cn/e/wap/');
        $t = $doc->html();
        $t = mb_convert_encoding($t,'ISO-8859-1','utf-8');
        $t = mb_convert_encoding($t,'utf-8','GBK');
        echo $t;die;

        // $html = file_get_contents('https://m.sohu.com/a/216335910_660408/?pvid=000115_3w_a');
        // $doc = \phpQuery::newDocumentHTML($html);
        $doc = \phpQuery::newDocumentFile('https://m.sohu.com/a/216335910_660408/?pvid=000115_3w_a');
        // $h2 = pq('h2[class="title-info"]')->text();

        $content = $doc->find('#articleContent');
        $content->find('.lookall-box')->remove();
        $content->find('.article-tags')->remove();
        // $content->find('.statement')->remove();
        $content = $content->html();
        print_r($content);die;
    }
}