@extends('layout.master')

@section('body-class', 'page-checkout')

@push('header')
  <script src="{{ asset('vendor/vue/2.7/vue' . (!config('app.debug') ? '.min' : '') . '.js') }}"></script>
  <script src="{{ asset('vendor/scrolltofixed/jquery-scrolltofixed-min.js') }}"></script>
  <script src="{{ asset('vendor/element-ui/index.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('vendor/element-ui/index.css') }}">
  <style>
    body.page-checkout #wrapper {
      padding-top: var(--banli-header-height, 104px) !important;
    }
    body.page-checkout .section-dark {
      padding-top: clamp(1rem, 2vw, 1.5rem);
    }
  </style>
@endpush

@section('content')
<div class="bg-dark section-dark text-light" style="min-height: 100vh;">
  <x-shop-breadcrumb type="static" value="checkout.index"/>

  <div class="container">
    @if (!is_mobile())
      <div class="row mt-1 justify-content-center">
        <div class="col-12 col-md-9">@include('shared.steps', ['steps' => 2])</div>
      </div>
    @endif

    <div class="row {{ !is_mobile() ? 'mt-5' : ''}}">
      <div class="col-12 col-md-8 left-column">
        @if (!current_customer() && is_mobile())
          <div class="card glass-card total-wrap mb-4 p-lg-4">
            <div class="card-header border-secondary">
              <h5 class="mb-0 text-light">{{ __('shop/login.login_and_sign') }}</h5>
            </div>
            <div class="card-body">
              <button class="btn btn-outline-light guest-checkout-login"><i
                  class="bi bi-box-arrow-in-right me-2"></i>{{ __('shop/login.login_and_sign') }}</button>
            </div>
          </div>
        @endif

        <div class="card glass-card">
          <div class="card-body p-lg-4">
            @hook('checkout.body.header')

            @hookwrapper('checkout._address')
            @include('checkout._address')
            @endhookwrapper

            <div class="checkout-black glass-card p-3 rounded mb-4">
              <h5 class="checkout-title text-light">{{ __('shop/checkout.payment_method') }}</h5>
              <div class="radio-line-wrap" id="payment-methods-wrap">
                @foreach ($payment_methods as $payment)
                  <div class="radio-line-item {{ $payment['code'] == $current['payment_method_code'] ? 'active' : '' }}"
                       data-key="payment_method_code" data-value="{{ $payment['code'] }}">
                    <div class="left">
                      <span class="radio"></span>
                      <img src="{{ $payment['icon'] }}" class="img-fluid rounded-2" alt="{{ $payment['name'] }}">
                    </div>
                    <div class="right ms-2">
                      <div class="title">{{ $payment['name'] }}</div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            @if ($shipping_require)
              @hookwrapper('checkout.shipping_method')
              <div class="checkout-black glass-card p-3 rounded mb-4">
                <h5 class="checkout-title text-light">{{ __('shop/checkout.delivery_method') }}</h5>
                <div class="radio-line-wrap" id="shipping-methods-wrap">
                  @foreach ($shipping_methods as $methods)
                    @foreach ($methods['quotes'] as $shipping)
                      <div
                        class="radio-line-item {{ $shipping['code'] == $current['shipping_method_code'] ? 'active':'' }}"
                        data-key="shipping_method_code" data-value="{{ $shipping['code'] }}">
                        <div class="left">
                          <span class="radio"></span>
                          <img src="{{ $shipping['icon'] }}" class="img-fluid rounded-2" alt="{{ $shipping['name'] }}">
                        </div>
                        <div class="right ms-2">
                          <div class="title">{{ $shipping['name'] }}</div>
                          @if (isset($shipping['html']) && trim(strip_tags($shipping['html'])) !== '')
                            <div class="mt-2">{{ strip_tags($shipping['html']) }}</div>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  @endforeach
                </div>
              </div>
              @endhookwrapper
            @endif

            <div class="checkout-black glass-card p-3 rounded mb-4">
              <h5 class="checkout-title text-light">{{ __('shop/checkout.comment') }}</h5>
              <div class="comment-wrap" id="comment-wrap">
                <textarea rows="5" type="text" class="form-control form-control-dark" name="comment"
                          placeholder="{{ __('shop/checkout.comment') }}">{{ old('comment', $comment ?? '') }}</textarea>
              </div>
            </div>

            @hook('checkout.bottom')
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4 right-column">
        <div class="x-fixed-top">
          @if (!current_customer() && !is_mobile())
            <div class="card glass-card total-wrap mb-4 p-lg-4">
              <div class="card-header border-secondary">
                <h5 class="mb-0 text-light">{{ __('shop/login.login_and_sign') }}</h5>
              </div>
              <div class="card-body">
                <button class="btn btn-outline-light guest-checkout-login"><i
                    class="bi bi-box-arrow-in-right me-2"></i>{{ __('shop/login.login_and_sign') }}</button>
              </div>
            </div>
          @endif

          <div class="card glass-card total-wrap p-lg-4">
            <div class="card-header border-secondary d-flex align-items-center justify-content-between">
              <h5 class="mb-0 text-light">{{ __('shop/checkout.cart_totals') }}</h5>
              <span class="rounded-circle bg-neon text-dark" style="width: 24px; height: 24px; text-align: center; line-height: 24px;">{{ $carts['quantity'] }}</span>
            </div>
            <div class="card-body">
              @hookwrapper('checkout.products')
              <div class="products-wrap">
                @foreach ($carts['carts'] as $cart)
                  <div class="item">
                    <div class="image">
                      <div class="img border d-flex align-items-center justify-content-center wh-50 me-2">
                        <img src="{{ image_resize($cart['image'], 100, 100) }}" class="img-fluid" alt="{{ $cart['name'] }}">
                      </div>
                      <div class="name">
                        <div title="{{ $cart['name'] }}" class="text-truncate-2">{{ $cart['name'] }}</div>
                        @if ($cart['variant_labels'])
                          <div class="text-muted mt-1">{{ $cart['variant_labels'] }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="price text-end">
                      <div>{!! $cart['price_format'] !!}</div>
                      <div class="quantity">x {{ $cart['quantity'] }}</div>
                    </div>
                  </div>
                @endforeach
              </div>
              @endhookwrapper
              <ul class="totals">
                @foreach ($totals as $total)
                  <li><span>{{ $total['title'] }}</span><span>{{ $total['amount_format'] }}</span></li>
                @endforeach
              </ul>
              <div class="d-grid gap-2 mt-3 submit-checkout-wrap">
                @if (is_mobile())
                  <div class="text-nowrap">
                    <span>{{ __('common.text_total') }}</span>: <span
                      class="fw-bold text-total">{{ $totals[count($totals) - 1]['amount_format'] }}</span>
                  </div>
                @endif

                @hookwrapper('checkout.confirm')
                <button class="btn btn-neon fw-bold fs-5" type="button"
                        id="submit-checkout"
                        data-label="{{ __('shop/checkout.submit_order') }}"
                        data-loading-label="{{ __('common.text_loading') }}">{{ __('shop/checkout.submit_order') }}</button>
                @endhookwrapper
              </div>

              @hook('checkout.total.footer')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @hook('checkout.footer')
</div>
@endsection

@push('add-scripts')
  <script>
    $(document).ready(function () {
      let checkoutSubmitting = false;

      $(document).on('click', '.radio-line-item', function (event) {
        if ($(this).hasClass('active')) return;
        updateCheckout($(this).data('key'), $(this).data('value'))
      });

      $('#submit-checkout').click(function (event) {
        if (checkoutSubmitting) {
          return;
        }

        const address = config.isLogin ? checkoutAddressApp.form.shipping_address_id : checkoutAddressApp.source.guest_shipping_address;
        const payment = config.isLogin ? checkoutAddressApp.form.payment_address_id : checkoutAddressApp.source.guest_payment_address;

        if (checkoutAddressApp.shippingRequired && !address) {
          layer.msg('{{ __('shop/checkout.error_address') }}', () => {
          })
          return;
        }

        if (!payment) {
          layer.msg('{{ __('shop/checkout.error_payment_address') }}', () => {
          })
          return;
        }

        let data = {
          comment: $('textarea[name=comment]').val()
        }

        checkoutSubmitting = true;
        setCheckoutSubmitting(true);

        $http.post('/checkout/confirm', data).then((res) => {
          if (!res || res.status == 'fail') {
            layer.msg(res && res.message ? res.message : '{{ __('common.api_error_message') }}');
            checkoutSubmitting = false;
            setCheckoutSubmitting(false);
            return;
          }

          const lang = "{{ locale() === system_setting('base.locale') ? "null": session()->get('locale') }}";
          let path = '/' + '{{ session()->get('locale') }}' + '/orders/' + res.number + '/pay?type=create';
          if(lang === "null") {
            path = '/orders/' + res.number + '/pay?type=create';
          }

          location = path;
        }).catch(() => {
          checkoutSubmitting = false;
          setCheckoutSubmitting(false);
        })
      });

      $('.guest-checkout-login').click(function (event) {
        bk.openLogin();
      });
    });

    function setCheckoutSubmitting(isSubmitting) {
      const $button = $('#submit-checkout');
      const label = $button.data('label');
      const loadingLabel = $button.data('loading-label');

      $button.prop('disabled', isSubmitting);
      $button.text(isSubmitting ? loadingLabel : label);
    }

    const updateCheckout = (key, value, callback) => {
      $http.put('/checkout', {[key]: value}).then((res) => {
        if (res.status == 'fail') {
          layer.msg(res.message, () => {
          })
          return;
        }

        updateTotal(res.totals)
        updateShippingMethods(res.shipping_methods, res.current.shipping_method_code)
        updatePaymentMethods(res.payment_methods, res.current.payment_method_code)

        if (typeof callback === 'function') {
          callback(res)
        }
      })
    }

    const updateTotal = (totals) => {
      const $totals = $('ul.totals').empty();

      totals.forEach((item) => {
        $('<li>')
          .append($('<span>').text(item.title || ''))
          .append($('<span>').text(item.amount_format || ''))
          .appendTo($totals);
      });
    }

    const updateShippingMethods = (data, shipping_method_code) => {
      const $wrap = $('<div>', {
        class: 'radio-line-wrap',
        id: 'shipping-methods-wrap',
      });

      data.forEach((methods) => {
        methods.quotes.forEach((quote) => {
          const $item = buildCheckoutMethodItem({
            key: 'shipping_method_code',
            code: quote.code,
            name: quote.name,
            icon: quote.icon,
            active: shipping_method_code == quote.code,
            html: quote.html,
          });

          $wrap.append($item);
        })
      })

      $('#shipping-methods-wrap').replaceWith($wrap);
    }

    const updatePaymentMethods = (data, payment_method_code) => {
      const $wrap = $('<div>', {
        class: 'radio-line-wrap',
        id: 'payment-methods-wrap',
      });

      data.forEach((item) => {
        $wrap.append(buildCheckoutMethodItem({
          key: 'payment_method_code',
          code: item.code,
          name: item.name,
          icon: item.icon,
          active: payment_method_code == item.code,
        }));
      })

      $('#payment-methods-wrap').replaceWith($wrap);
    }

    function buildCheckoutMethodItem(options) {
      const $item = $('<div>', {
        class: 'radio-line-item d-flex align-items-center' + (options.active ? ' active' : ''),
      }).attr({
        'data-key': options.key,
        'data-value': options.code || '',
      });

      const $left = $('<div>', {class: 'left'}).append($('<span>', {class: 'radio'}));
      const safeIcon = normalizeCheckoutAssetUrl(options.icon);
      if (safeIcon) {
        $('<img>', {
          src: safeIcon,
          class: 'img-fluid rounded-2',
          alt: options.name || '',
        }).appendTo($left);
      }

      const $right = $('<div>', {class: 'right ms-2'})
        .append($('<div>', {class: 'title'}).text(options.name || ''));

      if (options.html) {
        $('<div>', {class: 'mt-2'})
          .append(sanitizeCheckoutHtml(options.html))
          .appendTo($right);
      }

      return $item.append($left, $right);
    }

    function normalizeCheckoutAssetUrl(value) {
      const url = String(value || '').trim();

      if (!url || /^(javascript|data|vbscript):/i.test(url)) {
        return '';
      }

      return url;
    }

    function sanitizeCheckoutHtml(value) {
      const allowedTags = ['B', 'BR', 'DIV', 'EM', 'I', 'P', 'SMALL', 'SPAN', 'STRONG'];
      const allowedClasses = ['text-muted', 'text-secondary', 'text-light', 'small', 'fw-bold', 'mt-1', 'mt-2', 'mb-0'];
      const source = document.createElement('template');
      const fragment = document.createDocumentFragment();

      source.innerHTML = String(value || '');

      function walk(node, target) {
        Array.from(node.childNodes).forEach((child) => {
          if (child.nodeType === Node.TEXT_NODE) {
            target.appendChild(document.createTextNode(child.textContent || ''));
            return;
          }

          if (child.nodeType !== Node.ELEMENT_NODE) {
            return;
          }

          if (!allowedTags.includes(child.tagName)) {
            walk(child, target);
            return;
          }

          const clone = document.createElement(child.tagName.toLowerCase());
          const classNames = (child.getAttribute('class') || '')
            .split(/\s+/)
            .filter((className) => allowedClasses.includes(className));

          if (classNames.length) {
            clone.setAttribute('class', classNames.join(' '));
          }

          walk(child, clone);
          target.appendChild(clone);
        });
      }

      walk(source.content, fragment);

      return fragment;
    }
  </script>
@endpush
