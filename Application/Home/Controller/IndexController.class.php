<?php
namespace Home\Controller;

use Think\Log;
use Think\Crypt;
use Think\Image;

Vendor('phpQuery.phpQuery');

class IndexController extends BaseController {

    public function add() {

    }
    public function index(){
        // TODO: Common 目录怎么使用
        // echo dpe();die;

        $h = file_get_contents('https://mbd.baidu.com/newspage/data/landingshare?context=%7B%22nid%22%3A%22news_9844321684069543017%22%2C%22sourceFrom%22%3A%22bjh%22%7D&type=news');
        echo $h;die;
        $img = "https://f12.baidu.com/it/?u=2674946297,2122048651&fm=173&app=49&f=JPEG?w=640&h=480&s=D77816C50C72ECD65A3FF8240300B058&access=215967316";
        $res = file_get_contents($img);
        var_dump($res);die;
        $im = new Image(2, $img);
        print_r($im);die;

        // 测试LOG
        Log::record('ID:5461313213', 'DEBUG');
        print_r($this->keywords);die;
        // 测试加密

        $key = '123456';
        $str = '[{"url":"http://www.baidu12341234132413241234.com"},{"url":"http://www.baidu12341234132413241234.com"}]';
        $cr = Crypt::encrypt($str, $key);
        echo $cr;die;
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function toutiao() {
        $arr = range(1, 1);
        foreach ($arr as $i) {
            $url = 'http://47.244.140.215:8091/feeds/toutiao?pageNo='.$i.'&num=20';
            $json = file_get_contents($url);
            $data = json_decode($json, true);
            foreach ($data['articles'] as $value) {
                $id = $value['newsId'];
                $title = $value['title'];
                $url = $value['real_url'];
                $content = $value['content'];
                if (json_decode($content, true)) {
                    continue;
                }

                $cate = $value['category'];
                echo $id . "<br>";
                echo $url . "<br>";
                $content = $this->format($content);
                $content = $this->finder($content);
                // Log::record('[url] ' . $url, 'DEBUG');
                // Log::record('[content] ' . $content, 'DEBUG');
                if ($this->strlt100($content)) {
                    continue;
                }
                echo $content . "<br>";
            }
        }
    }

}