<div class="module-item py-5 {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}" style="background-color: {{ $content['bg_color'] ?? 'transparent' }};">
    <div class="module-info module-img-text-banner py-5">
        <div class="container">
            <div class="row align-items-center g-5 {{ ($content['image_position'] ?? 'right') === 'left' ? 'flex-row-reverse' : '' }}">
                <div class="col-lg-7">
                    <div class="text-{{ $content['text_position'] ?? 'left' }}">
                        @if(!empty($content['sub_title']))
                            <div class="subtitle mb-3" style="color: #00d2ff; font-weight: 500; font-size: 1.1rem; letter-spacing: 1px;">
                                @php
                                    $subTitle = is_array($content['sub_title']) ? ($content['sub_title'][locale()] ?? $content['sub_title']['en'] ?? '') : $content['sub_title'];
                                    $subTitle = preg_replace('/[\[\]]+/', '', (string) $subTitle);
                                    $subTitle = trim($subTitle);
                                @endphp
                                {{ $subTitle }}
                            </div>
                        @endif
                        
                        @if(!empty($content['title']))
                            <h2 class="mb-4 fw-bold" style="font-size: 3.5rem; line-height: 1.2; color: {{ $content['text_color'] ?? '#ffffff' }};">
                                {{ is_array($content['title']) ? ($content['title'][locale()] ?? $content['title']['en'] ?? '') : $content['title'] }}
                            </h2>
                        @endif
                        
                        @if(!empty($content['description']))
                            <p class="lead mb-5" style="color: rgba(255,255,255,0.7); font-size: 1.15rem; line-height: 1.8; max-width: 600px;">
                                {{ is_array($content['description']) ? ($content['description'][locale()] ?? $content['description']['en'] ?? '') : $content['description'] }}
                            </p>
                        @endif
                        
                        @if(!empty($content['link']['value']))
                            <a href="{{ shop_route('products.show', $content['link']['value']) }}" class="btn btn-lg rounded-pill px-5 py-3 fw-bold" style="background-color: {{ $content['btn_bg'] ?? '#6a11cb' }}; color: {{ $content['btn_color'] ?? '#ffffff' }}; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 20px rgba(106, 17, 203, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                {{ __('common.buy_now') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="wow scaleIn position-relative">
                        @php
                            $mediaSrc = !empty($content['image']) ? image_origin(is_array($content['image']) ? ($content['image']['src'][locale()] ?? $content['image']['src'] ?? '') : $content['image']) : 'https://madebydesignesia.com/themes/cyber/images/misc/c1.webp';
                            $isMp4 = str_ends_with(strtolower($mediaSrc), '.mp4');
                        @endphp
                        
                        @if ($isMp4)
                            <video src="{{ $mediaSrc }}" class="w-100 rotate-animation" autoplay loop muted playsinline style="border-radius: 12px; filter: drop-shadow(0 0 30px rgba(106, 17, 203, 0.3)); transform-origin: center center;"></video>
                        @else
                            <img src="{{ $mediaSrc }}" class="w-100 rotate-animation" alt="{{ $content['title'] ?? 'Feature Highlight' }}" style="border-radius: 12px; filter: drop-shadow(0 0 30px rgba(106, 17, 203, 0.3)); transform-origin: center center;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
