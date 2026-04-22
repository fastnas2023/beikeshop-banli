<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
    <section id="section-why-attend" class="bg-dark section-dark text-light" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 offset-lg-3 text-center">
                    @if(!empty($content['sub_title']))
                    <div class="subtitle wow fadeInUp mb-3" style="{{ !empty($content['text_color']) ? 'color: '.$content['text_color'].';' : '' }}">{{ is_array($content['sub_title']) ? ($content['sub_title'][locale()] ?? $content['sub_title']['en'] ?? '') : $content['sub_title'] }}</div>
                    @endif
                    <h2 class="wow fadeInUp" data-wow-delay=".2s" style="{{ !empty($content['text_color']) ? 'color: '.$content['text_color'].';' : '' }}">
                        {{ !empty($content['title']) ? (is_array($content['title']) ? ($content['title'][locale()] ?? $content['title']['en'] ?? '') : $content['title']) : 'What You’ll Gain' }}
                    </h2>
                    @if(!empty($content['description']))
                    <p class="lead mb-0 wow fadeInUp" style="{{ !empty($content['text_color']) ? 'color: '.$content['text_color'].';' : '' }}">{{ is_array($content['description']) ? ($content['description'][locale()] ?? $content['description']['en'] ?? '') : $content['description'] }}</p>
                    @else
                    <p class="lead mb-0 wow fadeInUp" style="{{ !empty($content['text_color']) ? 'color: '.$content['text_color'].';' : '' }}">Hear from global AI pioneers, industry disruptors, and bold thinkers shaping the future across every domain.</p>
                    @endif
                </div>
            </div>

            <div class="spacer-single"></div>

            <div class="row g-4">
                @if(isset($content['images']) && count($content['images']) > 0)
                    @foreach ($content['images'] as $image)
                    @php
                        $imgSrc = is_array($image['image']) ? ($image['image']['src'][locale()] ?? $image['image']['src'] ?? '') : ($image['image'] ?? '');
                        $linkUrl = is_array($image['url'] ?? null) ? ($image['url']['link'] ?? $image['url']['value'] ?? 'javascript:void(0)') : ($image['url'] ?? 'javascript:void(0)');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="hover">
                            <a href="{{ $linkUrl }}" class="d-block text-decoration-none">
                                <div class="bg-dark-2 relative rounded-1 overflow-hidden hover-bg-color hover-text-light wow scale-in-mask">
                                    <div class="abs p-40 bottom-0 z-2">
                                        <div class="relative wow fadeInUp">
                                            <h4>{{ !empty($image['title']) ? (is_array($image['title']) ? ($image['title'][locale()] ?? $image['title']['en'] ?? '') : $image['title']) : ($image['text'] ?? 'Cutting-Edge Knowledge') }}</h4>
                                            <p class="mb-0">{{ !empty($image['description']) ? (is_array($image['description']) ? ($image['description'][locale()] ?? $image['description']['en'] ?? '') : $image['description']) : ($image['sub_text'] ?? '') }}</p>
                                        </div>
                                    </div>
                                    <div class="gradient-edge-bottom h-100"></div>
                                    <img src="{{ $imgSrc ?: 'https://madebydesignesia.com/themes/cyber/images/misc/s3.webp' }}" class="w-100 hover-scale-1-1" alt="{{ $image['text'] ?? '' }}">
                                    <div class="abs w-100 h-100 start-0 top-0 hover-op-1 radial-gradient-color"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback if no images in BeikeShop module -->
                    @php
                        $fallback_images = [
                            ['title' => 'Cutting-Edge Knowledge', 'desc' => 'Stay ahead of the curve with insights from AI leaders shaping tomorrow’s technology.', 'img' => 's3.webp'],
                            ['title' => 'Hands-On Learning', 'desc' => 'Join live workshops and labs to build practical skills in AI and machine learning.', 'img' => 's4.webp'],
                            ['title' => 'Global Networking', 'desc' => 'Meet developers, founders, and researchers from around the world to collaborate and grow.', 'img' => 's5.webp'],
                            ['title' => 'Startup Showcase', 'desc' => 'Explore the latest AI tools and ideas from promising startups and research labs.', 'img' => 's6.webp'],
                            ['title' => 'AI Career Boost', 'desc' => 'Access exclusive job fairs, mentorship sessions, and recruiting events to grow your career.', 'img' => 's7.webp'],
                            ['title' => 'Ethics & Future', 'desc' => 'Engage in vital conversations around AI ethics, policy, and the future of intelligence.', 'img' => 's8.webp']
                        ];
                    @endphp
                    @foreach($fallback_images as $f)
                    <div class="col-lg-4 col-md-6">
                        <div class="hover">
                            <div class="bg-dark-2 relative rounded-1 overflow-hidden hover-bg-color hover-text-light wow scale-in-mask">
                                <div class="abs p-40 bottom-0 z-2">
                                    <div class="relative wow fadeInUp">
                                        <h4>{{ $f['title'] }}</h4>
                                        <p class="mb-0">{{ $f['desc'] }}</p>
                                    </div>
                                </div>
                                <div class="gradient-edge-bottom h-100"></div>
                                <img src="https://madebydesignesia.com/themes/cyber/images/misc/{{ $f['img'] }}" class="w-100 hover-scale-1-1" alt="">
                                <div class="abs w-100 h-100 start-0 top-0 hover-op-1 radial-gradient-color"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
