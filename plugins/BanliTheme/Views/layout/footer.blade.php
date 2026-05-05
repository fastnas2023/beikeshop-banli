@php
  $contact = $footer_content['content']['contact'] ?? [];
  $intro = $footer_content['content']['intro'] ?? [];
  $localeValue = function ($value, $fallback = '') {
    if (is_array($value)) {
      return $value[locale()] ?? $value['en'] ?? $value['zh_cn'] ?? $fallback;
    }

    return $value !== null && $value !== '' ? $value : $fallback;
  };
  $address = $contact['address'][locale()] ?? $contact['address']['en'] ?? '121 AI Blvd, San Francisco BCA 94107';
  $phone = $contact['telephone'] ?? system_setting('base.telephone', '+1 123 456 789');
  $email = $contact['email_address'] ?? system_setting('base.email', 'contact@example.com');
  $addressTitle = $localeValue($contact['address_title'] ?? null, 'Address');
  $contactTitle = $localeValue($contact['title'] ?? null, 'Contact Us');
  $phoneLabel = $localeValue($contact['phone_label'] ?? null, 'T.');
  $emailLabel = $localeValue($contact['email_label'] ?? null, 'M.');
  $themeLogo = public_path('banli_theme-assets/logo-light/banli-logo.png');
  $logo = file_exists($themeLogo) ? asset('banli_theme-assets/logo-light/banli-logo.png') : image_origin($intro['logo'] ?? system_setting('base.logo'));
  $banliBrandText = system_setting('base.banli_theme_brand_text') ?: system_setting('base.store_name') ?: 'Banli';
  $footerBrandText = $localeValue($intro['brand_text'] ?? null, $banliBrandText);
  $copyright = $footer_content['bottom']['copyright'][locale()] ?? '';
  $socials = collect($intro['social_network'] ?? [])->filter(fn ($item) => $item['show'] ?? true)->values();
  $linkGroups = collect(['link1', 'link2', 'link3'])->map(function ($key) use ($footer_content, $localeValue) {
    $group = $footer_content['content'][$key] ?? [];
    $links = collect($group['links'] ?? [])->filter(fn ($link) => !empty($link['link']) || !empty($link['url']))->values();

    return [
      'title' => $localeValue($group['title'] ?? null, ''),
      'links' => $links,
    ];
  })->filter(fn ($group) => $group['title'] || $group['links']->isNotEmpty())->values();
@endphp

<footer class="footer-wrap banli-footer-aivent">
  @hook('footer.before')

  <section id="section-subscribe" class="bg-dark section-dark text-light relative jarallax banli-footer-subscribe" data-speed="0.45">
    <img src="{{ asset('banli_theme-assets/aivent/images/background/3.webp') }}" class="jarallax-img subscribe-bg-image" alt="">
    <div class="gradient-edge-top"></div>
    <div class="gradient-edge-bottom"></div>
    <div class="sw-overlay op-8"></div>
    <div class="container relative z-2">
      <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10 text-center">
          <div class="subtitle">Stay in the Loop</div>
          <h2>Join the Future of Innovation</h2>
          <p class="subscribe-copy">
            Making better things takes time. Drop us your email to stay in the know as we work to reduce our environmental impact. We'll share other exciting news and exclusive offers, too.
          </p>

          <div class="spacer-single"></div>
          <form id="form_subscribe" class="form-subscribe" autocomplete="off">
            <input type="email" name="email" placeholder="Enter Your Email Address" required>
            <button type="submit" class="btn-main">SIGN UP</button>

            <div class="subscribe-options">
              <label class="subscribe-check">
                <input type="checkbox" checked>
                <span>Keep me updated on other news and exclusive offers</span>
              </label>
              <p>
                Note: You can opt-out at any time. See our <a href="#">Privacy Policy</a> and <a href="#">Terms</a>.
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <div class="banli-footer-main">
    <div class="container">
      @if ($linkGroups->isNotEmpty())
        <div class="banli-footer-links row gy-4">
          @foreach ($linkGroups as $group)
            <div class="col-12 col-md-4">
              <h6>{{ $group['title'] }}</h6>
              @foreach ($group['links'] as $link)
                <a href="{{ $link['link'] ?? $link['url'] ?? '#' }}">{{ $link['text'] ?? $link['title'] ?? '' }}</a>
              @endforeach
            </div>
          @endforeach
        </div>
      @endif

      <div class="row align-items-center gy-5">
        <div class="col-12 col-lg-4">
          <div class="banli-footer-block banli-footer-address">
            <h5>{{ $addressTitle }}</h5>
            <p>{!! nl2br(e($address)) !!}</p>
          </div>
        </div>

        <div class="col-12 col-lg-4">
          <div class="banli-footer-brand">
            @if ($logo)
              <a href="{{ shop_route('home.index') }}" class="banli-footer-logo" aria-label="{{ system_setting('base.meta_title', 'BeikeShop') }}">
                <img src="{{ $logo }}" alt="{{ system_setting('base.meta_title', 'BeikeShop') }}">
                <span>{{ $footerBrandText }}</span>
              </a>
            @endif

            <div class="banli-footer-socials">
              @forelse ($socials as $index => $item)
                <a href="{{ $item['link'] ?: '#' }}" target="_blank" aria-label="Social {{ $index + 1 }}">
                  <img src="{{ image_origin($item['image']) }}" alt="">
                </a>
              @empty
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
              @endforelse
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-4">
          <div class="banli-footer-block banli-footer-contact">
            <h5>{{ $contactTitle }}</h5>
            @if ($phone)
              <p>{{ $phoneLabel }} {{ $phone }}</p>
            @endif
            @if (($contact['email'] ?? true) && $email)
              <p>{{ $emailLabel }} {{ $email }}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  @hookwrapper('footer.copyright')
  <div class="banli-footer-bottom">
    <div class="container">
      <div class="banli-footer-copyright">
        @if(!check_license())
          <span class="me-1">{!! __('common.text_powered') !!}</span>
        @endif
        {!! $copyright ?: 'Copyright 2026 - Banli Theme by BeikeShop' !!}
      </div>
    </div>
  </div>
  @endhookwrapper

