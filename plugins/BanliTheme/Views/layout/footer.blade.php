<footer class="footer-wrap position-relative pt-5 pb-3" style="background: #08080c; border-top: 1px solid rgba(255,255,255,0.05); margin-top: 50px;">
  @hook('footer.before')

  <div class="container-fluid">
    @hook('footer.services.before')

    @hook('footer.services.after')

    <div class="footer-content mb-5">
      <div class="row g-4">
        <div class="col-12 col-md-4 me-lg-4">
          <div class="footer-content-left footer-link-wrap pe-lg-4">
            <h5 class="text-white mb-4 fw-bold" style="font-size: 16px; letter-spacing: 1px;">{{ __('shop/common.company_profile') }}</h5>
            <div class="intro-wrap">
              @if ($footer_content['content']['intro']['logo'] ?? false)
                <div class="logo mb-4"><a href="{{ shop_route('home.index') }}"><img src="{{ image_origin($footer_content['content']['intro']['logo']) }}" alt="{{ system_setting('base.meta_title', 'BeikeShop开源好用的跨境电商系统') }}" class="img-fluid" style="filter: brightness(0) invert(1); max-height: 40px;"></a></div>
              @endif
              <div class="text text-white-50 mb-4" style="font-size: 15px; line-height: 1.8;">{!! $footer_content['content']['intro']['text'][locale()] ?? 'Join the ultimate conference for AI enthusiasts, developers, and visionaries. Explore the future today.' !!}</div>
              <div class="social-network d-flex gap-3">
                @foreach ($footer_content['content']['intro']['social_network'] ?? [] as $item)
                <a href="{{ $item['link'] }}" target="_blank" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center social-btn" style="width: 40px; height: 40px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);"><img src="{{ image_origin($item['image']) }}" class="img-fluid" style="filter: brightness(0) invert(1);"></a>
                @endforeach
                @if (empty($footer_content['content']['intro']['social_network']))
                  <a href="#" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center social-btn" style="width: 40px; height: 40px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center social-btn" style="width: 40px; height: 40px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center social-btn" style="width: 40px; height: 40px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);"><i class="bi bi-instagram"></i></a>
                @endif
              </div>
            </div>
          </div>
        </div>
        @for ($i = 1; $i <= 3; $i++)
          @php
            $link = $footer_content['content']['link' . $i];
          @endphp
          @if ($design || ($link['title'][locale()] ?? false))
          <div class="col-12 col-md-2 footer-content-link{{ $i }} footer-link-wrap">
            <h5 class="text-white mb-4 fw-bold" style="font-size: 16px; letter-spacing: 1px;">{{ $link['title'][locale()] ?? '' }}</h5>
            <ul class="list-unstyled">
              @foreach ($link['links'] as $item)
                @if ($item['link'])
                <li class="mb-3">
                  <a href="{{ $item['link'] }}" @if (isset($item['new_window']) && $item['new_window']) target="_blank" @endif class="text-white-50 text-decoration-none hover-text-primary transition-all d-inline-flex align-items-center" style="font-size: 15px;">
                    <i class="bi bi-chevron-right me-2" style="font-size: 12px; color: #00d2ff;"></i> {{ $item['text'] }}
                  </a>
                </li>
              @endif
              @endforeach
            </ul>
          </div>
          @endif
        @endfor

        @hook('footer.contact.before')
        @hookwrapper('footer.contact')
        <div class="col-12 col-md-3 footer-content-contact footer-link-wrap">
          <h5 class="text-white mb-4 fw-bold" style="font-size: 16px; letter-spacing: 1px;">{{ __('common.contact_us') }}</h5>
          <ul class="list-unstyled text-white-50">
            @if ($footer_content['content']['contact']['email'])
              <li class="mb-3 d-flex align-items-start" style="font-size: 15px;"><i class="bi bi-envelope-paper text-primary me-3 mt-1 fs-5" style="color: #00d2ff !important;"></i> <span>{{ system_setting('base.email') }}</span></li>
            @endif
            @if ($footer_content['content']['contact']['telephone'])
              <li class="mb-3 d-flex align-items-start" style="font-size: 15px;"><i class="bi bi-telephone text-primary me-3 mt-1 fs-5" style="color: #00d2ff !important;"></i> <span>{{ $footer_content['content']['contact']['telephone'] }}</span></li>
            @endif
            @if ($footer_content['content']['contact']['address'][locale()] ?? '')
              <li class="mb-3 d-flex align-items-start" style="font-size: 15px;"><i class="bi bi-geo-alt text-primary me-3 mt-1 fs-5" style="color: #00d2ff !important;"></i> <span>{{ $footer_content['content']['contact']['address'][locale()] ?? '' }}</span></li>
            @endif
          </ul>
        </div>
        @endhookwrapper
        @hook('footer.contact.after')
      </div>
    </div>
  </div>

  @hookwrapper('footer.copyright')
  <div class="footer-bottom py-4" style="border-top: 1px solid rgba(255,255,255,0.05); background: #050508;">
    <div class="container-fluid">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="copyright-content text-white-50 mb-3 mb-md-0" style="font-size: 14px;">
          <!-- 删除版权信息, 请先购买授权 https://beikeshop.com/service -->
          @if(!check_license())
          <span class="me-1">{!! __('common.text_powered') !!}</span>
          @endif
          {!! $footer_content['bottom']['copyright'][locale()] ?? '' !!}
        </div>
        @if (isset($footer_content['bottom']['image']) && $footer_content['bottom']['image'])
          <div class="right-img">
            <img src="{{ image_origin($footer_content['bottom']['image']) }}" class="img-fluid" style="filter: brightness(0) invert(1); opacity: 0.5;">
          </div>
        @endif
      </div>
    </div>
  </div>
  @endhookwrapper

  @hook('footer.after')
</footer>

<style>
.hover-text-primary:hover {
  color: #00d2ff !important;
}
.transition-all {
  transition: all 0.3s ease;
}
.sponsor-logo img:hover {
  filter: none !important;
  transform: scale(1.1);
}
.social-btn {
  transition: all 0.3s ease;
}
.social-btn:hover {
  background: #00d2ff !important;
  border-color: #00d2ff !important;
  color: #000 !important;
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0, 210, 255, 0.4);
}
.social-btn:hover i {
  color: #000 !important;
}
.social-btn:hover img {
  filter: brightness(0) !important;
}
</style>
