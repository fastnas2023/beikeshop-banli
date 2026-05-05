@php
  $banliBrandText = system_setting('base.banli_theme_brand_text') ?: system_setting('base.store_name') ?: 'Banli';
@endphp

<header class="transparent">
  @hook('header.before')
  <div class="top-wrap" style="background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 8px 0; font-size: 13px;">
    <div class="container d-flex justify-content-between align-items-center text-light">
      <div class="left d-flex align-items-center">
        @php($showCurrencySwitcher = currencies()->count() > 1)
        @php($showLanguageSwitcher = count($languages) > 1)

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
            .top-switcher {
              position: relative;
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
              z-index: 2005 !important;
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
          </style>
          <div class="top-switchers">
            @hookwrapper('header.top.currency')
            @if ($showCurrencySwitcher)
              <div class="dropdown top-switcher">
                <a class="top-switcher-toggle" href="javascript:void(0)" id="currency-dropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
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
                <a class="top-switcher-toggle" href="javascript:void(0)" id="language-dropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
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
                                                  {{ $menu['name'] }}
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
                                  <li><a class="menu-item active" href="#section-hero">Home</a></li>
                                  <li><a class="menu-item" href="#section-about">About</a></li>
                                  <li><a class="menu-item" href="#section-speakers">Speakers</a></li>
                                  <li><a class="menu-item" href="#section-schedule">Schedule</a></li>
                                  <li><a class="menu-item" href="#section-tickets">Tickets</a></li>
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

  @hook('header.after')
</header>
