<div class="module-item py-5 {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
  <div class="module-info module-icons">
    @if ($content['title'])
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold text-white mb-3">
        <span class="text-gradient">{{ $content['title'] }}</span>
      </h2>
      @if ($content['sub_title'])
      <p class="text-white-50">{{ $content['sub_title'] }}</p>
      @endif
    </div>
    @endif
    
    <div class="{{ !empty($content['module_size']) ? $content['module_size'] : 'container'  }}">
      <div class="row g-4 justify-content-center">
        @foreach ($content['images'] as $image)
        <div class="col-6 col-md-4 col-lg">
          <a href="{{ $image['url'] ?: 'javascript:void(0)' }}" class="text-decoration-none d-block h-100">
            <div class="icon-card text-center p-4 h-100 border-0 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);">
              <div class="icon-wrapper d-inline-flex justify-content-center align-items-center mb-4 rounded-circle" style="width: 80px; height: 80px; background: rgba(106, 17, 203, 0.1); border: 1px solid rgba(106, 17, 203, 0.3);">
                <img src="{{ $image['image'] }}" class="img-fluid seo-img p-3 icon-img-filter" alt="{{ $image['image_alt'] ?? ''}}">
              </div>
              @if ($image['text'])
              <h5 class="text-white fw-bold mt-2 mb-2 title">{{ $image['text'] }}</h5>
              @endif
              @if ($image['sub_text'])
              <p class="text-white-50 mb-0 small sub-title">{{ $image['sub_text'] }}</p>
              @endif
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <style>
  .icon-card {
    transition: all 0.3s ease;
  }
  .icon-card:hover {
    background: rgba(255,255,255,0.05) !important;
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(106, 17, 203, 0.15);
    border-color: rgba(106, 17, 203, 0.4) !important;
  }
  .icon-card:hover .icon-wrapper {
    background: linear-gradient(135deg, rgba(106, 17, 203, 0.2) 0%, rgba(37, 117, 252, 0.2) 100%) !important;
    transform: scale(1.1);
    transition: transform 0.3s ease;
  }
  .icon-img-filter {
    filter: brightness(0) invert(1);
  }
  </style>
</div>
