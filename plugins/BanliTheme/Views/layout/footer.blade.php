@php
  $contact = $footer_content['content']['contact'] ?? [];
  $intro = $footer_content['content']['intro'] ?? [];
  $subscribe = $footer_content['content']['subscribe'] ?? [];
  $localeValue = function ($value, $fallback = '') {
    if (is_array($value)) {
      return $value[locale()] ?? $value['en'] ?? $value['zh_cn'] ?? $fallback;
    }

    return $value !== null && $value !== '' ? $value : $fallback;
  };
  $boolValue = function ($value, $default = false) {
    if (is_bool($value)) {
      return $value;
    }

    if ($value === null || $value === '') {
      return $default;
    }

    $filtered = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    return $filtered ?? $default;
  };
  $address = $contact['address'][locale()] ?? $contact['address']['en'] ?? system_setting('base.address', '');
  $phone = $contact['telephone'] ?? system_setting('base.telephone', '');
  $email = $contact['email_address'] ?? system_setting('base.email', '');
  $addressTitle = $localeValue($contact['address_title'] ?? null, __('admin/builder.text_address'));
  $contactTitle = $localeValue($contact['title'] ?? null, __('common.contact_us'));
  $phoneLabel = $localeValue($contact['phone_label'] ?? null, __('common.phone'));
  $emailLabel = $localeValue($contact['email_label'] ?? null, __('common.email'));
  $themeLogo = public_path('banli_theme-assets/logo-light/banli-logo.png');
  $logo = file_exists($themeLogo) ? asset('banli_theme-assets/logo-light/banli-logo.png') : image_origin($intro['logo'] ?? system_setting('base.logo'));
  $banliBrandText = system_setting('base.banli_theme_brand_text') ?: system_setting('base.store_name') ?: 'Banli';
  $footerBrandText = $localeValue($intro['brand_text'] ?? null, $banliBrandText);
  $copyright = $footer_content['bottom']['copyright'][locale()] ?? '';
  $socials = collect($intro['social_network'] ?? [])->filter(fn ($item) => $item['show'] ?? true)->values();
  $defaultSocials = collect([
    ['name' => 'Facebook', 'icon' => 'bi-facebook'],
    ['name' => 'Instagram', 'icon' => 'bi-instagram'],
    ['name' => 'X / Twitter', 'icon' => 'bi-twitter'],
    ['name' => 'YouTube', 'icon' => 'bi-youtube'],
    ['name' => 'TikTok', 'icon' => 'bi-tiktok'],
    ['name' => 'Pinterest', 'icon' => 'bi-pinterest'],
    ['name' => 'LinkedIn', 'icon' => 'bi-linkedin'],
    ['name' => 'WhatsApp', 'icon' => 'bi-whatsapp'],
    ['name' => 'Telegram', 'icon' => 'bi-telegram'],
    ['name' => 'Discord', 'icon' => 'bi-discord'],
    ['name' => 'Reddit', 'icon' => 'bi-reddit'],
    ['name' => 'Snapchat', 'icon' => 'bi-snapchat'],
  ]);
  $subscribeEnabled = $boolValue($subscribe['enabled'] ?? system_setting('base.banli_theme_subscribe_enabled', false), false);
  $subscribeEndpoint = trim((string) ($subscribe['endpoint'] ?? system_setting('base.banli_theme_subscribe_endpoint', '')));
  $subscribeSubtitle = $localeValue($subscribe['sub_title'] ?? null, __('BanliTheme::common.subscribe_subtitle'));
  $subscribeTitle = $localeValue($subscribe['title'] ?? null, __('BanliTheme::common.subscribe_title'));
  $subscribeCopy = $localeValue($subscribe['description'] ?? null, __('BanliTheme::common.subscribe_copy'));
  $subscribeOption = $localeValue($subscribe['option_text'] ?? null, __('BanliTheme::common.subscribe_option'));
  $privacyUrl = trim((string) ($subscribe['privacy_url'] ?? ''));
  $termsUrl = trim((string) ($subscribe['terms_url'] ?? ''));
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

  @if ($subscribeEnabled && $subscribeEndpoint)
  <section id="section-subscribe" class="bg-dark section-dark text-light relative jarallax banli-footer-subscribe" data-speed="0.45">
    <img src="{{ asset('banli_theme-assets/aivent/images/background/3.webp') }}" class="jarallax-img subscribe-bg-image" alt="">
    <div class="gradient-edge-top"></div>
    <div class="gradient-edge-bottom"></div>
    <div class="sw-overlay op-8"></div>
    <div class="container relative z-2">
      <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10 text-center">
          <div class="subtitle">{{ $subscribeSubtitle }}</div>
          <h2>{{ $subscribeTitle }}</h2>
          <p class="subscribe-copy">
            {{ $subscribeCopy }}
          </p>

          <div class="spacer-single"></div>
          <form id="form_subscribe" class="form-subscribe" autocomplete="off" data-endpoint="{{ $subscribeEndpoint }}">
            <input type="email" name="email" placeholder="{{ __('BanliTheme::common.subscribe_placeholder') }}" required>
            <button type="submit" class="btn-main" data-label="{{ __('BanliTheme::common.subscribe_button') }}" data-loading-label="{{ __('common.text_loading') }}">{{ __('BanliTheme::common.subscribe_button') }}</button>

            <div class="subscribe-options">
              <label class="subscribe-check">
                <input type="checkbox" name="marketing_opt_in" checked>
                <span>{{ $subscribeOption }}</span>
              </label>
              @if ($privacyUrl || $termsUrl)
                <p>
                  {{ __('BanliTheme::common.subscribe_note') }}
                  @if ($privacyUrl)
                    <a href="{{ $privacyUrl }}" target="_blank" rel="noopener noreferrer">{{ __('BanliTheme::common.privacy_policy') }}</a>
                  @endif
                  @if ($termsUrl)
                    @if ($privacyUrl) / @endif
                    <a href="{{ $termsUrl }}" target="_blank" rel="noopener noreferrer">{{ __('BanliTheme::common.terms') }}</a>
                  @endif
                </p>
              @endif
              <div class="subscribe-feedback" aria-live="polite"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  @endif

  <div class="banli-footer-main">
    <div class="container">
      @if ($logo)
        <div class="banli-footer-brand">
          <a href="{{ shop_route('home.index') }}" class="banli-footer-logo" aria-label="{{ system_setting('base.meta_title', 'BeikeShop') }}">
            <img src="{{ $logo }}" alt="{{ system_setting('base.meta_title', 'BeikeShop') }}">
            <span>{{ $footerBrandText }}</span>
          </a>

          <div class="banli-footer-socials">
            @forelse ($socials as $index => $item)
              <a href="{{ $item['link'] ?: '#' }}" target="_blank" aria-label="Social {{ $index + 1 }}">
                <img src="{{ image_origin($item['image']) }}" alt="">
              </a>
            @empty
              @foreach ($defaultSocials as $item)
                <a href="#" aria-label="{{ $item['name'] }}">
                  <i class="bi {{ $item['icon'] }}"></i>
                </a>
              @endforeach
            @endforelse
          </div>
        </div>
      @endif

      <div class="banli-footer-grid">
        @foreach ($linkGroups as $group)
          <div class="banli-footer-links">
            <h6>{{ $group['title'] }}</h6>
            @foreach ($group['links'] as $link)
              <a href="{{ $link['link'] ?? $link['url'] ?? '#' }}">{{ $link['text'] ?? $link['title'] ?? '' }}</a>
            @endforeach
          </div>
        @endforeach

        @if ($address)
          <div class="banli-footer-block banli-footer-address">
            <h5>{{ $addressTitle }}</h5>
            <p>{!! nl2br(e($address)) !!}</p>
          </div>
        @endif

        @if ($phone || (($contact['email'] ?? true) && $email))
          <div class="banli-footer-block banli-footer-contact">
            <h5>{{ $contactTitle }}</h5>
            @if ($phone)
              <p>{{ $phoneLabel }} {{ $phone }}</p>
            @endif
            @if (($contact['email'] ?? true) && $email)
              <p>{{ $emailLabel }} {{ $email }}</p>
            @endif
          </div>
        @endif
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
  @if ($subscribeEnabled && $subscribeEndpoint)
  <script>
    $(document).off('submit.banliSubscribe', '#form_subscribe').on('submit.banliSubscribe', '#form_subscribe', function(e) {
      e.preventDefault();
      const $form = $(this);
      const $button = $form.find('button[type="submit"]');
      const $feedback = $form.find('.subscribe-feedback');
      const email = ($form.find('input[name="email"]').val() || '').trim();
      const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      const storageKey = 'banli-subscribe-email:' + location.host;

      function showSubscribeMessage(message, type) {
        $feedback
          .removeClass('text-success text-danger text-warning')
          .addClass(type === 'success' ? 'text-success' : (type === 'warning' ? 'text-warning' : 'text-danger'))
          .text(message);

        if (typeof layer !== 'undefined') {
          layer.msg(message);
        }
      }

      if (!ok) {
        showSubscribeMessage(@json(__('BanliTheme::common.subscribe_invalid_email')), 'danger');
        return;
      }

      if (localStorage.getItem(storageKey) === email) {
        showSubscribeMessage(@json(__('BanliTheme::common.subscribe_duplicate')), 'warning');
        return;
      }

      $button.prop('disabled', true).text($button.data('loading-label'));
      $feedback.text('');

      $http.post($form.data('endpoint'), {
        email: email,
        marketing_opt_in: $form.find('input[name="marketing_opt_in"]').is(':checked') ? 1 : 0,
      }).then((res) => {
        if (res && res.status == 'fail') {
          showSubscribeMessage(res.message || @json(__('common.api_error_message')), 'danger');
          return;
        }

        localStorage.setItem(storageKey, email);
        showSubscribeMessage((res && res.message) || @json(__('BanliTheme::common.subscribe_success')), 'success');
        $form.get(0).reset();
      }).catch(() => {
        showSubscribeMessage(@json(__('common.api_error_message')), 'danger');
      }).finally(() => {
        $button.prop('disabled', false).text($button.data('label'));
      });
    });
  </script>
  @endif
