@extends('layout.master')
@section('body-class', 'page-categories bg-dark text-light')
@section('title', $category->description->meta_title ?: system_setting('base.meta_title', 'BeikeShop开源好用的跨境电商系统') .' - '. $category->description->name)
@section('keywords', $category->description->meta_keywords ?: system_setting('base.meta_keyword'))
@section('description', $category->description->meta_description ?: system_setting('base.meta_description'))

@push('header')
  <script src="{{ asset('vendor/scrolltofixed/jquery-scrolltofixed-min.js') }}"></script>
  <style>
    .page-categories #content {
      background: #101435;
    }
    body.page-categories #wrapper {
      padding-top: var(--banli-header-height, clamp(7rem, 8vw, 8.25rem)) !important;
    }
    body.page-categories .breadcrumb-wrap {
      margin: 0 0 clamp(1.25rem, 2vw, 1.625rem) !important;
      padding: 0 !important;
      overflow: visible;
      background: transparent !important;
    }
    body.page-categories .breadcrumb-wrap .container {
      width: 100%;
      max-width: 100%;
      min-height: 2.875rem;
      margin: 0;
      padding: .55rem 1.125rem;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 8px;
      background: rgba(255,255,255,.025) !important;
      box-sizing: border-box;
    }
    body.page-categories .breadcrumb-wrap .container-fluid {
      height: auto !important;
    }
    body.page-categories .breadcrumb-wrap .breadcrumb {
      min-height: 1.625rem;
      margin: 0;
      padding: 0 !important;
      align-items: center;
      row-gap: .25rem;
    }
    body.page-categories .breadcrumb-wrap .breadcrumb-item,
    body.page-categories .breadcrumb-wrap .breadcrumb-item a {
      color: rgba(255,255,255,.62);
      text-decoration: none;
    }
    body.page-categories .breadcrumb-wrap .breadcrumb-item.active {
      color: rgba(255,255,255,.82);
      font-weight: 700;
    }
    .banli-category-page {
      padding: clamp(1rem, 1.8vw, 1.75rem) 0 clamp(4rem, 7vw, 5.5rem);
      background:
        radial-gradient(circle at 82% 8%, rgba(122, 76, 243, .16), transparent 36%),
        radial-gradient(circle at 12% 18%, rgba(0, 210, 255, .10), transparent 34%),
        #101435;
    }
    .banli-category-hero {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      margin-bottom: clamp(1rem, 1.7vw, 1.375rem);
      padding: clamp(30px, 3.4vw, 52px);
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      background: rgba(255,255,255,.025);
      box-shadow: 0 26px 70px rgba(0,0,0,.22);
    }
    .banli-category-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -2;
      border-radius: inherit;
      background: url('{{ asset('banli_theme-assets/aivent/images/background/5.webp') }}') center / cover no-repeat;
      transform: scale(1.01);
    }
    .banli-category-hero::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -1;
      border-radius: inherit;
      background:
        radial-gradient(circle at 86% 52%, rgba(122, 76, 243, .20), transparent 28%),
        linear-gradient(90deg, rgba(16,20,53,.95), rgba(16,20,53,.70) 54%, rgba(16,20,53,.90));
    }
    .banli-category-hero > .row {
      position: relative;
      z-index: 1;
      min-height: clamp(240px, 23vw, 310px);
    }
    .banli-category-copy {
      max-width: 820px;
    }
    .banli-category-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 14px;
      color: #8b6dff;
      font-size: 14px;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
    }
    .banli-category-kicker::before,
    .banli-category-kicker::after {
      color: #8b6dff;
      font-weight: 900;
    }
    .banli-category-kicker::before {
      content: "[";
    }
    .banli-category-kicker::after {
      content: "]";
    }
    .banli-category-hero h1 {
      margin: 0;
      color: #fff;
      font-size: clamp(34px, 4vw, 64px);
      line-height: 1.08;
      letter-spacing: 0;
    }
    .banli-category-hero .category-desc {
      max-width: 760px;
      margin-top: 18px;
      color: rgba(255,255,255,.72);
      font-size: 17px;
      line-height: 1.75;
    }
    .banli-category-visual {
      position: relative;
      min-height: 100%;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding-right: clamp(.25rem, 1vw, 1rem);
    }
    .banli-category-visual::before {
      content: "";
      position: absolute;
      right: 5%;
      top: 50%;
      width: min(18rem, 84%);
      aspect-ratio: 1;
      border-radius: 999px;
      background:
        radial-gradient(circle, rgba(255,255,255,.18), transparent 58%),
        radial-gradient(circle, rgba(122,76,243,.28), transparent 64%);
      transform: translateY(-50%);
      filter: blur(1px);
      opacity: .75;
    }
    .banli-category-image {
      position: relative;
      width: min(clamp(11.5rem, 17vw, 15rem), 100%);
      aspect-ratio: 4 / 5;
      margin-left: auto;
      overflow: hidden;
      border-radius: 10px;
      border: 1px solid rgba(255,255,255,.26);
      background: rgba(255,255,255,.08);
      box-shadow: 0 24px 58px rgba(0,0,0,.34);
      transform: translateZ(0);
    }
    .banli-category-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center top;
      transition: transform .35s ease;
    }
    .banli-category-image:hover img {
      transform: scale(1.035);
    }
    .banli-category-image-label {
      position: absolute;
      left: 12px;
      right: 12px;
      bottom: 12px;
      display: block;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      padding: 8px 10px;
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 8px;
      color: rgba(255,255,255,.88);
      background: rgba(16,20,53,.58);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      font-size: 12px;
      font-weight: 800;
      letter-spacing: .02em;
    }
    .banli-category-layout {
      align-items: flex-start;
    }
    .banli-category-sidebar {
      position: sticky;
      top: 132px;
    }
    .banli-category-sidebar.glass-card,
    .banli-category-products .glass-card {
      background: rgba(255,255,255,.045);
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      box-shadow: 0 18px 45px rgba(0,0,0,.18);
    }
    .banli-category-sidebar.glass-card {
      padding: 18px;
      background: rgba(255,255,255,.032);
      border-color: rgba(255,255,255,.09);
      box-shadow: 0 16px 40px rgba(0,0,0,.16);
    }
    .banli-category-products .product-list-container > .row:not(.product-list-wrap) .glass-card {
      overflow: hidden;
      padding: 0;
      background: rgba(255,255,255,.035);
      border-color: rgba(255,255,255,.09);
      box-shadow: 0 14px 34px rgba(0,0,0,.14);
      transition: border-color .18s ease, transform .18s ease, box-shadow .18s ease, background .18s ease;
    }
    .banli-category-products .product-list-container > .row:not(.product-list-wrap) .glass-card:hover {
      background: rgba(255,255,255,.045);
      border-color: rgba(0,210,255,.28);
      box-shadow: 0 18px 42px rgba(0,0,0,.22);
      transform: translateY(-2px);
    }
    .banli-category-products .product-list-container > .row:not(.product-list-wrap) .product-wrap {
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .banli-category-products .product-tool {
      display: grid !important;
      grid-template-columns: auto minmax(0, 1fr);
      gap: 16px;
      padding: 12px 14px;
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      background: rgba(255,255,255,.04);
    }
    .banli-category-products .style-wrap {
      display: inline-flex !important;
      align-items: center;
      gap: 6px;
      min-width: 88px;
    }
    .banli-category-products .style-wrap label {
      width: 40px !important;
      height: 40px !important;
      min-width: 40px !important;
      min-height: 40px !important;
      flex: 0 0 40px !important;
      display: inline-flex !important;
      align-items: center;
      justify-content: center;
      line-height: 1 !important;
      margin: 0 !important;
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 8px;
      color: rgba(255,255,255,.62);
      background: rgba(255,255,255,.035);
      cursor: pointer;
      transition: color .18s ease, background .18s ease, border-color .18s ease, transform .18s ease;
    }
    .banli-category-products .style-wrap label:hover {
      color: #fff;
      border-color: rgba(0,210,255,.35);
      background: rgba(0,210,255,.08);
    }
    .banli-category-products .style-wrap label.active {
      color: #fff;
      border-color: rgba(0,210,255,.55);
      background: linear-gradient(135deg, rgba(0,210,255,.18), rgba(122,76,243,.22));
      box-shadow: 0 0 0 3px rgba(0,210,255,.08);
    }
    .banli-category-products .style-wrap svg {
      width: 18px;
      height: 18px;
      display: block;
      fill: currentColor;
    }
    .banli-category-products .right-per-page {
      justify-content: flex-end;
      gap: 14px;
      min-width: 0;
    }
    .banli-category-products .form-select {
      min-width: 130px;
      color: rgba(255,255,255,.92);
      background-color: rgba(255,255,255,.06);
      border-color: rgba(255,255,255,.14);
      border-radius: 8px;
    }
    .banli-category-products .product-wrap .image {
      border-radius: 8px 8px 0 0 !important;
      background: #fff;
      aspect-ratio: 1;
    }
    .banli-category-products .product-wrap .image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .banli-category-products .product-bottom-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 16px 16px 18px;
    }
    .banli-category-products .product-name {
      color: #fff;
      font-weight: 750;
      line-height: 1.5;
      min-height: 54px;
      display: -webkit-box;
      overflow: hidden;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
    .banli-category-products .product-price {
      margin-top: 12px;
      display: flex;
      align-items: baseline;
      gap: 12px;
      flex-wrap: wrap;
    }
    .banli-category-products .price-new {
      font-size: 20px;
      line-height: 1;
    }
    .banli-category-products .price-old {
      margin-left: 0 !important;
      font-size: 14px;
    }
    .filter-value-wrap .list-group {
      flex-wrap: wrap;
      gap: 8px;
    }
    .filter-value-wrap .list-group-item {
      margin: 0 !important;
      padding: 9px 14px;
      color: rgba(255,255,255,.88);
      background: rgba(255,255,255,.045);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 8px !important;
      font-weight: 700;
      cursor: pointer;
      transition: color .18s ease, background .18s ease, border-color .18s ease, transform .18s ease;
    }
    .filter-value-wrap .list-group-item:hover {
      color: #fff;
      background: rgba(0,210,255,.10);
      border-color: rgba(0,210,255,.32);
      transform: translateY(-1px);
    }
    .filter-value-wrap .list-group-item.delete-all {
      color: rgba(255,255,255,.78);
      background: rgba(255,255,255,.025);
    }
    @media (max-width: 991.98px) {
      body.page-categories #wrapper {
        padding-top: var(--banli-header-height, clamp(10rem, 45vw, 11rem)) !important;
      }
      body.page-categories .breadcrumb-wrap {
        margin-bottom: 16px !important;
      }
      body.page-categories .breadcrumb-wrap .container {
        min-height: 2.625rem;
        padding: .5rem .875rem;
      }
      .banli-category-page {
        padding-top: .75rem;
      }
      .banli-category-hero {
        margin-bottom: 1rem;
        padding: clamp(1.25rem, 6vw, 1.5rem);
      }
      .banli-category-hero > .row {
        min-height: auto;
      }
      .banli-category-hero h1 {
        font-size: clamp(32px, 10vw, 44px);
      }
      .banli-category-hero .category-desc {
        font-size: 14px;
        line-height: 1.65;
      }
      .banli-category-image {
        width: min(clamp(11rem, 58vw, 15rem), 100%);
        margin: 8px auto 0;
      }
      .banli-category-visual {
        justify-content: center;
        padding-right: 0;
      }
      .banli-category-sidebar {
        position: static;
      }
      .left-column {
        display: none;
      }
      .left-column .x-fixed-top.active {
        position: fixed;
        inset: 0 auto 0 0;
        width: min(340px, 88vw);
        max-height: 100vh;
        overflow-y: auto;
        z-index: 2100;
      }
      .banli-category-products .product-tool {
        grid-template-columns: 1fr;
      }
      .banli-category-products .right-per-page {
        justify-content: space-between;
        flex-wrap: wrap;
      }
    }
  </style>
