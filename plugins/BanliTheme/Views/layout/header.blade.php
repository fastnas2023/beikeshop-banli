<header class="transparent">
  @hook('header.before')
  <div class="top-wrap" style="background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 8px 0; font-size: 13px;">
    <div class="container d-flex justify-content-between align-items-center text-light">
      <div class="left d-flex align-items-center">
        @hookwrapper('header.top.currency')
        @if (currencies()->count() > 1)
          <style>
            #currency-dropdown::after, #language-dropdown::after {
              display: none;
            }
            .top-dropdown-btn {
              padding: 0;
              background: transparent;
              border: none;
              opacity: 0.8;
              transition: all 0.3s ease;
              display: flex;
              align-items: center;
              cursor: pointer;
            }
            .top-dropdown-btn:hover {
              opacity: 1;
              color: #00d2ff !important;
            }
            /* Add subtle underline on hover to indicate interactivity */
            .top-dropdown-btn:hover .dropdown-text {
              text-decoration: underline;
              text-underline-offset: 4px;
            }
          </style>
          <div class="dropdown me-4">
            <a class="text-light text-decoration-none top-dropdown-btn" href="javascript:void(0)" id="currency-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="me-1 dropdown-text" style="font-weight: 500;">
              @foreach (currencies() as $currency)
                @if ($currency->code == current_currency_code())
                  {{ $currency->symbol_left }}{{ $currency->name }}{{ $currency->symbol_right }}
                @endif
              @endforeach
              </span>
              <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" style="margin-top: 2px;">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
              </svg>
            </a>
            <ul class="dropdown-menu shadow-sm border-0" aria-labelledby="currency-dropdown" style="background: #111118; min-width: 120px; border-radius: 8px; margin-top: 10px !important; border: 1px solid rgba(255,255,255,0.05) !important;">
              @foreach (currencies() as $currency)
                <li><a class="dropdown-item" href="{{ shop_route('currency.switch', [$currency->code]) }}" style="padding: 8px 15px; font-size: 13px; color: #aaa; transition: color 0.3s;" onmouseover="this.style.color='#00d2ff'; this.style.backgroundColor='transparent';" onmouseout="this.style.color='#aaa';">{{ $currency->symbol_left }}{{ $currency->name }}{{ $currency->symbol_right }}</a></li>
              @endforeach
            </ul>
          </div>
        @endif
        @endhookwrapper

        @hookwrapper('header.top.language')
        @if (count($languages) > 1)
          <div class="dropdown">
            <a class="text-light text-decoration-none top-dropdown-btn" href="javascript:void(0)" id="language-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="me-1 dropdown-text" style="font-weight: 500;">{{ current_language()->name }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" style="margin-top: 2px;">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
              </svg>
            </a>
            <ul class="dropdown-menu shadow-sm border-0" aria-labelledby="language-dropdown" style="background: #111118; min-width: 120px; border-radius: 8px; margin-top: 10px !important; border: 1px solid rgba(255,255,255,0.05) !important;">
              @foreach ($languages as $language)
                <li><a class="dropdown-item" href="{{ shop_route('lang.switch', [$language->code]) }}" style="padding: 8px 15px; font-size: 13px; color: #aaa; transition: color 0.3s;" onmouseover="this.style.color='#00d2ff'; this.style.backgroundColor='transparent';" onmouseout="this.style.color='#aaa';">{{ $language->name }}</a></li>
              @endforeach
            </ul>
          </div>
        @endif
        @endhookwrapper

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
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="de-flex sm-pt10">
                  <div class="de-flex-col">
                      <!-- logo begin -->
                      @hookwrapper('header.menu.logo')
                      <div id="logo">
                          <a href="{{ shop_route('home.index') }}">
                              <img class="logo-main" src="{{ image_origin(system_setting('base.logo')) }}" alt="" style="filter: brightness(0) invert(1); max-height: 40px;">
                              <img class="logo-scroll" src="{{ image_origin(system_setting('base.logo')) }}" alt="" style="filter: brightness(0) invert(1); max-height: 40px;">
                              <img class="logo-mobile" src="{{ image_origin(system_setting('base.logo')) }}" alt="" style="filter: brightness(0) invert(1); max-height: 40px;">
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
