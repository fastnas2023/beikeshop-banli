@extends('layout.master')
@section('body-class', 'page-brand-detail bg-dark text-light')
@section('title', $brand->name)
@php
  $brandProductsText = locale() == 'zh_cn'
    ? $products->total() . ' 件商品'
    : $products->total() . ' items';
  $brandLogo = trim((string) ($brand->logo ?? ''));
  $demoBrandLogos = [
    'gucci' => 'banli_theme-assets/brand-logos/gucci.png',
    'valentino' => 'banli_theme-assets/brand-logos/valentino.png',
    'balenciaga' => 'banli_theme-assets/brand-logos/balenciaga.png',
    'saint-laurent' => 'banli_theme-assets/brand-logos/saint-laurent.png',
    'louis-vuitton' => 'banli_theme-assets/brand-logos/louis-vuitton.png',
    'prada' => 'banli_theme-assets/brand-logos/prada.png',
    'chanel' => 'banli_theme-assets/brand-logos/chanel.png',
    'dior' => 'banli_theme-assets/brand-logos/dior.png',
    'armani' => 'banli_theme-assets/brand-logos/armani.png',
    'burberry' => 'banli_theme-assets/brand-logos/burberry.png',
    'versace' => 'banli_theme-assets/brand-logos/versace.png',
    'hermes' => 'banli_theme-assets/brand-logos/hermes.png',
  ];
  $brandKey = str_replace([' ', 'è', 'é'], ['-', 'e', 'e'], strtolower($brand->name));

  if ($brandLogo && (str_contains($brandLogo, 'banli_theme-assets/sponsors/') || str_contains($brandLogo, 'image/catalog/demo/brands/')) && isset($demoBrandLogos[$brandKey])) {
    $brandLogo = image_origin($demoBrandLogos[$brandKey]) . '?v=20260609';
  } elseif ($brandLogo) {
    $brandLogo = image_origin($brandLogo);
  }
@endphp