@endpush

@section('content')
  <section class="banli-category-page">
  <div class="container">
    <div class="banli-category-hero">
      <div class="row g-4 align-items-center">
        <div class="{{ $category->image ? 'col-12 col-lg-9' : 'col-12' }}">
          <div class="banli-category-copy">
            <div class="banli-category-kicker">Collection</div>
            <h1>{{ $category->description->name }}</h1>
            @if($category->description->content)
              <div class="category-desc">{!! $category->description->content !!}</div>
            @endif
          </div>
        </div>
        @if($category->image)
          <div class="col-12 col-lg-3">
            <div class="banli-category-visual">
              <div class="banli-category-image">
                <img src="{{ image_origin($category->image) }}" alt="{{ $category->description->name }}">
                <span class="banli-category-image-label">{{ $category->description->name }}</span>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>

    <x-shop-breadcrumb type="category" :value="$category" />

    <div class="row banli-category-layout">
      <div class="col-12 col-lg-3 pe-lg-4 left-column">
        <div class="x-fixed-top glass-card banli-category-sidebar">@include('shared.filter_sidebar_block')</div>
      </div>

      <div class="col-12 col-lg-9 right-column banli-category-products">
        @hook('category.products.before')
        <div class="filter-value-wrap mb-2 d-none">
          <ul class="list-group list-group-horizontal">
            @foreach ($filter_data['attr'] as $index => $attr)
              @foreach ($attr['values'] as $value_index => $value)
                @if ($value['selected'])
                <li class="list-group-item me-1 mb-1" data-attr="{{ $index }}" data-attrval="{{ $value_index }}">
                  {{ $attr['name'] }}: {{ $value['name'] }} <i class="bi bi-x-lg ms-1"></i>
                </li>
                @endif
              @endforeach
            @endforeach
            <li class="list-group-item me-1 mb-1 delete-all">{{ __('common.delete_all') }}</li>
          </ul>
        </div>

        @if ($children)
          <div class="children-wrap mb-4 d-flex flex-wrap align-items-center gap-2">
            <span class="text-white-50 me-2" style="font-size: 14px;">{{ __('category.children') }}:</span>
            @foreach ($children as $item)
              <a href="{{ $item['url'] }}" class="cyber-tag-sm">{{ $item['name'] }}</a>
            @endforeach
          </div>
          <style>
            .cyber-tag-sm {
              background-color: rgba(255, 255, 255, 0.05);
              border: 1px solid rgba(255, 255, 255, 0.1);
              color: rgba(255, 255, 255, 0.8);
              padding: 4px 16px;
              font-size: 13px;
              border-radius: 50px;
              text-decoration: none;
              transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
              display: inline-block;
              font-weight: 500;
              letter-spacing: 0.5px;
            }
            .cyber-tag-sm:hover,
            .cyber-tag-sm:focus {
              background-color: rgba(0, 210, 255, 0.1);
              border-color: #00d2ff;
              color: #00d2ff;
              transform: translateY(-2px);
              outline: none;
              box-shadow: 0 4px 12px rgba(0, 210, 255, 0.2);
            }
            .cyber-tag-sm:active {
              transform: translateY(0);
              box-shadow: 0 2px 6px rgba(0, 210, 255, 0.2);
            }
          </style>
        @endif

        <div class="d-lg-none d-flex justify-content-between align-items-center mb-4">
          <h2 class="h5 fw-bold text-white mb-0">{{ $category->description->name }}</h2>
          <div class="mb-filter border border-light-subtle rounded px-3 py-2 text-white-50" style="cursor: pointer;"><i class="bi bi-funnel me-2"></i>Filter</div>
        </div>

        <div class="product-list-container">
          @if(count($products_format))
            @include('shared.filter_bar_block')
            <div class="row g-3 g-lg-4 {{ request('style_list') == 'list' ? 'product-list-wrap' : ''}}">
              @foreach ($products_format as $product)
                <div class="{{ !request('style_list') || request('style_list') == 'grid' ? 'col-6 col-sm-4 col-md-3 col-lg-4' : 'col-12'}}">
                  <div class="glass-card h-100">
                    @include('shared.product')
                  </div>
                </div>
              @endforeach
            </div>
          @else
          <x-shop-no-data />
        @endif

        {{ $products->links('shared/pagination/bootstrap-4') }}

        @hook('category.products.after')
      </div>
    </div>
  </div>
  </section>

