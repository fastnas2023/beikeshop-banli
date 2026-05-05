@addStyle(asset('vendor/swiper/swiper-bundle.min.css'))
@addScript(asset('vendor/swiper/swiper-bundle.min.js'))

<section class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
  <div class="module-info {{ $content['module_size'] ?? 'w-100' }}">
    <div class="swiper module-swiper-{{ $module_id }} module-slideshow">
      <div class="swiper-wrapper">
        @foreach($content['images'] as $image)
          <div class="swiper-slide">
            <a href="{{ $image['link']['link'] ?: 'javascript:void(0)' }}" class="d-flex justify-content-center">
              @if (($image['type'] ?? 'image') == 'video')
                <video src="{{ $image['image'] }}" class="img-fluid w-100" controls loop autoplay muted playsinline></video>
              @else
                <img src="{{ $image['image'] }}" fetchpriority="high" class="img-fluid seo-img" alt="{{ $image['image_alt'] ?? '' }}">
              @endif
            </a>
          </div>
        @endforeach
      </div>
      <div class="swiper-pagination slideshow-pagination-{{ $module_id }}"></div>
      <div class="swiper-button-prev slideshow-btnprev-{{ $module_id }}"></div>
      <div class="swiper-button-next slideshow-btnnext-{{ $module_id }}"></div>
    </div>
  </div>

  <script>
    function slideshowSwiper{{ str_replace('-', '_', $module_id) }}() {
      new Swiper('.module-swiper-{{ $module_id }}', {
        loop: {{ count($content['images']) > 1 ? 'true' : 'false' }},
        autoplay: true,
        pauseOnMouseEnter: true,
        clickable: true,
        pagination: {
          el: '.slideshow-pagination-{{ $module_id }}',
          clickable: true
        },
        navigation: {
          nextEl: '.slideshow-btnnext-{{ $module_id }}',
          prevEl: '.slideshow-btnprev-{{ $module_id }}',
        },
      })
    }

    @if ($design)
      bk.loadStyle('{{ asset('vendor/swiper/swiper-bundle.min.css') }}');
      bk.loadScript('{{ asset('vendor/swiper/swiper-bundle.min.js') }}', () => {
        slideshowSwiper{{ str_replace('-', '_', $module_id) }}();
      })
    @else
      slideshowSwiper{{ str_replace('-', '_', $module_id) }}();
    @endif
  </script>
</section>
