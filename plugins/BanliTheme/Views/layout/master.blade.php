<!doctype html>
<html lang="{{ locale() }}" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ $shop_base_url }}">

    <!-- Title and Meta Description -->
    <title>@yield('title', system_setting('base.meta_title', 'BeikeShop开源好用的跨境电商系统'))</title>
    <meta name="keywords" content="@yield('keywords', system_setting('base.meta_keywords'))">
    <meta name="description" content="@yield('description', system_setting('base.meta_description'))">

    <!-- 引入 Manrope 科技感字体 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Open Graph Meta Tags -->
    <meta property="og:site_name" content="{{ system_setting('base.meta_title', 'BeikeShop') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="@yield('title', system_setting('base.meta_title', 'BeikeShop开源好用的跨境电商系统'))">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:description" content="@yield('description', system_setting('base.meta_description'))">
    <meta property="og:image" content="@yield('og_image', image_origin(system_setting('base.logo')))">
    <meta property="og:image:secure_url" content="@yield('og_image', image_origin(system_setting('base.logo')))">
    <meta property="og:image:width" content="@yield('og_image_width', '300')">
    <meta property="og:image:height" content="@yield('og_image_height', '300')">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', system_setting('base.meta_title', 'BeikeShop开源好用的跨境电商系统'))">
    <meta name="twitter:description" content="@yield('description', system_setting('base.meta_description'))">

    <!-- Generator Meta -->
    <meta name="generator" content="BeikeShop v{{ config('beike.version') }}({{ config('beike.build') }})">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ image_origin(system_setting('base.favicon')) }}">

    <!-- CSS and JS -->
    <!-- Removed BeikeShop default bootstrap to prevent conflicts -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ plugin_asset('banli_theme', '/public/build/beike/shop/banli_theme/css/bootstrap.css') }}"> -->
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/layer/3.5.1/layer.js') }}"></script>
    <script src="{{ asset('vendor/lazysizes/lazysizes.min.js') }}" defer></script>
    
    <!-- BeikeShop Core Vue/JS (Required for Editor) -->
    <script src="{{ asset('vendor/vue/2.7/vue' . (!config('app.debug') ? '.min' : '') . '.js') }}"></script>
    
    @if(request()->query('design') == 1)
      <!-- Load BeikeShop's core js to enable Editor click events when in Design Mode -->
      <script src="{{ asset('build/beike/shop/default/js/app.js') }}"></script>
    @endif
    <!-- <script src="{{ asset('build/beike/shop/banli_theme/js/app.js') }}"></script> -->

    <script>
      // 定义全局 bk 对象以防止 jQuery 异常
      window.bk = window.bk || {};
      window.bk.debounce = function(func, wait) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
      };
    </script>
    <script src="{{ asset('build/beike/shop/banli_theme/js/app.js') }}?v=banli-layout-20260623-1"></script>
    <!-- Removed BeikeShop default app.css to prevent conflicts -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('build/beike/shop/banli_theme/css/app.css') }}"> -->

    <!-- Cyber Theme CSS (Load last to override defaults) -->
    <link href="{{ asset('build/beike/shop/banli_theme/banli_theme/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{ asset('build/beike/shop/banli_theme/banli_theme/css/vendors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/beike/shop/banli_theme/banli_theme/css/style.css') }}?v=banli-layout-20260623-1" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/beike/shop/banli_theme/banli_theme/css/colors/scheme-01.css') }}" rel="stylesheet" type="text/css" id="colors">

    @if(request()->query('design') == 1)
    <style>
        .modules-box .module-item {
            position: relative;
        }
        .modules-box .module-item.module-item-design:after {
            content: '';
            display: none;
            position: absolute;
            left: 2px; right: 2px; top: 2px; bottom: 2px;
            z-index: 9999;
            border-radius: var(--bs-border-radius);
            cursor: pointer;
        }
        .modules-box .module-item.module-item-design.currently-editing:after {
            display: block;
            outline: 3px solid #0072ff;
            background: rgba(0, 114, 255, 0.1);
        }
        .modules-box .module-item.module-item-design:hover:not(.currently-editing):after {
            display: block;
            outline: 2px dashed #0072ff;
            background: rgba(0, 114, 255, 0.05);
        }
    </style>
    @endif

    @if (system_setting('base.head_code'))
      {!! system_setting('base.head_code') !!}
    @endif

    @hook('layout.header.code')
    @stack('header')

    @renderStyles
    <style>
      :root {
        --banli-header-height: 104px;
        --banli-z-content: 0;
        --banli-z-sticky: 50;
        --banli-z-header: 1000;
        --banli-z-dropdown: 1100;
        --banli-z-backdrop: 2190;
        --banli-z-offcanvas: 2200;
        --banli-z-modal: 2400;
        --banli-z-editor: 9000;
      }
      html {
        background: #101139;
        overflow-y: auto;
        scrollbar-color: rgba(255,255,255,0.28) #101139;
      }
      body {
        background: #101435;
        min-height: 100%;
        overflow-x: clip !important;
        overflow-y: visible !important;
      }
      html::-webkit-scrollbar {
        width: 8px;
      }
      html::-webkit-scrollbar-track {
        background: #101139;
      }
      html::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.28);
        border-radius: 999px;
      }
      html::-webkit-scrollbar-thumb:hover {
        background: rgba(255,255,255,0.42);
      }
      #wrapper {
        overflow-x: clip !important;
        overflow-y: visible !important;
      }
      .scrollbar,
      body:not(.page-home) .scrollbar-v,
      body:not(.page-home) .float-text {
        display: none !important;
      }
      #offcanvas-mobile-menu,
      #offcanvas-right-cart,
      #offcanvas-search-top {
        position: fixed !important;
        z-index: var(--banli-z-offcanvas);
      }
      #offcanvas-mobile-menu,
      #offcanvas-right-cart {
        top: 0 !important;
        bottom: 0 !important;
        height: 100vh !important;
        height: 100dvh !important;
        max-height: 100vh !important;
        max-height: 100dvh !important;
        overflow: hidden !important;
      }
      .banli-product-quick-view-layer {
        overflow: hidden !important;
        border: 1px solid rgba(0, 210, 255, 0.24);
        border-radius: 12px;
        background: #101435;
        box-shadow: 0 28px 80px rgba(0, 0, 0, 0.48);
      }
      .banli-product-quick-view-layer .layui-layer-content,
      .banli-product-quick-view-layer iframe {
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
        border-radius: inherit;
        background: #101435;
      }
      .banli-product-quick-view-layer .layui-layer-setwin {
        top: 12px;
        right: 12px;
        z-index: 2;
      }
      .banli-product-quick-view-layer .layui-layer-setwin .layui-layer-close2 {
        right: 0;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: rgba(16, 20, 53, 0.82);
        box-shadow: 0 0 0 1px rgba(255,255,255,0.14);
      }
      body.page-product-quick-view #wrapper {
        padding-top: 0 !important;
      }
      @media (max-width: 575.98px) {
        .banli-product-quick-view-layer {
          border-radius: 0;
          border-left: 0;
          border-right: 0;
        }
      }
      @media (max-width: 991.98px) {
        :root {
          --banli-header-height: 176px;
        }
      }
      header.smaller {
        background: rgba(16, 20, 53, 0.75) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.4s ease;
      }
      header.smaller .top-wrap {
        display: none !important;
      }
      header {
        transition: all 0.4s ease;
      }
      /* Prevent content overlap with absolute header on non-home pages */
      body:not(.page-home):not(.banli-news-list):not(.banli-news-single) #wrapper {
        padding-top: var(--banli-header-height, 104px);
      }
      body:not(.page-home):not(.banli-news-list):not(.banli-news-single) header.transparent {
        background: #101435;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: var(--banli-z-header);
      }
      body:not(.page-home) .breadcrumb-filter {
        padding-top: 20px;
        padding-bottom: 20px;
      }
      .breadcrumb-filter .breadcrumb {
        margin-bottom: 0;
      }
      .breadcrumb-filter .breadcrumb-item,
      .breadcrumb-filter .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
      }
      .breadcrumb-filter .breadcrumb-item.active {
        color: #fff;
        font-weight: 500;
      }
      .breadcrumb-filter .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.4);
      }
      
      /* Fix search popover styles for dark theme */
      #offcanvas-search-top {
        background-color: rgba(16, 20, 53, 0.98) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        color: #fff;
        height: 100vh !important;
        height: 100dvh !important;
        max-height: 100vh;
        max-height: 100dvh;
        overflow-y: auto;
        overscroll-behavior: contain;
        border-bottom: 1px solid rgba(0, 210, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        z-index: var(--banli-z-offcanvas);
      }
      body.banli-search-open .offcanvas-backdrop,
      body.banli-search-open .modal-backdrop {
        z-index: var(--banli-z-backdrop);
      }
      .dropdown-menu {
        z-index: var(--banli-z-dropdown);
      }
      .modal {
        z-index: var(--banli-z-modal) !important;
      }
      #offcanvas-search-top .container {
        max-width: 1304px;
        padding-top: 28px;
        padding-bottom: 48px;
      }
      #offcanvas-search-top .offcanvas-header {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 48px;
        gap: 16px;
        align-items: center;
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 30px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 30px;
      }
      #offcanvas-search-top .search-input-wrap {
        flex-wrap: nowrap;
        min-width: 0;
        min-height: 64px;
      }
      #offcanvas-search-top .search-popover-input {
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        border-radius: 8px 0 0 8px;
        padding: 15px 25px;
        min-width: 0;
        min-height: 64px;
        line-height: 1.2;
      }
      #offcanvas-search-top .search-popover-input:focus {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: #00d2ff;
        box-shadow: 0 0 0 0.25rem rgba(0, 210, 255, 0.15);
      }
      #offcanvas-search-top .input-group-text {
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #00d2ff;
        border-radius: 0 8px 8px 0;
        width: 68px;
        flex: 0 0 68px;
        justify-content: center;
        padding: 0;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      #offcanvas-search-top .input-group-text svg {
        display: block;
        width: 22px;
        height: 22px;
      }
      #offcanvas-search-top .input-group-text:hover {
        background-color: #00d2ff;
        color: #000;
        border-color: #00d2ff;
      }
      #offcanvas-search-top .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
        margin-left: 20px;
        opacity: 0.5;
        transition: opacity 0.3s ease;
        justify-self: end;
      }
      #offcanvas-search-top .btn-close:hover {
        opacity: 1;
      }
      #offcanvas-search-top h5 {
        color: #fff;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
      }
      #offcanvas-search-top h5::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 16px;
        background-color: #00d2ff;
        margin-right: 10px;
        border-radius: 2px;
      }
      #offcanvas-search-top .hot-search-list {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        padding-left: 0;
        margin-top: 20px;
      }
      #offcanvas-search-top .search-pop-products-wrap {
        position: relative;
        min-height: 180px;
      }
      #offcanvas-search-top .search-pop-products-wrap .spinner-border {
        display: none;
        position: absolute;
        top: 54px;
        left: 0;
        width: 34px;
        height: 34px;
        color: #00d2ff;
        z-index: 2;
      }
      #offcanvas-search-top .search-pop-products-wrap.loading .spinner-border {
        display: inline-block;
      }
      #offcanvas-search-top .search-pop-products-wrap.loading .sp-products {
        opacity: .35;
        pointer-events: none;
      }
      #offcanvas-search-top .sp-products .product-wrap .image {
        aspect-ratio: 1;
        background: #fff;
      }
      #offcanvas-search-top .sp-products .product-wrap .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      #offcanvas-search-top .cyber-tag {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.8);
        padding: 8px 20px;
        font-size: 14px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        font-weight: 500;
        letter-spacing: 0.5px;
      }
      #offcanvas-search-top .cyber-tag:hover,
      #offcanvas-search-top .cyber-tag:focus {
        background-color: rgba(0, 210, 255, 0.1);
        border-color: #00d2ff;
        color: #00d2ff;
        transform: translateY(-2px);
        outline: none;
        box-shadow: 0 4px 12px rgba(0, 210, 255, 0.2);
      }
      #offcanvas-search-top .cyber-tag:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(0, 210, 255, 0.2);
      }
      
      /* Hide original cart button outside hover area to avoid duplication */
      .product-wrap > .button-wrap {
        display: none !important;
      }
      
      /* Rotate Animation */
      @keyframes rotate-animation {
        0% { transform: rotate(0deg); }
        50% { transform: rotate(180deg); }
        100% { transform: rotate(360deg); }
      }
      .rotate-animation {
        animation: rotate-animation 10s infinite linear;
      }
      .product-wrap .image {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
      }
      .product-wrap .image .image-after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transform: scale(1);
        transition: all 0.4s ease-out;
      }
      .product-wrap:hover .image .image-after {
        opacity: 1;
        z-index: 9;
        transform: scale(1.1);
      }
      .product-wrap .image .image-before {
        width: 100%;
        transition: opacity 0.4s ease;
      }
      .product-wrap .image .button-wrap {
        width: 100%;
        position: absolute;
        z-index: 40;
        bottom: -50px;
        opacity: 0;
        display: flex;
        justify-content: center;
        gap: 8px;
        min-width: 0;
        transition: all .3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }
      .product-wrap:hover .image .button-wrap {
        bottom: 15px;
        opacity: 1;
      }
      .product-wrap .image .button-wrap .btn {
        background:
          linear-gradient(180deg, rgba(38, 43, 82, 0.92), rgba(25, 30, 62, 0.92)) !important;
        border: 1px solid rgba(144, 118, 255, 0.42) !important;
        color: #fff !important;
        border-radius: 50px;
        padding: 8px 16px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
        min-width: 0;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.28);
      }
      .product-wrap .image .button-wrap .btn-add-cart {
        background:
          linear-gradient(135deg, rgba(122, 76, 243, 0.96), rgba(45, 111, 242, 0.94)) !important;
        border-color: rgba(255, 255, 255, 0.18) !important;
        color: #fff !important;
        box-shadow: 0 14px 30px rgba(74, 90, 220, 0.34);
      }
      .product-wrap .image .button-wrap .btn:hover {
        background:
          linear-gradient(135deg, rgba(151, 105, 255, 0.98), rgba(54, 126, 255, 0.96)) !important;
        border-color: rgba(255, 255, 255, 0.26) !important;
        color: #fff !important;
        transform: translateY(-3px);
        box-shadow: 0 16px 34px rgba(74, 90, 220, 0.42);
      }
      .product-wrap .product-bottom-info {
        padding-top: 15px;
      }
      @media (max-width: 576px) {
        .product-wrap:not(.list) .image .button-wrap {
          opacity: 1;
          bottom: 10px;
          gap: 6px !important;
        }
        .product-wrap:not(.list) .image .button-wrap .btn {
          width: 36px !important;
          height: 36px !important;
          padding: 0 !important;
          flex: 0 0 36px !important;
          border-radius: 50% !important;
          justify-content: center;
        }
        .product-wrap:not(.list) .image .button-wrap .btn i,
        .product-wrap:not(.list) .image .button-wrap .btn svg {
          width: 16px !important;
          height: 16px !important;
          margin: 0 !important;
        }
        .product-wrap:not(.list) .image .button-wrap .btn span {
          display: none !important;
        }
      }
      .btn-wishlist .bi-heart-fill .icon-empty { display: none !important; }
      .btn-wishlist .bi-heart-fill .icon-fill { display: block !important; }
      .btn-wishlist .bi-heart .icon-empty { display: block !important; }
      .btn-wishlist .bi-heart .icon-fill { display: none !important; }
    </style>
    <style>
      .glass-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 20px; transition: all 0.3s; }
      .glass-card:hover { border-color: rgba(0,210,255,0.5); box-shadow: 0 0 15px rgba(0,210,255,0.2); }
      .btn-neon { background: linear-gradient(90deg, #6a11cb, #2575fc); color: white; border: none; box-shadow: 0 0 10px rgba(37,117,252,0.5); }
      .form-control-dark { background: rgba(0,0,0,0.3); border: 1px solid #444; color: #fff; }
    </style>
  </head>
<body class="@yield('body-class') {{ request('_from') }} dark-scheme">
  <div id="wrapper">
    @if (!request('iframe') && request('_from') != 'app')
      <div class="float-text show-on-scroll">
        <span><a href="#" aria-label="Scroll to top">Scroll to top</a></span>
      </div>
      <div class="scrollbar-v show-on-scroll" aria-hidden="true"></div>
    @endif

    @if(trim($__env->yieldContent('bk-page-loading')))
      @include('shared.bk-page-loading')
    @endif
    @if (!request('iframe') && request('_from') != 'app')
      @hook('layout.master.header.before')
      @include('layout.header')
      @hook('layout.master.header.after')
    @endif

    @hook('layout.master.content.before')
    @yield('content')
    @hook('layout.master.content.after')

    @if (!request('iframe') && request('_from') != 'app')
      @hook('layout.master.footer.before')
      @include('layout.footer')
      @hook('layout.master.footer.after')
    @endif
  </div>

  <script>
    @hook('layout.master.script.before')

    (function () {
      let lastHeight = 0;

      function updateBanliHeaderHeight() {
        const header = document.querySelector('header');
        const height = header ? Math.ceil(header.getBoundingClientRect().height) : 0;

        if (height > 0 && height !== lastHeight) {
          lastHeight = height;
          document.documentElement.style.setProperty('--banli-header-height', height + 'px');
        }
      }

      window.updateBanliHeaderHeight = updateBanliHeaderHeight;
      document.addEventListener('DOMContentLoaded', updateBanliHeaderHeight);
      window.addEventListener('load', updateBanliHeaderHeight);
      window.addEventListener('resize', bk.debounce(updateBanliHeaderHeight, 120));
      window.addEventListener('orientationchange', bk.debounce(updateBanliHeaderHeight, 120));
      window.addEventListener('scroll', bk.debounce(updateBanliHeaderHeight, 80), {passive: true});
    }());

    const config = {
      isLogin: !!{{ current_customer()->id ?? 'null' }},
      guestCheckout: !!{{ system_setting('base.guest_checkout', 1) }},
      loginShowPrice: !!{{ system_setting('base.show_price_after_login', 0) }},
      productImageOriginWidth: @json((int)system_setting('base.product_image_origin_width', 800)),
      productImageOriginHeight: @json((int)system_setting('base.product_image_origin_height', 800)),
    }

    // 如果页面使用了ElementUI，且当前语言不是中文，则加载对应的语言包
    @if (locale() != 'zh_cn')
    if (typeof ELEMENT !== 'undefined') {
        const elLocale = '{{ asset('vendor/element-ui/language/'.locale().'.js') }}';
        document.write("<script src='" + elLocale + "'><\/script>")

        $(function () {
          setTimeout(() => {
            ELEMENT.locale(ELEMENT.lang['{{ locale() }}'])
          }, 0);
        })
      }
    @endif
  </script>

  @if (strpos($_SERVER['SERVER_SOFTWARE'], 'nginx') !== false)
    <div class="nginx-alert d-none">{!! __('shop/common.nginx_alert') !!}</div>
  @endif

  <script src="{{ asset('build/beike/shop/banli_theme/banli_theme/js/vendors.js') }}"></script>
  <script src="{{ asset('build/beike/shop/banli_theme/banli_theme/js/designesia.js') }}"></script>
  <script src="{{ asset('build/beike/shop/banli_theme/banli_theme/js/countdown-custom.js') }}"></script>
  <script src="{{ asset('build/beike/shop/banli_theme/banli_theme/js/custom-marquee.js') }}"></script>
  <script>
    $(document).ready(function() {
        if(typeof WOW !== 'undefined') {
            new WOW().init();
        } else {
            console.error("WOW is undefined!");
            $('.wow').css('visibility', 'visible').css('animation-name', 'none');
        }
    });
  </script>

  @renderScripts
  @stack('add-scripts')
  @hook('layout.master.footer.code')
</body>
<!-- BeikeShop v{{ config('beike.version') }}({{ config('beike.build') }}) -->
</html>
