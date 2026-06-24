<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
        <section id="section-offers" class="bg-dark section-dark text-light pt-80 relative jarallax" aria-label="section" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
            <img src="https://madebydesignesia.com/themes/cyber/images/background/7.webp" class="jarallax-img" alt="">
            <div class="gradient-edge-top"></div>
            <div class="gradient-edge-bottom"></div>
            <div class="sw-overlay op-7"></div>

            <div class="container relative z-2">
                <div class="row g-4 gx-5 justify-content-center">
                  <div class="col-lg-6 text-center">
                      @if(!empty($content['scroll_text']['text']))
                      @php
                          $scrollText = is_array($content['scroll_text']['text']) ? $content['scroll_text']['text'][locale()] ?? '' : $content['scroll_text']['text'];
                      @endphp
                      <div class="subtitle s2 mb-3 wow fadeInUp" data-wow-delay=".0s">{{ $scrollText }}</div>
                      @else
                      <div class="subtitle s2 mb-3 wow fadeInUp" data-wow-delay=".0s">Offer Options</div>
                      @endif
                      
                      <h2 class="wow fadeInUp" data-wow-delay=".2s">Choose Your Package</h2>
                      <p class="lead wow fadeInUp" data-wow-delay=".4s">Present featured bundles, service plans, or collection tiers for different customer needs.</p>
                  </div>
                </div>

                <div class="row g-4 justify-content-center">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-theme owl-3-dots wow mask-right">
                            @if(isset($content['images']) && count($content['images']) > 0)
                                @foreach ($content['images'] as $image)
                                @php
                                    $imgSrc = is_array($image['image']) ? ($image['image']['src'][locale()] ?? $image['image']['src'] ?? '') : ($image['image'] ?? '');
                                    $linkUrl = is_array($image['link'] ?? null) ? ($image['link']['link'] ?? $image['link']['value'] ?? 'javascript:void(0)') : ($image['link'] ?? 'javascript:void(0)');
                                    $title = is_array($image['title'] ?? '') ? ($image['title'][locale()] ?? '') : ($image['title'] ?? 'Package');
                                    $subTitle = is_array($image['sub_title'] ?? '') ? ($image['sub_title'][locale()] ?? '') : ($image['sub_title'] ?? '$0');
                                    $description = is_array($image['description'] ?? '') ? ($image['description'][locale()] ?? '') : ($image['description'] ?? '');
                                @endphp
                                <div class="item">
                                    <div class="d-ticket">
                                        <img src="{{ $imgSrc ?: 'https://madebydesignesia.com/themes/cyber/images/logo.webp' }}" class="w-80px mb-4" alt="">
                                        <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                        <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                        <h2>{{ $title }}</h2>
                                        <h4 class="mb-4">{{ $subTitle }}</h4>
                                        <div class="fs-14">Available Online</div>
                                    </div>
                                    <div class="relative">
                                        <div class="py-4 z-2">
                                            @if($description)
                                            <ul class="ul-check mb-4">
                                                @foreach(explode("\n", strip_tags($description)) as $line)
                                                    @if(trim($line))
                                                    <li>{{ trim($line) }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            @else
                                            <ul class="ul-check mb-4">
                                                <li>Suitable for featured store campaigns</li>
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
    
                                    <a class="btn-main fx-slide w-100" href="{{ $linkUrl }}"><span>View Details</span></a>
                                </div>
                                @endforeach
                            @else
                            <div class="item">
                                <div class="d-ticket">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo.webp" class="w-80px mb-4" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                    <h2>Standard</h2>
                                    <h4 class="mb-4">$299</h4>
                                    <div class="fs-14">Available Online</div>
                                </div>

                                <div class="relative overflow-hidden">
                                    <div class="py-4 z-2">
                                        <ul class="ul-check mb-4">
                                            <li>Entry-level bundle for new customers.</li>
                                            <li>Clear product highlights and benefits.</li>
                                            <li>Flexible content for store campaigns.</li>
                                            <li>Works for products, services, or memberships.</li>
                                        </ul>
                                    </div>

                                    <a class="btn-main fx-slide w-100" href="#latest-products"><span>View Details</span></a>
                                    
                                </div>
                            </div>
                            <!-- package item end -->

                            <!-- package item begin -->
                            <div class="item">
                                <div class="d-ticket">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo.webp" class="w-80px mb-4" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                    <h2>VIP</h2>
                                    <h4 class="mb-4">$699</h4>
                                    <div class="fs-14">Available Online</div>
                                </div>
                                <div class="relative">
                                    <div class="py-4 z-2">
                                        <ul class="ul-check mb-4">
                                            <li>Includes all Standard bundle benefits.</li>
                                            <li>Useful for premium product sets.</li>
                                            <li>Priority support or fulfillment messaging.</li>
                                            <li>Space for extra services and incentives.</li>
                                        </ul>
                                    </div>
                                </div>

                                <a class="btn-main fx-slide w-100" href="#latest-products"><span>View Details</span></a>
                            </div>
                            <!-- package item end -->

                            <!-- package item begin -->
                            <div class="item">
                                <div class="d-ticket s2">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo.webp" class="w-80px mb-4" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                    <h2>Complete</h2>
                                    <h4 class="mb-4">$1199</h4>
                                    <div class="fs-14">Available Online</div>
                                </div>
                                <div class="relative">
                                    <div class="py-4 z-2">
                                        <ul class="ul-check mb-4">
                                            <li>Includes all Premium bundle benefits.</li>
                                            <li>Good for full collection campaigns.</li>
                                            <li>Supports personalized service messaging.</li>
                                            <li>Room for exclusive member benefits.</li>
                                        </ul>
                                    </div>
                                </div>

                                <a class="btn-main fx-slide w-100" href="#latest-products"><span>View Details</span></a>
                            </div>
                            <!-- package item end -->

                            <!-- package item begin -->
                            <div class="item">
                                <div class="d-ticket s2">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo.webp" class="w-80px mb-4" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                    <h2>Exclusive</h2>
                                    <h4 class="mb-4">$2499</h4>
                                    <div class="fs-14">Available Online</div>
                                </div>
                                <div class="relative">
                                    <div class="py-4 z-2">
                                        <ul class="ul-check mb-4">
                                            <li>Includes all Complete bundle benefits.</li>
                                            <li>Ideal for limited or high-value offers.</li>
                                            <li>Priority consultation or service options.</li>
                                            <li>Exclusive content for loyal customers.</li>
                                        </ul>
                                    </div>
                                </div>

                                <a class="btn-main fx-slide w-100" href="#latest-products"><span>View Details</span></a>
                            </div>
                            <!-- package item end -->

                            <!-- package item begin -->
                            <div class="item">
                                <div class="d-ticket s3">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo.webp" class="w-80px mb-4" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                    <h2>Starter</h2>
                                    <h4 class="mb-4">$149</h4>
                                    <div class="fs-14">Available Online</div>
                                </div>
                                <div class="relative">
                                    <div class="py-4 z-2">
                                        <ul class="ul-check mb-4">
                                            <li>Simple offer for first-time buyers.</li>
                                            <li>Compact benefits for easy comparison.</li>
                                            <li>Works for trial packs or sample sets.</li>
                                            <li>Clear next step to product details.</li>
                                        </ul>
                                    </div>
                                </div>

                                <a class="btn-main fx-slide w-100" href="#latest-products"><span>View Details</span></a>
                            </div>
                            <!-- package item end -->

                            <!-- package item begin -->
                            <div class="item">
                                <div class="d-ticket s3">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo.webp" class="w-80px mb-4" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/misc/barcode.webp" class="w-20 p-2 abs abs-middle end-0 me-2" alt="">
                                    <img src="https://madebydesignesia.com/themes/cyber/images/logo-big-white.webp" class="w-40 abs abs-centered me-4 op-2" alt="">
                                    <h2>Digital</h2>
                                    <h4 class="mb-4">$99</h4>
                                    <div class="fs-14">Available Online</div>
                                </div>
                                <div class="relative">
                                    <div class="py-4 z-2">
                                        <ul class="ul-check mb-4">
                                            <li>Online-friendly offer presentation.</li>
                                            <li>Great for digital products or services.</li>
                                            <li>Supports downloadable resources.</li>
                                            <li>Easy to adapt for member benefits.</li>
                                        </ul>
                                    </div>
                                </div>

                                <a class="btn-main fx-slide w-100" href="#latest-products"><span>View Details</span></a>
                            </div>
                            <!-- package item end -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
