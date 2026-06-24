@php
    $contactItems = collect([
        [
            'icon' => 'icofont-google-map',
            'title' => __('admin/builder.text_address'),
            'value' => system_setting('base.address', ''),
        ],
        [
            'icon' => 'icofont-phone',
            'title' => __('common.phone'),
            'value' => system_setting('base.telephone', ''),
        ],
        [
            'icon' => 'icofont-envelope',
            'title' => __('common.email'),
            'value' => system_setting('base.email', ''),
        ],
    ])->filter(fn ($item) => trim((string) $item['value']) !== '')->values();
@endphp

<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
        <section id="section-venue" class="bg-dark section-dark text-light pt-80 relative jarallax" aria-label="section" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
          <div class="container relative z-2">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Store Information</div>
                    
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Visit & Contact</h2>
                    <p class="lead wow fadeInUp" data-wow-delay=".6s">Use this section for showroom details, service contacts, or brand location information.</p>
                </div>
            </div>

            <div class="row g-4">
                @if(isset($content['images']) && count($content['images']) > 0)
                    @foreach(array_slice($content['images'], 0, 2) as $image)
                    @php
                        $imgSrc = is_array($image['image']) ? ($image['image']['src'][locale()] ?? $image['image']['src'] ?? '') : ($image['image'] ?? '');
                    @endphp
                    <div class="col-sm-6">
                        <img src="{{ $imgSrc ?: 'https://madebydesignesia.com/themes/cyber/images/misc/l1.webp' }}" class="w-100 rounded-1 wow scale-in-mask" alt="{{ $image['title'] ?? '' }}">
                    </div>
                    @endforeach
                @else
                <div class="col-sm-6">
                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/l1.webp" class="w-100 rounded-1 wow scale-in-mask" alt="">
                </div>

                <div class="col-sm-6">
                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/l2.webp" class="w-100 rounded-1 wow scale-in-mask" alt="">
                </div>
                @endif

                <div class="clearfix"></div>

                @forelse($contactItems as $item)
                <div class="col-lg-4 col-md-6 mb-sm-30">
                    <div class="d-flex justify-content-center wow fadeInUp" data-wow-delay=".2s">
                        <i class="fs-60 id-color {{ $item['icon'] }}"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $item['title'] }}</h4>
                            <p>{!! nl2br(e($item['value'])) !!}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-8 text-center">
                    <div class="bg-dark-2 rounded-1 p-4 wow fadeInUp">
                        <h4 class="mb-2">Store Contact</h4>
                        <p class="mb-0 text-white-50">Configure address, phone, or email in store settings.</p>
                    </div>
                </div>
                @endforelse
            </div>

          </div>
        </section>

        @if(!empty($content['scroll_text']['text']))
        @php
            $scrollText = is_array($content['scroll_text']['text']) ? $content['scroll_text']['text'][locale()] ?? '' : $content['scroll_text']['text'];
            $words = array_filter(array_map('trim', explode('/', $scrollText)));
            if(count($words) < 4) {
                $words = array_merge($words, $words, $words, $words);
            }
        @endphp
        <section class="section-dark p-0" aria-label="section" style="overflow: hidden; padding-top: 30px; padding-bottom: 30px;">
            <div class="bg-color text-light d-flex py-4 lh-1 rot-2 relative z-2" style="width: 250vw; margin-left: -75vw; white-space: nowrap;">
                <div class="de-marquee-list-1 wow fadeInLeft" data-wow-duration="3s">
                    @foreach($words as $word)
                    <span class="fs-60 mx-3">{{ $word }}</span>
                    <span class="fs-60 mx-3 op-2">/</span>
                    @endforeach
                    @foreach($words as $word)
                    <span class="fs-60 mx-3">{{ $word }}</span>
                    <span class="fs-60 mx-3 op-2">/</span>
                    @endforeach
                </div>
            </div>

            <div class="bg-color-2 text-light d-flex py-4 lh-1 rot-min-1 mt-min-20 relative z-1" style="width: 250vw; margin-left: -75vw; white-space: nowrap;">
                <div class="de-marquee-list-2 wow fadeInRight" data-wow-duration="3s">
                    @foreach(array_reverse($words) as $word)
                    <span class="fs-60 mx-3">{{ $word }}</span>
                    <span class="fs-60 mx-3 op-2">/</span>
                    @endforeach
                    @foreach(array_reverse($words) as $word)
                    <span class="fs-60 mx-3">{{ $word }}</span>
                    <span class="fs-60 mx-3 op-2">/</span>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
</div>
