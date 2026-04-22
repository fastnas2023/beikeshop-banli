@php
    $hero = isset($content['images'][0]) ? $content['images'][0] : [];
    $bgImage = isset($hero['image']) ? (is_array($hero['image']) ? ($hero['image']['src'][locale()] ?? $hero['image']['src'] ?? '') : $hero['image']) : '';
    $videoRaw = !empty($hero['video']) ? (is_array($hero['video']) ? ($hero['video']['src'][locale()] ?? $hero['video']['src'] ?? '') : $hero['video']) : '';
    $videoSrc = !empty($videoRaw) ? (filter_var($videoRaw, FILTER_VALIDATE_URL) ? $videoRaw : asset($videoRaw)) : asset('image/catalog/banli_theme/cyber-bg-2.mp4');
    $i18n = function ($val, $default = '') {
        if (is_array($val)) {
            return $val[locale()] ?? (count($val) ? (reset($val) ?: $default) : $default);
        }

        return $val ?: $default;
    };

    $title = $i18n($hero['title'] ?? null, 'AI Summit 2026');
    $subTitle = $i18n($hero['sub_title'] ?? null, 'The Future of Intelligence');
    $date = $i18n($hero['date'] ?? null, 'October 1–5, 2026');
    $location = $i18n($hero['location'] ?? null, 'San Francisco, CA');
    $btn1Text = $i18n($hero['btn1_text'] ?? null, 'Get Tickets');
    $btn2Text = $i18n($hero['btn2_text'] ?? null, 'View Schedule');
    $btn2Link = $hero['btn2_link'] ?? '#section-schedule';
    $linkUrl = isset($hero['link']) ? (is_array($hero['link']) ? ($hero['link']['link'] ?? $hero['link']['value'] ?? '#section-tickets') : $hero['link']) : '#section-tickets';
    $countdownTitle = $i18n($hero['countdown_title'] ?? null, 'Hurry Up!');
    $countdownSubTitle = $i18n($hero['countdown_sub_title'] ?? null, 'Book Your Seat Now');
    $countdownDate = $hero['countdown_date'] ?? '2026-10-01 08:00:00';
    $countdownAddress = $i18n($hero['countdown_address'] ?? null, "121 AI Blvd,\nSan Francisco BCA 94107");
@endphp
<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
<section id="section-hero" class="section-dark no-top no-bottom text-light jarallax relative mh-800" data-jarallax-video="mp4:{{ $videoSrc }}">
    <div class="gradient-edge-top op-6 h-50 color"></div>
    <div class="gradient-edge-bottom"></div>
    <div class="sw-overlay op-8"></div>
    <div class="abs abs-centered z-2 w-80">
        <div class="container wow scaleIn" data-wow-duration="3s">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="subtitle">{{ $subTitle }}</div>
                    <h1 class="fs-120 text-uppercase fs-sm-12vw mb-4 lh-1">{{ $title }}</h1>

                    <div class="d-block d-md-flex justify-content-center">
                        <div class="d-flex justify-content-center align-items-center mx-4">
                            <i class="bi bi-calendar text-gradient me-3 fs-4"></i>
                            <h4 class="mb-0">{{ $date }}</h4>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mx-4">
                            <i class="bi bi-geo-alt text-gradient me-3 fs-4"></i>
                            <h4 class="mb-0">{{ $location }}</h4>
                        </div>
                    </div>

                    <div class="spacer-single"></div>

                    @if($btn1Text)
                    <a class="btn-main mx-2 fx-slide" href="{{ $linkUrl }}"><span>{{ $btn1Text }}</span></a>
                    @endif
                    @if($btn2Text)
                    <a class="btn-main btn-line mx-2 fx-slide" href="{{ $btn2Link }}"><span>{{ $btn2Text }}</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="abs w-100 start-0 bottom-0 z-3">
        <div class="container">
            <div class="sm-hide border-white-op-3 p-40 py-4 rounded-1 bg-blur relative overflow-hidden wow fadeInUp">
                <div class="gradient-edge-bottom color start-0 h-50 op-5"></div>
                <div class="row g-4 justify-content-between align-items-center relative z-2">
                    <div class="col-lg-3">
                        <h2 class="mb-0">{{ $countdownTitle }}</h2>
                        <h4 class="mb-0">{{ $countdownSubTitle }}</h4>
                    </div>
                    <div class="col-lg-4">
                        <div id="defaultCountdown" class="pt-2" data-date="{{ $countdownDate }}"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <i class="fs-60 icofont-google-map id-color"></i>
                            <div class="ms-3">
                                <h4 class="mb-0">{!! nl2br(e($countdownAddress)) !!}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Background Video Fallback (If Jarallax fails) -->
    <video src="{{ $videoSrc }}" class="w-100 h-100 jarallax-video-fallback" style="object-fit: cover; opacity: 0.7; position: absolute; top: 0; left: 0; z-index: 0; pointer-events: none; display: none;" loop autoplay muted playsinline></video>
</section>
</div>