@push('header')
  <style>
    body.page-brand-detail {
      background: #101435;
    }
    body.page-brand-detail #wrapper {
      padding-top: var(--banli-header-height, clamp(7rem, 8vw, 8.25rem)) !important;
    }
    .banli-brand-page {
      padding: clamp(1rem, 1.8vw, 1.75rem) 0 clamp(4rem, 7vw, 5.5rem);
      background:
        radial-gradient(circle at 82% 8%, rgba(122, 76, 243, .16), transparent 36%),
        radial-gradient(circle at 12% 18%, rgba(0, 210, 255, .10), transparent 34%),
        #101435;
    }
    .banli-brand-hero {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      margin-bottom: clamp(1rem, 1.7vw, 1.375rem);
      padding: clamp(26px, 3vw, 44px);
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 8px;
      background: rgba(255,255,255,.025);
      box-shadow:
        0 24px 64px rgba(0,0,0,.22),
        inset 0 1px 0 rgba(255,255,255,.08);
    }
    .banli-brand-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -2;
      border-radius: inherit;
      background: url('{{ asset('banli_theme-assets/aivent/images/background/5.webp') }}') center 42% / cover no-repeat;
      transform: scale(1.006);
    }
    .banli-brand-hero::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -1;
      pointer-events: none;
      border-radius: inherit;
      background:
        radial-gradient(circle at 86% 52%, rgba(122, 76, 243, .16), transparent 30%),
        linear-gradient(180deg, rgba(16,20,53,.18), rgba(16,20,53,.06) 34%, rgba(16,20,53,.22)),
        linear-gradient(90deg, rgba(16,20,53,.88), rgba(16,20,53,.58) 54%, rgba(16,20,53,.78));
      box-shadow: inset 0 1px 0 rgba(255,255,255,.10), inset 0 -1px 0 rgba(255,255,255,.08);
    }
    .banli-brand-hero > .row {
      position: relative;
      z-index: 1;
      min-height: clamp(220px, 21vw, 286px);
      align-items: center;
    }
    .banli-brand-kicker {
      display: inline-flex;
      margin-bottom: 14px;
      color: #8b6dff;
      font-size: 14px;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
    }
    .banli-brand-hero h1 {
      margin: 0;
      color: #fff;
      font-size: clamp(34px, 4vw, 64px);
      line-height: 1.08;
      letter-spacing: 0;
    }
    .banli-brand-hero p {
      max-width: 640px;
      margin: 18px 0 0;
      color: rgba(255,255,255,.72);
      font-size: 17px;
      line-height: 1.75;
    }
    .banli-brand-logo {
      width: min(clamp(10rem, 18vw, 13.75rem), 100%);
      aspect-ratio: 1.45;
      margin-left: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(13,17,48,.58);
      box-shadow: 0 20px 45px rgba(0,0,0,.24), inset 0 1px 0 rgba(255,255,255,.06);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
    }
    .banli-brand-logo img {
      max-width: 82%;
      max-height: 70%;
      object-fit: contain;
      filter: saturate(.9);
    }
    body.page-brand-detail .breadcrumb-wrap {
      margin: 0 0 clamp(1.25rem, 2vw, 1.625rem) !important;
      padding: 0 !important;
      overflow: visible;
      background: transparent !important;
    }
    body.page-brand-detail .breadcrumb-wrap .container {
      width: 100%;
      min-height: 2.875rem;
      padding: .55rem 1.125rem;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 8px;
      background: rgba(255,255,255,.025) !important;
    }
    body.page-brand-detail .breadcrumb-wrap .breadcrumb {
      min-height: 1.625rem;
      margin: 0;
      padding: 0 !important;
      align-items: center;
      row-gap: .25rem;
    }
    body.page-brand-detail .breadcrumb-item,
    body.page-brand-detail .breadcrumb-item a {
      color: rgba(255,255,255,.62);
      text-decoration: none;
    }
    body.page-brand-detail .breadcrumb-item.active {
      color: rgba(255,255,255,.82);
      font-weight: 700;
    }
    .banli-brand-products .glass-card {
      height: 100%;
      overflow: hidden;
      padding: 0;
      background: rgba(255,255,255,.035);
      border: 1px solid rgba(255,255,255,.09);
      border-radius: 8px;
      box-shadow: 0 14px 34px rgba(0,0,0,.14);
      transition: border-color .18s ease, transform .18s ease, box-shadow .18s ease, background .18s ease;
    }
    .banli-brand-products .glass-card:hover {
      background: rgba(255,255,255,.045);
      border-color: rgba(0,210,255,.28);
      box-shadow: 0 18px 42px rgba(0,0,0,.22);
      transform: translateY(-2px);
    }
    .banli-brand-products .product-wrap {
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .banli-brand-products .product-wrap .image {
      border-radius: 8px 8px 0 0 !important;
      background: #fff;
      aspect-ratio: 1;
    }
    .banli-brand-products .product-wrap .image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .banli-brand-products .product-bottom-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 16px 16px 18px;
    }
    .banli-brand-products .product-name {
      color: #fff;
      font-weight: 750;
      line-height: 1.5;
      min-height: 54px;
      display: -webkit-box;
      overflow: hidden;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
    .banli-brand-products .product-price {
      margin-top: 12px;
      display: flex;
      align-items: baseline;
      gap: 12px;
      flex-wrap: wrap;
      min-height: 56px;
    }
    .banli-brand-products .price-new {
      display: block;
      max-width: 100%;
      font-size: 20px;
      line-height: 1;
      overflow-wrap: anywhere;
    }
    .banli-brand-products .price-old {
      margin-left: 0 !important;
      font-size: 14px;
      line-height: 1.2;
    }
    .banli-brand-products .price-old-placeholder {
      visibility: hidden;
    }
    @media (max-width: 991.98px) {
      body.page-brand-detail #wrapper {
        padding-top: var(--banli-header-height, clamp(10rem, 45vw, 11rem)) !important;
      }
      .banli-brand-hero {
        padding: clamp(1.25rem, 6vw, 1.5rem);
      }
      .banli-brand-hero h1 {
        font-size: clamp(32px, 10vw, 44px);
      }
      .banli-brand-hero p {
        font-size: 14px;
        line-height: 1.65;
      }
      .banli-brand-logo {
        width: min(clamp(8.5rem, 46vw, 11.25rem), 100%);
        margin: 4px auto 0;
      }
      .banli-brand-products .product-price {
        min-height: 62px;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 8px;
      }
      .banli-brand-products .price-new {
        font-size: clamp(22px, 7.2vw, 30px);
        line-height: 1.05;
      }
      .banli-brand-products .price-old {
        display: block;
        min-height: 18px;
        font-size: 14px;
        line-height: 1.25;
      }
    }
  </style>
@endpush

@section('content')
  <section class="banli-brand-page">
    <div class="container">
      <div class="banli-brand-hero">
        <div class="row g-4 align-items-center">
          <div class="{{ $brandLogo ? 'col-12 col-lg-9' : 'col-12' }}">
            <div class="banli-brand-kicker">{{ __('shop/brands.index') }}</div>
            <h1>{{ $brand->name }}</h1>
            <p>{{ __('product.brand') }} {{ $brand->name }} · {{ $brandProductsText }}</p>
          </div>
          @if($brandLogo)
            <div class="col-12 col-lg-3">
              <div class="banli-brand-logo">
                <img src="{{ $brandLogo }}" alt="{{ $brand->name }}">
              </div>
            </div>
          @endif
        </div>
      </div>

      <x-shop-breadcrumb type="brand" :value="$brand" />

      @hook('brand.info.before')
      <div class="banli-brand-products">
        @if (count($products_format))
          <div class="row g-3 g-lg-4">
            @foreach ($products_format as $product)
              <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                <div class="glass-card">
                  @include('shared.product')
                </div>
              </div>
            @endforeach
          </div>
        @else
          <x-shop-no-data />
        @endif

        {{ $products->links('shared/pagination/bootstrap-4') }}
      </div>
      @hook('brand.info.after')
    </div>
  </section>
@endsection

@push('add-scripts')
  <script>
    updateBanliBrandHeaderOffset();
    $(window).on('load resize orientationchange', bk.debounce(updateBanliBrandHeaderOffset, 120));

    function updateBanliBrandHeaderOffset() {
      const header = document.querySelector('header');
      const height = header ? Math.ceil(header.getBoundingClientRect().height) : 0;

      if (height > 0) {
        document.documentElement.style.setProperty('--banli-header-height', height + 'px');
      }
    }
  </script>
@endpush
