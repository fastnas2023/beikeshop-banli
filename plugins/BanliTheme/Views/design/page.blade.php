@addStyle(asset('vendor/swiper/swiper-bundle.min.css'))
@addScript(asset('vendor/swiper/swiper-bundle.min.js'))

<div class="module-item py-5 {{ $design ? 'module-item-design' : ''}} aivent-dark-section" id="module-{{ $module_id }}">
  <div class="module-info module-pages">
    <div class="{{ !empty($content['module_size']) ? $content['module_size'] : 'container'  }} position-relative banli-news-home-container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">
          <span class="neon-text-gradient">{{ $content['title'] ?: 'Latest News & Updates' }}</span>
        </h2>
        <p class="text-white-50 neon-subtitle">Share store updates, buying guides, brand stories, or service information.</p>
      </div>

      @if ($content['items'])
        <div class="row g-4 justify-content-center">
          @foreach ($content['items'] as $item)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 bg-transparent border-0 tech-news-card-wrapper">
              <a href="{{ (isset($item['url']) ? $item['url'] : shop_route('pages.show', [$item['id']])) }}" class="d-block h-100 text-decoration-none tech-news-card">
                <div class="position-relative h-100 w-100 overflow-hidden card-inner-box">
                  <div class="position-absolute top-0 start-0 w-100 h-100 gradient-overlay" style="z-index: 1;"></div>
                  <img src="{{ $item['image'] }}" class="img-fluid position-absolute top-0 start-0 w-100 h-100 page-img" alt="{{ $item['title'] ?? '' }}">
                  
                  <div class="position-absolute bottom-0 start-0 w-100 p-4 z-2 content-overlay">
                    <div class="mb-3">
                        <span class="badge neon-badge">News</span>
                    </div>
                    <h4 class="card-title text-white mb-2 fw-bold page-title neon-title">
                      {{ $item['title'] ?? '' }}
                    </h4>
                    <p class="text-white-50 mb-0 page-summary line-clamp-2">{{ $item['summary'] ?? '' }}</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        @if (count($content['items']) > 3)
        <div class="d-flex justify-content-center mt-5">
          <a class="btn neon-btn rounded-pill px-5 py-3 btn-lg shadow-sm" href="{{ shop_route('page_categories.home') }}">{{ __('common.show_all') }}</a>
        </div>
        @endif
      @elseif (!$content['items'] and $design)
        <div class="row g-4">
          @for ($s = 0; $s < 3; $s++)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 bg-transparent border-0 tech-news-card-wrapper">
              <div class="position-relative overflow-hidden card-inner-box">
                <a href="javascript:void(0)" class="d-block"><img src="{{ asset('image/placeholder.png') }}" class="img-fluid w-100 placeholder-img"></a>
              </div>
              <div class="card-body px-0 pt-4 pb-0 text-center">
                <h4 class="text-white-50 neon-title">Please configure articles</h4>
              </div>
            </div>
          </div>
          @endfor
        </div>
      @endif
    </div>
  </div>

  <style>
  /* Dark module styles for news and article cards. */
  .aivent-dark-section {
    background-color: #0b0b13; /* Dark background */
    position: relative;
    overflow: hidden;
  }
  .aivent-dark-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(0, 255, 255, 0.03) 0%, transparent 60%);
    pointer-events: none;
    z-index: 0;
  }
  .module-pages {
    position: relative;
    z-index: 1;
  }
  .banli-news-home-container {
    max-width: 1304px;
    margin-left: auto;
    margin-right: auto;
  }
  .neon-text-gradient {
    background: linear-gradient(90deg, #00ffff, #e023ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
  }
  .neon-subtitle {
    letter-spacing: 1px;
    font-size: 1.1rem;
  }
  .tech-news-card-wrapper {
    perspective: 1000px;
  }
  .tech-news-card {
    display: block;
    border-radius: 16px;
    padding: 1px; /* space for gradient border */
    background: linear-gradient(145deg, rgba(0,255,255,0.2) 0%, rgba(224,35,255,0.2) 100%);
    transition: all 0.4s ease;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.05);
  }
  .card-inner-box {
    background: #11111d;
    border-radius: 15px;
    min-height: 400px;
  }
  .placeholder-img {
    height: 240px; 
    object-fit: cover; 
    opacity: 0.3;
    filter: grayscale(100%) sepia(50%) hue-rotate(180deg);
  }
  .gradient-overlay {
    background: linear-gradient(to bottom, rgba(11,11,19,0.1) 0%, rgba(11,11,19,0.95) 100%);
    transition: background 0.4s ease;
  }
  .page-img {
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    opacity: 0.8;
  }
  .content-overlay {
    transition: transform 0.4s ease;
  }
  .neon-badge {
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid #00ffff;
    color: #00ffff;
    font-weight: 500;
    letter-spacing: 1px;
    box-shadow: 0 0 8px rgba(0, 255, 255, 0.3);
  }
  .neon-title {
    line-height: 1.4;
    transition: color 0.3s ease, text-shadow 0.3s ease;
  }
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.6;
    transition: color 0.3s ease;
  }
  
  /* Hover Effects */
  .tech-news-card:hover {
    transform: translateY(-8px);
    background: linear-gradient(145deg, rgba(0,255,255,0.6) 0%, rgba(224,35,255,0.6) 100%);
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.2), 0 0 15px rgba(224, 35, 255, 0.2);
  }
  .tech-news-card:hover .page-img {
    transform: scale(1.08);
    opacity: 1;
  }
  .tech-news-card:hover .gradient-overlay {
    background: linear-gradient(to bottom, rgba(11,11,19,0) 0%, rgba(11,11,19,1) 100%);
  }
  .tech-news-card:hover .neon-title {
    color: #00ffff !important;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
  }
  .tech-news-card:hover .page-summary {
    color: rgba(255, 255, 255, 0.9) !important;
  }

  /* Neon Button */
  .neon-btn {
    color: #fff;
    background: transparent;
    border: 1px solid rgba(0, 255, 255, 0.5);
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: all 0.3s ease;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.1);
  }
  .neon-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
    z-index: -1;
  }
  .neon-btn:hover {
    color: #00ffff;
    border-color: #00ffff;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.4), inset 0 0 10px rgba(0, 255, 255, 0.2);
    transform: translateY(-2px);
  }
  .neon-btn:hover::before {
    left: 100%;
  }
  </style>
</div>
