<?php

namespace Plugin\BanliTheme;

use Illuminate\Support\Facades\View;

class Bootstrap
{
    private const HOME_MODULE_ORDER = [
        'banli_hero_demo_1' => 10,
        'banli_hero_demo_2' => 10,
        'banli_hero_demo_3' => 10,
        'banli_hero_demo_4' => 10,
        'banli_hero_demo_5' => 10,
        'slideshow' => 10,
        'icons' => 20,
        'tab_product' => 30,
        'img_text_slideshow_2' => 40,
        'product' => 50,
        'brand' => 60,
        'img_text_banner' => 70,
        'img_text_banner_multiple' => 80,
        'page' => 90,
    ];

    private const LEGACY_HOME_MODULE_SEQUENCE = [
        'banli_hero_demo_1',
        'img_text_slideshow_2',
        'icons',
        'tab_product',
        'img_text_banner_multiple',
        'product',
        'img_text_banner',
        'brand',
        'page',
    ];

    private const DESIGN_EDITOR_ORDER = [
        'editor-banli_hero' => 10,
        'editor-icons' => 20,
        'editor-tab_product' => 30,
        'editor-product' => 40,
        'editor-img_text_slideshow2' => 50,
        'editor-img_text_banner' => 60,
        'editor-img_text_banner_multiple' => 70,
        'editor-brand' => 80,
        'editor-page' => 90,
        'editor-rich_text' => 100,
        'editor-slide_show' => 110,
        'editor-img_text_slideshow' => 120,
        'editor-image100' => 130,
        'editor-image200' => 140,
        'editor-image300' => 150,
        'editor-image301' => 160,
        'editor-image400' => 170,
        'editor-image401' => 180,
        'editor-image402' => 190,
        'editor-image403' => 200,
    ];

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
            $data['editors'] = $this->sortDesignEditors($data['editors']);

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
            $code = $content['module_code'] ?? '';
            if ($this->isBanliHeroCode($code)) {
                $content = $this->normalizeHeroContent($content, $code);
            } elseif ($code) {
                $content = $this->normalizeLegacyDesignModuleContent($code, $content);
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
                $module['content'] = $this->normalizeLegacyDesignModuleContent($code, $module['content'] ?? []);
                $settings['modules'][$index] = $module;
                continue;
            }

            $module['code'] = $code;
            $module['name'] = $this->heroNameFromCode($code);
            $module['view_path'] = 'design.banli_hero';
            $module['content'] = $this->normalizeHeroContent($module['content'] ?? [], $code);

