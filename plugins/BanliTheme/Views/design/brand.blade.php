<div class="module-item py-4 banli-brand-section {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
  <div class="module-info module-brand">
    <div class="sponsors-wrap">
      <h6 class="banli-brand-title text-center text-uppercase mb-2">{{ $content['title'] ?: 'Featured Brands' }}</h6>
      @if(!empty($content['subtitle']))
      <p class="banli-brand-subtitle text-center mb-4">{{ $content['subtitle'] }}</p>
      @else
      <div class="banli-brand-title-spacer"></div>
      @endif
      
      <div class="container">
        <div class="row align-items-center justify-content-center banli-brand-grid">
          @foreach ($content['brands'] as $brand)
            @php
              $brandName = trim((string) ($brand['name'] ?? ''));
              $brandLogo = trim((string) ($brand['logo'] ?? ''));
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
          <div class="sponsor-logo">
            <a href="{{ $brand['url'] ?: 'javascript:void(0)' }}" class="banli-brand-card text-decoration-none {{ $showLogo ? 'has-logo' : 'is-text-only' }}" aria-label="{{ $brandName ?: __('common.brand') }}">
              <span class="banli-brand-card-shine" aria-hidden="true"></span>
              @if($showLogo)
                <img
                  src="{{ $brandLogo }}"
                  alt="{{ $brandName }}"
                  class="brand-img-filter"
                  loading="lazy"
                  onerror="this.hidden=true; this.closest('.banli-brand-card').classList.add('is-text-only'); this.nextElementSibling.hidden=false;">
                <span class="banli-brand-name" hidden>{{ $brandName }}</span>
              @else
                <span class="banli-brand-name">{{ $brandName }}</span>
              @endif
            </a>
          </div>
          @endforeach
        </div>
      </div>

      @if (!empty($content['brands']))
      <div class="d-flex justify-content-center mt-4">
        <a class="banli-brand-all-btn" href="{{ shop_route('brands.index') }}">{{ __('common.show_all') }}</a>
      </div>
      @endif
    </div>
  </div>

  <style>
  .banli-brand-section {
    position: relative;
    padding-left: 0 !important;
    padding-right: 0 !important;
  }
  .banli-brand-section .sponsors-wrap {
    width: 100%;
    max-width: none;
    margin: 0;
    padding: clamp(34px, 4vw, 52px) 0 clamp(38px, 4.2vw, 56px);
    border-top: 1px solid rgba(255,255,255,0.04);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    background:
      radial-gradient(circle at 50% 0%, rgba(47, 125, 246, .10), transparent 34%),
      linear-gradient(180deg, rgba(255,255,255,.018), rgba(255,255,255,0));
  }
  .banli-brand-section .sponsors-wrap > .container {
    max-width: 1500px;
    padding-left: clamp(28px, 4vw, 72px);
    padding-right: clamp(28px, 4vw, 72px);
  }
  .banli-brand-section .banli-brand-title {
    margin: 0;
    color: rgba(255,255,255,.72);
    font-size: clamp(15px, 1.15vw, 20px);
    font-weight: 850;
    letter-spacing: .18em;
    line-height: 1.2;
  }
  .banli-brand-section .banli-brand-subtitle {
    margin: 10px auto 26px;
    max-width: 620px;
    color: rgba(255,255,255,.50);
    font-size: 14px;
    font-weight: 650;
    line-height: 1.5;
  }
  .banli-brand-section .banli-brand-title-spacer {
    height: 26px;
  }
  .banli-brand-section .banli-brand-grid {
    display: grid !important;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 14px;
    max-width: 1240px;
    margin-left: auto;
    margin-right: auto;
  }
  .banli-brand-section .sponsor-logo {
    width: 100%;
    min-width: 0;
    padding: 0;
  }
  .banli-brand-section .banli-brand-card {
    position: relative;
    isolation: isolate;
    height: 96px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,.08);
    background:
      linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.035)),
      rgba(13, 17, 48, .84);
    box-shadow: inset 0 1px 0 rgba(255,255,255,.06);
    transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
  }
  .banli-brand-section .banli-brand-card-shine {
    position: absolute;
    inset: 0;
    z-index: -1;
    opacity: 0;
    background:
      radial-gradient(circle at 50% 0%, rgba(0,210,255,.20), transparent 48%),
      linear-gradient(90deg, transparent, rgba(255,255,255,.08), transparent);
    transition: opacity .22s ease;
  }
  .sponsor-logo .brand-img-filter {
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
  .banli-brand-section .banli-brand-name {
    display: block;
    max-width: 100%;
    overflow: hidden;
    color: rgba(255,255,255,.78);
    font-size: clamp(15px, 1.05vw, 20px);
    font-weight: 850;
    line-height: 1.15;
    letter-spacing: .08em;
    text-align: center;
    text-overflow: ellipsis;
    text-transform: uppercase;
    white-space: nowrap;
  }
  .sponsor-logo:hover .banli-brand-card {
    transform: translateY(-2px);
    border-color: rgba(0, 210, 255, .32);
    background:
      linear-gradient(180deg, rgba(255,255,255,.10), rgba(255,255,255,.045)),
      rgba(18, 25, 65, .92);
    box-shadow: 0 16px 34px rgba(0,0,0,.18), inset 0 1px 0 rgba(255,255,255,.08);
  }
  .sponsor-logo:hover .banli-brand-card-shine {
    opacity: 1;
  }
  .sponsor-logo:hover .brand-img-filter {
    filter: drop-shadow(0 0 16px rgba(255,255,255,.18)) brightness(1.12);
    opacity: 1;
    transform: scale(1.025);
  }
  .banli-brand-section .banli-brand-all-btn {
    min-width: 132px;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,.14);
    color: rgba(255,255,255,.76);
    background: rgba(255,255,255,.025);
    font-size: 14px;
    font-weight: 750;
    letter-spacing: .02em;
    text-decoration: none;
    transition: color .22s ease, border-color .22s ease, background .22s ease, transform .22s ease;
  }
  .banli-brand-section .banli-brand-all-btn:hover,
  .banli-brand-section .banli-brand-all-btn:focus-visible {
    color: #fff;
    border-color: rgba(0,210,255,.40);
    background: rgba(0,210,255,.10);
    transform: translateY(-1px);
  }
  @media (max-width: 1199.98px) {
    .banli-brand-section .banli-brand-grid {
      grid-template-columns: repeat(4, minmax(0, 1fr));
    }
  }
  @media (max-width: 767.98px) {
    .banli-brand-section .banli-brand-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px;
    }
    .banli-brand-section .banli-brand-card {
      height: 82px;
      padding: 12px;
    }
    .sponsor-logo .brand-img-filter {
      max-height: 54px;
      max-width: 90%;
    }
    .banli-brand-section .banli-brand-name {
      font-size: 13px;
    }
  }
  </style>
</div>
