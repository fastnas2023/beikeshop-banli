@extends('layout.master')
@section('body-class', 'page-brands')

@section('content')
@push('header')
  <style>
    body.page-brands #content {
      background: #101435;
    }
    body.page-brands .breadcrumb-filter {
      margin-bottom: 0;
      border-top: 1px solid rgba(255,255,255,.05);
      border-bottom: 1px solid rgba(255,255,255,.06);
      background: rgba(255,255,255,.025);
    }
    body.page-brands .banli-brands-page {
      min-height: 100vh;
      padding: clamp(36px, 4vw, 62px) 0 clamp(60px, 6vw, 92px);
      background:
        radial-gradient(circle at 78% 10%, rgba(122, 76, 243, .15), transparent 34%),
        radial-gradient(circle at 15% 15%, rgba(0, 210, 255, .10), transparent 30%),
        #101435;
    }
    body.page-brands .banli-brands-shell {
      max-width: 1280px;
    }
    body.page-brands .banli-brands-heading {
      margin-bottom: 22px;
      text-align: center;
    }
    body.page-brands .banli-brands-kicker {
      margin: 0 0 10px;
      color: rgba(255,255,255,.48);
      font-size: 13px;
      font-weight: 850;
      letter-spacing: .18em;
      line-height: 1.2;
      text-transform: uppercase;
    }
    body.page-brands .banli-brands-title {
      margin: 0;
      color: #fff;
      font-size: clamp(32px, 4vw, 56px);
      font-weight: 850;
      letter-spacing: 0;
      line-height: 1.05;
    }
    body.page-brands .banli-brands-index {
      position: sticky;
      top: calc(var(--banli-header-height, 104px) + 12px);
      z-index: 20;
      display: flex;
      gap: 8px;
      margin: 0 auto 34px;
      padding: 10px;
      overflow-x: auto;
      list-style: none;
      scrollbar-width: none;
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 8px;
      background: rgba(16, 20, 53, .76);
      box-shadow: 0 18px 44px rgba(0,0,0,.22);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
    }
    body.page-brands .banli-brands-index::-webkit-scrollbar {
      display: none;
    }
    body.page-brands .banli-brands-index-item {
      flex: 0 0 auto;
    }
    body.page-brands .banli-brands-index-link {
      width: 42px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      color: rgba(255,255,255,.72);
      background: rgba(255,255,255,.045);
      font-size: 14px;
      font-weight: 850;
      line-height: 1;
      text-decoration: none;
      transition: color .2s ease, background .2s ease, box-shadow .2s ease, transform .2s ease;
    }
    body.page-brands .banli-brands-index-link:hover,
    body.page-brands .banli-brands-index-link:focus-visible {
      color: #fff;
      background: rgba(0, 210, 255, .14);
      box-shadow: inset 0 0 0 1px rgba(0,210,255,.24);
      transform: translateY(-1px);
    }
    body.page-brands .banli-brand-groups {
      display: grid;
      gap: 18px;
      margin: 0;
      padding: 0;
      list-style: none;
    }
    body.page-brands .banli-brand-group {
      scroll-margin-top: calc(var(--banli-header-height, 104px) + 86px);
      display: grid;
      grid-template-columns: 72px minmax(0, 1fr);
      gap: 18px;
      padding: 20px;
      border: 1px solid rgba(255,255,255,.09);
      border-radius: 8px;
      background:
        linear-gradient(180deg, rgba(255,255,255,.055), rgba(255,255,255,.028)),
        rgba(18, 22, 58, .72);
    }
    body.page-brands .banli-brand-letter {
      width: 52px;
      height: 52px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      color: #fff;
      background: linear-gradient(135deg, rgba(0,210,255,.20), rgba(122,76,243,.22));
      font-size: 22px;
      font-weight: 900;
      line-height: 1;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.08);
    }
    body.page-brands .banli-brand-grid {
      display: grid;
      grid-template-columns: repeat(5, minmax(0, 1fr));
      gap: 14px;
    }
    body.page-brands .banli-brand-card {
      position: relative;
      min-height: 124px;
      padding: 14px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 10px;
      overflow: hidden;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 8px;
      color: rgba(255,255,255,.82);
      background:
        linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.035)),
        rgba(13, 17, 48, .84);
      text-align: center;
      text-decoration: none;
      box-shadow: inset 0 1px 0 rgba(255,255,255,.06);
      transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
    }
    body.page-brands .banli-brand-card::before {
      content: "";
      position: absolute;
      inset: 0;
      opacity: 0;
      background: radial-gradient(circle at 50% 0%, rgba(0,210,255,.18), transparent 52%);
      transition: opacity .22s ease;
    }
    body.page-brands .banli-brand-card:hover,
    body.page-brands .banli-brand-card:focus-visible {
      color: #fff;
      transform: translateY(-2px);
      border-color: rgba(0, 210, 255, .32);
      background:
        linear-gradient(180deg, rgba(255,255,255,.10), rgba(255,255,255,.045)),
        rgba(18, 25, 65, .92);
      box-shadow: 0 16px 34px rgba(0,0,0,.18), inset 0 1px 0 rgba(255,255,255,.08);
    }
    body.page-brands .banli-brand-card:hover::before,
    body.page-brands .banli-brand-card:focus-visible::before {
      opacity: 1;
    }
    body.page-brands .banli-brand-logo {
      position: relative;
      z-index: 1;
      width: 100%;
      min-height: 58px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    body.page-brands .banli-brand-logo img {
      max-width: 88%;
      max-height: 62px;
      width: auto;
      height: auto;
      object-fit: contain;
      filter: drop-shadow(0 0 12px rgba(255,255,255,.10));
      mix-blend-mode: normal;
      opacity: .9;
      transition: opacity .22s ease, filter .22s ease, transform .22s ease;
    }
    body.page-brands .banli-brand-card:hover .banli-brand-logo img,
    body.page-brands .banli-brand-card:focus-visible .banli-brand-logo img {
      filter: drop-shadow(0 0 16px rgba(255,255,255,.18)) brightness(1.12);
      opacity: 1;
      transform: scale(1.025);
    }
    body.page-brands .banli-brand-name {
      position: relative;
      z-index: 1;
      max-width: 100%;
      overflow: hidden;
      color: currentColor;
      font-size: 14px;
      font-weight: 850;
      line-height: 1.2;
      letter-spacing: .04em;
      text-overflow: ellipsis;
      text-transform: uppercase;
      white-space: nowrap;
    }
    body.page-brands .banli-brand-card.is-text-only .banli-brand-logo {
      display: none;
    }
    body.page-brands .banli-brand-card.is-text-only .banli-brand-name {
      font-size: clamp(15px, 1.1vw, 18px);
      letter-spacing: .08em;
    }
    @media (max-width: 1199.98px) {
      body.page-brands .banli-brand-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
      }
    }
    @media (max-width: 991.98px) {
      body.page-brands .banli-brands-index {
        top: 12px;
      }
      body.page-brands .banli-brand-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }
    }
    @media (max-width: 767.98px) {
      body.page-brands .banli-brands-page {
        padding-top: 30px;
      }
      body.page-brands .banli-brand-group {
        grid-template-columns: 1fr;
        gap: 12px;
        padding: 14px;
      }
      body.page-brands .banli-brand-letter {
        width: 44px;
        height: 44px;
        font-size: 18px;
      }
      body.page-brands .banli-brand-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
      }
      body.page-brands .banli-brand-card {
        min-height: 104px;
        padding: 12px;
      }
      body.page-brands .banli-brand-name {
        font-size: 12px;
      }
      body.page-brands .banli-brand-card.is-text-only .banli-brand-name {
        font-size: 13px;
      }
    }
  </style>
