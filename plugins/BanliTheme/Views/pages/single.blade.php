@extends('layout.master')
@php
  $isArticlePage = (int) ($page->page_category_id ?? 0) > 0;
@endphp
@section('body-class', $isArticlePage ? 'page-pages banli-news-single section-dark' : 'page-pages banli-static-page section-dark')
@section('title', $page->description->meta_title ?: $page->description->title)
@section('keywords', $page->description->meta_keywords)
@section('description', $page->description->meta_description)
@section('og_type', 'article')
@section('og_image', $page->image ? image_origin($page->image) : asset('banli_theme-assets/aivent/images/misc/sd1.webp'))
@section('og_image_width', '1200')
@section('og_image_height', '800')

@push('header')
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}">
  <style>
    body.banli-static-page {
      background: #101435;
    }
    body.banli-static-page #wrapper {
      padding-top: var(--banli-header-height, clamp(7rem, 8vw, 8.25rem)) !important;
    }
    .banli-static-page-hero {
      position: relative;
      overflow: hidden;
      padding: clamp(3.25rem, 6vw, 5.5rem) 0 clamp(2.75rem, 5vw, 4.75rem);
      background: #101435;
    }
    .banli-static-page-hero .jarallax-img,
    .banli-static-page-hero::before {
      position: absolute;
      inset: 0;
    }
    .banli-static-page-hero .jarallax-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: .55;
    }
    .banli-static-page-hero::before {
      content: "";
      z-index: 1;
      background:
        radial-gradient(circle at 78% 20%, rgba(122, 76, 243, .18), transparent 34%),
        linear-gradient(180deg, rgba(16, 20, 53, .68), #101435 96%);
    }
    .banli-static-page-hero .container {
      position: relative;
      z-index: 2;
    }
    .banli-static-page-hero h1 {
      max-width: 860px;
      margin: 0;
      color: #fff;
      font-size: clamp(42px, 5.6vw, 82px);
      line-height: 1.06;
      letter-spacing: 0;
    }
    .banli-static-page-hero p {
      max-width: 760px;
      margin: 22px 0 0;
      color: rgba(255, 255, 255, .74);
      font-size: clamp(16px, 1.5vw, 20px);
      line-height: 1.75;
    }
    .banli-static-page-body {
      padding: clamp(1.5rem, 3vw, 2.5rem) 0 clamp(4rem, 7vw, 5.5rem);
      background: #101435;
    }
    .banli-static-page-body .breadcrumb-wrap {
      margin: 0 0 clamp(1.25rem, 2vw, 1.625rem) !important;
      padding: 0 !important;
      background: transparent !important;
      overflow: visible;
    }
    .banli-static-page-body .breadcrumb-wrap .container {
      width: 100%;
      min-height: 2.875rem;
      padding: .55rem 1.125rem;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 8px;
      background: rgba(255,255,255,.025) !important;
    }
    .banli-static-page-body .breadcrumb-wrap .breadcrumb {
      margin: 0;
      padding: 0 !important;
      align-items: center;
    }
    .banli-static-page-body .breadcrumb-item,
    .banli-static-page-body .breadcrumb-item a {
      color: rgba(255,255,255,.62);
      text-decoration: none;
    }
    .banli-static-page-card {
      overflow: hidden;
      padding: clamp(1.5rem, 3vw, 3rem);
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      background:
        linear-gradient(135deg, rgba(255,255,255,.065), rgba(255,255,255,.028));
      box-shadow: 0 24px 70px rgba(0,0,0,.22);
    }
    .banli-static-page-image {
      width: 100%;
      max-height: 520px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,.10);
      box-shadow: 0 20px 48px rgba(0,0,0,.22);
    }
    .banli-static-content,
    .banli-static-content p,
    .banli-static-content li,
    .banli-static-content span,
    .banli-static-content div {
      color: rgba(255,255,255,.78) !important;
      font-family: inherit !important;
      font-size: clamp(16px, 1.25vw, 18px) !important;
      line-height: 1.85 !important;
      background: transparent !important;
    }
    .banli-static-content h1,
    .banli-static-content h2,
    .banli-static-content h3,
    .banli-static-content h4,
    .banli-static-content h5,
    .banli-static-content h6 {
      color: #fff !important;
      margin: 0 0 18px;
      font-family: inherit !important;
      line-height: 1.25 !important;
      letter-spacing: 0;
    }
    .banli-static-content img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }
    @media (max-width: 991.98px) {
      body.banli-static-page #wrapper {
        padding-top: var(--banli-header-height, clamp(10rem, 45vw, 11rem)) !important;
      }
      .banli-static-page-hero {
        padding: 2.5rem 0 2.25rem;
      }
      .banli-static-page-body {
        padding-top: 1.25rem;
      }
      .banli-static-page-card {
        padding: 1.25rem;
      }
    }
  </style>
@endpush

