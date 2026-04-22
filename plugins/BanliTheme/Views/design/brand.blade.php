<div class="module-item py-5 {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
  <div class="module-info module-brand">
    <div class="sponsors-wrap" style="padding-top: 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 3rem;">
      <h6 class="text-center text-white-50 text-uppercase tracking-wider mb-2" style="letter-spacing: 2px;">{{ $content['title'] ?: 'Trusted By Leading Companies' }}</h6>
      @if(!empty($content['subtitle']))
      <p class="text-center text-white-50 mb-5 small">{{ $content['subtitle'] }}</p>
      @else
      <div class="mb-5"></div>
      @endif
      
      <div class="{{ $content['module_size'] ?? 'container-fluid' }}">
        <div class="row align-items-center justify-content-center g-4 opacity-75">
          @foreach ($content['brands'] as $brand)
          <div class="col-6 col-md-4 col-lg-2 text-center sponsor-logo">
            <a href="{{ $brand['url'] ?: 'javascript:void(0)' }}" class="text-decoration-none d-flex align-items-center justify-content-center brand-card-hover overflow-hidden" style="height: 100px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; transition: all 0.3s ease;">
              @if(!empty($brand['logo']))
                <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] ?? '' }}" class="w-100 h-100 brand-img-filter" style="transition: all 0.3s ease; object-fit: cover;">
              @else
                <span class="text-white-50 fw-semibold" style="font-size: 0.9rem; letter-spacing: 0.5px;">{{ $brand['name'] ?? '' }}</span>
              @endif
            </a>
          </div>
          @endforeach
        </div>
      </div>

      @if (!empty($content['brands']))
      <div class="d-flex justify-content-center mt-5">
        <a class="btn btn-outline-light rounded-pill px-4 py-2" style="border-color: rgba(255,255,255,0.2); font-size: 0.9rem; letter-spacing: 1px;" href="{{ shop_route('brands.index') }}">{{ __('common.show_all') }}</a>
      </div>
      @endif
    </div>
  </div>

  <style>
  .sponsor-logo .brand-img-filter {
    filter: brightness(200%) grayscale(100%);
    opacity: 0.6;
  }
  .sponsor-logo:hover .brand-card-hover {
    background: rgba(255,255,255,0.08) !important;
    border-color: rgba(255,255,255,0.15) !important;
    transform: translateY(-5px);
  }
  .sponsor-logo:hover .brand-img-filter {
    filter: brightness(100%) grayscale(0%);
    opacity: 1;
    transform: scale(1.1);
  }
  </style>
</div>
