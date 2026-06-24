<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
    @php
        $htmlContent = '';
        if (!empty($content['text'])) {
            $htmlContent = is_string($content['text']) ? $content['text'] : ($content['text'][locale()] ?? $content['text']['en'] ?? '');
        } elseif (!empty($content['content'])) {
            $htmlContent = is_string($content['content']) ? $content['content'] : ($content['content'][locale()] ?? $content['content']['en'] ?? '');
        }
        if ($htmlContent) {
            $htmlContent = str_replace('/banli_theme-assets/aivent//banli_theme-assets/aivent/', '/banli_theme-assets/aivent/', $htmlContent);
            $htmlContent = preg_replace('/\\b(src|href)=\"images\\//i', '$1=\"/banli_theme-assets/aivent/images/', $htmlContent);
            $htmlContent = preg_replace("/\\b(src|href)='images\\//i", '$1=\'/banli_theme-assets/aivent/images/', $htmlContent);
            $htmlContent = preg_replace("/url\\((\"|')?images\\//i", 'url($1/banli_theme-assets/aivent/images/', $htmlContent);
            $htmlContent = preg_replace('/data-bgimage=\"url\\(images\\//i', 'data-bgimage=\"url(/banli_theme-assets/aivent/images/', $htmlContent);
            $htmlContent = preg_replace("/data-bgimage='url\\(images\\//i", 'data-bgimage=\'url(/banli_theme-assets/aivent/images/', $htmlContent);
        }
    @endphp

    @if($htmlContent)
        {!! $htmlContent !!}
    @else
        <section id="section-faq" class="bg-dark section-dark text-light" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">{{ __('BanliTheme::common.featured_products') }}</div>
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">{{ __('common.text_hint') }}</h2>
                    </div>

                    <div class="col-lg-7">
                        <div class="accordion s2 wow fadeInUp">
                            <div class="accordion-section">
                                <div class="accordion-section-title" data-tab="#accordion-a1">
                                    {{ __('BanliTheme::common.rich_text_default_question') }}
                                </div>
                                <div class="accordion-section-content" id="accordion-a1">
                                    {{ __('BanliTheme::common.rich_text_default_answer') }}
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
