<div class="offcanvas" tabindex="-1" id="offcanvas-search-top" aria-labelledby="offcanvasTopLabel" data-bs-backdrop="true" data-bs-scroll="false">
  <div class="container">
    <div class="offcanvas-header">
      <div class="search-input-wrap input-group mb-0">
        <input type="text" class="form-control search-popover-input input-group-lg fs-4" autofocus placeholder="{{ __('common.input') }}"
               value="{{ request('keyword') }}" data-lang="{{ locale() === system_setting('base.locale') ? '' : session()->get('locale') }}">
        <button type="button" class="input-group-text search-popover-submit" aria-label="{{ __('common.search') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
        </button>
      </div>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    @if ($hot_keywords)
    <div class="hot-search-wrap mb-4">
      <h5>{{ __('shop/products.hot_search') }}</h5>
      <div class="hot-search-list">
        @foreach ($hot_keywords as $keyword)
          <a class="cyber-tag" href="{{ shop_route('products.search', ['keyword' => $keyword]) }}">{{ $keyword }}</a>
        @endforeach
      </div>
    </div>
    @endif

    @if ($products)
    <div class="search-pop-products-wrap">
      <div class="spinner-border" role="status"></div>
      <h5 class="hot-products-title">{{ __('shop/products.hot_products') }}</h5>

      <div class="sp-products hot-products-list">
        <div class="row g-3 g-lg-4 {{ is_mobile() == 'list' ? 'product-list-wrap' : ''}}">
          @foreach ($products as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
              @include('shared.product', ['mode' => is_mobile() ? 'list' : 'grid', 'show_actions' => true])
            </div>
          @endforeach
        </div>
      </div>
      <div class="sp-products search-products-list d-none">
        <div class="row g-3 g-lg-4"></div>
      </div>
    </div>
    @endif
  </div>
</div>

@push('add-scripts')
  <script>
    if ($(window).width() < 768) {
      $('#offcanvas-search-top').addClass('offcanvas-start');
    } else {
      $('#offcanvas-search-top').addClass('offcanvas-top');
    }

    const searchOffcanvas = document.getElementById('offcanvas-search-top');
    if (searchOffcanvas) {
      searchOffcanvas.addEventListener('show.bs.offcanvas', function () {
        document.body.classList.add('banli-search-open');
      });
      searchOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
        document.body.classList.remove('banli-search-open');
      });
    }

    $(function () {
      const $input = $('.search-popover-input');
      const $wrap = $('.search-pop-products-wrap');
      const $hotList = $wrap.find('.hot-products-list');
      const $searchList = $wrap.find('.search-products-list');
      const $title = $('.hot-products-title');
      const isMobile = @json(is_mobile());
      let searchRequestId = 0;

      $input.off('input.banliSearch').on('input.banliSearch', bk.debounce(function () {
        const keyword = $input.val().trim();

        $wrap.addClass('loading');

        if (keyword.length > 0) {
          topSearchGetData(keyword)
        } else {
          searchRequestId += 1;
          $wrap.removeClass('loading');
          $hotList.removeClass('d-none');
          $searchList.addClass('d-none').find('.row').empty();
          $title.text('{{ __("shop/products.hot_products") }}').removeClass('d-none');
        }
      }, 300));

      $(document).off('click.banliSearchShowAll', '.search-pop-products-show-all .btn').on('click.banliSearchShowAll', '.search-pop-products-show-all .btn', function () {
        $(".search-popover-input").trigger({
          type: "keydown",
          keyCode: 13
        });
      });

      $('a[href="#offcanvas-search-top"]').off('click.banliSearchOpen').on('click.banliSearchOpen', function () {
        const keyword = $input.val().trim();
        if (keyword) {
          topSearchGetData(keyword)
        }

        setTimeout(function () {
          $input.trigger('focus');
        }, 180);
      })

      $input.off('keydown.banliSearch').on('keydown.banliSearch', function (event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
          searchSubmit();
        }
      });

      $('.search-popover-submit').off('click.banliSearch').on('click.banliSearch', searchSubmit);

      function searchSubmit() {
        const keyword = $input.val().trim();

        if (!keyword) {
          $input.trigger('focus');
          return;
        }

        window.location.href = '{{ shop_route('products.search') }}?keyword=' + encodeURIComponent(keyword);
      }

      function topSearchGetData(keyword) {
        const searchListHeight = $searchList.height();
        const requestId = ++searchRequestId;
        $http.get('{{ shop_route('products.autocomplete') }}', { name: keyword, html: true, limit: 5 }, { hload: true }).then(res => {
          if (requestId !== searchRequestId || keyword !== $input.val().trim()) {
            return;
          }

          $hotList.addClass('d-none');
          if (searchListHeight) {
            $searchList.height(searchListHeight);
          }
          $searchList.removeClass('d-none').find('.row').html(res);
          if (isMobile) {
            $('.search-products-list .product-wrap').addClass('list');
          }

          $title.text(res ? '{{ __("shop/products.search_result") }}' : '{{ __("shop/products.hot_products") }}');
          $title.toggleClass('d-none', !res);
        }).finally(() => {
          if (requestId === searchRequestId) {
            $wrap.removeClass('loading');
          }
        });
      }
    })
  </script>
@endpush
