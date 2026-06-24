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
      padding-top: var(--banli-header-height, 132px) !important;
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
      padding: clamp(18px, 2vw, 28px);
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 8px;
      background: rgba(255,255,255,.025);
      box-shadow: 0 24px 64px rgba(0,0,0,.22), inset 0 1px 0 rgba(255,255,255,.08);
    }
    .banli-category-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -2;
      border-radius: inherit;
      background: url('{{ asset('banli_theme-assets/aivent/images/background/5.webp') }}') center 42% / cover no-repeat;
      transform: scale(1.006);
    }
    .banli-category-hero::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -1;
      border-radius: inherit;
      background:
        radial-gradient(circle at 86% 52%, rgba(122, 76, 243, .16), transparent 30%),
        linear-gradient(180deg, rgba(16,20,53,.18), rgba(16,20,53,.06) 34%, rgba(16,20,53,.22)),
        linear-gradient(90deg, rgba(16,20,53,.88), rgba(16,20,53,.58) 54%, rgba(16,20,53,.78));
    }
    .banli-category-hero > .row {
      position: relative;
      z-index: 1;
      min-height: clamp(140px, 12vw, 180px);
      align-items: center;
    }
    .banli-category-copy {
      max-width: 820px;
    }
    .banli-category-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 10px;
      color: #8b6dff;
      font-size: 12px;
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
      font-size: clamp(28px, 2.8vw, 42px);
      line-height: 1.08;
      letter-spacing: 0;
    }
    .banli-category-hero .category-desc {
      max-width: 760px;
      margin-top: 12px;
      color: rgba(255,255,255,.72);
      font-size: 14px;
      line-height: 1.55;
    }
    .banli-category-visual {
      position: relative;
      min-height: 100%;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding-right: clamp(.25rem, .8vw, .75rem);
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
      width: clamp(9.25rem, 10vw, 10.5rem);
      max-width: 100%;
      aspect-ratio: 4 / 5;
      margin-left: auto;
      overflow: hidden;
      border-radius: 10px;
      border: 1px solid rgba(255,255,255,.26);
      background: rgba(255,255,255,.08);
      box-shadow: 0 18px 42px rgba(0,0,0,.28);
      transform: translateZ(0);
    }
    .banli-category-image img {
      display: block;
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
      padding: 7px 10px;
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
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .banli-category-hero > .row {
        min-height: clamp(132px, 11vw, 160px);
      }
      .banli-category-hero .col-xl-9 {
        flex: 0 0 100%;
        width: 100%;
      }
      .banli-category-hero .col-xl-3 {
        display: none;
      }
      .banli-category-copy {
        max-width: min(820px, 78%);
      }
    }
    .banli-category-layout {
      align-items: flex-start;
    }
    .banli-category-layout > [class*="col-"],
    .banli-category-products,
    .banli-category-products .product-list-container,
    .banli-category-products .product-list-container > .row > [class*="col-"] {
      min-width: 0;
    }
    .banli-category-sidebar {
      position: sticky;
      top: calc(var(--banli-header-height, 104px) + 18px);
    }
    @media (min-width: 1200px) {
      .banli-category-filter-offcanvas.offcanvas-start {
        position: static !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        bottom: auto !important;
        width: auto !important;
        max-width: 100% !important;
        height: auto !important;
        max-height: none !important;
        z-index: auto !important;
        visibility: visible !important;
        transform: none !important;
        overflow: visible !important;
        background: rgba(255,255,255,.032) !important;
      }
      .banli-category-filter-offcanvas .offcanvas-header {
        display: none !important;
      }
      .banli-category-filter-offcanvas .offcanvas-body {
        padding: 0 !important;
        max-height: none !important;
        overflow-x: hidden !important;
        overflow-y: visible !important;
        scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,.26) transparent;
      }
      .banli-category-filter-offcanvas .offcanvas-body::-webkit-scrollbar {
        width: 6px;
      }
      .banli-category-filter-offcanvas .offcanvas-body::-webkit-scrollbar-track {
        background: transparent;
      }
      .banli-category-filter-offcanvas .offcanvas-body::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,.22);
        border-radius: 999px;
      }
    }
    .banli-category-sidebar.glass-card,
    .banli-category-products .glass-card {
      background: rgba(255,255,255,.045);
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      box-shadow: 0 18px 45px rgba(0,0,0,.18);
    }
    .banli-category-sidebar.glass-card {
      padding: 16px;
      background: rgba(255,255,255,.032);
      border-color: rgba(255,255,255,.07);
      box-shadow: 0 16px 40px rgba(0,0,0,.16);
    }
    .banli-category-sidebar .banli-check:has(.form-check-input:checked) {
      color: #fff;
      background:
        linear-gradient(135deg, rgba(0,210,255,.16), rgba(122,76,243,.16));
      border-color: rgba(0,210,255,.42);
      box-shadow: inset 0 1px 0 rgba(255,255,255,.08), 0 8px 20px rgba(0,0,0,.14);
    }
    .banli-category-sidebar .banli-check:has(.form-check-input:checked) .form-check-label {
      color: #fff;
    }
    .banli-category-filter-offcanvas .offcanvas-body {
      display: block;
    }
    .banli-category-filter-offcanvas .offcanvas-header {
      border-bottom: 1px solid rgba(255,255,255,.10);
      background: rgba(16,20,53,.96);
    }
    .banli-category-filter-offcanvas .offcanvas-title {
      color: #fff;
      font-size: 18px;
      font-weight: 800;
      letter-spacing: 0;
    }
    .banli-category-filter-offcanvas .btn-close {
      filter: invert(1) grayscale(100%) brightness(220%);
      opacity: .85;
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
      min-width: 0;
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
      min-width: 0;
    }
    .banli-category-products .product-name {
      color: #fff;
      font-weight: 750;
      line-height: 1.5;
      height: 3em;
      min-height: 3em;
      max-height: 3em;
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
      min-height: 56px;
      min-width: 0;
    }
    .banli-category-products .price-new {
      display: block;
      max-width: 100%;
      font-size: 20px;
      line-height: 1;
      overflow-wrap: anywhere;
    }
    .banli-category-products .price-old {
      margin-left: 0 !important;
      font-size: 14px;
      line-height: 1.2;
    }
    .banli-category-products .price-old-placeholder {
      visibility: hidden;
    }
    .banli-category-products .product-list-wrap {
      --bs-gutter-y: 0;
      gap: 0;
    }
    .banli-category-products .product-list-wrap > [class*="col-"] {
      padding-top: 0;
      padding-bottom: 0;
    }
    .banli-category-products .product-list-wrap > [class*="col-"] + [class*="col-"] {
      margin-top: 0;
      border-top: 1px solid rgba(255,255,255,.085);
    }
    .banli-category-products .product-list-wrap .glass-card {
      padding: 18px 0;
      border: 0;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
    }
    .banli-category-products .product-wrap.list {
      display: grid;
      grid-template-columns: minmax(180px, 240px) minmax(0, 1fr);
      gap: clamp(20px, 2.8vw, 36px);
      align-items: center;
      min-height: 240px;
    }
    .banli-category-products .product-wrap.list .image {
      width: 100%;
      max-width: 240px;
      aspect-ratio: 1;
      border-radius: 8px !important;
      background: #f8f8f8;
    }
    .banli-category-products .product-wrap.list .product-bottom-info {
      min-height: 0;
      padding: 0;
      justify-content: center;
    }
    .banli-category-products .product-wrap.list .product-name {
      height: auto;
      min-height: 0;
      max-height: none;
      margin-bottom: 14px;
      color: rgba(255,255,255,.92);
      font-size: clamp(18px, 1.45vw, 24px);
      font-weight: 720;
      line-height: 1.42;
      -webkit-line-clamp: 2;
    }
    .banli-category-products .product-wrap.list .product-price {
      min-height: 0;
      margin-top: 0;
      margin-bottom: 16px;
      gap: 12px;
    }
    .banli-category-products .product-wrap.list .price-new {
      font-size: clamp(20px, 1.6vw, 28px);
    }
    .banli-category-products .product-wrap.list .button-wrap {
      display: flex !important;
      align-items: center;
      gap: 10px;
      margin-top: 0 !important;
    }
    .banli-category-products .product-wrap.list .button-wrap .btn {
      height: 38px !important;
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 999px !important;
      background: rgba(255,255,255,.045) !important;
      color: rgba(255,255,255,.86) !important;
      box-shadow: none !important;
      transition: background .18s ease, border-color .18s ease, color .18s ease;
    }
    .banli-category-products .product-wrap.list .button-wrap .btn:hover {
      background: rgba(255,255,255,.08) !important;
      border-color: rgba(255,255,255,.24);
      color: #fff !important;
    }
    .banli-category-products .product-wrap.list .btn-add-cart {
      min-width: 142px;
      padding-inline: 18px !important;
    }
    .banli-category-products .product-wrap.list .btn-quick-view,
    .banli-category-products .product-wrap.list .btn-wishlist {
      width: 38px !important;
      min-width: 38px;
      padding: 0 !important;
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
    .banli-category-sidebar .sidebar-widget {
      list-style: none;
      margin: 0;
      padding: 0 0 14px;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }
    .banli-category-sidebar .sidebar-widget li {
      display: grid;
      grid-template-columns: minmax(0, 1fr) auto;
      align-items: start;
      gap: 6px;
      position: relative;
      width: 100%;
      margin: 2px 0;
      padding: 3px;
      border: 1px solid transparent;
      border-radius: 8px;
      overflow: visible;
      line-height: 1.35;
      transition: background .18s ease, border-color .18s ease;
    }
    .banli-category-sidebar .sidebar-widget .category-href {
      display: flex;
      align-items: center;
      grid-column: 1;
      width: 100%;
      min-height: 36px;
      min-width: 0;
      padding: 8px 10px;
      overflow: hidden;
      color: rgba(255,255,255,.84);
      text-overflow: ellipsis;
      white-space: nowrap;
      text-decoration: none;
      border: 1px solid transparent;
      border-radius: 8px;
      transition: color .18s ease, background .18s ease, border-color .18s ease;
    }
    .banli-category-sidebar .sidebar-widget .category-href:hover {
      color: #fff;
      background: rgba(255,255,255,.045);
      border-color: rgba(255,255,255,.08);
    }
    .banli-category-sidebar .sidebar-widget li:has(> .accordion-collapse.show) {
      background: transparent;
      border-color: transparent;
    }
    .banli-category-sidebar .sidebar-widget li.active {
      background: transparent;
      border-color: transparent;
    }
    .banli-category-sidebar .sidebar-widget li.active > .category-href {
      color: #fff;
      background: rgba(0,210,255,.07);
      border-color: transparent;
      font-weight: 800;
    }
    .banli-category-sidebar .sidebar-widget li.active > .category-href::before {
      content: "";
      position: static;
      display: inline-block;
      flex: 0 0 auto;
      width: 7px;
      height: 7px;
      margin-right: 9px;
      border-radius: 999px;
      background: #00d2ff;
      box-shadow: 0 0 10px rgba(0,210,255,.48);
    }
    .banli-category-sidebar .sidebar-widget ul {
      grid-column: 1 / -1;
      width: auto;
      margin: 4px 0 0 10px;
      padding: 4px 0 4px 14px;
      list-style: none;
      border-left: 1px solid rgba(140,164,220,.24);
    }
    .banli-category-sidebar .sidebar-widget ul .category-href {
      color: rgba(255,255,255,.70);
      font-size: 14px;
      font-weight: 650;
    }
    .banli-category-sidebar .sidebar-widget ul li {
      margin: 0;
      padding: 2px 0 2px 8px;
    }
    .banli-category-sidebar .sidebar-widget .toggle-icon {
      position: static;
      grid-column: 2;
      align-self: start;
      z-index: 2;
      width: 30px;
      height: 30px;
      min-width: 30px;
      min-height: 30px;
      flex: 0 0 30px;
      float: none !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      overflow: hidden !important;
      box-sizing: border-box;
      contain: paint;
      margin: 3px 0 0 !important;
      padding: 0 !important;
      color: rgba(255,255,255,.64);
      border: 1px solid rgba(255,255,255,.085);
      border-radius: 7px;
      background: rgba(255,255,255,.025);
      transform: none !important;
      transition: color .18s ease, background .18s ease, border-color .18s ease;
    }
    .banli-category-sidebar .sidebar-widget .toggle-icon:hover {
      color: #fff;
      background: rgba(0,210,255,.10);
      border-color: rgba(0,210,255,.32);
    }
    .banli-category-sidebar .sidebar-widget .toggle-icon i {
      display: none !important;
    }
    .banli-category-sidebar .sidebar-widget .toggle-icon::before {
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      width: 8px;
      height: 8px;
      display: block;
      box-sizing: border-box;
      border-right: 2px solid currentColor;
      border-bottom: 2px solid currentColor;
      transform: translate(-50%, -50%) rotate(45deg);
      transform-origin: 50% 50%;
      transition: transform .18s ease;
    }
    .banli-category-sidebar .sidebar-widget .toggle-icon:not(.collapsed)::before {
      transform: translate(-50%, -50%) rotate(225deg);
    }
    @media (max-width: 1199.98px) {
      body.page-categories #wrapper {
        padding-top: var(--banli-header-height, 176px) !important;
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
        padding: clamp(1.1rem, 5vw, 1.35rem);
      }
      .banli-category-hero > .row {
        min-height: auto;
      }
      .banli-category-hero h1 {
        font-size: clamp(30px, 9vw, 40px);
      }
      .banli-category-hero .category-desc {
        font-size: 14px;
        line-height: 1.65;
      }
      .banli-category-image {
        width: min(100%, 280px);
        aspect-ratio: 16 / 11;
        margin: 12px auto 0;
        background:
          linear-gradient(180deg, rgba(255,255,255,.95), rgba(245,247,252,.92));
      }
      .banli-category-image img {
        object-fit: contain;
        object-position: center center;
      }
      .banli-category-image-label {
        left: 10px;
        right: 10px;
        bottom: 10px;
        padding: 7px 10px;
        font-size: 11px;
      }
      .banli-category-visual {
        justify-content: center;
        padding-right: 0;
      }
      .banli-category-visual::before {
        width: min(16rem, 72%);
        opacity: .52;
      }
      .banli-category-layout > .left-column {
        width: 0 !important;
        max-width: 0 !important;
        flex: 0 0 0 !important;
        height: 0 !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
      }
      .banli-category-products {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
      }
      .banli-category-sidebar,
      .banli-category-filter-offcanvas {
        position: fixed !important;
        top: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        z-index: 2200;
        height: 100vh !important;
        height: 100dvh !important;
        max-height: none !important;
        transform: translateX(-100%) !important;
        visibility: hidden !important;
        overflow-y: auto !important;
        overscroll-behavior: contain;
      }
      .banli-category-filter-offcanvas {
        width: min(340px, 88vw);
        color: #fff;
        background:
          linear-gradient(180deg, rgba(16,20,53,.99), rgba(11,15,41,.99)) !important;
        border-right: 1px solid rgba(255,255,255,.10);
        box-shadow: 24px 0 60px rgba(0,0,0,.45);
      }
      .banli-category-filter-offcanvas.show,
      .banli-category-filter-offcanvas.showing {
        transform: translateX(0) !important;
        visibility: visible !important;
      }
      .banli-category-filter-offcanvas.hiding {
        visibility: visible !important;
      }
      .banli-category-filter-offcanvas .offcanvas-body {
        padding: 18px;
      }
      .banli-category-products .product-tool {
        grid-template-columns: 1fr;
      }
      .banli-category-products .right-per-page {
        justify-content: space-between;
        flex-wrap: wrap;
      }
      .banli-category-products .product-price {
        min-height: 62px;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 8px;
      }
      .banli-category-products .price-new {
        font-size: clamp(22px, 7.2vw, 30px);
        line-height: 1.05;
      }
      .banli-category-products .price-old {
        display: block;
        min-height: 18px;
        font-size: 14px;
        line-height: 1.25;
      }
      .banli-category-products .product-wrap.list {
        grid-template-columns: 132px minmax(0, 1fr);
        gap: 14px;
        min-height: 156px;
      }
      .banli-category-products .product-wrap.list .image {
        max-width: 132px;
      }
      .banli-category-products .product-wrap.list .product-name {
        font-size: 15px;
        line-height: 1.38;
      }
      .banli-category-products .product-wrap.list .button-wrap {
        flex-wrap: wrap;
      }
    }
  </style>
