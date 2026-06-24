<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
    <section id="section-featured-products" class="bg-dark section-dark text-light" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 relative z-3">
                      <div class="text-center">
                          @if(!empty($content['sub_title']))
                          <div class="subtitle wow fadeInUp" data-wow-delay=".0s">{{ is_array($content['sub_title']) ? ($content['sub_title'][locale()] ?? $content['sub_title']['en'] ?? '') : $content['sub_title'] }}</div>
                          @else
                          <div class="subtitle wow fadeInUp" data-wow-delay=".0s">{{ __('BanliTheme::common.collection') }}</div>
                          @endif
                          
                          <h2 class="wow fadeInUp" data-wow-delay=".2s">
                              {{ !empty($content['title']) ? (is_array($content['title']) ? $content['title'][locale()] ?? '' : $content['title']) : __('BanliTheme::common.featured_products') }}
                          </h2>
                          
                          @if(!empty($content['description']))
                          <p class="lead wow fadeInUp">{{ is_array($content['description']) ? $content['description'][locale()] ?? '' : $content['description'] }}</p>
                          @endif
                      </div>
                </div>
            </div>

            <div class="row g-4">
                @if(isset($content['images']) && count($content['images']) > 0)
                    @foreach ($content['images'] as $image)
                    @php
                        $imgSrc = is_array($image['image']) ? ($image['image']['src'][locale()] ?? $image['image']['src'] ?? '') : ($image['image'] ?? '');
                        $linkUrl = is_array($image['url'] ?? null) ? ($image['url']['link'] ?? $image['url']['value'] ?? 'javascript:void(0)') : ($image['url'] ?? 'javascript:void(0)');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="hover bg-dark-2 rounded-1 overflow-hidden h-100 wow fadeIn">
                            <a href="{{ $linkUrl }}" class="d-block overflow-hidden" style="aspect-ratio: 1/1;">
                                <img src="{{ $imgSrc }}" class="w-100 h-100 transition-transform hover-scale-1-1" style="object-fit: cover;" alt="{{ !empty($image['title']) ? (is_array($image['title']) ? ($image['title'][locale()] ?? $image['title']['en'] ?? '') : $image['title']) : '' }}">
                            </a>
                            <div class="p-4 text-center">
                                <h4 class="mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 1.4; height: 2.8em;">
                                    <a href="{{ $linkUrl }}" class="text-light">{{ !empty($image['title']) ? (is_array($image['title']) ? ($image['title'][locale()] ?? $image['title']['en'] ?? '') : $image['title']) : '' }}</a>
                                </h4>
                                <div class="fs-18 text-gradient fw-bold">{{ !empty($image['sub_title']) ? (is_array($image['sub_title']) ? ($image['sub_title'][locale()] ?? $image['sub_title']['en'] ?? '') : $image['sub_title']) : '' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @elseif(isset($content['tabs']) && count($content['tabs']) > 0 && isset($content['tabs'][0]['products']) && count($content['tabs'][0]['products']) > 0)
                    @php
                        $products = array_slice($content['tabs'][0]['products'], 0, 4);
                    @endphp
                    @foreach($products as $product)
                    @php
                        $productId = $product['id'] ?? $product['product_id'] ?? 0;
                        $productName = $product['name_format'] ?? $product['name'] ?? '';
                        $productPrice = $product['price_format'] ?? format_price($product['price'] ?? 0);
                        $productImage = $product['images'][0] ?? $product['image'] ?? '';
                        $productUrl = $product['url'] ?? route('product.show', ['id' => $productId]);
                    @endphp
                    <div class="col-lg-3 col-md-6">
                        <div class="product-wrap hover bg-dark-2 rounded-1 overflow-hidden h-100 wow fadeIn position-relative">
                            <div class="image position-relative overflow-hidden">
                                <a href="{{ $productUrl }}" class="d-block overflow-hidden position-relative" style="aspect-ratio: 1/1;">
                                    <img src="{{ image_origin($productImage) }}" class="w-100 h-100 transition-transform hover-scale-1-1" style="object-fit: cover;" alt="{{ $productName }}">
                                    @if(isset($product['images']) && count($product['images']) > 1)
                                        <img src="{{ image_origin($product['images'][1]) }}" class="image-after" alt="{{ $productName }}">
                                    @endif
                                </a>
                                
                                <div class="button-wrap d-flex justify-content-center gap-2 px-2">
                                    <button
                                      class="btn btn-dark text-light btn-add-cart rounded-pill px-3 py-2 flex-grow-1 d-flex align-items-center justify-content-center gap-2"
                                      style="height: 40px;"
                                      product-id="{{ $product['sku_id'] ?? $product['id'] ?? $productId }}"
                                      onclick="bk.addCart({sku_id: '{{ $product['sku_id'] ?? $product['id'] ?? $productId }}'}, this)">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                      </svg>
                                      <span class="d-none d-sm-inline" style="font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ __('shop/products.add_to_cart') }}</span>
                                    </button>
                                    <button
                                      class="btn btn-dark text-light btn-quick-view rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center p-0"
                                      style="width: 40px; height: 40px;"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="{{ __('common.quick_view') }}"
                                      onclick="bk.productQuickView({{ $product['product_id'] ?? $product['id'] ?? $productId }})">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                      </svg>
                                    </button>
                                    <button
                                      class="btn btn-dark text-light btn-wishlist rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center p-0"
                                      style="width: 40px; height: 40px;"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="{{ __('shop/products.add_to_favorites') }}"
                                      data-in-wishlist="{{ !empty($product['in_wishlist']) ? 1 : 0 }}"
                                      onclick="bk.addWishlist('{{ $product['product_id'] ?? $product['id'] ?? $productId }}', this)">
                                      <i class="bi {{ !empty($product['in_wishlist']) ? 'bi-heart-fill text-danger' : 'bi-heart' }} d-flex align-items-center justify-content-center" style="font-style: normal;">
                                        <svg class="icon-empty" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                          <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                        <svg class="icon-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                      </i>
                                    </button>
                                </div>
                            </div>

                            <div class="p-4 text-center product-bottom-info">
                                <h4 class="mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 1.4; height: 2.8em;">
                                    <a href="{{ $productUrl }}" class="text-light">{{ $productName }}</a>
                                </h4>
                                <div class="fs-18 text-gradient fw-bold product-price" product-id="{{ $product['sku_id'] ?? '' }}">
                                    <span class="price-new text-gradient fw-bold fs-18">{{ $productPrice }}</span>
                                    @if(isset($product['origin_price']) && $product['price'] != $product['origin_price'] && $product['origin_price'] > 0)
                                        <span class="price-old text-decoration-line-through text-white-50 ms-2 small">{{ $product['origin_price_format'] ?? format_price($product['origin_price']) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Generic product placeholders for unconfigured modules. -->
                    @php
                        $placeholderProducts = [
                            ['name' => 'Featured Item', 'label' => 'New Arrival'],
                            ['name' => 'Signature Product', 'label' => 'Best Seller'],
                            ['name' => 'Seasonal Pick', 'label' => 'Limited Drop'],
                            ['name' => 'Everyday Essential', 'label' => 'Customer Favorite'],
                            ['name' => 'Premium Selection', 'label' => 'Curated Choice'],
                            ['name' => 'Gift Collection', 'label' => 'Ready to Shop'],
                        ];
                    @endphp
                    @foreach($placeholderProducts as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="hover bg-dark-2 rounded-1 overflow-hidden h-100 wow fadeIn">
                            <a href="javascript:void(0)" class="d-block overflow-hidden" style="aspect-ratio: 1/1;">
                                <img src="{{ asset('image/placeholder.png') }}" class="w-100 h-100 transition-transform hover-scale-1-1" style="object-fit: cover;" alt="">
                            </a>
                            <div class="p-4 text-center">
                                <h4 class="mb-2"><a href="javascript:void(0)" class="text-light">{{ $product['name'] }}</a></h4>
                                <div class="fs-16 text-gradient fw-bold">{{ $product['label'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
