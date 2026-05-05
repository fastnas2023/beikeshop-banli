<?php

namespace Plugin\BanliTheme;

use Illuminate\Support\Facades\View;

class Bootstrap
{
    public function boot()
    {
        // 注册主题专属的 hook 或视图路径
        $pluginViewPath = base_path('plugins/BanliTheme/Views');
        app('view')->getFinder()->prependLocation($pluginViewPath);
        app('view')->prependNamespace('admin', $pluginViewPath . '/admin');

        add_hook_filter('admin.design.index.data', function ($data) {
            $data['editors'] = $data['editors'] ?? [];
            if (! in_array('editor-banli_hero', $data['editors'], true)) {
                array_unshift($data['editors'], 'editor-banli_hero');
            }

            if (isset($data['design_settings'])) {
                $data['design_settings'] = $this->normalizeHeroModules($data['design_settings']);
            }

            return $data;
        });

        add_hook_filter('admin.design.preview.data', function ($data) {
            if ($this->isBanliHeroCode($data['code'] ?? '')) {
                $data['view_path'] = 'design.banli_hero';
            }

            return $data;
        });

        add_hook_filter('helpers.system_setting', function ($data) {
            if (($data['key'] ?? '') === 'base.design_setting') {
                $data['setting'] = $this->normalizeHeroModules($data['setting']);
            }

            return $data;
        });

        add_hook_action('admin.design.update.after', function ($moduleData) {
            $normalized = $this->normalizeHeroModules($moduleData);
            if ($normalized !== $moduleData) {
                \Beike\Repositories\SettingRepo::storeValue('design_setting', $normalized);
            }
        });

        add_hook_filter('service.design.module.content', function ($content) {
            if ($this->isBanliHeroCode($content['module_code'] ?? '')) {
                $content = $this->normalizeHeroContent($content, $content['module_code']);
            }

            return $content;
        });
    }

    private function normalizeHeroModules($settings)
    {
        if (! is_array($settings) || empty($settings['modules']) || ! is_array($settings['modules'])) {
            return $settings;
        }

        foreach ($settings['modules'] as $index => $module) {
            $code = $module['code'] ?? '';

            if ($this->isLegacySlideshowHero($module)) {
                $code = 'banli_hero_demo_1';
                $module['content'] = $this->slideshowHeroToBanliHero($module['content'] ?? []);
            } elseif ($code === 'aivent_hero' || $code === 'banli_hero') {
                $style = $module['content']['hero_style'] ?? 'demo_1';
                $code = $this->heroCodeFromStyle($style);
            } elseif (! $this->isBanliHeroCode($code)) {
                continue;
            }

            $module['code'] = $code;
            $module['name'] = $this->heroNameFromCode($code);
            $module['view_path'] = 'design.banli_hero';
            $module['content'] = $this->normalizeHeroContent($module['content'] ?? [], $code);

            $settings['modules'][$index] = $module;
        }

        return $settings;
    }

    private function isBanliHeroCode(string $code): bool
    {
        return $code === 'aivent_hero'
            || $code === 'banli_hero'
            || preg_match('/^banli_hero_demo_[1-5]$/', $code) === 1;
    }

    private function heroCodeFromStyle(string $style): string
    {
        $style = preg_match('/^demo_[1-5]$/', $style) ? $style : 'demo_1';

        return 'banli_hero_' . $style;
    }

    private function heroStyleFromCode(string $code): string
    {
        if (preg_match('/^banli_hero_(demo_[1-5])$/', $code, $matches)) {
            return $matches[1];
        }

        return 'demo_1';
    }

    private function heroNameFromCode(string $code): string
    {
        switch ($this->heroStyleFromCode($code)) {
            case 'demo_2':
                return '板栗 Hero 02 · 居中标题轮播';
            case 'demo_3':
                return '板栗 Hero 03 · 大字分屏静态背景';
            case 'demo_4':
                return '板栗 Hero 04 · 左文案背景轮播';
            case 'demo_5':
                return '板栗 Hero 05 · 左标题右倒计时';
            default:
                return '板栗 Hero 01 · 视频背景倒计时';
        }
    }

    private function isLegacySlideshowHero(array $module): bool
    {
        if (($module['code'] ?? '') !== 'slideshow') {
            return false;
        }

        $first = $module['content']['images'][0] ?? [];

        return is_array($first)
            && (isset($first['title']) || isset($first['sub_title']) || isset($first['countdown_date']) || isset($first['video']));
    }

