@extends('layout.master')
@section('body-class', 'page-product' . (request('iframe') ? ' page-product-quick-view' : ''))
@section('title', $product['meta_title'] ?: $product['name'])
@section('keywords', $product['meta_keywords'] ?: system_setting('base.meta_keyword'))
@section('description', $product['meta_description'] ?: system_setting('base.meta_description'))
@section('og_type', 'product')
@section('og_image', $product['images'][0]['popup'] ?? '')
@section('og_image_width', system_setting('base.product_image_origin_width'))
@section('og_image_height', system_setting('base.product_image_origin_height'))

@section('bk-page-loading', true)

@addScript(asset('vendor/vue/2.7/vue' . (!config('app.debug') ? '.min' : '') . '.js'))
@addStyle(asset('vendor/swiper/swiper-bundle.min.css'))
@addScript(asset('vendor/swiper/swiper-bundle.min.js'))

@push('header')
  @if ($has_video)
    <script src="{{ asset('vendor/video/video.min.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('vendor/video/video-js.min.css') }}">
  @endif
  <style id="product-hide-elements">
    .product-description, .relations-wrap, footer {
      display: none;
    }
  </style>
  <style>
    /* Dark tech theme tabs */
    .page-product #content {
      background: #101435;
    }
    .banli-product-page {
      min-height: 100vh;
      padding: 0 0 72px;
      background:
        radial-gradient(circle at 78% 8%, rgba(122, 76, 243, .10), transparent 32%),
        radial-gradient(circle at 18% 14%, rgba(64, 102, 175, .10), transparent 30%),
        linear-gradient(180deg, rgba(255,255,255,.014), rgba(255,255,255,0) 260px),
        #0e122a;
    }
    body.page-product:not(.page-product-quick-view) .breadcrumb-filter,
    body.page-product:not(.page-product-quick-view) .breadcrumb-wrap {
      display: block !important;
      margin: 0 0 clamp(14px, 1.2vw, 18px) !important;
      padding: 0 !important;
      border-top: 1px solid rgba(255,255,255,.045);
      border-bottom: 1px solid rgba(255,255,255,.075);
      background: rgba(255,255,255,.018) !important;
    }
    body.page-product:not(.page-product-quick-view) .breadcrumb-filter .container,
    body.page-product:not(.page-product-quick-view) .breadcrumb-wrap .container,
    body.page-product:not(.page-product-quick-view) .breadcrumb-filter .container-fluid,
    body.page-product:not(.page-product-quick-view) .breadcrumb-wrap .container-fluid {
      min-height: 42px;
      display: flex;
      align-items: center;
      max-width: 1920px;
      padding-left: clamp(20px, 2.4vw, 48px);
      padding-right: clamp(20px, 2.4vw, 48px);
    }
    body.page-product:not(.page-product-quick-view) .breadcrumb-filter nav,
    body.page-product:not(.page-product-quick-view) .breadcrumb-wrap nav {
      width: 100%;
    }
    body.page-product .breadcrumb-filter .breadcrumb,
    body.page-product .breadcrumb-wrap .breadcrumb {
      min-width: 0;
      flex-wrap: nowrap;
      overflow: hidden;
      margin: 0;
      padding: 0;
    }
    body.page-product .breadcrumb-filter .breadcrumb-item,
    body.page-product .breadcrumb-wrap .breadcrumb-item {
      min-width: 0;
      flex: 0 0 auto;
      color: rgba(247,247,244,.48) !important;
      font-size: 13px;
      font-weight: 500;
      line-height: 1.4;
    }
    body.page-product .breadcrumb-filter .breadcrumb-item a,
    body.page-product .breadcrumb-wrap .breadcrumb-item a {
      color: rgba(247,247,244,.54) !important;
      text-decoration: none;
      transition: color .2s ease;
    }
    body.page-product .breadcrumb-filter .breadcrumb-item a:hover,
    body.page-product .breadcrumb-wrap .breadcrumb-item a:hover {
      color: rgba(247,247,244,.9) !important;
    }
    body.page-product .breadcrumb-filter .breadcrumb-item + .breadcrumb-item::before,
    body.page-product .breadcrumb-wrap .breadcrumb-item + .breadcrumb-item::before {
      color: rgba(247,247,244,.22) !important;
    }
    body.page-product .breadcrumb-filter .breadcrumb-item.active,
    body.page-product .breadcrumb-wrap .breadcrumb-item:last-child {
      flex: 1 1 auto;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      color: rgba(247,247,244,.72) !important;
      font-weight: 600 !important;
    }
    .banli-product-top {
      --bs-gutter-y: 0;
      align-items: stretch;
      margin-bottom: 0 !important;
      padding: clamp(18px, 1.8vw, 28px);
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      background:
        radial-gradient(circle at 82% 16%, rgba(67, 95, 160, .11), transparent 32%),
        linear-gradient(180deg, rgba(255,255,255,.026), rgba(255,255,255,.012));
      box-shadow: inset 0 1px 0 rgba(255,255,255,.045);
    }
    .banli-product-page .product-container {
      max-width: 1920px;
      padding-left: clamp(20px, 2.4vw, 48px);
      padding-right: clamp(20px, 2.4vw, 48px);
    }
    .banli-product-page .product-image {
      position: relative;
      height: auto;
      display: grid;
      grid-template-columns: 82px minmax(0, 1fr);
      gap: 18px;
      padding: 0;
      overflow: hidden;
      border: 0;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
    }
    .banli-product-page .product-image::before {
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      background:
        radial-gradient(circle at 18% 8%, rgba(95,125,190,.08), transparent 32%),
        linear-gradient(90deg, rgba(255,255,255,.035), transparent 34%);
    }
    .banli-product-page .product-image > * {
      position: relative;
      z-index: 1;
    }
    .banli-product-page .product-image .left {
      width: 82px;
      min-width: 0;
    }
    .banli-product-page .product-image .right,
    .banli-product-page .product-img,
    .banli-product-page #swiper-mobile {
      height: clamp(470px, 33vw, 540px);
      min-height: 470px;
      border-radius: 8px;
      overflow: hidden;
      background:
        linear-gradient(180deg, #f9f9fb, #ffffff);
      box-shadow: inset 0 0 0 1px rgba(16,20,53,.06);
    }
    .banli-product-page .product-img {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .banli-product-page .product-img img,
    .banli-product-page #swiper-mobile img {
      width: 100% !important;
      height: 100% !important;
      object-fit: contain;
      object-position: center center;
    }
    .banli-product-page .product-left-thumb-wrap {
      height: clamp(470px, 33vw, 540px);
    }
    .banli-product-page .product-left-thumb-wrap .swiper-slide {
      width: 74px !important;
      height: 74px !important;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid rgba(255,255,255,.12);
      background: #fff;
      opacity: .72;
      box-shadow: inset 0 0 0 1px rgba(16,20,53,.05);
      transition: opacity .2s ease, border-color .2s ease, transform .2s ease, box-shadow .2s ease;
    }
    .banli-product-page .product-left-thumb-wrap .swiper-slide.active {
      opacity: 1;
      border-color: rgba(140, 164, 220, .68);
      transform: translateY(-1px);
      box-shadow: 0 0 0 3px rgba(140, 164, 220, .12), 0 8px 18px rgba(0,0,0,.16);
    }
    .banli-product-page .product-left-thumb-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .banli-product-page .peoduct-info {
      position: relative;
      overflow: visible;
      height: 100%;
      min-height: 0;
      padding: clamp(12px, 1.3vw, 18px) clamp(8px, 1.2vw, 18px) !important;
      border: 0;
      border-radius: 0 !important;
      background: transparent;
      box-shadow: none;
    }
    .banli-product-page .peoduct-info::before {
      content: none;
    }
    .banli-product-page .peoduct-info > * {
      position: relative;
      z-index: 1;
    }
    .banli-product-page .banli-product-eyebrow {
      margin: 0 0 16px;
      color: rgba(247,247,244,.62);
      font-size: 12px;
      font-weight: 500;
      letter-spacing: .22em;
      line-height: 1.4;
      text-transform: uppercase;
    }
    .banli-product-page .peoduct-info .product-name {
      display: -webkit-box;
      max-width: 680px;
      margin-bottom: 14px !important;
      overflow: hidden;
      color: rgba(247,247,244,.96);
      font-size: clamp(21px, 1.34vw, 26px) !important;
      font-weight: 400 !important;
      line-height: 1.38 !important;
      letter-spacing: .075em;
      text-transform: uppercase;
      -webkit-line-clamp: 5;
      -webkit-box-orient: vertical;
    }
    .banli-product-page .price-wrap {
      margin: 12px 0 14px;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(255,255,255,.10);
    }
    .banli-product-page .new-price {
      color: rgba(247,247,244,.96) !important;
      font-size: clamp(24px, 1.8vw, 32px) !important;
      font-weight: 500 !important;
      letter-spacing: .015em;
      text-shadow: none;
    }
    .banli-product-page .old-price {
      color: rgba(247,247,244,.42) !important;
      font-size: 15px;
      font-weight: 600;
    }
    .banli-product-page .stock-and-sku {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 8px 18px;
      margin: 0 0 18px !important;
      color: rgba(255,255,255,.78);
    }
    .banli-product-page .stock-and-sku .d-lg-flex {
      display: flex !important;
      min-height: auto;
      align-items: center;
      padding: 0;
      border: 0;
      border-radius: 0;
      background: transparent;
      font-size: 13px;
    }
    .banli-product-page .stock-and-sku .d-lg-flex + .d-lg-flex::before {
      content: "|";
      margin-right: 18px;
      color: rgba(255,255,255,.22);
    }
    .banli-product-page .stock-and-sku .banli-product-brand-row,
    .banli-product-page .stock-and-sku .banli-product-model-row {
      display: none !important;
    }
    .banli-product-page .stock-and-sku .title {
      min-width: 0;
      margin-right: 6px;
      color: rgba(255,255,255,.66) !important;
    }
    .banli-product-page .variables-wrap {
      margin-bottom: 18px !important;
      padding: 0 !important;
      border: 0;
      border-radius: 0 !important;
      background: transparent;
    }
    .banli-product-page .variable-group p {
      margin-bottom: 8px !important;
      color: rgba(247,247,244,.76);
      font-size: 12px;
      font-weight: 500;
      letter-spacing: .18em;
      text-transform: uppercase;
    }
    .banli-product-page .variable-info {
      display: flex !important;
      flex-wrap: wrap !important;
      gap: 8px !important;
    }
    .banli-product-page .variable-info > div {
      min-width: 54px;
      margin: 0 !important;
      padding: 8px 16px !important;
      border: 1px solid rgba(255,255,255,.18) !important;
      border-radius: 4px !important;
      color: rgba(247,247,244,.82);
      background: rgba(255,255,255,.022) !important;
      font-size: 13px;
      font-weight: 650;
      text-align: center;
      cursor: pointer;
      transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
    }
    .banli-product-page .variable-info > div:hover,
    .banli-product-page .variable-info > div.selected {
      color: #fff;
      border-color: rgba(255,255,255,.26) !important;
      background: rgba(255,255,255,.055) !important;
      transform: none;
      box-shadow: none;
    }
    .banli-product-page .variable-info > div.disabled {
      opacity: .38;
      cursor: not-allowed;
      pointer-events: none;
    }
    .banli-product-page .variable-group {
      margin-bottom: 10px !important;
    }
    .banli-product-page .variable-group:last-child {
      margin-bottom: 0 !important;
    }
    .banli-product-page .quantity-wrap + *,
    .banli-product-page .product-btns {
      margin-top: 0;
    }
    .banli-product-page .peoduct-info [class*="mb-md-3"] {
      margin-bottom: 12px !important;
    }
    .banli-product-page .quantity-wrap {
      width: min(100%, 178px);
      max-width: 178px;
      display: grid !important;
      grid-template-columns: 44px minmax(70px, 1fr) 44px;
      align-items: stretch;
      border-radius: 8px;
      overflow: visible;
      border: 1px solid rgba(255,255,255,.11);
      background: rgba(255,255,255,.022);
    }
    .banli-product-page .quantity-wrap .btn,
    .banli-product-page .quantity-wrap .form-control {
      min-width: 0;
      height: 36px;
      color: #fff;
      border: 0 !important;
      border-radius: 0 !important;
      background: transparent;
      box-shadow: none !important;
    }
    .banli-product-page .quantity-wrap .btn {
      width: 42px;
      min-width: 42px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex: 0 0 58px;
      background: rgba(255,255,255,.045);
    }
    .banli-product-page .quantity-wrap .form-control {
      width: 100% !important;
      justify-self: stretch;
      text-align: center;
      border-left: 1px solid rgba(255,255,255,.12) !important;
      border-right: 1px solid rgba(255,255,255,.12) !important;
      font-weight: 750;
      font-size: 15px;
    }
    .banli-product-page .quantity-wrap .quantity-reduce {
      border-radius: 8px 0 0 8px !important;
    }
    .banli-product-page .quantity-wrap .quantity-increase {
      border-radius: 0 8px 8px 0 !important;
    }
    .banli-product-page .quantity-wrap .quantity-reduce i,
    .banli-product-page .quantity-wrap .quantity-increase i {
      display: none;
    }
    .banli-product-page .quantity-wrap .quantity-reduce::before {
      content: "-";
      font-size: 20px;
      line-height: 1;
    }
    .banli-product-page .quantity-wrap .quantity-increase::before {
      content: "+";
      font-size: 20px;
      line-height: 1;
    }
    .banli-product-page .product-btns .add-cart-btns {
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
      gap: 16px;
      margin-top: 16px;
      max-width: 520px;
    }
    .banli-product-page .product-btns .btn {
      min-height: 46px;
      padding: 0 20px;
      border-radius: 4px;
      margin: 0 !important;
      font-size: 13px;
      font-weight: 650 !important;
      letter-spacing: .14em;
      text-transform: uppercase;
    }
    .banli-product-page .product-btns .add-cart,
    .banli-product-page .product-btns .btn-buy-now {
      width: 100%;
      min-width: 0;
      box-shadow: none;
    }
    .banli-product-page .product-btns .add-cart {
      border: 1px solid rgba(255,255,255,.16) !important;
      color: #fff !important;
      background: linear-gradient(135deg, rgba(69, 95, 142, .92), rgba(71, 91, 146, .86)) !important;
    }
    .banli-product-page .product-btns .btn-buy-now {
      border: 1px solid rgba(255,255,255,.14) !important;
      color: rgba(247,247,244,.90) !important;
      background: transparent !important;
    }
    .banli-product-page .product-btns .add-cart:hover,
    .banli-product-page .product-btns .btn-buy-now:hover {
      transform: translateY(-1px);
      border-color: rgba(255,255,255,.22) !important;
      background: #2a314f !important;
      box-shadow: none;
    }
    .banli-product-page .add-wishlist .btn {
      margin-top: 12px !important;
      color: rgba(255,255,255,.68) !important;
      text-decoration: none;
      font-size: 13px;
    }
    .banli-product-page .product-description,
    .banli-product-page .relations-wrap {
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px !important;
      background: rgba(255,255,255,.045);
    }
    .banli-product-page .relations-wrap {
      width: min(calc(100% - clamp(40px, 4.8vw, 96px)), 1920px);
      margin: clamp(26px, 2.6vw, 42px) auto 0 !important;
      padding: clamp(24px, 2.4vw, 34px) 0 clamp(26px, 2.6vw, 38px);
      overflow: hidden;
      border-color: rgba(255,255,255,.08);
      background:
        linear-gradient(180deg, rgba(255,255,255,.024), rgba(255,255,255,.012)),
        rgba(255,255,255,.012);
      box-shadow: inset 0 1px 0 rgba(255,255,255,.035);
    }
    .banli-product-page .relations-wrap .container {
      max-width: none;
      width: 100%;
      padding-left: clamp(22px, 3vw, 56px);
      padding-right: clamp(22px, 3vw, 56px);
    }
    .banli-product-page .relations-wrap .title {
      position: relative;
      margin: 0 0 clamp(18px, 1.8vw, 26px);
      color: rgba(247,247,244,.82);
      font-size: clamp(13px, .86vw, 16px);
      font-weight: 600;
      line-height: 1.2;
      letter-spacing: .22em;
      text-transform: uppercase;
    }
    .banli-product-page .relations-wrap .title::after {
      content: "";
      display: block;
      width: 48px;
      height: 1px;
      margin: 12px auto 0;
      border-radius: 99px;
      background: rgba(140, 164, 220, .55);
      box-shadow: none;
    }
    .banli-product-page .relations-wrap .product {
      position: relative;
      padding: 0 44px 26px;
    }
    .banli-product-page .relations-wrap .swiper {
      overflow: hidden;
      padding: 1px;
      border: 0;
      outline: 0;
      box-shadow: none;
    }
    .banli-product-page .relations-wrap .swiper-wrapper {
      align-items: stretch;
    }
    .banli-product-page .relations-wrap .swiper-slide {
      height: auto;
    }
    .banli-product-page .relations-wrap .product-wrap {
      position: relative;
      height: 100%;
      padding: 10px;
      overflow: hidden;
      border: 1px solid rgba(255,255,255,.085);
      border-radius: 8px;
      background:
        linear-gradient(180deg, rgba(34, 38, 78, .62) 0%, rgba(20, 25, 61, .72) 100%),
        rgba(20, 25, 61, .56);
      box-shadow: none;
      transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
    }
    .banli-product-page .relations-wrap .product-wrap::before {
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      background:
        radial-gradient(circle at 28% 4%, rgba(255,255,255,.085), transparent 34%),
        linear-gradient(180deg, rgba(255,255,255,.035), transparent 46%);
    }
    .banli-product-page .relations-wrap .product-wrap > * {
      position: relative;
      z-index: 1;
    }
    .banli-product-page .relations-wrap .product-wrap:hover {
      transform: translateY(-2px);
      border-color: rgba(140, 164, 220, .26);
      box-shadow: 0 12px 28px rgba(8, 10, 32, .20);
    }
    .banli-product-page .relations-wrap .product-wrap .image {
      aspect-ratio: 1.05;
      border-radius: 6px !important;
      background: #fff;
      box-shadow: inset 0 0 0 1px rgba(16,20,53,.06);
    }
    .banli-product-page .relations-wrap .product-wrap .image img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover;
      object-position: center top;
      transition: transform .35s ease;
    }
    .banli-product-page .relations-wrap .product-wrap:hover .image img {
      transform: scale(1.035);
    }
    .banli-product-page .relations-wrap .product-bottom-info {
      padding: 12px 2px 2px;
    }
    .banli-product-page .relations-wrap .product-name {
      display: -webkit-box !important;
      height: 2.72em;
      min-height: 2.72em;
      max-height: 2.72em;
      margin-bottom: 10px;
      overflow: hidden;
      color: #fff;
      font-size: clamp(14px, .9vw, 16px);
      font-weight: 720;
      line-height: 1.34;
      letter-spacing: 0;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
    .banli-product-page .relations-wrap .product-price {
      display: flex;
      align-items: baseline;
      gap: 9px;
      min-height: 26px;
      white-space: nowrap;
    }
    .banli-product-page .relations-wrap .price-new {
      color: rgba(76, 145, 255, .96) !important;
      font-size: clamp(17px, 1vw, 20px);
      font-weight: 780 !important;
      letter-spacing: .01em;
    }
    .banli-product-page .relations-wrap .price-old {
      color: rgba(255,255,255,.46) !important;
      font-size: clamp(12px, .72vw, 14px);
      font-weight: 700;
    }
    .banli-product-page .relations-wrap .button-wrap {
      left: 50%;
      right: auto;
      bottom: 12px;
      width: auto !important;
      padding: 0;
      gap: 8px !important;
      opacity: 0;
      transform: translate(-50%, 10px);
      transition: opacity .25s ease, transform .25s ease;
    }
    .banli-product-page .relations-wrap .product-wrap:hover .button-wrap {
      opacity: 1;
      transform: translate(-50%, 0);
    }
    .banli-product-page .relations-wrap .button-wrap .btn {
      width: 34px !important;
      height: 34px !important;
      min-width: 34px !important;
      flex: 0 0 34px !important;
      padding: 0 !important;
      border-radius: 999px !important;
      font-size: 0 !important;
      gap: 0 !important;
      background:
        linear-gradient(180deg, rgba(34,39,80,.88), rgba(24,29,64,.94)) !important;
      border-color: rgba(255,255,255,.16) !important;
      box-shadow: 0 10px 20px rgba(0,0,0,.24);
    }
    .banli-product-page .relations-wrap .button-wrap .btn-add-cart {
      background:
        linear-gradient(135deg, rgba(0,210,255,.82), rgba(122,76,243,.88)) !important;
      border-color: rgba(255,255,255,.20) !important;
    }
    .banli-product-page .relations-wrap .button-wrap .btn svg,
    .banli-product-page .relations-wrap .button-wrap .btn i {
      width: 15px !important;
      height: 15px !important;
      margin: 0 !important;
    }
    .banli-product-page .relations-wrap .button-wrap .btn span {
      display: none !important;
    }
    .banli-product-page .relations-swiper-prev,
    .banli-product-page .relations-swiper-next {
      width: 38px;
      height: 38px;
      margin-top: -28px;
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 50%;
      color: #fff;
      background: rgba(255,255,255,.045);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: none;
      transition: background .2s ease, border-color .2s ease, color .2s ease;
    }
    .banli-product-page .relations-swiper-prev {
      left: 0;
    }
    .banli-product-page .relations-swiper-next {
      right: 0;
    }
    .banli-product-page .relations-swiper-prev:hover,
    .banli-product-page .relations-swiper-next:hover {
      border-color: rgba(0,210,255,.55);
      color: #fff;
      background: rgba(69, 95, 142, .72);
    }
    .banli-product-page .relations-swiper-prev::after,
    .banli-product-page .relations-swiper-next::after {
      font-size: 13px;
      font-weight: 800;
    }
    .banli-product-page .relations-pagination {
      bottom: 0 !important;
    }
    .banli-product-page .relations-pagination .swiper-pagination-bullet {
      width: 9px;
      height: 9px;
      background: rgba(255,255,255,.22);
      opacity: 1;
    }
    .banli-product-page .relations-pagination .swiper-pagination-bullet-active {
      width: 22px;
      border-radius: 99px;
      background: rgba(140, 164, 220, .82);
    }
    .nav-tabs.nav-overflow {
      border-bottom-color: #333 !important;
    }
    .nav-tabs .nav-link {
      background-color: transparent !important;
      color: #adb5bd !important;
      border: none !important;
      border-bottom: 2px solid transparent !important;
      transition: all 0.3s ease;
    }
    .nav-tabs .nav-link:hover {
      color: #f8f9fa !important;
    }
    .nav-tabs .nav-link.active {
      color: #0dcaf0 !important;
      border-bottom: 2px solid #0dcaf0 !important;
      text-shadow: 0 0 8px rgba(13, 202, 240, 0.5);
    }
    body.page-product-quick-view {
      overflow: hidden !important;
      background: #101435;
    }
    body.page-product-quick-view #wrapper {
      padding-top: 0 !important;
      overflow: hidden !important;
    }
    body.page-product-quick-view #content,
    body.page-product-quick-view .banli-product-page {
      background: #101435;
    }
    body.page-product-quick-view .banli-product-page {
      height: 100vh;
      min-height: 100vh;
      padding: 18px !important;
      overflow: hidden;
      overscroll-behavior: contain;
    }
    body.page-product-quick-view .product-container {
      width: 100%;
      max-width: none;
      height: 100%;
      padding: 0 !important;
      overflow: hidden;
    }
    body.page-product-quick-view .banli-product-top {
      height: 100%;
      min-height: 0;
      margin: 0 !important;
      padding: 0;
      border: 0;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
      --bs-gutter-x: 18px;
      --bs-gutter-y: 18px;
    }
    body.page-product-quick-view .banli-product-top > [class*="col-"] {
      min-height: 0;
      margin-bottom: 0 !important;
    }
    body.page-product-quick-view .product-image {
      grid-template-columns: 66px minmax(0, 1fr);
      gap: 14px;
      min-height: 0;
      padding: 12px;
      box-shadow: none;
    }
    body.page-product-quick-view .product-image .left {
      width: 66px;
      display: block !important;
    }
    body.page-product-quick-view .product-image .right,
    body.page-product-quick-view .product-img,
    body.page-product-quick-view #swiper-mobile {
      height: min(52vh, 430px);
      min-height: 0;
    }
    body.page-product-quick-view .product-left-thumb-wrap {
      height: min(52vh, 430px);
    }
    body.page-product-quick-view .product-left-thumb-wrap .swiper-slide {
      width: 62px !important;
      height: 62px !important;
      border-radius: 7px;
    }
    body.page-product-quick-view .peoduct-info {
      height: auto;
      max-height: none;
      padding: 20px !important;
      overflow: visible;
      overscroll-behavior: contain;
      box-shadow: none;
    }
    body.page-product-quick-view .peoduct-info .product-name {
      margin-bottom: 12px !important;
      font-size: clamp(18px, 1.75vw, 24px) !important;
      line-height: 1.24 !important;
    }
    body.page-product-quick-view .price-wrap {
      margin: 12px 0 8px;
    }
    body.page-product-quick-view .new-price {
      font-size: clamp(28px, 3vw, 38px) !important;
    }
    body.page-product-quick-view .stock-and-sku {
      grid-template-columns: 1fr;
      gap: 4px;
      margin-bottom: 12px !important;
    }
    body.page-product-quick-view .variables-wrap {
      margin-bottom: 12px !important;
      padding: 12px !important;
    }
    body.page-product-quick-view .variable-group {
      margin-bottom: 12px !important;
    }
    body.page-product-quick-view .variable-info {
      gap: 8px !important;
    }
    body.page-product-quick-view .variable-info > div {
      min-width: 46px;
      padding: 7px 12px !important;
    }
    body.page-product-quick-view .quantity-wrap {
      width: min(100%, 280px);
      max-width: 280px;
      grid-template-columns: 50px minmax(90px, 1fr) 50px;
    }
    body.page-product-quick-view .quantity-wrap .btn,
    body.page-product-quick-view .quantity-wrap .form-control {
      height: 48px;
    }
    body.page-product-quick-view .quantity-wrap .btn {
      width: 50px;
      min-width: 50px;
      flex-basis: 50px;
    }
    body.page-product-quick-view .product-btns .add-cart-btns {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px;
      margin-top: 12px;
    }
    body.page-product-quick-view .product-btns .btn {
      width: 100%;
      min-height: 46px;
      padding: 0 14px;
      white-space: nowrap;
    }
    @media (min-width: 768px) {
      body.page-product-quick-view .banli-product-top > .col-xl-7,
      body.page-product-quick-view .banli-product-top > .col-xl-5 {
        flex: 0 0 auto;
        width: 50%;
      }
    }
    @media (max-width: 1199.98px) {
      .banli-product-page .peoduct-info {
        margin-top: 18px;
      }
    }
    @media (max-width: 991.98px) {
      .banli-product-page {
        padding: 34px 0 66px;
      }
      .banli-product-page .product-image {
        display: block;
        padding: 12px;
      }
      .banli-product-page .product-image .left {
        display: none !important;
      }
      .banli-product-page .product-image .right,
      .banli-product-page .product-img,
      .banli-product-page #swiper-mobile {
        width: 100%;
        height: auto !important;
        min-height: 0 !important;
        aspect-ratio: 1;
      }
      .banli-product-page .peoduct-info {
        margin-top: 18px;
      }
      body.page-product-quick-view .peoduct-info {
        margin-top: 0;
      }
      .banli-product-page .product-btns .btn {
        flex: 1 1 100%;
      }
      .banli-product-page .relations-wrap {
        margin-top: 48px !important;
        padding: 34px 0 42px;
      }
      .banli-product-page .relations-wrap .container {
        padding-left: 20px;
        padding-right: 20px;
      }
      .banli-product-page .relations-wrap .product {
        padding: 0 0 42px;
      }
      .banli-product-page .relations-wrap .product-wrap {
        padding: 12px;
      }
      .banli-product-page .relations-wrap .product-name {
        min-height: 48px;
        font-size: 16px;
        line-height: 1.42;
      }
      .banli-product-page .relations-wrap .price-new {
        font-size: 17px;
      }
      .banli-product-page .relations-wrap .button-wrap {
        opacity: 1;
        transform: none;
      }
      .banli-product-page .relations-swiper-prev,
      .banli-product-page .relations-swiper-next {
        display: none;
      }
    }
    @media (max-width: 767.98px) {
      .banli-product-page {
        padding: 24px 0 58px;
      }
      .banli-product-page .product-container {
        padding-left: 14px;
        padding-right: 14px;
      }
      body.page-product .breadcrumb-filter,
      body.page-product .breadcrumb-wrap {
        padding-top: 14px;
        padding-bottom: 14px;
      }
      body.page-product .breadcrumb-filter .breadcrumb,
      body.page-product .breadcrumb-wrap .breadcrumb {
        row-gap: 0;
      }
      body.page-product .breadcrumb-filter .breadcrumb-item.active,
      body.page-product .breadcrumb-wrap .breadcrumb-item:last-child {
        display: none;
      }
      .banli-product-page .peoduct-info .product-name {
        font-size: 24px !important;
        line-height: 1.2 !important;
      }
      body.page-product-quick-view {
        overflow: auto !important;
      }
      body.page-product-quick-view #wrapper {
        overflow: visible !important;
      }
      body.page-product-quick-view .banli-product-page {
        height: auto;
        min-height: 100vh;
        padding: 12px !important;
      }
      body.page-product-quick-view .product-container {
        height: auto;
        overflow: visible;
      }
      body.page-product-quick-view .banli-product-top {
        height: auto;
      }
      body.page-product-quick-view .product-image .right,
      body.page-product-quick-view .product-img,
      body.page-product-quick-view #swiper-mobile {
        height: auto;
        max-height: none;
        aspect-ratio: 1;
      }
      body.page-product-quick-view .peoduct-info {
        margin-top: 12px;
        max-height: none;
        padding: 16px !important;
        overflow: visible;
      }
      .banli-product-page .quantity-wrap {
        width: min(100%, 288px);
        max-width: 288px;
        grid-template-columns: 48px minmax(92px, 1fr) 48px;
      }
      .banli-product-page .quantity-wrap .btn,
      .banli-product-page .quantity-wrap .form-control {
        height: 46px;
      }
      .banli-product-page .quantity-wrap .btn {
        width: 48px;
        min-width: 48px;
        flex-basis: 48px;
      }
      body.page-product-quick-view .product-btns .add-cart-btns {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endpush

@php
  $iframeClass = request('iframe') ? 'd-none' : '';
@endphp

@section('content')
  <section class="banli-product-page section-dark text-light" style="{{ request('iframe') ? 'padding-top: 20px;' : '' }}">
  @hook('product.detail.before')

  @if (!request('iframe'))
    <x-shop-breadcrumb type="product" :value="$product['id']"/>
  @endif

  <div class="container product-container {{ request('iframe') ? 'pt-4' : '' }}">
    @hook('product.detail.content.before')
    <div class="row g-4 g-xl-5 mb-md-5 mt-md-0 banli-product-top" id="product-top">
      <div class="col-12 col-xl-7 mb-2">
        @hookwrapper('product.detail.images')
        <div class="product-image">
          @if(!is_mobile())
            <div class="left {{ $iframeClass }}" v-if="images.length">
              <div class="swiper product-left-thumb-wrap" id="swiper">
                <div class="swiper-wrapper">
                  @foreach ($product['images'] as $item)
                  <div class="swiper-slide {{ $loop->first ? 'active' : '' }}">
                    <a href="javascript:;" data-image="{{ $item['preview'] }}" data-zoom-image="{{ $item['popup'] }}">
                      <img src="{{ $item['thumb'] }}" alt="{{ $product['name'] }}" class="img-fluid seo-img" width="120" height="120">
                    </a>
                  </div>
                  @endforeach
                </div>
                <div class="swiper-pager">
                  <div class="swiper-button-next new-feature-slideshow-next"></div>
                  <div class="swiper-button-prev new-feature-slideshow-prev"></div>
                </div>
              </div>
            </div>
            <div class="right" id="zoom">
              @include('product.product-video')
              <div class="product-img">
                <img alt="{{ $product['name'] }}"
                  src="{{ $product['images'][0]['preview'] ?? system_setting('base.placeholder') ?? asset('image/placeholder.png') }}"
                  class="img-fluid seo-img"
                  width="{{ system_setting('base.product_image_origin_width', 800) }}"
                  height="{{ system_setting('base.product_image_origin_height', 800) }}">
              </div>
            </div>
          @else
            @include('product.product-video')
            <div class="swiper" id="swiper-mobile">
              <div class="swiper-wrapper">
                @foreach ($product['images'] as $item)
                <div class="swiper-slide d-flex align-items-center justify-content-center">
                  <img src="{{ $item['preview'] }}" fetchpriority="high" width="{{ system_setting('base.product_image_origin_width', 800) }}" height="{{ system_setting('base.product_image_origin_height', 800) }}" class="img-fluid seo-img" alt="{{ $product['name'] }}">
                </div>
                @endforeach
              </div>
              <div class="swiper-pagination mobile-pagination"></div>
            </div>
          @endif
        </div>
        @endhookwrapper
      </div>

      <div class="col-12 col-xl-5">
        <div class="peoduct-info product-mb-block glass-card p-4 rounded" id="product-app" v-cloak>
          <div class="banli-product-eyebrow">
            {{ $product['brand_name'] ?? 'Banli Selection' }}
          </div>
          @hookwrapper('product.detail.name')
          <h1 class="mb-xl-4 mb-2 product-name fs-3 fw-bold" style="line-height: 1.4;" title="{{ $product['name'] }}">{{ $product['name'] }}</h1>
          @endhookwrapper
          @hookwrapper('product.detail.price')
          @if ((system_setting('base.show_price_after_login') and current_customer()) or !system_setting('base.show_price_after_login'))
            <div class="price-wrap d-flex align-items-end">
              <div class="new-price fs-1 lh-1 fw-bold text-primary me-2">@{{ product.price_format }}</div>
              <div class="old-price text-white-50 text-decoration-line-through"
                   v-if="product.price != product.origin_price && product.origin_price !== 0">
                @{{ product.origin_price_format }}
              </div>
              @hook('product.detail.origin_price.after')
            </div>
          @else
            <div class="product-price">
              <div class="text-light fs-6">{{ __('common.before') }} <a class="price-new fs-6 login-before-show-price" href="javascript:void(0);">{{ __('common.login') }}</a> {{ __('common.show_price') }}
              </div>
            </div>
          @endif

          @hook('product.detail.price.after')

          @endhookwrapper
          <div class="stock-and-sku mb-lg-4 mb-2">
            @hook('shop.product.detail.quantity.before')

            @hookwrapper('product.detail.quantity')
            <div class="d-lg-flex banli-product-stock-row">
              <span class="title text-muted">{{ __('product.stock') }}:</span>
              <span :class="product.quantity > 0 ? 'text-success' : 'text-secondary'">
                <template v-if="product.quantity > 0">{{ __('shop/products.in_stock') }}</template>
                <template v-else>{{ __('shop/products.out_stock') }}</template>
              </span>
            </div>
            @endhookwrapper

            @if ($product['brand_id'])
              @hookwrapper('product.detail.brand')
              <div class="d-lg-flex banli-product-brand-row">
                <span class="title text-muted">{{ __('product.brand') }}:</span>
                <a href="{{ shop_route('brands.show', $product['brand_id']) }}">{{ $product['brand_name'] }}</a>
              </div>
              @endhookwrapper
            @endif

            @hookwrapper('product.detail.sku')
            <div class="d-lg-flex banli-product-sku-row"><span class="title text-muted">SKU:</span>@{{ product.sku }}</div>
            @endhookwrapper

            @hookwrapper('product.detail.model')
            <div class="d-lg-flex banli-product-model-row" v-if="product.model"><span
                class="title text-muted">{{ __('shop/products.model') }}:</span> @{{ product.model }}
            </div>
            @endhookwrapper

            @hookwrapper('product.detail.weight')
            <div class="d-lg-flex" v-if="product.weight != 0"><span class="title text-muted">{{ __('admin/product.weight_text') }}:</span> @{{ product.weight }} {{ __('product.' . $product['weight_class']) }}</div>
            @endhookwrapper

            @hook('shop.product.detail.weight.after')
          </div>
          @hookwrapper('product.detail.variables')
          <div class="variables-wrap mb-md-3 glass-card p-3 rounded" v-if="source.variables.length">
            <style>
              .variable-info {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
              }
              .variable-info > div {
                margin: 0 !important;
                border: 1px solid rgba(255,255,255,0.2);
                border-radius: 4px;
                padding: 6px 12px;
                cursor: pointer;
                transition: all 0.2s;
              }
              .variable-info > div.selected {
                border-color: #00d2ff;
                background: rgba(0, 210, 255, 0.1);
                color: #00d2ff;
              }
              .variable-info > div:hover {
                border-color: rgba(0, 210, 255, 0.5);
              }
            </style>
            <div class="variable-group mb-3" v-for="variable, variable_index in source.variables" :key="variable_index">
              <p class="mb-2">
                @{{ variable.name }}
                <span class="text-secondary" v-if="selectedVariantsIndex[variable_index] !== undefined && selectedVariantsIndex[variable_index] !== null && variable.values[selectedVariantsIndex[variable_index]]">
                  : @{{ variable.values[selectedVariantsIndex[variable_index]].name }}
                </span>
              </p>
              <div class="variable-info">
                <div
                  v-for="value, value_index in variable.values"
                  @click="checkedVariableValue(variable_index, value_index, value)"
                  :key="value_index"
                  role="button"
                  :aria-disabled="value.disabled ? 'true' : 'false'"
                  :tabindex="value.disabled ? -1 : 0"
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  :title="value.image ? value.name : ''"
                  :class="[value.selected ? 'selected' : '', value.disabled ? 'disabled' : '', value.image ? 'is-v-image' : '']">
                  <span class="image" v-if="value.image"><img :src="value.image" class="img-fluid" :alt="value.name"></span>
                  <span v-else>@{{ value.name }}</span>
                </div>
              </div>
            </div>
          </div>
          @endhookwrapper

          @hook('shop.product.detail.product-btns.before')

          @hookwrapper('product.detail.quantity.input')
          <div class="mb-md-3">
            <p class="mb-2">{{ __('rma.quantity') }}:</p>
            <div class="input-group quantity-wrap">
              <button class="btn quantity-reduce" type="button"><i class="bi bi-dash-lg"></i></button>
              <input type="text" class="form-control" :disabled="!product.quantity || product.active != 1" onkeyup="this.value=this.value.replace(/\D/g,'')" v-model="quantity" name="quantity" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <button class="btn quantity-increase" type="button"><i class="bi bi-plus-lg"></i></button>
            </div>
          </div>
          @endhookwrapper

          <div class="product-btns">
            @hook('product.detail.buy.before')
            <div class="add-cart-btns">
              @hook('shop.product.detail.btns.before')

              @hookwrapper('product.detail.add_to_cart')
              <button
                class="btn btn-neon add-cart fw-bold"
                :product-id="product.id"
                :product-price="product.price"
                :disabled="isAddingCart || !product.quantity || product.active != 1"
                @click="addCart(false, $event)"
              ><i class="bi bi-cart-fill me-1"></i>{{ __('shop/products.add_to_cart') }}
              </button>
              @endhookwrapper
              @hookwrapper('product.detail.buy_now')
              <button
                class="btn btn-neon ms-md-3 btn-buy-now fw-bold"
                :disabled="isAddingCart || !product.quantity || product.active != 1"
                :product-id="product.id"
                :product-price="product.price"
                @click="addCart(true, $event)"
              ><i class="bi bi-bag-fill me-1"></i>{{ __('shop/products.buy_now') }}
              </button>
              @endhookwrapper

              @hook('shop.product.detail.btns.after')
            </div>
            @hook('product.detail.buy.after')
            @if ($product['active'])
              @if (current_customer() || !request('iframe'))
                @hookwrapper('product.detail.wishlist')
                <div class="add-wishlist">
                  <button class="btn btn-link ps-md-0 text-secondary" data-in-wishlist="{{ $product['in_wishlist'] }}"
                          onclick="bk.addWishlist('{{ $product['id'] }}', this)">
                    <i class="bi bi-heart{{ $product['in_wishlist'] ? '-fill' : '' }} me-1"></i>
                    <span>{{ __('shop/products.add_to_favorites') }}</span>
                  </button>
                </div>
                @endhookwrapper
              @endif
            @else
              <div class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> {{ __('product.has_been_inactive') }}</div>
            @endif
          </div>

          @hook('product.detail.after')
        </div>
      </div>
    </div>

    @hook('product.tab.iframe.before')
    @hookwrapper('shop.product.description')
    <div class="product-description product-mb-block glass-card p-4 rounded mt-4 {{ $iframeClass }}">
      <div class="nav nav-tabs nav-overflow justify-content-start justify-content-md-center border-bottom mb-3">
        @hook('shop.product.description.tabs.before')
        <a class="nav-link fw-bold active fs-5" data-bs-toggle="tab" href="#product-description">
          {{ __('shop/products.product_details') }}
        </a>
        @if ($product['attributes'])
          <a class="nav-link fw-bold fs-5" data-bs-toggle="tab" href="#product-attributes">
            {{ __('admin/attribute.index') }}
          </a>
        @endif
        @hook('product.tab.after.link')
      </div>
      <div class="tab-content">
        @hook('shop.product.description.tabs.content.before')
        <div class="tab-pane fade show active" id="product-description" role="tabpanel">
          <div class="rich-text-editor-content">{!! $product['description'] !!}</div>
        </div>
        <div class="tab-pane fade" id="product-attributes" role="tabpanel">
          <table class="table table-dark table-bordered attribute-table">
            @foreach ($product['attributes'] as $group)
              <thead class="table-dark">
              <tr>
                <td colspan="2"><strong>{{ $group['attribute_group_name'] }}</strong></td>
              </tr>
              </thead>
              <tbody>
              @foreach ($group['attributes'] as $item)
                <tr>
                  <td>{{ $item['attribute'] }}</td>
                  <td>{{ $item['attribute_value'] }}</td>
                </tr>
              @endforeach
              </tbody>
            @endforeach
          </table>
        </div>
        @hook('product.tab.after.pane')
      </div>
    </div>
    @endhookwrapper
    @hook('product.detail.content.after')
  </div>

  @if ($relations && !request('iframe'))
    <div class="relations-wrap mt-2 mt-md-5 product-mb-block">
      <div class="container position-relative">
        <div class="title text-center">{{ __('admin/product.product_relations') }}</div>
        <div class="product swiper-style-plus">
          <div class="swiper relations-swiper">
            <div class="swiper-wrapper">
              @foreach ($relations as $item)
                <div class="swiper-slide">
                  @include('shared.product', ['product' => $item])
                </div>
              @endforeach
            </div>
          </div>
          <div class="swiper-pagination relations-pagination"></div>
          <div class="swiper-button-prev relations-swiper-prev"></div>
          <div class="swiper-button-next relations-swiper-next"></div>
        </div>
      </div>
    </div>
  @endif

  @hook('product.detail.footer')
  </section>
@endsection

@push('add-scripts')
  <script src="{{ asset('vendor/zoom/jquery.zoom.min.js') }}"></script>
  <script>
    @hook('product.detail.script.before')

    let swiperMobile = null;
    var swiper = null;
    const isIframe = bk.getQueryString('iframe', false);
    const productImageOriginWidth = @json(system_setting('base.product_image_origin_width', 800));
    const productImageOriginHeight = @json(system_setting('base.product_image_origin_height', 800));

    $(function () {
      descriptionImagesLazy()
      $('#zoom').trigger('zoom.destroy');
      $('#zoom').zoom({url: $('#swiper a').attr('data-zoom-image')});

      var relationsSwiper = new Swiper('.relations-swiper', {
        watchSlidesProgress: true,
        autoHeight: false,
        breakpoints: {
          320: {
            slidesPerView: 2,
            spaceBetween: 12,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 22,
          },
          1200: {
            slidesPerView: 4,
            spaceBetween: 28,
          },
          1600: {
            slidesPerView: 4,
            spaceBetween: 36,
          },
        },
        spaceBetween: 28,
        // 如果需要前进后退按钮
        navigation: {
          nextEl: '.relations-swiper-next',
          prevEl: '.relations-swiper-prev',
        },

        // 如果需要分页器
        pagination: {
          el: '.relations-pagination',
          clickable: true,
        },
      })
    });

    let app = new Vue({
      el: '#product-app',

      data: {
        selectedVariantsIndex: [], // 选中的变量索引
        images: [],
        product: {
          id: 0,
          images: "",
          model: "",
          origin_price: 0,
          origin_price_format: "",
          position: 0,
          price: 0,
          weight: 0,
          price_format: "",
          quantity: 0,
          sku: "",
        },
        quantity: 1,
        source: {
          skus: @json($product['skus']),
          weight: @json($product['weight'] ?? ''),
          variables: @json($product['variables'] ?? []),
        },
        request_variant: @json(request('variant')),
        extraCartParams: {},
        isAddingCart: false,
        @hook('product.detail.vue.data')
      },

      beforeMount() {
        @hook('product.detail.vue.beforeMount')
      },

      mounted() {
        $('.bk-page-loading').fadeOut();
        $('#product-hide-elements').remove();
        const skus = JSON.parse(JSON.stringify(this.source.skus));

        this.product = skus[0];
        this.images = @json($product['images'] ?? []);

        if (this.source.variables.length) {
          // 为 variables 里面每一个 values 的值添加 selected、disabled 字段
          this.source.variables.forEach(variable => {
            variable.values.forEach(value => {
              this.$set(value, 'selected', false)
              this.$set(value, 'disabled', false)
            })
          })

          if (this.request_variant && this.source.skus.find(sku => sku.sku == this.request_variant)) {
            const sku = this.source.skus.find(sku => sku.sku == this.request_variant)
            this.selectedVariantsIndex = JSON.parse(JSON.stringify(sku.variants))
            this.checkedVariants()
            this.getSelectedSku(false);
            this.updateSelectedVariantsStatus()
          }
        } else {
          this.product.weight = this.source.weight;
        }

        this.initSwiper();

        @hook('product.detail.vue.mounted')
      },

      methods: {
        normalizeVariants(selected, length) {
          return Array.from({ length }, (_, i) => selected?.[i] ?? 0);
        },

        checkedVariableValue(variable_index, value_index, value) {
          if (value.disabled) {
            return;
          }

          $('.product-image .swiper .swiper-slide').eq(0).addClass('active').siblings().removeClass('active');
          this.source.variables[variable_index].values.forEach((v, i) => {
            v.selected = i == value_index
          })

          this.updateSelectedVariantsIndex();
          this.getSelectedSku();
          this.updateSelectedVariantsStatus()
          $('.variables-wrap').removeClass('error');
        },

        // 把对应 selectedVariantsIndex 下标选中 variables -> values 的 selected 字段为 true
        checkedVariants() {
          this.source.variables.forEach((variable, index) => {
            const selectedValue = variable.values[this.selectedVariantsIndex[index]];
            if (selectedValue) {
              selectedValue.selected = true
            }
          })
        },

        getSelectedSku(reload = true) {
          const filledCount = this.selectedVariantsIndex.filter(v => v !== undefined && v !== null).length;

          // 通过 selectedVariantsIndex 的值比对 skus 的 variables
          let sku = this.source.skus.find(sku => sku.variants.toString() == this.selectedVariantsIndex.toString())

          if (filledCount < this.source.variables.length) {
            const selectedVariantsIndexLight = this.normalizeVariants(this.selectedVariantsIndex, this.source.variables.length);
            sku = this.source.skus.find(sku => sku.variants.toString() == selectedVariantsIndexLight.toString());
          }

          if (!sku) {
            $('.variables-wrap').addClass('error');
            layer.msg('{{ __('shop/products.error_variables') }}');
            return;
          }

          this.images = @json($product['images'] ?? []);
          this.images.unshift(...(Array.isArray(sku.images) ? sku.images : []));
          this.product = sku;

          if (swiperMobile) {
            swiperMobile.slideTo(0, 0, false)
          }

          if (filledCount == this.source.variables.length) {
            window.history.replaceState(null, '', bk.updateQueryStringParameter(window.location.href, 'variant', sku.sku));
          }

          setTimeout(() => {
            this.updatePeoductImage()
            $('#zoom img').attr('src', $('#swiper a').attr('data-image'));
            $('#zoom').trigger('zoom.destroy');
            $('#zoom').zoom({url: $('#swiper a').attr('data-zoom-image')});
          }, 0);

          closeVideo()
        },

        addCart(isBuyNow = false, event = null) {
          if (this.isAddingCart) {
            return;
          }

          //判断如果是多规格 并且没有选择组合
          const realLength = this.selectedVariantsIndex.filter(v => v !== undefined).length;

          if (this.source.variables.length && realLength < this.source.variables.length) {
            layer.msg('{{ __('shop/products.error_variables') }}');

            $('html, body').animate({scrollTop: 0}, 200);
            $('.variables-wrap').addClass('error');
            return;
          }

          let params = {
            sku_id: this.product.id,
            quantity: this.quantity,
            isBuyNow,
            ...this.extraCartParams // 插件扩展参数
          };

          // 插件扩展方法
          if (typeof this.beforeAddCartHooks === 'function') {
            const beforeAddCartHooks = this.beforeAddCartHooks(params);
            if (beforeAddCartHooks === false) {
              return;
            }
          }

          this.isAddingCart = true;
          const addCartRequest = bk.addCart(params, event ? event.currentTarget : null, () => {
            const lang = "{{ locale() === system_setting('base.locale') ? "null": session()->get('locale') }}";
            let path = '/' + '{{ session()->get('locale') }}' + '/checkout';
            if(lang === "null") {
              path = '/checkout';
            }

            if (isIframe) {
              let index = parent.layer.getFrameIndex(window.name); //当前iframe层的索引
              parent.bk.getCarts();
              setTimeout(() => {
                parent.layer.close(index);
                if (isBuyNow) {
                  parent.location.href = path;
                } else {
                  parent.$('.btn-right-cart')[0].click()
                }
              }, 400);
            } else {
              if (isBuyNow) {
                location.href = path;
              }
            }
          });

          if (addCartRequest && typeof addCartRequest.finally === 'function') {
            addCartRequest.finally(() => {
              this.isAddingCart = false;
            });
          } else {
            this.isAddingCart = false;
          }
        },

        updateSelectedVariantsIndex() {
          // 获取选中的 variables 内 value的 下标 index 填充到 selectedVariantsIndex 中
          this.source.variables.forEach((variable, index) => {
            variable.values.forEach((value, value_index) => {
              if (value.selected) {
                this.selectedVariantsIndex[index] = value_index
              }
            })
          })
        },

        updateSelectedVariantsStatus() {
          // 取出所有有库存且 active=1 的 SKU 的 variants
          const skus = this.source.skus.filter(sku => sku.active == 1 && sku.quantity > 0).map(sku => sku.variants);

          this.source.variables.forEach((variable, index) => {
            variable.values.forEach((value, value_index) => {
              // 拷贝当前已选择的规格索引
              const selectedVariantsIndex = this.selectedVariantsIndex.slice(0);

              selectedVariantsIndex[index] = value_index;

              const selectedSku = skus.find(sku => {
                return selectedVariantsIndex.every((v, i) => {
                  if (v === undefined || v === null) return true; // 这一维没选，不限制
                  return sku[i] == v; // 已经选择的维度必须匹配
                });
              });

              value.disabled = !selectedSku;
            });
          });
        },

        updatePeoductImage() {
          if (this.images.length) {
            if ($('.product-left-thumb-wrap').length) {
              if (swiper) {
                swiper.removeAllSlides()
                const slides = this.images.map((image, index) => `
                  <div class="swiper-slide ${index == 0 ? 'active' : ''}">
                    <a href="javascript:;" data-image="${image['preview']}" data-zoom-image="${image['popup']}">
                      <img src="${image['thumb']}" alt="${$('.product-name').text()}" class="img-fluid seo-img" width="120" height="120">
                    <\/a>
                  <\/div>
                `);
                swiper.appendSlide(slides);

                $('#zoom .product-img img').prop('src', this.images[0]['preview'])
              }
            } else {
              if (swiperMobile) {
                swiperMobile.removeAllSlides()
                const slides = this.images.map((image, index) => `
                  <div class="swiper-slide ${index == 0 ? 'active' : ''}">
                    <img src="${image['preview']}" alt="${$('.product-name').text()}" class="img-fluid seo-img" width="${productImageOriginWidth}" height="${productImageOriginHeight}">
                  <\/div>
                `);
                swiperMobile.appendSlide(slides);
              }
            }
          }
        },

        initSwiper() {
          swiper = new Swiper("#swiper", {
            direction: "vertical",
            slidesPerView: 1,
            spaceBetween: 3,
            autoHeight: true,
            mousewheel: true,
            breakpoints: {
              375: {
                slidesPerView: 3,
                spaceBetween: 3,
              },
              480: {
                slidesPerView: 4,
                spaceBetween: 27,
              },
              768: {
                slidesPerView: 6,
                spaceBetween: 3,
              },
            },
            navigation: {
              nextEl: '.new-feature-slideshow-next',
              prevEl: '.new-feature-slideshow-prev',
            },
            observeParents: true
          });

          @if (is_mobile())
            swiperMobile = new Swiper("#swiper-mobile", {
            slidesPerView: 1,
            pagination: {
              el: ".mobile-pagination",
            },
            observer: true,
            observeParents: true
          });
          @endif
        },

        @hook('product.detail.vue.methods')
      },

      @hook('product.detail.vue.hooks')
    });

    $(document).on("mouseover", ".product-image #swiper .swiper-slide a", function () {
      $(this).parent().addClass('active').siblings().removeClass('active');
      $('#zoom').trigger('zoom.destroy');
      $('#zoom img').attr('src', $(this).attr('data-image'));
      $('#zoom').zoom({url: $(this).attr('data-zoom-image')});
      closeVideo()
    });

    const selectedVariantsIndex = app.selectedVariantsIndex;
    const variables = app.source.variables;

    const selectedVariants = variables.map((variable, index) => {
      return variable.values[selectedVariantsIndex[index]]
    });

    // 优化详情描述里面的图片加载 -> 懒加载
    const descriptionImagesLazy = () => {
      var $content = $('.rich-text-editor-content');
      if (!$content.length) return;

      var $imgs = $content.find('img');
      $imgs.each(function (index, img) {
        var $img = $(img);

        $img.addClass('lazyload');

        var src = $img.attr('src');
        if (src) {
          $img.attr('data-src', src);
          $img.attr('src', '');
        }
      });
    };

    @hook('product.detail.script.after')
  </script>
@endpush
