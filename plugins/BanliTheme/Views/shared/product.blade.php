<div class="product-wrap {{ request('style_list') ?? '' }} {{ $style_list ?? '' }}">
  <div class="image position-relative overflow-hidden rounded">
    @hook('product_list.item.image.tag')

    <a href="{{ $product['url'] }}">
      @hookwrapper('product_list.item.image')
      <img
        data-sizes="auto"
        data-src="{{ $product['images'][0] ?? image_resize('', 500, 500) }}"
        src="{{ image_resize('', 500, 500) }}"
        alt="{{ $product['name'] }}"
        class="img-fluid image-before lazyload">
        @if (count($product['images']) > 1)
        <img
        width="600"
        height="600"
        src="{{ $product['images'][1] ?? image_resize('', 500, 500) }}"
        alt="{{ $product['name'] }}"
        class="img-fluid image-after">
        @endif
      @endhookwrapper
    </a>
    @if (!request('style_list') || request('style_list') == 'grid' || ($style_list ?? '' == 'grid'))
      <div class="button-wrap d-flex justify-content-center gap-2 px-2">
        @hookwrapper('shared.product.btn.add_cart')
        <button
          class="btn btn-dark text-light btn-add-cart rounded-pill px-3 py-2 flex-grow-1 d-flex align-items-center justify-content-center gap-2"
          style="height: 40px;"
          product-id="{{ $product['sku_id'] ?? $product['id'] }}"
          product-price="{{ $product['price'] }}"
          onclick="bk.addCart({sku_id: '{{ $product['sku_id'] ?? $product['id'] }}'}, this)">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <span class="d-none d-sm-inline" style="font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ __('shop/products.add_to_cart') }}</span>
        </button>
        @endhookwrapper
        @hookwrapper('shared.product.btn.quick_view')
        <button
          class="btn btn-dark text-light btn-quick-view rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center p-0"
          style="width: 40px; height: 40px;"
          product-id="{{ $product['sku_id'] ?? $product['id'] }}"
          product-price="{{ $product['price'] }}"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          title="{{ __('common.quick_view') }}"
          onclick="bk.productQuickView({{ $product['id'] }})">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
          </svg>
        </button>
        @endhookwrapper
        @hookwrapper('shared.product.btn.add_to_favorites')
        <button
          class="btn btn-dark text-light btn-wishlist rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center p-0"
          style="width: 40px; height: 40px;"
          product-id="{{ $product['sku_id'] ?? $product['id'] }}"
          product-price="{{ $product['price'] }}"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          title="{{ __('shop/products.add_to_favorites') }}"
          data-in-wishlist="{{ !empty($product['in_wishlist']) ? 1 : 0 }}"
          onclick="bk.addWishlist('{{ $product['id'] }}', this)">
          <i class="bi {{ !empty($product['in_wishlist']) ? 'bi-heart-fill text-danger' : 'bi-heart' }} d-flex align-items-center justify-content-center" style="font-style: normal;">
            <svg class="icon-empty" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg>
            <svg class="icon-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
            </svg>
          </i>
        </button>
        @endhookwrapper
      </div>
    @endif
  </div>
  <div class="product-bottom-info">
    @hook('product_list.item.name.before')
    <div class="product-name">{{ $product['name_format'] }}</div>

    @hookwrapper('product_list.item.price')
    @if ((system_setting('base.show_price_after_login') and current_customer()) or !system_setting('base.show_price_after_login'))
      <div class="product-price" product-id="{{ $product['sku_id'] ?? $product['id'] }}">
        <span class="price-new text-primary fw-bold">{{ $product['price_format'] }}</span>
        @if (isset($product['origin_price']) && $product['price'] != $product['origin_price'] && $product['origin_price'] > 0)
          <span class="price-old text-decoration-line-through text-white-50 ms-2 small">{{ $product['origin_price_format'] ?? format_price($product['origin_price']) }}</span>
        @endif
      </div>
    @else
      <div class="product-price" product-id="{{ $product['sku_id'] ?? $product['id'] }}">
        <div class="text-dark fs-6">{{ __('common.before') }} <a class="price-new fs-6 login-before-show-price" href="javascript:void(0);">{{ __('common.login') }}</a> {{ __('common.show_price') }}</div>
      </div>
    @endif
    @endhookwrapper

    @if (request('style_list') == 'list' || ($style_list ?? '' == 'list'))
      <div class="button-wrap mt-3 d-flex gap-2">
        <button
          class="btn btn-dark text-light btn-add-cart rounded-pill px-4"
          style="height: 40px;"
          onclick="bk.addCart({sku_id: '{{ $product['sku_id'] ?? $product['id'] }}'}, this)">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          {{ __('shop/products.add_to_cart') }}
        </button>

        <button
          class="btn btn-dark text-light btn-quick-view rounded-circle d-flex align-items-center justify-content-center"
          style="width: 40px; height: 40px;"
          product-id="{{ $product['sku_id'] ?? $product['id'] }}"
          product-price="{{ $product['price'] }}"
          onclick="bk.productQuickView({{ $product['id'] }})">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
          </svg>
        </button>
        
        <button class="btn btn-dark text-light btn-wishlist rounded-circle d-flex align-items-center justify-content-center" 
          style="width: 40px; height: 40px;"
          data-in-wishlist="{{ !empty($product['in_wishlist']) ? 1 : 0 }}" 
          onclick="bk.addWishlist('{{ $product['id'] }}', this)">
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
    @endif
  </div>

  @hook('product_list.item.after')
</div>