@endpush

<style>
@font-face {
  font-family: "bootstrap-icons";
  src: url("/vendor/bootstrap/icon/bootstrap-icons.woff2?08efbba7c53d8c5413793eecb19b20bb") format("woff2"),
       url("/vendor/bootstrap/icon/bootstrap-icons.woff?08efbba7c53d8c5413793eecb19b20bb") format("woff");
  font-display: block;
}
.banli-footer-aivent {
  position: relative;
  z-index: 0;
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
  position: relative;
  z-index: 1;
  padding: clamp(2.25rem, 3.3vw, 3rem) 0 clamp(2rem, 3vw, 2.75rem);
  background:
    linear-gradient(180deg, rgba(16,20,53,.98), #101435 34%, #101435 100%);
}
.banli-footer-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(130px, 1fr)) minmax(180px, 1.05fr) minmax(220px, 1.2fr);
  gap: clamp(1.75rem, 3vw, 3.5rem);
  align-items: start;
}
.banli-footer-block {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}
.banli-footer-block h5 {
  margin: 0 0 16px;
  color: #fff;
  font-size: 18px;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: 0;
}
.banli-footer-block p {
  margin: 0 0 8px;
  color: rgba(255, 255, 255, .68);
  font-size: 15px;
  font-weight: 650;
  line-height: 1.55;
}
.banli-footer-address {
  text-align: left;
}
.banli-footer-contact {
  text-align: left;
}
.banli-footer-brand {
  display: flex;
  min-height: 0;
  margin-bottom: clamp(1.75rem, 2.8vw, 2.5rem);
  padding-bottom: clamp(1.25rem, 2vw, 1.75rem);
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  border-bottom: 1px solid rgba(255, 255, 255, .10);
}
.banli-footer-links {
  min-width: 0;
  text-align: left;
}
.banli-footer-links h6 {
  margin: 0 0 16px;
  color: #fff;
  font-size: 18px;
  font-weight: 800;
  line-height: 1.2;
}
.banli-footer-links a {
  display: block;
  margin: 9px 0;
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
  max-width: 44px;
  max-height: 44px;
  width: auto;
  height: auto;
  object-fit: contain;
}
.banli-footer-logo span {
  color: #fff;
  font-size: 30px;
  font-weight: 800;
  line-height: 1;
  letter-spacing: 0;
}
.banli-footer-socials {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  flex-wrap: wrap;
  gap: 8px;
  max-width: min(620px, 58vw);
}
.banli-footer-socials a {
  width: 34px;
  height: 34px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  color: rgba(255, 255, 255, .78);
  background: rgba(255, 255, 255, .105);
  border: 1px solid rgba(255, 255, 255, .08);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, .06);
  transition: transform .22s ease, background .22s ease, border-color .22s ease, color .22s ease;
}
.banli-footer-socials a:hover {
  transform: translateY(-2px);
  color: #fff;
  border-color: rgba(0, 210, 255, .34);
  background: linear-gradient(135deg, rgba(0, 210, 255, .22), rgba(122, 76, 243, .26));
}
.banli-footer-socials img {
  max-width: 18px;
  max-height: 18px;
  filter: brightness(0) invert(1);
}
.banli-footer-socials i {
  font-size: 16px;
  line-height: 1;
}
.banli-footer-socials .bi::before {
  display: inline-block;
  font-family: "bootstrap-icons" !important;
  font-style: normal;
  font-weight: normal !important;
  font-variant: normal;
  line-height: 1;
  text-transform: none;
  vertical-align: -.125em;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.banli-footer-socials .bi-facebook::before { content: "\f344"; }
.banli-footer-socials .bi-instagram::before { content: "\f437"; }
.banli-footer-socials .bi-twitter::before { content: "\f5ef"; }
.banli-footer-socials .bi-youtube::before { content: "\f62b"; }
.banli-footer-socials .bi-tiktok::before { content: "\f6cc"; }
.banli-footer-socials .bi-pinterest::before { content: "\f663"; }
.banli-footer-socials .bi-linkedin::before { content: "\f472"; }
.banli-footer-socials .bi-whatsapp::before { content: "\f618"; }
.banli-footer-socials .bi-telegram::before { content: "\f5b3"; }
.banli-footer-socials .bi-discord::before { content: "\f300"; }
.banli-footer-socials .bi-reddit::before { content: "\f650"; }
.banli-footer-socials .bi-snapchat::before { content: "\f665"; }
.banli-footer-bottom {
  border-top: 0;
  padding: 0 0 18px;
  background: rgba(16, 20, 53, .72);
}
.banli-footer-bottom .container {
  position: relative;
  padding-top: 18px;
  border-top: 0;
}
.banli-footer-bottom .container::before {
  content: "";
  position: absolute;
  top: 0;
  left: calc(var(--bs-gutter-x, 1.5rem) * .5);
  right: calc(var(--bs-gutter-x, 1.5rem) * .5);
  height: 1px;
  background: rgba(255, 255, 255, .10);
  pointer-events: none;
}
.banli-footer-copyright {
  color: rgba(255, 255, 255, .9);
  text-align: center;
  font-size: 17px;
  font-weight: 700;
  line-height: 1.5;
}
@media (max-width: 991.98px) {
  .banli-footer-main {
    padding: 2.625rem 0 2.25rem;
  }
  .banli-footer-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 2rem 2.25rem;
  }
  .banli-footer-block,
  .banli-footer-brand {
    min-height: 0;
  }
  .banli-footer-block h5 {
    font-size: 18px;
    margin-bottom: 12px;
  }
  .banli-footer-block p,
  .banli-footer-copyright {
    font-size: 16px;
  }
  .banli-footer-logo img {
    max-width: 42px;
    max-height: 42px;
  }
  .banli-footer-logo span {
    font-size: 28px;
  }
}
@media (max-width: 575.98px) {
  .banli-footer-main {
    padding: 34px 0 28px;
  }
  .banli-footer-brand {
    flex-direction: column;
    align-items: flex-start;
  }
  .banli-footer-socials {
    justify-content: flex-start;
    max-width: 100%;
  }
  .banli-footer-grid {
    grid-template-columns: 1fr;
    gap: 1.75rem;
  }
  .banli-footer-block p {
    font-size: 16px;
    line-height: 1.65;
  }
  .banli-footer-socials a {
    width: 36px;
    height: 36px;
  }
  .banli-footer-logo span {
    font-size: 38px;
  }
}
</style>
