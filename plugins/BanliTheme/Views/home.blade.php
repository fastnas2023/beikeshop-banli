@extends('layout.master')
@section('body-class', 'page-home')
@section('content')
@php
  $banliBoolValue = function ($value, $default = true) {
    if (is_bool($value)) {
      return $value;
    }

    if ($value === null || $value === '') {
      return $default;
    }

    $filtered = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    return $filtered ?? $default;
  };
  $banliDefaultMarqueeItems = [
    __('BanliTheme::common.marquee_new_arrivals'),
    __('BanliTheme::common.marquee_curated_finds'),
    __('BanliTheme::common.marquee_fast_checkout'),
    __('BanliTheme::common.marquee_member_offers'),
    __('BanliTheme::common.marquee_quality_picks'),
    __('BanliTheme::common.marquee_fresh_styles'),
  ];
  $banliMarqueeItemsSetting = system_setting('base.banli_theme_marquee_items', []);
  if (is_string($banliMarqueeItemsSetting)) {
    $decoded = json_decode($banliMarqueeItemsSetting, true);
    $banliMarqueeItemsSetting = is_array($decoded) ? $decoded : preg_split('/\r\n|\r|\n/', $banliMarqueeItemsSetting);
  }
  $banliMarqueeItems = collect($banliMarqueeItemsSetting ?: $banliDefaultMarqueeItems)
    ->map(fn ($item) => trim((string) $item))
    ->filter()
    ->values();
  $banliShowMarquee = $banliBoolValue(system_setting('base.banli_theme_marquee_enabled', true), true) && $banliMarqueeItems->isNotEmpty();
@endphp

@push('header')
  <style>
    #section-store-marquee {
      position: relative;
      background:
        linear-gradient(180deg, rgba(8, 10, 24, 0) 0%, rgba(12, 15, 38, .88) 18%, #101435 62%, #101435 100%);
    }
    #section-store-marquee::before,
    #section-store-marquee::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      z-index: 0;
      pointer-events: none;
    }
    #section-store-marquee::before {
      top: 0;
      height: clamp(2rem, 5vw, 5rem);
      background: linear-gradient(180deg, rgba(8, 10, 24, .92), rgba(8, 10, 24, 0));
    }
    #section-store-marquee::after {
      bottom: 0;
      height: clamp(2.5rem, 6vw, 6rem);
      background: linear-gradient(180deg, rgba(16, 20, 53, 0), #101435);
    }
    #section-store-marquee,
    #section-store-marquee .marquee-viewport {
      overflow: hidden;
    }
    #section-store-marquee .marquee-viewport {
      position: relative;
      z-index: 1;
      padding: clamp(48px, 5vw, 86px) 0 clamp(36px, 3.6vw, 62px);
    }
    #section-store-marquee .marquee-band {
      width: calc(100% + clamp(180px, 14vw, 320px));
      margin-left: calc(clamp(90px, 7vw, 160px) * -1);
      position: relative;
      z-index: 1;
      overflow: visible;
      transform-origin: center center;
      padding-top: clamp(12px, 1vw, 20px) !important;
      padding-bottom: clamp(12px, 1vw, 20px) !important;
    }
    #section-store-marquee .marquee-band + .marquee-band {
      z-index: 2;
      margin-top: clamp(-28px, -1.3vw, -14px);
    }
    #section-store-marquee .de-marquee-list-1,
    #section-store-marquee .de-marquee-list-2,
    #section-store-marquee .js-marquee,
    #section-store-marquee .js-marquee-wrapper {
      display: flex !important;
      align-items: center;
      width: max-content;
      max-width: none;
      white-space: nowrap;
    }
    #section-store-marquee .fs-60 {
      display: inline-flex;
      flex: 0 0 auto;
      white-space: nowrap;
      font-size: clamp(36px, 3.8vw, 64px);
      line-height: 1.05;
    }
    @media (min-width: 992px) {
      #section-store-marquee .marquee-viewport {
        padding-top: clamp(78px, 5vw, 112px);
        padding-bottom: clamp(50px, 4vw, 80px);
      }
    }
  </style>
@endpush

<div id="content" class="no-top no-bottom">
  <div class="modules-box no-bottom no-top" id="home-modules-box">

  @hook('home.modules.before')

  @foreach($modules as $module)

    @include($module['view_path'], $module)
  @endforeach

  @if ($banliShowMarquee)
  <section id="section-store-marquee" class="section-dark p-0" aria-label="{{ __('BanliTheme::common.collection') }}">
    <div class="marquee-viewport">
      <div class="marquee-band bg-color text-light d-flex py-4 lh-1 rot-2">
        <div class="de-marquee-list-1">
          @foreach ($banliMarqueeItems as $item)
            <span class="fs-60 mx-3">{{ $item }}</span>
            <span class="fs-60 mx-3 op-2">/</span>
          @endforeach
        </div>
      </div>

      <div class="marquee-band bg-color-2 text-light d-flex py-4 lh-1 rot-min-1 mt-min-20">
        <div class="de-marquee-list-2">
          @foreach ($banliMarqueeItems as $item)
            <span class="fs-60 mx-3">{{ $item }}</span>
            <span class="fs-60 mx-3 op-2">/</span>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  @hook('home.modules.after')

  </div>
</div>

@endsection