@hook('footer.after')
</footer>

@push('add-scripts')
  <script>
    $(document).off('submit.banliSubscribe', '#form_subscribe').on('submit.banliSubscribe', '#form_subscribe', function(e) {
      e.preventDefault();
      const email = ($(this).find('input[name="email"]').val() || '').trim();
      const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

      if (!ok) {
        if (typeof layer !== 'undefined') {
          layer.msg('请输入正确的邮箱地址');
        } else {
          alert('请输入正确的邮箱地址');
        }
        return;
      }

      if (typeof layer !== 'undefined') {
        layer.msg('订阅成功');
      } else {
        alert('订阅成功');
      }
      $(this).get(0).reset();
    });
  </script>
@endpush

<style>
.banli-footer-aivent {
  position: relative;
  overflow: hidden;
  margin-top: 0;
  padding: 0 !important;
  color: #fff;
  background:
    linear-gradient(180deg, rgba(16, 20, 53, 0) 0%, #101435 18%, #101435 100%);
}
.banli-footer-subscribe {
  margin: 0;
}
.banli-footer-main {
  padding: clamp(4.5rem, 7vw, 5.125rem) 0 clamp(4rem, 6vw, 4.5rem);
}
.banli-footer-block {
  min-height: 160px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.banli-footer-block h5 {
  margin: 0 0 22px;
  color: #fff;
  font-size: 28px;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: 0;
}
.banli-footer-block p {
  margin: 0 0 10px;
  color: rgba(255, 255, 255, .86);
  font-size: 22px;
  font-weight: 700;
  line-height: 1.8;
}
.banli-footer-address {
  text-align: center;
}
.banli-footer-contact {
  text-align: center;
}
.banli-footer-brand {
  display: flex;
  min-height: 160px;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 28px;
}
.banli-footer-links {
  max-width: 920px;
  margin: 0 auto 54px;
  padding-bottom: 34px;
  border-bottom: 1px solid rgba(255, 255, 255, .10);
  text-align: center;
}
.banli-footer-links h6 {
  margin: 0 0 14px;
  color: #fff;
  font-size: 18px;
  font-weight: 800;
  line-height: 1.2;
}
.banli-footer-links a {
  display: block;
  margin: 8px 0;
  color: rgba(255, 255, 255, .66);
  font-size: 15px;
  font-weight: 650;
  line-height: 1.45;
  text-decoration: none;
  transition: color .2s ease;
}
.banli-footer-links a:hover {
  color: #fff;
}
.banli-footer-logo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  color: #fff;
  text-decoration: none;
}
.banli-footer-logo img {
  max-width: 82px;
  max-height: 82px;
  width: auto;
  height: auto;
  object-fit: contain;
}
.banli-footer-logo span {
  color: #fff;
  font-size: 58px;
  font-weight: 800;
  line-height: 1;
  letter-spacing: 0;
}
.banli-footer-socials {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}
.banli-footer-socials a {
  width: 48px;
  height: 48px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  color: #fff;
  background: rgba(255, 255, 255, .12);
  transition: transform .25s ease, background .25s ease, color .25s ease;
}
.banli-footer-socials a:hover {
  transform: translateY(-3px);
  color: #101435;
  background: #7a4cf3;
}
.banli-footer-socials img {
  max-width: 22px;
  max-height: 22px;
  filter: brightness(0) invert(1);
}
.banli-footer-socials i {
  font-size: 22px;
  line-height: 1;
}
.banli-footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, .12);
  padding: 34px 0;
  background: rgba(16, 20, 53, .72);
}
.banli-footer-copyright {
  color: rgba(255, 255, 255, .9);
  text-align: center;
  font-size: 20px;
  font-weight: 700;
  line-height: 1.5;
}
@media (max-width: 991.98px) {
  .banli-footer-main {
    padding: 3.875rem 0 3.25rem;
  }
  .banli-footer-block,
  .banli-footer-brand {
    min-height: 0;
  }
  .banli-footer-links {
    margin-bottom: 42px;
    padding-bottom: 28px;
  }
  .banli-footer-block h5 {
    font-size: 24px;
    margin-bottom: 14px;
  }
  .banli-footer-block p,
  .banli-footer-copyright {
    font-size: 18px;
  }
  .banli-footer-logo img {
    max-width: 64px;
    max-height: 64px;
  }
  .banli-footer-logo span {
    font-size: 44px;
  }
}
@media (max-width: 575.98px) {
  .banli-footer-main {
    padding: 52px 0 42px;
  }
  .banli-footer-links {
    margin-bottom: 36px;
  }
  .banli-footer-block p {
    font-size: 16px;
    line-height: 1.65;
  }
  .banli-footer-socials a {
    width: 42px;
    height: 42px;
  }
  .banli-footer-logo span {
    font-size: 38px;
  }
}
</style>
