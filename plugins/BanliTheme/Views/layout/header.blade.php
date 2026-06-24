@php
  $banliBrandText = system_setting('base.banli_theme_brand_text') ?: system_setting('base.store_name') ?: 'Banli';
@endphp

<header class="transparent">
  @hook('header.before')
  <div class="top-wrap" style="background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 0; font-size: 13px;">
    <div class="container banli-topbar-container d-flex justify-content-between align-items-center text-light">
      <div class="left d-flex align-items-center">
        @php
          $showCurrencySwitcher = currencies()->count() > 1;
          $showLanguageSwitcher = count($languages) > 1;
        @endphp

        @if ($showCurrencySwitcher || $showLanguageSwitcher)
          <style>
            #currency-dropdown::after, #language-dropdown::after {
              display: none;
            }
            .top-switchers {
              display: flex;
              align-items: center;
              flex-wrap: wrap;
              gap: 12px;
            }
            .top-wrap,
            .top-wrap .container,
            .top-switchers,
            .top-switcher {
              overflow: visible !important;
            }
            .top-wrap {
              position: relative;
              z-index: 2005;
            }
            header.transparent {
              overflow: visible !important;
            }
            .top-switcher {
              position: relative;
              z-index: 2300;
              margin-bottom: 0 !important;
              border: 0 !important;
              background: transparent !important;
            }
            .top-switcher > .top-switcher-toggle {
              position: relative;
              display: inline-flex !important;
              align-items: center;
              justify-content: space-between;
              gap: 10px;
              min-width: 116px !important;
              min-height: 36px;
              padding: 0 16px !important;
              border-radius: 999px !important;
              color: rgba(255,255,255,0.92) !important;
              text-decoration: none;
              font-weight: 650;
              letter-spacing: 0.2px;
              background:
                linear-gradient(180deg, rgba(10, 14, 42, 0.48), rgba(8, 11, 33, 0.28)) padding-box,
                linear-gradient(135deg, rgba(0, 210, 255, 0.55), rgba(156, 64, 255, 0.45), rgba(255, 98, 98, 0.35)) border-box;
              box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.06),
                0 10px 30px rgba(0,0,0,0.22);
              border: 1px solid transparent;
              backdrop-filter: blur(14px);
              -webkit-backdrop-filter: blur(14px);
              transition: transform 220ms ease, border-color 220ms ease, background 220ms ease, box-shadow 220ms ease;
              cursor: pointer;
              line-height: 1;
            }
            .top-switcher > .top-switcher-toggle::after {
              display: none !important;
              content: none !important;
            }
            .top-switcher > .top-switcher-toggle:hover,
            .top-switcher > .top-switcher-toggle:focus {
              transform: translateY(-1px);
              box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.06),
                0 18px 45px rgba(0,0,0,0.35),
                0 0 0 1px rgba(0, 210, 255, 0.16),
                0 0 22px rgba(0, 210, 255, 0.16);
              outline: none;
            }
            .top-switcher > .top-switcher-toggle .top-switcher-text,
            .top-switcher > .top-switcher-toggle .top-switcher-text span {
              display: inline-flex;
              align-items: baseline;
              gap: 8px;
              white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
              width: auto !important;
              padding: 0 !important;
              border: 0 !important;
              background: transparent !important;
              color: inherit !important;
              font-size: 13px !important;
              font-weight: 700 !important;
            }
            .top-switcher > .top-switcher-toggle .top-switcher-chip {
              font-size: 11px;
              font-weight: 750;
              letter-spacing: 1.1px;
              padding: 6px 10px;
              border-radius: 999px;
              background: rgba(255,255,255,0.06);
              border: 1px solid rgba(255,255,255,0.12);
              color: rgba(255,255,255,0.78);
            }
            .top-switcher > .top-switcher-toggle .top-switcher-caret {
              display: inline-flex !important;
              align-items: center;
              justify-content: center;
              width: auto !important;
              padding: 0 !important;
              border: 0 !important;
              background: transparent !important;
              opacity: 0.85;
              transition: transform 220ms ease, opacity 220ms ease;
              flex: 0 0 auto;
            }
            .show > .top-switcher-toggle .top-switcher-caret {
              transform: rotate(180deg);
              opacity: 1;
            }
            .top-switcher-menu {
              position: absolute !important;
              top: calc(100% + 10px) !important;
              left: 0 !important;
              right: auto !important;
              transform: none !important;
              background: rgba(9, 11, 24, 0.92) !important;
              background-color: rgba(9, 11, 24, 0.92) !important;
              border-radius: 14px !important;
              border: 1px solid rgba(255,255,255,0.1) !important;
              box-shadow: 0 22px 60px rgba(0,0,0,0.55);
              padding: 8px !important;
              min-width: 0 !important;
              width: 220px !important;
              max-width: calc(100vw - 32px);
              margin-top: 10px !important;
              z-index: 2400 !important;
              backdrop-filter: blur(18px);
              -webkit-backdrop-filter: blur(18px);
              overflow: hidden;
            }
            .top-switcher-menu.show {
              display: block !important;
            }
            .top-switcher-item {
              display: flex !important;
              align-items: center;
              justify-content: space-between;
              gap: 14px;
              padding: 11px 12px;
              border-radius: 12px;
              border: 1px solid transparent;
              color: rgba(255,255,255,0.76);
              font-size: 13px;
              text-decoration: none;
              width: 100% !important;
              min-width: 0 !important;
              transition: background 180ms ease, color 180ms ease, transform 180ms ease;
            }
            .top-switcher-item:hover,
            .top-switcher-item:focus {
              background: rgba(0, 210, 255, 0.12);
              color: rgba(255,255,255,0.96);
              outline: none;
              transform: translateX(2px);
            }
            .top-switcher-item .top-switcher-item-main {
              display: flex !important;
              align-items: center;
              gap: 10px;
              min-width: 0;
              flex: 1 1 auto;
            }
            .top-switcher-menu .top-switcher-item span {
              width: auto !important;
              padding: 0 !important;
              border: 0 !important;
              background: transparent !important;
              color: inherit !important;
              font-size: inherit !important;
            }
            .top-switcher-item .top-switcher-item-badge {
              display: inline-flex !important;
              align-items: center;
              justify-content: center;
              font-size: 11px;
              font-weight: 750;
              letter-spacing: 0.9px;
              min-width: 42px;
              padding: 5px 9px !important;
              border-radius: 999px !important;
              background: rgba(255,255,255,0.06) !important;
              border: 1px solid rgba(255,255,255,0.12) !important;
              color: rgba(255,255,255,0.72);
              flex: 0 0 auto;
            }
            .top-switcher-item.active {
              background: rgba(0, 210, 255, 0.18);
              border: 1px solid rgba(0, 210, 255, 0.24);
              color: rgba(255,255,255,0.98);
            }
            .top-switcher-item .top-switcher-check {
              display: inline-flex !important;
              width: auto !important;
              padding: 0 !important;
              border: 0 !important;
              background: transparent !important;
              opacity: 0;
              transform: scale(0.9);
              transition: opacity 180ms ease, transform 180ms ease;
            }
            .top-switcher-item.active .top-switcher-check {
              opacity: 1;
              transform: scale(1);
              color: #00d2ff;
            }
            @media (max-width: 991px) {
              .top-wrap .container {
                gap: 10px;
              }
              .top-wrap .left,
              .top-wrap .right {
                min-width: 0;
              }
              .top-switchers {
                flex-wrap: nowrap;
                gap: 8px;
              }
              .top-switcher > .top-switcher-toggle {
                min-width: 102px !important;
                min-height: 34px;
                padding: 0 12px !important;
                gap: 8px;
              }
              .top-switcher > .top-switcher-toggle .top-switcher-text,
              .top-switcher > .top-switcher-toggle .top-switcher-text span {
                font-size: 12px !important;
              }
              .top-wrap .right {
                font-size: 12px;
                white-space: nowrap;
              }
              .top-wrap .right .bi-telephone {
                display: none;
              }
            }
            @media (max-width: 576px) {
              .top-wrap .container {
                padding-left: 12px !important;
                padding-right: 12px !important;
              }
              .top-switcher-menu {
                width: min(220px, calc(100vw - 32px)) !important;
              }
            }
            .banli-topbar-container {
              min-height: 40px;
              gap: 18px;
            }
            .top-wrap .left {
              order: 2;
              margin-left: auto;
              min-width: 0;
            }
            .top-wrap .right {
              order: 1;
              display: flex;
              align-items: center;
              min-width: 0;
            }
            .top-wrap .right > div {
              display: inline-flex;
              align-items: center;
              gap: 8px;
              color: rgba(255,255,255,0.86);
              font-size: 13px;
              font-weight: 650;
              line-height: 1;
              white-space: nowrap;
            }
            .top-wrap .right .bi-telephone {
              color: rgba(0, 210, 255, 0.9);
              font-size: 13px;
            }
            .top-switchers {
              justify-content: flex-end;
              flex-wrap: nowrap;
              gap: 18px;
            }
            .top-switcher > .top-switcher-toggle {
              justify-content: center;
              gap: 6px;
              min-width: 0 !important;
              min-height: 30px;
              padding: 0 !important;
              border: 0 !important;
              border-radius: 0 !important;
              color: rgba(255,255,255,0.82) !important;
              background: transparent !important;
              box-shadow: none !important;
              letter-spacing: 0;
              font-weight: 650;
              backdrop-filter: none;
              -webkit-backdrop-filter: none;
              transition: color 180ms ease;
            }
            .top-switcher > .top-switcher-toggle:hover,
            .top-switcher > .top-switcher-toggle:focus {
              color: #fff !important;
              transform: none;
              box-shadow: none !important;
            }
            .top-switcher > .top-switcher-toggle .top-switcher-text,
            .top-switcher > .top-switcher-toggle .top-switcher-text span {
              font-size: 13px !important;
              font-weight: 650 !important;
              letter-spacing: 0;
            }
            .top-switcher > .top-switcher-toggle .top-switcher-caret {
              opacity: 0.74;
            }
            .top-switcher-menu {
              top: calc(100% + 8px) !important;
              left: auto !important;
              right: 0 !important;
              border-radius: 10px !important;
              border-color: rgba(255,255,255,0.12) !important;
              box-shadow: 0 16px 36px rgba(0,0,0,0.42);
              padding: 5px !important;
              width: 176px !important;
              margin-top: 6px !important;
              background: rgba(9, 11, 24, 0.96) !important;
              background-color: rgba(9, 11, 24, 0.96) !important;
            }
            .top-switcher-item {
              min-height: 42px;
              padding: 8px 10px;
              border-radius: 8px;
              gap: 10px;
              font-size: 13px;
              color: rgba(255,255,255,0.78);
              transform: none !important;
            }
            .top-switcher-item:hover,
            .top-switcher-item:focus {
              background: rgba(255,255,255,0.06);
              color: #fff;
              transform: none !important;
            }
            .top-switcher-item.active {
              background: rgba(0, 210, 255, 0.10);
              border-color: rgba(0, 210, 255, 0.28);
              color: #fff;
            }
            .top-switcher-item .top-switcher-item-main {
              gap: 10px;
            }
            .top-switcher-item .top-switcher-item-badge {
              min-width: 44px;
              padding: 0 !important;
              background: transparent !important;
              border: 0 !important;
              border-radius: 0 !important;
              color: rgba(255,255,255,0.88);
              font-size: 12px;
              font-weight: 750;
              letter-spacing: 0.8px;
              justify-content: flex-start;
            }
            .top-switcher-item.active .top-switcher-item-badge {
              color: #fff;
            }
            .top-switcher-check svg {
              width: 13px;
              height: 13px;
            }
            @media (max-width: 991px) {
              .banli-topbar-container {
                min-height: 36px;
                gap: 10px;
              }
              .top-switchers {
                gap: 12px;
              }
              .top-switcher > .top-switcher-toggle {
                min-width: 0 !important;
                min-height: 30px;
                padding: 0 !important;
              }
              .top-switcher > .top-switcher-toggle .top-switcher-text,
              .top-switcher > .top-switcher-toggle .top-switcher-text span,
              .top-wrap .right > div {
                font-size: 12px !important;
              }
            }
            @media (max-width: 576px) {
              .top-wrap .right > div {
                max-width: 42vw;
                overflow: hidden;
                text-overflow: ellipsis;
              }
              .top-switchers {
                gap: 10px;
              }
              .top-switcher-menu {
                width: min(176px, calc(100vw - 32px)) !important;
              }
            }
          </style>
          <div class="top-switchers">
            @hookwrapper('header.top.currency')
            @if ($showCurrencySwitcher)
              <div class="dropdown top-switcher">
                <a class="top-switcher-toggle" href="javascript:void(0)" id="currency-dropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                  <span class="top-switcher-text">
                    @foreach (currencies() as $currency)
                      @if ($currency->code == current_currency_code())
                        <span>{{ $currency->symbol_left }}{{ $currency->code }}{{ $currency->symbol_right }}</span>
                      @endif
                    @endforeach
                  </span>
                  <span class="top-switcher-caret">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                  </span>
                </a>
                <ul class="dropdown-menu top-switcher-menu" aria-labelledby="currency-dropdown">
                  @foreach (currencies() as $currency)
                    <li>
                      <a class="top-switcher-item {{ $currency->code == current_currency_code() ? 'active' : '' }}" href="{{ shop_route('currency.switch', [$currency->code]) }}">
                        <span class="top-switcher-item-main">
                          <span class="top-switcher-item-badge">{{ $currency->code }}</span>
                          <span style="min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $currency->name }}</span>
                        </span>
                        <span class="top-switcher-check">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                          </svg>
                        </span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
            @endhookwrapper

            @hookwrapper('header.top.language')
            @if ($showLanguageSwitcher)
              <div class="dropdown top-switcher">
                <a class="top-switcher-toggle" href="javascript:void(0)" id="language-dropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                  <span class="top-switcher-text">
                    <span>{{ current_language()->name }}</span>
                  </span>
                  <span class="top-switcher-caret">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                  </span>
                </a>
                <ul class="dropdown-menu top-switcher-menu" aria-labelledby="language-dropdown">
                  @foreach ($languages as $language)
                    <li>
                      <a class="top-switcher-item {{ $language->code == locale() ? 'active' : '' }}" href="{{ shop_route('lang.switch', [$language->code]) }}">
                        <span class="top-switcher-item-main">
                          <span class="top-switcher-item-badge">{{ strtoupper($language->code) }}</span>
                          <span style="min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $language->name }}</span>
                        </span>
                        <span class="top-switcher-check">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                          </svg>
                        </span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
            @endhookwrapper
          </div>
        @endif

        @hook('header.top.left')
      </div>

      @hook('header.top.language.after')

      <div class="right">
        @if (system_setting('base.telephone', ''))
          @hookwrapper('header.top.telephone')
          <div class="my-auto"><i class="bi bi-telephone me-2"></i> {{ system_setting('base.telephone') }}</div>
          @endhookwrapper
        @endif

        @hook('header.top.right')
      </div>
    </div>
  </div>
  <style>
    .banli-mobile-header-wrap {
      display: none;
    }
    @media (max-width: 991px) {
      .banli-mobile-header-wrap {
        display: block;
        padding-left: 12px;
        padding-right: 12px;
      }
      .banli-mobile-nav {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        min-height: 76px;
        gap: 10px;
      }
      .banli-mobile-nav-group {
        display: flex;
        align-items: center;
        gap: 14px;
      }
      .banli-mobile-nav-left {
        justify-content: flex-start;
      }
      .banli-mobile-nav-right {
        justify-content: flex-end;
      }
      .banli-mobile-brand {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 0;
        color: #fff;
        text-decoration: none;
        line-height: 1;
      }
      .banli-mobile-brand-mark {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
      .banli-mobile-brand-mark img {
        width: 42px;
        height: 42px;
        object-fit: contain;
        display: block;
      }
      .banli-mobile-brand-name {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: 0;
        color: #fff;
        white-space: nowrap;
      }
      .banli-mobile-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        color: rgba(255,255,255,.94);
        text-decoration: none;
        position: relative;
      }
      .banli-mobile-icon-btn svg {
        width: 26px;
        height: 26px;
        display: block;
      }
      .banli-mobile-icon-btn .cart-badge-quantity {
        left: 18px;
        top: -5px;
      }
      .banli-desktop-nav {
        display: none !important;
      }

      #offcanvas-mobile-menu {
        width: min(86vw, 360px);
        background:
          linear-gradient(180deg, rgba(16, 20, 53, 0.98), rgba(11, 15, 41, 0.98)) !important;
        color: #fff !important;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 24px 0 60px rgba(0, 0, 0, 0.45);
      }

      #offcanvas-mobile-menu .offcanvas-header {
        padding: 16px 18px;
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
      }

      #offcanvas-mobile-menu .offcanvas-title {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0;
      }

      #offcanvas-mobile-menu .btn-close {
        filter: invert(1) grayscale(100%) brightness(220%);
        opacity: .82;
        box-shadow: none !important;
      }

      #offcanvas-mobile-menu .btn-close:hover,
      #offcanvas-mobile-menu .btn-close:focus {
        opacity: 1;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap {
        padding: 0;
        background: transparent;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion {
        border-top: 0;
        background: transparent;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .accordion-item {
        background: transparent !important;
        border: 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text {
        background: transparent;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text > a {
        min-height: 56px;
        padding: 0 18px;
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.92) !important;
        font-size: 16px;
        font-weight: 650;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text > a:hover,
      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text > a:focus {
        color: #fff !important;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text > span {
        width: 52px;
        height: 56px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.72);
        border-left: 1px solid rgba(255, 255, 255, 0.08);
        background: transparent !important;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text > span:active,
      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .nav-item-text > span[aria-expanded="true"] {
        background: rgba(255, 255, 255, 0.05) !important;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .accordion-item > .accordion-collapse {
        padding: 0 18px 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(255, 255, 255, 0.02);
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .children-group + .children-group {
        border-top: 1px dashed rgba(255, 255, 255, 0.08);
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .children-title {
        min-height: 48px;
        color: rgba(255, 255, 255, 0.88);
        font-weight: 600;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .children-title > span {
        width: 44px;
        height: 44px;
        margin-right: -10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.68);
        background: transparent !important;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .children-title > span:active,
      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .children-title > span[aria-expanded="true"] {
        background: rgba(255, 255, 255, 0.05) !important;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .ul-children .nav-link {
        padding: 10px 0;
        color: rgba(255, 255, 255, 0.72) !important;
        font-size: 14px;
      }

      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .ul-children .nav-link:hover,
      #offcanvas-mobile-menu .mobile-menu-wrap #menu-accordion .ul-children .nav-link:focus {
        color: #fff !important;
      }

      #offcanvas-mobile-menu .badge {
        box-shadow: none;
      }
    }
    @media (max-width: 420px) {
      .banli-mobile-nav-group {
        gap: 10px;
      }
      .banli-mobile-brand-mark {
        width: 38px;
        height: 38px;
        flex-basis: 38px;
      }
      .banli-mobile-brand-mark img {
        width: 38px;
        height: 38px;
      }
      .banli-mobile-brand-name {
        font-size: 21px;
      }
      .banli-mobile-icon-btn {
        width: 32px;
        height: 32px;
      }
      .banli-mobile-icon-btn svg {
        width: 24px;
        height: 24px;
      }
    }
  </style>

  <div class="container banli-mobile-header-wrap">
    <div class="banli-mobile-nav">
      <div class="banli-mobile-nav-group banli-mobile-nav-left">
        <button type="button" class="banli-mobile-icon-btn mobile-open-menu border-0 bg-transparent p-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-mobile-menu" aria-controls="offcanvas-mobile-menu" aria-label="Menu">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
          </svg>
        </button>
        <a href="#offcanvas-search-top" data-bs-toggle="offcanvas" class="banli-mobile-icon-btn" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </a>
      </div>

      <a href="{{ shop_route('home.index') }}" class="banli-mobile-brand" aria-label="Banli">
        <span class="banli-mobile-brand-mark">
          <img src="{{ asset('banli_theme-assets/logo-light/banli-logo.png') }}" alt="">
        </span>
        <span class="banli-mobile-brand-name">{{ $banliBrandText }}</span>
      </a>

      <div class="banli-mobile-nav-group banli-mobile-nav-right">
        <a href="{{ shop_route('account.index') }}" class="banli-mobile-icon-btn" aria-label="Account">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
          </svg>
        </a>
        <a href="javascript:void(0);" class="banli-mobile-icon-btn btn-right-cart {{ equal_route('shop.carts.index') ? 'page-cart' : '' }}" aria-label="Cart">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
          </svg>
          <span class="badge cart-badge-quantity">0</span>
        </a>
      </div>
    </div>
  </div>

  <div class="container banli-desktop-nav">
      <div class="row">
          <div class="col-md-12">
              <div class="de-flex sm-pt10">
                  <div class="de-flex-col">
                      <!-- logo begin -->
                      @hookwrapper('header.menu.logo')
                      <div id="logo">
                          <a href="{{ shop_route('home.index') }}" class="banli-header-brand" aria-label="Banli">
                              <span class="banli-header-brand-mark">
                                <img class="logo-main" src="{{ asset('banli_theme-assets/logo-light/banli-logo.png') }}" alt="">
                                <img class="logo-scroll" src="{{ asset('banli_theme-assets/logo-light/banli-logo.png') }}" alt="">
                                <img class="logo-mobile" src="{{ asset('banli_theme-assets/logo-light/banli-logo.png') }}" alt="">
                              </span>
                              <span class="banli-header-brand-name">{{ $banliBrandText }}</span>
                          </a>
                      </div>
                      @endhookwrapper
                      <!-- logo close -->
                  </div>

                  <div class="de-flex-col" style="flex: 1; justify-content: flex-end; gap: 40px;">
                      <div class="de-flex-col header-col-mid">
                          <ul id="mainmenu">
                              @if(isset($menu_content) && count($menu_content) > 0)
                                  @foreach ($menu_content as $menu)
                                      @if ($menu['name'])
                                          <li>
                                              <a class="menu-item" target="{{ isset($menu['new_window']) && $menu['new_window'] ? '_blank' : '_self' }}" href="{{ $menu['link'] ?: 'javascript:void(0)' }}">
                                                  <span class="banli-menu-label">{{ $menu['name'] }}</span>
                                                  @if (isset($menu['badge']) && $menu['badge']['name'])
                                                      <span class="badge banli-menu-badge"
                                                            style="background-color: {{ $menu['badge']['bg_color'] }}; color: {{ $menu['badge']['text_color'] }}; border-color: {{ $menu['badge']['bg_color'] }}">
                                                          {{ $menu['badge']['name'] }}
                                                      </span>
                                                  @endif
                                              </a>

                                              @if (isset($menu['children_group']) && count($menu['children_group']) > 0)
                                                  <ul>
                                                      @foreach ($menu['children_group'] as $group)
                                                          @if ($group['type'] == 'link' && isset($group['children']))
                                                              @foreach ($group['children'] as $children)
                                                                  @if (!is_array($children['link']['text']) && $children['link']['text'])
                                                                      <li>
                                                                          <a target="{{ isset($children['link']['new_window']) && $children['link']['new_window'] ? '_blank' : '_self' }}" href="{{ $children['link']['link'] ?: 'javascript:void(0)' }}">
                                                                              {{ $children['link']['text'] }}
                                                                          </a>
                                                                      </li>
                                                                  @endif
                                                              @endforeach
                                                          @endif
                                                      @endforeach
                                                  </ul>
                                              @endif
                                          </li>
                                      @endif
                                  @endforeach
                              @else
                                  <li><a class="menu-item active" href="{{ shop_route('home.index') }}">{{ __('common.home') }}</a></li>
                                  <li><a class="menu-item" href="{{ shop_route('categories.index') }}">{{ __('BanliTheme::common.categories') }}</a></li>
                                  <li><a class="menu-item" href="{{ shop_route('products.search') }}">{{ __('shop/products.search') }}</a></li>
                              @endif
                          </ul>
                      </div>
                      <style>
                        .top-icon-group {
                          display: flex;
                          align-items: center;
                          gap: 20px;
                        }
                        header div#logo {
                          width: auto;
                          min-width: 170px;
                          line-height: 1;
                        }
                        header #logo .banli-header-brand {
                          display: inline-flex;
                          align-items: center;
                          gap: 10px;
                          color: #fff;
                          text-decoration: none;
                          white-space: nowrap;
                        }
                        header #logo .banli-header-brand-mark {
                          width: 50px;
                          height: 50px;
                          position: relative;
                          display: inline-flex;
                          align-items: center;
                          justify-content: center;
                          flex: 0 0 auto;
                        }
                        header #logo .banli-header-brand-mark img {
                          position: absolute;
                          inset: 0;
                          width: 50px !important;
                          height: 50px !important;
                          max-width: none !important;
                          max-height: none !important;
                          object-fit: contain;
                        }
                        header #logo .banli-header-brand-name {
                          color: #fff;
                          font-size: 30px;
                          font-weight: 800;
                          line-height: 1;
                          letter-spacing: 0;
                        }
                        header.smaller #logo .banli-header-brand-mark,
                        header.smaller #logo .banli-header-brand-mark img {
                          width: 44px !important;
                          height: 44px !important;
                        }
                        header.smaller #logo .banli-header-brand-name {
                          font-size: 27px;
                        }
                        header #mainmenu > li > a.menu-item {
                          display: inline-flex !important;
                          align-items: center;
                          gap: 6px;
                          position: relative;
                          white-space: nowrap;
                          overflow: visible;
                        }
                        header #mainmenu > li.has-child::after,
                        header #mainmenu > li.menu-item-has-children::after,
                        header #mainmenu > li > a.menu-item::after {
                          display: none !important;
                          content: none !important;
                        }
                        header #mainmenu > li.menu-item-has-children > a.menu-item::after,
                        header #mainmenu > li.has-child > a.menu-item::after {
                          content: "" !important;
                          display: inline-block !important;
                          width: 7px;
                          height: 7px;
                          margin-left: 6px;
                          border-right: 2px solid currentColor;
                          border-bottom: 2px solid currentColor;
                          opacity: .72;
                          transform: rotate(45deg) translateY(-2px);
                          flex: 0 0 auto;
                        }
                        header #mainmenu .banli-menu-label {
                          display: inline-flex !important;
                          align-items: center;
                          position: static !important;
                          width: auto !important;
                          min-width: 0;
                          color: inherit !important;
                          border-bottom: 0 !important;
                          font-size: inherit !important;
                          line-height: 1.2 !important;
                          text-transform: none !important;
                          white-space: nowrap;
                        }
                        header #mainmenu li:hover a .banli-menu-label,
                        header #mainmenu a.active .banli-menu-label {
                          width: auto !important;
                        }
                        header #mainmenu .banli-menu-badge {
                          display: inline-flex;
                          align-items: center;
                          justify-content: center;
                          position: absolute !important;
                          top: 2px;
                          left: 50%;
                          right: auto;
                          min-width: 0;
                          min-height: 16px;
                          padding: 4px 8px;
                          border: 1px solid rgba(255, 255, 255, .18) !important;
                          border-radius: 999px;
                          font-size: 10px;
                          font-weight: 800;
                          line-height: 1;
                          letter-spacing: 0;
                          box-shadow: 0 8px 18px rgba(0, 0, 0, .24), inset 0 1px 0 rgba(255, 255, 255, .26);
                          text-shadow: 0 1px 0 rgba(0, 0, 0, .16);
                          transform: translateX(-50%);
                          pointer-events: none;
                          white-space: nowrap;
                        }
                        header #mainmenu .banli-menu-badge::after {
                          content: "";
                          position: absolute;
                          left: 8px;
                          bottom: -3px;
                          width: 6px;
                          height: 6px;
                          background: inherit;
                          border-right: 1px solid rgba(255, 255, 255, .14);
                          border-bottom: 1px solid rgba(255, 255, 255, .14);
                          transform: rotate(45deg);
                        }
                        @media (min-width: 992px) and (max-width: 1399.98px) {
                          header #mainmenu > li {
                            margin-right: 22px;
                          }
                          header #mainmenu > li > a.menu-item {
                            font-size: 14px;
                            gap: 4px;
                          }
                          header #mainmenu .banli-menu-badge {
                            padding: 3px 6px;
                            font-size: 9px;
                          }
                        }
                        .top-icon-btn {
                          color: #fff;
                          font-size: 20px;
                          opacity: 0.8;
                          transition: all 0.3s ease;
                          text-decoration: none;
                          position: relative;
                          display: flex;
                          align-items: center;
                          justify-content: center;
                        }
                        .top-icon-btn:hover {
                          opacity: 1;
                          color: #00d2ff;
                          transform: translateY(-2px);
                        }
                        .top-icon-btn .badge {
                          position: absolute;
                          top: -6px;
                          right: -10px;
                          background: linear-gradient(135deg, #8a2387, #e94057, #f27121);
                          border: 1px solid #111118;
                          font-size: 10px;
                          padding: 3px 6px;
                          border-radius: 10px;
                          box-shadow: 0 2px 5px rgba(0,0,0,0.5);
                        }
                        #menu-btn {
                          display: none !important; /* Hide by default on desktop */
                        }
                        #menu-btn::before {
                          display: none !important; /* Override legacy pseudo-element */
                        }
                        @media (max-width: 991px) {
                          header div#logo {
                            min-width: 128px;
                          }
                          header #logo .banli-header-brand-mark,
                          header #logo .banli-header-brand-mark img {
                            width: 42px !important;
                            height: 42px !important;
                          }
                          header #logo .banli-header-brand-name {
                            font-size: 24px;
                          }
                          .header-col-mid, #mainmenu {
                            display: none !important;
                          }
                          .top-icon-group {
                            gap: 12px;
                            margin-left: 0 !important;
                            padding-right: 0 !important;
                          }
                          .top-icon-btn {
                            font-size: 18px;
                          }
                          .top-icon-btn.hide-on-mobile {
                            display: none !important;
                          }
                          #menu-btn {
                            display: flex !important; /* Show on mobile */
                            color: #fff;
                          }
                        }
                      </style>
                      <div class="menu_side_area top-icon-group" style="margin-left: 20px; padding-right: 15px;">
                          @hookwrapper('header.menu.icon')
                          <!-- Search Icon -->
                          <a href="#offcanvas-search-top" data-bs-toggle="offcanvas" class="top-icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                          </a>
                          
                          <!-- Wishlist Icon -->
                          <a href="{{ shop_route('account.wishlist.index') }}" class="top-icon-btn hide-on-mobile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                              <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>
                          </a>
                          
                          <!-- Account Icon -->
                          <a href="{{ shop_route('account.index') }}" class="top-icon-btn hide-on-mobile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                            </svg>
                          </a>
                          
                          <!-- Cart Icon -->
                          <a href="javascript:void(0);" class="top-icon-btn btn-right-cart {{ equal_route('shop.carts.index') ? 'page-cart' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                            <span class="badge cart-badge-quantity">0</span>
                          </a>
                          @endhookwrapper
                          
                          <!-- Mobile Menu Button -->
                          <span id="menu-btn" class="ms-2 mobile-open-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-mobile-menu" role="button" aria-controls="offcanvas-mobile-menu" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; cursor: pointer; position: relative;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                          </span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-mobile-menu" style="background: var(--bg-dark-1); color: #fff;">
    <div class="offcanvas-header border-bottom border-secondary">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">{{ __('common.menu') }}</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mobile-menu-wrap">
      @include('shared.menu-mobile')
    </div>
  </div>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-right-cart" aria-labelledby="offcanvasRightLabel" style="background: var(--bg-dark-1); color: #fff;"></div>

  <x-shop-search-popover />

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const topSwitchers = Array.from(document.querySelectorAll('.top-switcher'));

      const supportsDesktopHover = function () {
        return window.matchMedia('(min-width: 992px) and (hover: hover) and (pointer: fine)').matches;
      };

      const getDropdown = function (toggle) {
        if (!window.bootstrap || !bootstrap.Dropdown || !toggle) return null;
        return bootstrap.Dropdown.getOrCreateInstance(toggle, {
          autoClose: 'outside',
          display: 'static'
        });
      };

      const hideSwitcher = function (switcher) {
        const toggle = switcher.querySelector('.top-switcher-toggle');
        const dropdown = getDropdown(toggle);
        if (dropdown) {
          dropdown.hide();
          return;
        }

        toggle?.setAttribute('aria-expanded', 'false');
        switcher.classList.remove('show');
        const menu = switcher.querySelector('.top-switcher-menu');
        if (menu) {
          menu.classList.remove('show');
          menu.removeAttribute('data-bs-popper');
        }
      };

      const hideOtherSwitchers = function (currentSwitcher) {
        topSwitchers.forEach(function (switcher) {
          if (switcher !== currentSwitcher) hideSwitcher(switcher);
        });
      };

      topSwitchers.forEach(function (switcher) {
        const toggle = switcher.querySelector('.top-switcher-toggle');
        const menu = switcher.querySelector('.top-switcher-menu');
        if (!toggle || !menu) return;

        let closeTimer = null;

        const clearCloseTimer = function () {
          if (closeTimer) {
            window.clearTimeout(closeTimer);
            closeTimer = null;
          }
        };

        const showSwitcher = function () {
          if (!supportsDesktopHover()) return;
          clearCloseTimer();
          hideOtherSwitchers(switcher);
          const dropdown = getDropdown(toggle);
          if (dropdown) dropdown.show();
        };

        const queueHide = function () {
          if (!supportsDesktopHover()) return;
          clearCloseTimer();
          closeTimer = window.setTimeout(function () {
            hideSwitcher(switcher);
          }, 180);
        };

        switcher.addEventListener('mouseenter', showSwitcher);
        switcher.addEventListener('pointerenter', showSwitcher);
        switcher.addEventListener('mouseover', function (event) {
          if (!switcher.contains(event.relatedTarget)) showSwitcher();
        });

        switcher.addEventListener('mouseleave', queueHide);
        switcher.addEventListener('pointerleave', queueHide);
        switcher.addEventListener('mouseout', function (event) {
          if (!switcher.contains(event.relatedTarget)) queueHide();
        });

        menu.addEventListener('mouseenter', clearCloseTimer);
        menu.addEventListener('pointerenter', clearCloseTimer);
        menu.addEventListener('mouseleave', queueHide);
        menu.addEventListener('pointerleave', queueHide);

        toggle.addEventListener('click', function () {
          hideOtherSwitchers(switcher);
        });

        toggle.addEventListener('keydown', function (event) {
          if (event.key === 'Escape') {
            hideSwitcher(switcher);
            toggle.focus();
          }

          if (event.key === 'ArrowDown') {
            const dropdown = getDropdown(toggle);
            if (dropdown) dropdown.show();
            const firstItem = menu.querySelector('.top-switcher-item');
            if (firstItem) {
              event.preventDefault();
              firstItem.focus();
            }
          }
        });

        menu.addEventListener('keydown', function (event) {
          if (event.key === 'Escape') {
            hideSwitcher(switcher);
            toggle.focus();
          }
        });
      });

      const offcanvasMobileMenu = document.getElementById('offcanvas-mobile-menu');
      if (offcanvasMobileMenu) {
        offcanvasMobileMenu.addEventListener('show.bs.offcanvas', function () {
          topSwitchers.forEach(hideSwitcher);
        });
      }
    });
  </script>

  @hook('header.after')
</header>