            $settings['modules'][$index] = $module;
        }

        if ($this->isLegacyDefaultHomeModuleSequence($settings['modules'])) {
            $settings['modules'] = $this->sortHomeModules($settings['modules']);
        }

        return $settings;
    }

    private function sortDesignEditors(array $editors): array
    {
        $indexed = [];
        foreach (array_values($editors) as $index => $editor) {
            $indexed[] = [
                'editor' => $editor,
                'index' => $index,
                'priority' => self::DESIGN_EDITOR_ORDER[$editor] ?? 1000,
            ];
        }

        usort($indexed, function ($a, $b) {
            if ($a['priority'] === $b['priority']) {
                return $a['index'] <=> $b['index'];
            }

            return $a['priority'] <=> $b['priority'];
        });

        return array_column($indexed, 'editor');
    }

    private function sortHomeModules(array $modules): array
    {
        $indexed = [];
        foreach (array_values($modules) as $index => $module) {
            $indexed[] = [
                'module' => $module,
                'index' => $index,
                'priority' => $this->homeModulePriority($module),
            ];
        }

        usort($indexed, function ($a, $b) {
            if ($a['priority'] === $b['priority']) {
                return $a['index'] <=> $b['index'];
            }

            return $a['priority'] <=> $b['priority'];
        });

        return array_column($indexed, 'module');
    }

    private function isLegacyDefaultHomeModuleSequence(array $modules): bool
    {
        $codes = array_map(function ($module) {
            return $module['code'] ?? '';
        }, array_values($modules));

        return $codes === self::LEGACY_HOME_MODULE_SEQUENCE;
    }

    private function homeModulePriority(array $module): int
    {
        $code = $module['code'] ?? '';

        return self::HOME_MODULE_ORDER[$code] ?? 1000;
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
        $defaults = $this->heroDefaults($style);
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
        $content['btn1_link'] = $this->normalizeHeroLink($content['btn1_link'] ?? '#latest-products');
        $content['btn2_link'] = $this->normalizeHeroLink($content['btn2_link'] ?? '#top-collections');
        $content['slider_images'] = $content['slider_images'] ?? [];
        $content = $this->normalizeLegacyHeroCopy($content, $defaults);

        return $content;
    }

    private function heroDefaults(string $style): array
    {
        $defaults = [
            'demo_1' => [
                'title' => 'Banli Future Store',
                'sub_title' => 'Next Commerce Experience',
                'description' => 'Curated drops, flexible modules, and immersive motion for a storefront that feels current on every screen.',
                'date' => 'New Season 2026',
                'location' => 'Global Online Store',
                'btn1_text' => 'Shop Now',
                'btn1_link' => '#latest-products',
                'btn2_text' => 'View Collection',
                'btn2_link' => '#top-collections',
                'countdown_title' => 'Limited Drop',
                'countdown_sub_title' => 'New Arrivals Live',
                'countdown_address' => "Banli Studio,\nGlobal Online",
            ],
            'demo_2' => [
                'title' => 'Curated essentials for modern living.',
                'sub_title' => 'New Season Collection',
                'description' => 'Explore new arrivals, standout pieces, and a shopping experience tuned for every screen.',
                'location' => 'Online Store',
            ],
            'demo_3' => [
                'title' => 'Fresh',
                'sub_title' => 'Arrivals',
                'description' => 'A focused edit of products, stories, and seasonal picks ready for your next order.',
                'location' => 'Online Store',
            ],
            'demo_4' => [
                'title' => 'Discover the season\'s featured collection',
                'sub_title' => 'Featured Collection',
                'description' => 'Bring the latest products, offers, and brand moments into a storefront that feels polished from first view to checkout.',
                'location' => 'Online Store',
            ],
            'demo_5' => [
                'title' => 'Drop. Style. Repeat.',
                'sub_title' => 'Limited Collection',
                'description' => 'A focused release of fresh picks and member offers, built for quick browsing and confident checkout.',
                'location' => 'Online Store',
                'btn1_text' => 'Shop Now',
                'btn1_link' => '#latest-products',
                'btn2_text' => 'View Collection',
                'btn2_link' => '#top-collections',
                'countdown_title' => 'Limited Drop',
                'countdown_sub_title' => 'New Arrivals Live',
                'countdown_address' => "Banli Studio,\nGlobal Online",
            ],
        ];

        return $defaults[$style] ?? $defaults['demo_1'];
    }

    private function normalizeLegacyHeroCopy(array $content, array $defaults): array
    {
        $rules = [
            'title' => ['AI Summit 2026', 'The Future Intelligent'],
            'sub_title' => ['The Future of Intelligence'],
            'date' => ['October 1-5, 2026', 'October 1–5, 2026'],
            'location' => ['San Francisco, CA'],
            'btn1_text' => ['Get Tickets'],
            'btn2_text' => ['View Schedule'],
            'countdown_title' => ['Hurry Up!'],
            'countdown_sub_title' => ['Book Your Seat Now'],
            'countdown_address' => ['121 AI Blvd'],
        ];

        foreach ($rules as $field => $legacyValues) {
            if (! array_key_exists($field, $defaults)) {
                continue;
            }

            if (! array_key_exists($field, $content) || $this->matchesLegacyText($content[$field], $legacyValues)) {
                $content[$field] = $this->localizedDefault($defaults[$field]);
            }
        }

        if ($this->matchesLegacyLink($content['btn1_link'] ?? null)) {
            $content['btn1_link'] = $this->normalizeHeroLink($defaults['btn1_link'] ?? '#latest-products');
        }

        if ($this->matchesLegacyLink($content['btn2_link'] ?? null)) {
            $content['btn2_link'] = $this->normalizeHeroLink($defaults['btn2_link'] ?? '#top-collections');
        }

        return $content;
    }

    private function localizedDefault(string $value): array
    {
        return [
            'zh_cn' => $value,
            'en' => $value,
        ];
    }

    private function matchesLegacyText($value, array $legacyValues): bool
    {
        $values = is_array($value) ? array_filter($value, 'is_scalar') : [$value];

        foreach ($values as $text) {
            $normalized = $this->normalizeHeroText((string) $text);

            foreach ($legacyValues as $legacyValue) {
                $legacyNormalized = $this->normalizeHeroText($legacyValue);
                if ($normalized === $legacyNormalized || str_contains($normalized, $legacyNormalized)) {
                    return true;
                }
            }
        }

        return false;
    }

    private function matchesLegacyLink($link): bool
    {
        if (is_array($link)) {
            $link = $link['link'] ?? $link['value'] ?? '';
        }

        $link = strtolower(trim((string) $link));

        return in_array($link, ['tickets.html', '#section-tickets', '#section-schedule'], true);
    }

    private function normalizeHeroText(string $value): string
    {
        $value = str_replace(['–', '—'], '-', $value);
        $value = preg_replace('/\s+/', ' ', trim($value));

        return strtolower($value);
    }

    private function normalizeLegacyDesignModuleContent(string $code, array $content): array
    {
        if (! $this->containsLegacyEventCopy($content)) {
            return $content;
        }

        if ($code === 'img_text_banner') {
            return array_replace($content, [
                'title' => $this->localizedDefault('Curated Products for Modern Stores'),
                'sub_title' => $this->localizedDefault('[ About the Brand ]'),
                'description' => $this->localizedDefault('Use this section to introduce your product selection, service promise, or independent brand story.'),
            ]);
        }

        if ($code === 'rich_text') {
            $content['text'] = $this->localizedDefault($this->legacyRichTextReplacement($content));
            unset($content['content']);

            return $content;
        }

        if ($code === 'img_text_banner_multiple') {
            unset($content['description']);
            $content['title'] = $this->localizedDefault('Why Customers Choose Us');
            $content['sub_title'] = $this->localizedDefault('Brand Advantages');

            return $content;
        }

        if ($code === 'tab_product') {
            unset($content['images']);
            $content['title'] = $this->localizedDefault('Featured Products');
            $content['sub_title'] = $this->localizedDefault('Collection');

            return $content;
        }

        return $content;
    }

    private function legacyRichTextReplacement(array $content): string
    {
        $text = implode("\n", $this->flattenStrings($content));

        if (str_contains($text, 'section-schedule')) {
            return <<<'HTML'
<section id="section-service-flow" class="bg-dark section-dark text-light">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <div class="col-lg-6 text-center">
        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Service Flow</div>
        <h2 class="wow fadeInUp" data-wow-delay=".2s">From Browsing to Delivery</h2>
        <p class="lead wow fadeInUp" data-wow-delay=".4s">Use this section to explain shopping steps, service milestones, or brand processes.</p>
      </div>
    </div>
    <div class="row g-4 mt-3">
      <div class="col-md-4">
        <div class="bg-dark-2 rounded-1 p-4 h-100">
          <h4>Discover</h4>
          <p class="mb-0 text-white-50">Feature new arrivals, product stories, and curated collections.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="bg-dark-2 rounded-1 p-4 h-100">
          <h4>Order</h4>
          <p class="mb-0 text-white-50">Guide customers through secure checkout and clear order confirmation.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="bg-dark-2 rounded-1 p-4 h-100">
          <h4>Support</h4>
          <p class="mb-0 text-white-50">Show delivery updates, after-sales care, and service commitments.</p>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;
        }

        if (str_contains($text, 'section-venue') || str_contains($text, '121 AI Blvd')) {
            return <<<'HTML'
<section id="section-store-info" class="bg-dark section-dark text-light pt-80 relative">
  <div class="container relative z-2">
    <div class="row g-4 justify-content-center">
      <div class="col-lg-6 text-center">
        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Store Information</div>
        <h2 class="wow fadeInUp" data-wow-delay=".2s">Visit & Contact</h2>
        <p class="lead wow fadeInUp" data-wow-delay=".6s">Use this section for showroom details, service contacts, or brand location information.</p>
      </div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="bg-dark-2 rounded-1 p-4 wow fadeInUp">
          <h4 class="mb-2">Store Contact</h4>
          <p class="mb-0 text-white-50">Configure address, phone, or email in store settings.</p>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;
        }

        return <<<'HTML'
<section id="section-faq" class="bg-dark section-dark text-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5">
        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Customer Help</div>
        <h2 class="wow fadeInUp" data-wow-delay=".2s">Frequently Asked Questions</h2>
      </div>
      <div class="col-lg-7">
        <div class="accordion s2 wow fadeInUp">
          <div class="accordion-section">
            <div class="accordion-section-title" data-tab="#accordion-a1">How do I edit this section?</div>
            <div class="accordion-section-content" id="accordion-a1">Open the design builder and replace this placeholder with store content, product notes, or customer information.</div>
            <div class="accordion-section-title" data-tab="#accordion-a2">What should this area contain?</div>
            <div class="accordion-section-content" id="accordion-a2">Use it for shipping, returns, product care, warranty, service process, or brand FAQs.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;
    }

    private function containsLegacyEventCopy($value): bool
    {
        $needles = [
            'AI Summit',
            'AI Innovators',
            'artificial intelligence',
            'The Future of Intelligence',
            'Get Tickets',
            'View Schedule',
            'Ticket Options',
            'Choose Your Pass',
            'section-schedule',
            '121 AI Blvd',
            'San Francisco Tech Pavilion',
            'contact@aivent.com',
            'What ticket options are available',
            'Virtual Ticket',
            'Full Access Pass',
        ];

        foreach ($this->flattenStrings($value) as $text) {
            foreach ($needles as $needle) {
                if (stripos($text, $needle) !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    private function flattenStrings($value): array
    {
        if (is_string($value)) {
            return [$value];
        }

        if (! is_array($value)) {
            return [];
        }

        $strings = [];
        foreach ($value as $item) {
            array_push($strings, ...$this->flattenStrings($item));
        }

        return $strings;
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