@endpush

<x-shop-breadcrumb type="static" value="brands.index" />

<section class="banli-brands-page">
<div class="container banli-brands-shell">
  @hook('brand.list.before')
  <div class="banli-brands-heading">
    <p class="banli-brands-kicker">Brand Directory</p>
    <h1 class="banli-brands-title">{{ __('shop/brands.index') }}</h1>
  </div>

  <ul class="banli-brands-index">
    @foreach ($brands as $brand)
      <li class="banli-brands-index-item">
        <a href="{{ request()->url() }}#{{ $brand['0']['first'] }}" class="banli-brands-index-link">{{ $brand['0']['first'] }}</a>
      </li>
    @endforeach
  </ul>

  <ul class="banli-brand-groups">
    @foreach ($brands as $brand)
    <li class="banli-brand-group" id="{{ $brand['0']['first'] }}">
      <div class="banli-brand-letter">{{ $brand['0']['first'] }}</div>
      <div class="banli-brand-grid">
          @foreach ($brand as $item)
            @php
              $brandName = trim((string) ($item['name'] ?? ''));
              $brandLogo = trim((string) ($item['logo'] ?? ''));
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
              $brandKey = str_replace([' ', 'è', 'é'], ['-', 'e', 'e'], strtolower($brandName));
              if ($brandLogo && (str_contains($brandLogo, 'banli_theme-assets/sponsors/') || str_contains($brandLogo, 'image/catalog/demo/brands/')) && isset($demoBrandLogos[$brandKey])) {
                $brandLogo = image_origin($demoBrandLogos[$brandKey]) . '?v=20260609';
              }
              $showLogo = $brandLogo !== '';
            @endphp
            <article class="banli-brand-tile">
              <a href="{{ type_route('brand', $item['id']) }}" class="banli-brand-card {{ $showLogo ? 'has-logo' : 'is-text-only' }}">
                @if ($showLogo)
                  <span class="banli-brand-logo">
                    <img
                      src="{{ $brandLogo }}"
                      alt="{{ $brandName }}"
                      loading="lazy"
                      onerror="this.hidden=true; this.closest('.banli-brand-card').classList.add('is-text-only'); this.closest('.banli-brand-card').querySelector('.banli-brand-name').hidden=false;">
                  </span>
                @endif
                <span class="banli-brand-name">{{ $brandName }}</span>
              </a>
            </article>
          @endforeach
      </div>
    </li>
    @endforeach
  </ul>
  @hook('brand.list.after')
</div>
</section>

@endsection