@section('content')
  @php
    $postDate = $page->created_at;
    $postImage = $page->image ? image_origin($page->image) : asset('banli_theme-assets/aivent/images/misc/sd1.webp');
  @endphp

  @if ($isArticlePage)
    <section id="section-hero" class="section-dark no-top no-bottom text-light jarallax relative mh-500" data-speed="0.45">
      <img src="{{ asset('banli_theme-assets/aivent/images/background/3.webp') }}" class="jarallax-img" alt="">
      <div class="gradient-edge-bottom h-50"></div>
      <div class="sw-overlay op-5"></div>
      <div class="abs bottom-10 z-2 w-100">
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
              <h1 class="text-start fs-48 fs-sm-10vw mb-0">{{ $page->description->title }}</h1>
            </div>

            <div class="col-lg-2">
              <div class="relative text-lg-end mt-4 mt-lg-0">
                <div class="d-inline-block z-2 bg-color rounded-1 text-white p-4 text-center fw-600 banli-news-single-date">
                  <h4 class="fs-60 mb-0 lh-1">{{ $postDate ? $postDate->format('d') : '' }}</h4>
                  <span class="fs-20 fw-60">{{ $postDate ? $postDate->format('M') : '' }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="banli-news-single-section">
      <div class="container">
        <div class="row g-4 justify-content-center">
          <div class="col-lg-10">
            <div class="blog-read">
              <div class="post-text">
                <img src="{{ $postImage }}" class="w-100 rounded-1 mb-4 banli-news-single-image" alt="{{ $page->description->title }}">

                @if ($page->category || $page->author || $page->views)
                  <div class="banli-news-meta">
                    @if ($page->category)
                      <span>{{ $page->category->description->title }}</span>
                    @endif
                    @if ($page->author)
                      <span>{{ __('page_category.author') }}: {{ $page->author }}</span>
                    @endif
                    @if ($page->views)
                      <span>{{ __('page_category.views') }}: {{ $page->views }}</span>
                    @endif
                  </div>
                @endif

                <div class="rich-text-editor-content banli-news-content">{!! $page_format['content'] !!}</div>
              </div>
            </div>

            @if ($products)
              <div class="relations-wrap mt-5">
                <div class="title text-center fs-4 mb-4">{{ __('admin/product.product_relations') }}</div>
                <div class="product swiper-style-plus">
                  <div class="swiper relations-swiper">
                    <div class="swiper-wrapper">
                      @foreach ($products as $item)
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
            @endif
          </div>
        </div>
      </div>
    </section>
  @else
    <section class="banli-static-page-hero text-light">
      <img src="{{ asset('banli_theme-assets/aivent/images/background/3.webp') }}" class="jarallax-img" alt="">
      <div class="container">
        <div class="subtitle">Information</div>
        <h1>{{ $page->description->title }}</h1>
        @if ($page->description->summary)
          <p>{{ $page->description->summary }}</p>
        @endif
      </div>
    </section>

    <section class="banli-static-page-body">
      <div class="container">
        <x-shop-breadcrumb type="page" :value="$page->id" />

        <div class="banli-static-page-card">
          <div class="row g-4 g-lg-5 align-items-start">
            @if ($page->image)
              <div class="col-lg-5">
                <img src="{{ image_origin($page->image) }}" class="banli-static-page-image" alt="{{ $page->description->title }}">
              </div>
            @endif

            <div class="{{ $page->image ? 'col-lg-7' : 'col-lg-10 mx-auto' }}">
              <div class="rich-text-editor-content banli-static-content">{!! $page_format['content'] !!}</div>
            </div>
          </div>
        </div>

        @if ($products)
          <div class="relations-wrap mt-5">
            <div class="title text-center fs-4 mb-4">{{ __('admin/product.product_relations') }}</div>
            <div class="product swiper-style-plus">
              <div class="swiper relations-swiper">
                <div class="swiper-wrapper">
                  @foreach ($products as $item)
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
        @endif
      </div>
    </section>
  @endif
  @hook('pages.single.footer')
@endsection

@push('add-scripts')
  <script>
    updateBanliPageHeaderOffset();
    $(window).on('load resize orientationchange', bk.debounce(updateBanliPageHeaderOffset, 120));

    function updateBanliPageHeaderOffset() {
      const header = document.querySelector('header');
      const height = header ? Math.ceil(header.getBoundingClientRect().height) : 0;

      if (height > 0) {
        document.documentElement.style.setProperty('--banli-header-height', height + 'px');
      }
    }

    if ($('.relations-swiper').length) {
      var relationsSwiper = new Swiper('.relations-swiper', {
        watchSlidesProgress: true,
        breakpoints: {
          320: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 4,
            slidesPerGroup: 4,
            spaceBetween: 30,
          },
        },
        spaceBetween: 30,
        navigation: {
          nextEl: '.relations-swiper-next',
          prevEl: '.relations-swiper-prev',
        },
        pagination: {
          el: '.relations-pagination',
          clickable: true,
        },
      })
    }
  </script>
@endpush