@endsection

@push('add-scripts')
<script>
  let filterAttr = @json($filter_data['attr'] ?? []);
  const banliCategoryScrollKey = 'banli-category-scroll:' + window.location.pathname;

  $(function () {
    updateBanliHeaderOffset();

    const scrollY = sessionStorage.getItem(banliCategoryScrollKey);
    if (scrollY !== null) {
      sessionStorage.removeItem(banliCategoryScrollKey);
      setTimeout(function () {
        window.scrollTo({ top: Math.max(parseInt(scrollY, 10) || 0, 0), behavior: 'auto' });
      }, 80);
    }
  });

  $(window).on('load resize orientationchange', bk.debounce(updateBanliHeaderOffset, 120));

  function updateBanliHeaderOffset() {
    const header = document.querySelector('header');
    const height = header ? Math.ceil(header.getBoundingClientRect().height) : 0;

    if (height > 0) {
      document.documentElement.style.setProperty('--banli-header-height', height + 'px');
    }
  }

  $('.filter-value-wrap li').click(function(event) {
    let [attr, val] = [$(this).data('attr'),$(this).data('attrval')];
    if ($(this).hasClass('delete-all')) {
      return deleteFilterAll();
    }

    filterAttr[attr].values[val].selected = false;
    filterProductData();
  });

  if ($('.filter-value-wrap li').length > 1) {
    $('.filter-value-wrap').removeClass('d-none')
  }

  $('.attr-value-check').change(function(event) {
    let [attr, val] = [$(this).data('attr'),$(this).data('attrval')];
    filterAttr[attr].values[val].selected = $(this).is(":checked");
    filterProductData();
  });

  $('.form-select, input[name="style_list"]').change(function(event) {
    filterProductData();
  });

  if ($(window).width() < 992) {
    $('.mb-filter').on('click', function() {
      $('.left-column').fadeIn(0).find('.x-fixed-top').addClass('active');
    });
    $(document).on('click', '.left-column', function(e) {
      if ( $(e.target).closest('.x-fixed-top').length === 0 ) {
        $('.left-column .x-fixed-top').removeClass('active');
        setTimeout("$('.left-column').fadeOut(50)", 220);
      }
    });
  }

  function filterProductData() {
    let url = bk.removeURLParameters(window.location.href, 'attr', 'price', 'sort', 'order');
    let [psMin, psMax, pMin, pMax] = [$('.price-select-min').val(), $('.price-select-max').val(), $('.price-min').val(), $('.price-max').val()];
    let order = $('.order-select').val();
    let perpage = $('.perpage-select').val();
    let styleList = $('input[name="style_list"]:checked').val();

    layer.load(2, {shade: [0.3,'#fff'] })

    if (filterAttrChecked(filterAttr)) {
      url = bk.updateQueryStringParameter(url, 'attr', filterAttrChecked(filterAttr));
    }

    if ((psMin != pMin) || (psMax != pMax)) {
      url = bk.updateQueryStringParameter(url, 'price', `${psMin}-${psMax}`);
    }

    if (order) {
      let orderKeys = order.split('|');
      url = bk.updateQueryStringParameter(url, 'sort', orderKeys[0]);
      url = bk.updateQueryStringParameter(url, 'order', orderKeys[1]);
    }

    if (perpage) {
      url = bk.updateQueryStringParameter(url, 'per_page', perpage);
    }

    if (styleList) {
     url = bk.updateQueryStringParameter(url, 'style_list', styleList);
    }

    sessionStorage.setItem(banliCategoryScrollKey, String(window.scrollY));
    location = url;
  }

  function filterAttrChecked(data) {
    let filterAtKey = [];
    data.forEach((item) => {
      let checkedAtValues = [];
      item.values.forEach((val) => val.selected ? checkedAtValues.push(val.id) : '')
      if (checkedAtValues.length) {
        filterAtKey.push(`${item.id}:${checkedAtValues.join(',')}`)
      }
    })

    return filterAtKey.join('|')
  }

  function deleteFilterAll() {
    let url = bk.removeURLParameters(window.location.href, 'attr', 'price');
    sessionStorage.setItem(banliCategoryScrollKey, String(window.scrollY));
    location = url;
  }
</script>
@endpush
