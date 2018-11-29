<?php
namespace Home\Controller;


use Think\Controller;

class BaseController extends Controller
{
    public $keywords = array(
        '不得转载', '责任编辑', '本文来源','原标题', '原文链接', '作者', '版权声明', '特别声明',
        '公众号', '一点号', '微信号', '头条号', '微信平台', '蓝字', '搜狐知道', '新浪女性',
        '加威信', '加微心', '关注我们', '关注我',
    );

    public function strlt100($content) {
        if (mb_strlen(strip_tags($content)) < 100) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 格式化标签
     * @param string $content
     * @return string
     */
    public function format($content) {
        $content = str_replace(array("\r", "\n", "\t"), '', $content);
        $content = str_replace(array('<strong>', '</strong>', '<html>','<body>','</html>','</body>'), '', $content);
        $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);
        $content = preg_replace('/<video[\s\S]*?<\/video>/', '', $content);
        $content = preg_replace('/<(div)[^<>]*?display:\s*none[^<>]*?>[\s\S]*?<\/\1>/i', '', $content);

        $content = preg_replace('/<(p|span)[^>]*?>(\s|<br>)*<\/\1>/', '', $content);
        $content = preg_replace('/\s??(style|class|id)="[^"]*?"/', '', $content);

        $content = preg_replace('/(<\/?)h\d{1}[\s\S]*?(>)/i', '$1p$2', $content);
        // $content = preg_replace('/href="[\s\S]*?"/', 'href="javascript:void(0);"', $content);
        $content = preg_replace('/<a[^>]*?href=[^>]*?>([\s\S]*?)<\/a>/', '$1', $content);
        $content = preg_replace('/(<img)[\s\S]*?(src="[\s\S]*?")[\s\S]*?(>)/', '$1 $2$3', $content);
        return trim($content);
    }

    /**
     * 查找关键字过滤
     * @param string $content
     * @param array $appends 追加
     * @return string
     */
    public function finder($content, $appends = array()) {
        $patterns = $this->keywords;
        $patterns = array_merge($patterns, $appends);
        return preg_replace_callback('/<p[\s\S]*?>([\s\S]*?)<\/p>/', function ($matches) use($patterns) {
            foreach ($patterns as $pattern) {
                if (preg_match('/'.$pattern.'/', $matches[1])) {
                    return '';
                }
                else if (! trim($matches[1])) {
                    return '';
                }
            }
            return '<p>'.trim($matches[1]).'</p>';
        }, $content);
    }
}