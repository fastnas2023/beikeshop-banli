@extends('layout.master')
@section('body-class', 'page-categories-home banli-news-list')
@section('title', __('page_category.index'))

@section('content')
  <section id="section-hero" class="section-dark no-top no-bottom text-light jarallax relative mh-500" data-speed="0.45">
    <img src="{{ asset('banli_theme-assets/aivent/images/background/3.webp') }}" class="jarallax-img" alt="">
    <div class="gradient-edge-bottom h-50"></div>
    <div class="sw-overlay op-5"></div>
    <div class="abs w-80 bottom-10 z-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-between gx-5">
          <div class="col-lg-6">
            <div class="relative">
              <div class="text-start">
                <h1 class="fs-96 text-uppercase fs-sm-10vw mb-0 lh-1">{{ __('page_category.index') }}</h1>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <p class="mb-0">{{ system_setting('base.meta_description') ?: 'Explore the latest stories, insights, and updates from Banli.' }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="banli-news-grid-section">
    <div class="container">
      @if ($active_pages->count() > 0)
        <div class="row g-4">
          @foreach ($active_pages as $page)
            @php
              $fallbackIndex = (($loop->iteration - 1) % 6) + 1;
              $postImage = $page->image ? image_origin($page->image) : asset("banli_theme-assets/aivent/images/news/s{$fallbackIndex}.webp");
              $postDate = $page->created_at;
            @endphp
            <div class="col-lg-4 col-md-6">
              <a href="{{ shop_route('pages.show', [$page->id]) }}" class="d-block hover relative rounded-20 overflow-hidden text-light banli-news-card">
                <div class="abs z-2 bg-color rounded-2 text-white p-3 pb-2 m-4 text-center fw-600 banli-news-date">
                  <h4 class="fs-36 mb-0 lh-1">{{ $postDate ? $postDate->format('d') : '' }}</h4>
                  <span>{{ $postDate ? $postDate->format('M') : '' }}</span>
                </div>

                <img src="{{ $postImage }}" class="w-100 hover-scale-1-1" alt="{{ $page->description->title }}">

                <div class="absolute start-0 bottom-0 p-4 z-2">
                  <h4>{{ $page->description->title }}</h4>
                  @if ($page->description->summary)
                    <p>{{ $page->description->summary }}</p>
                  @endif
                </div>

                <div class="gradient-edge-bottom h-70"></div>
              </a>
            </div>
          @endforeach

          <div class="col-lg-12 pt-4 text-center">
            <div class="d-inline-block">
              {{ $active_pages->links('shared/pagination/bootstrap-4') }}
            </div>
          </div>
        </div>
      @else
        <x-shop-no-data />
      @endif
    </div>
  </section>
@endsection