    private function slideshowHeroToBanliHero(array $content): array
    {
        $first = $content['images'][0] ?? [];

        if (! is_array($first)) {
            return $content;
        }

        return [
            'style' => $content['style'] ?? ['background_color' => ''],
            'floor' => $content['floor'] ?? ['zh_cn' => '', 'en' => ''],
            'module_size' => $content['module_size'] ?? 'w-100',
            'hero_style' => 'demo_1',
            'background_image' => [
                'src' => ['zh_cn' => '', 'en' => ''],
                'alt' => ['zh_cn' => '', 'en' => ''],
            ],
            'background_video' => $first['video'] ?? [
                'src' => ['zh_cn' => 'banli_theme-assets/aivent/video/2.mp4', 'en' => 'banli_theme-assets/aivent/video/2.mp4'],
                'alt' => ['zh_cn' => '', 'en' => ''],
            ],
            'title' => $first['title'] ?? ['zh_cn' => 'Banli Future Store', 'en' => 'Banli Future Store'],
            'sub_title' => $first['sub_title'] ?? ['zh_cn' => 'Next Commerce Experience', 'en' => 'Next Commerce Experience'],
            'description' => $first['description'] ?? ['zh_cn' => 'Curated drops, flexible modules, and immersive motion for a storefront that feels current on every screen.', 'en' => 'Curated drops, flexible modules, and immersive motion for a storefront that feels current on every screen.'],
            'date' => $first['date'] ?? ['zh_cn' => 'New Season 2026', 'en' => 'New Season 2026'],
            'location' => $first['location'] ?? ['zh_cn' => 'Global Online Store', 'en' => 'Global Online Store'],
            'btn1_text' => $first['btn1_text'] ?? ['zh_cn' => 'Shop Now', 'en' => 'Shop Now'],
            'btn1_link' => $first['link'] ?? ['type' => 'custom', 'value' => '#latest-products', 'link' => '#latest-products'],
            'btn2_text' => $first['btn2_text'] ?? ['zh_cn' => 'View Collection', 'en' => 'View Collection'],
            'btn2_link' => ['type' => 'custom', 'value' => $first['btn2_link'] ?? '#top-collections', 'link' => $first['btn2_link'] ?? '#top-collections'],
            'slider_images' => [],
            'countdown_title' => $first['countdown_title'] ?? ['zh_cn' => 'Limited Drop', 'en' => 'Limited Drop'],
            'countdown_sub_title' => $first['countdown_sub_title'] ?? ['zh_cn' => 'New Arrivals Live', 'en' => 'New Arrivals Live'],
            'countdown_date' => $first['countdown_date'] ?? '2026-10-01 08:00:00',
            'countdown_address' => $first['countdown_address'] ?? ['zh_cn' => "Banli Studio,\nGlobal Online", 'en' => "Banli Studio,\nGlobal Online"],
        ];
    }

    private function normalizeHeroContent(array $content, string $code): array
    {
        $style = $this->heroStyleFromCode($code);
        $content['hero_style'] = $style;
        $content['module_size'] = $content['module_size'] ?? 'w-100';
        $content['style'] = $content['style'] ?? ['background_color' => ''];
        $content['floor'] = $content['floor'] ?? ['zh_cn' => '', 'en' => ''];
        $content['background_image'] = $style === 'demo_1' ? [
            'src' => ['zh_cn' => '', 'en' => ''],
            'alt' => ['zh_cn' => '', 'en' => ''],
        ] : ($content['background_image'] ?? [
            'src' => ['zh_cn' => 'banli_theme-assets/aivent/images/background/5.webp', 'en' => 'banli_theme-assets/aivent/images/background/5.webp'],
            'alt' => ['zh_cn' => '', 'en' => ''],
        ]);
        $content['background_video'] = $content['background_video'] ?? [
            'src' => ['zh_cn' => $content['video_src'] ?? 'banli_theme-assets/aivent/video/2.mp4', 'en' => $content['video_src'] ?? 'banli_theme-assets/aivent/video/2.mp4'],
            'alt' => ['zh_cn' => '', 'en' => ''],
        ];
        $content['btn1_link'] = $this->normalizeHeroLink($content['btn1_link'] ?? ($style === 'demo_1' ? '#latest-products' : '#section-tickets'));
        $content['btn2_link'] = $this->normalizeHeroLink($content['btn2_link'] ?? ($style === 'demo_1' ? '#top-collections' : '#section-schedule'));
        $content['slider_images'] = $content['slider_images'] ?? [];

        return $content;
    }

    private function normalizeHeroLink($link): array
    {
        if (is_array($link)) {
            $link['type'] = $link['type'] ?? 'custom';
            $link['value'] = $link['value'] ?? ($link['link'] ?? '');
            $link['link'] = $link['link'] ?? ($link['type'] === 'custom' ? $link['value'] : '');

            return $link;
        }

        return [
            'type' => 'custom',
            'value' => (string) $link,
            'link' => (string) $link,
        ];
    }
}