@endpush

@section('content')
  @php
    $categoryProductMode = request('style_list') == 'list' ? 'list' : 'grid';
  @endphp
  <section class="banli-category-page">
  <div class="container">
    <div class="banli-category-hero">
      <div class="row g-4 align-items-center">
        <div class="{{ $category->image ? 'col-12 col-xl-9' : 'col-12' }}">
          <div class="banli-category-copy">
            <div class="banli-category-kicker">{{ __('BanliTheme::common.collection') }}</div>
            <h1>{{ $category->description->name }}</h1>
            @if($category->description->content)
              <div class="category-desc">{!! $category->description->content !!}</div>
            @endif
          </div>
        </div>
        @if($category->image)
          <div class="col-12 col-xl-3">
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
      <div class="col-12 col-xl-3 pe-xl-4 left-column">
        <div class="offcanvas-xl offcanvas-start glass-card banli-category-sidebar banli-category-filter-offcanvas"
             tabindex="-1"
             id="banli-category-filter"
             aria-labelledby="banli-category-filter-label">
          <div class="offcanvas-header d-xl-none">
            <h5 class="offcanvas-title" id="banli-category-filter-label">{{ __('common.filter') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#banli-category-filter" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body p-xl-0">
            @include('shared.filter_sidebar_block')
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-9 right-column banli-category-products">
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

        <div class="d-xl-none d-flex justify-content-between align-items-center mb-4">
          <h2 class="h5 fw-bold text-white mb-0">{{ $category->description->name }}</h2>
          <button type="button"
                  class="mb-filter btn border border-light-subtle rounded px-3 py-2 text-white-50"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#banli-category-filter"
                  aria-controls="banli-category-filter">
            <i class="bi bi-funnel me-2"></i>{{ __('common.filter') }}
          </button>
        </div>

        <div class="product-list-container">
          @if(count($products_format))
            @include('shared.filter_bar_block')
            <div class="row g-3 g-lg-4 {{ $categoryProductMode == 'list' ? 'product-list-wrap' : ''}}">
              @foreach ($products_format as $product)
                <div class="{{ $categoryProductMode == 'grid' ? 'col-6 col-sm-4 col-md-3 col-xl-4' : 'col-12'}}">
                  <div class="glass-card h-100">
                    @include('shared.product', ['mode' => $categoryProductMode, 'show_actions' => true])
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
