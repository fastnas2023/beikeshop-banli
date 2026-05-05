<div class="module-item py-4 banli-brand-section {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
  <div class="module-info module-brand">
    <div class="sponsors-wrap">
      <h6 class="text-center text-white-50 text-uppercase tracking-wider mb-2">{{ $content['title'] ?: 'Trusted By Leading Companies' }}</h6>
      @if(!empty($content['subtitle']))
      <p class="text-center text-white-50 mb-5 small">{{ $content['subtitle'] }}</p>
      @else
      <div class="mb-4"></div>
      @endif
      
      <div class="container">
        <div class="row align-items-center justify-content-center g-3 opacity-75 banli-brand-grid">
          @foreach ($content['brands'] as $brand)
          <div class="col-6 col-md-4 col-lg text-center sponsor-logo">
            <a href="{{ $brand['url'] ?: 'javascript:void(0)' }}" class="text-decoration-none d-flex align-items-center justify-content-center brand-card-hover overflow-hidden">
              @if(!empty($brand['logo']))
                <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] ?? '' }}" class="brand-img-filter">
              @else
                <span class="text-white-50 fw-semibold">{{ $brand['name'] ?? '' }}</span>
              @endif
            </a>
          </div>
          @endforeach
        </div>
      </div>

      @if (!empty($content['brands']))
      <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-outline-light rounded-pill px-4 py-2" style="border-color: rgba(255,255,255,0.2); font-size: 0.9rem; letter-spacing: 1px;" href="{{ shop_route('brands.index') }}">{{ __('common.show_all') }}</a>
      </div>
      @endif
    </div>
  </div>

  <style>
  .banli-brand-section .sponsors-wrap {
    max-width: 1304px;
    margin: 0 auto;
    padding: 36px 0 44px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
  }
  .banli-brand-section h6 {
    letter-spacing: 2px;
  }
  .banli-brand-section .banli-brand-grid {
    max-width: none;
    margin-left: auto;
    margin-right: auto;
  }
  .banli-brand-section .sponsor-logo {
    flex: 0 0 20%;
    max-width: 20%;
  }
  .banli-brand-section .brand-card-hover {
    height: 96px;
    padding: 0;
    background: rgba(255,255,255,0.035);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 8px;
    transition: all 0.3s ease;
  }
  .sponsor-logo .brand-img-filter {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(200%) grayscale(100%);
    opacity: 0.6;
    transition: all 0.3s ease;
  }
  .sponsor-logo:hover .brand-card-hover {
    background: rgba(255,255,255,0.08) !important;
    border-color: rgba(255,255,255,0.15) !important;
    transform: translateY(-3px);
  }
  .sponsor-logo:hover .brand-img-filter {
    filter: brightness(100%) grayscale(0%);
    opacity: 1;
    transform: scale(1.04);
  }
  @media (max-width: 991.98px) {
    .banli-brand-section .sponsor-logo {
      flex: 0 0 33.333333%;
      max-width: 33.333333%;
    }
  }
  @media (max-width: 575.98px) {
    .banli-brand-section .sponsors-wrap {
      padding-left: 16px;
      padding-right: 16px;
    }
    .banli-brand-section .sponsor-logo {
      flex: 0 0 50%;
      max-width: 50%;
    }
    .banli-brand-section .brand-card-hover {
      height: 86px;
      padding: 0;
    }
  }
  </style>
</div>
