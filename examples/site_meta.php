<?php
/**
 * SiteMeta - 站点元信息管理模块
 * 
 * 功能：
 * - 使用关联数组存储站点基础元信息
 * - 提供生成简短描述文本的静态方法
 * - 支持获取单条元数据或完整描述
 */
class SiteMeta
{
    /**
     * 站点元信息数组
     * 包含：站点名称、核心关键词、版权年份、备案号、站点简介
     * 
     * @var array
     */
    private static $meta = [
        'site_name'    => '华体会官方入口',
        'keywords'     => ['华体会', '体育', '娱乐', '在线平台'],
        'description'  => '华体会提供丰富体育赛事和娱乐项目，让用户享受极致在线体验。',
        'base_url'     => 'https://web-app-hth.com.cn',
        'year'         => '2025',
        'icp'          => '沪ICP备2025XXXXXX号',
        'author'       => 'HTH Tech Team',
    ];

    /**
     * 获取指定的元信息值
     *
     * @param string $key 元信息键名
     * @return string|null 如果键存在则返回对应值，否则返回 null
     */
    public static function get($key)
    {
        return isset(self::$meta[$key]) ? self::$meta[$key] : null;
    }

    /**
     * 生成简短的站点描述文本
     * 格式：站点名称 - 核心关键词 | 描述
     *
     * @return string 生成的描述文本
     */
    public static function generateShortDescription()
    {
        $name = htmlspecialchars(self::$meta['site_name'], ENT_QUOTES, 'UTF-8');
        $keywords = implode('、', array_map(function($kw) {
            return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
        }, self::$meta['keywords']));
        $desc = htmlspecialchars(self::$meta['description'], ENT_QUOTES, 'UTF-8');

        return "{$name} - {$keywords} | {$desc}";
    }

    /**
     * 生成包含链接和版权的简短页脚文本
     *
     * @return string 页脚描述
     */
    public static function generateFooterText()
    {
        $name = htmlspecialchars(self::$meta['site_name'], ENT_QUOTES, 'UTF-8');
        $url  = htmlspecialchars(self::$meta['base_url'], ENT_QUOTES, 'UTF-8');
        $year = htmlspecialchars(self::$meta['year'], ENT_QUOTES, 'UTF-8');
        $icp  = htmlspecialchars(self::$meta['icp'], ENT_QUOTES, 'UTF-8');

        return "© {$year} {$name} | <a href=\"{$url}\">{$url}</a> | {$icp}";
    }

    /**
     * 生成 SEO 友好的元标签 HTML 片段
     *
     * @return string
     */
    public static function generateMetaTags()
    {
        $name = htmlspecialchars(self::$meta['site_name'], ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(self::$meta['description'], ENT_QUOTES, 'UTF-8');
        $keywords = htmlspecialchars(
            implode(', ', self::$meta['keywords']),
            ENT_QUOTES,
            'UTF-8'
        );
        $url  = htmlspecialchars(self::$meta['base_url'], ENT_QUOTES, 'UTF-8');

        $tags = [];
        $tags[] = '<meta name="description" content="' . $desc . '" />';
        $tags[] = '<meta name="keywords" content="' . $keywords . '" />';
        $tags[] = '<meta property="og:title" content="' . $name . '" />';
        $tags[] = '<meta property="og:description" content="' . $desc . '" />';
        $tags[] = '<meta property="og:url" content="' . $url . '" />';
        $tags[] = '<link rel="canonical" href="' . $url . '" />';

        return implode("\n    ", $tags);
    }

    /**
     * 更新或新增元信息（用于动态配置）
     *
     * @param string $key   键名
     * @param mixed  $value 值
     * @return void
     */
    public static function set($key, $value)
    {
        self::$meta[$key] = $value;
    }

    /**
     * 获取所有元信息（用于调试或批量输出）
     *
     * @return array
     */
    public static function getAll()
    {
        return self::$meta;
    }
}

// --- 使用示例 ---
// 获取站点名称
$siteName = SiteMeta::get('site_name');
echo "站点名称: " . htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') . "\n";

// 生成简短描述
echo "简短描述: " . SiteMeta::generateShortDescription() . "\n";

// 生成页脚 HTML（注意：示例中直接输出，实际应放入 HTML 上下文中）
echo "页脚 HTML: " . SiteMeta::generateFooterText() . "\n";

// 生成 SEO 元标签
echo "SEO 元标签:\n" . SiteMeta::generateMetaTags() . "\n";

// 动态修改元信息示例
SiteMeta::set('description', '华体会致力于打造顶级在线体育娱乐平台。');
echo "更新后描述: " . SiteMeta::generateShortDescription() . "\n";

// 输出所有元信息
print_r(SiteMeta::getAll());
?>