<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
        <section id="section-venue" class="bg-dark section-dark text-light pt-80 relative jarallax" aria-label="section" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
          <div class="container relative z-2">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Event Location</div>
                    
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Location & Venue</h2>
                    <p class="lead wow fadeInUp" data-wow-delay=".6s">Join us in the heart of innovation at San Francisco Tech Pavilion—surrounded by top hotels, transit, and culture.</p>
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

                <div class="col-lg-4 col-md-6 mb-sm-30">
                    <div class="d-flex justify-content-center wow fadeInUp" data-wow-delay=".2s">
                        <i class="fs-60 id-color icofont-google-map"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">Address</h4>
                            <p>121 AI Blvd, San Francisco, CA 94107</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-sm-30">
                    <div class="d-flex justify-content-center wow fadeInUp" data-wow-delay=".4s">
                        <i class="fs-60 id-color icofont-phone"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">Phone</h4>
                            <p>Call: +1 123 456 789</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-sm-30">
                    <div class="d-flex justify-content-center wow fadeInUp" data-wow-delay=".6s">
                        <i class="fs-60 id-color icofont-envelope"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">Email</h4>
                            <p>contact@cyber.com</p>
                        </div>
                    </div>
                </div>
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
