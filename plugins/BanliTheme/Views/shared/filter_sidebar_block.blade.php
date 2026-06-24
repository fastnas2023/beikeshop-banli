<style>
  .module-category-wrap,
  .filter-box {
    color: rgba(255,255,255,0.92);
  }
  .module-category-wrap h4,
  .filter-box h4 {
    font-size: 16px;
    font-weight: 750;
    letter-spacing: 0.4px;
    margin-bottom: 14px;
    color: rgba(255,255,255,0.92);
  }
  .sidebar-widget {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }
  .sidebar-widget > li {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    align-items: center;
    gap: 8px 10px;
    padding: 8px 10px;
    border-radius: 8px;
    border: 1px solid transparent;
    transition: background 180ms ease, border-color 180ms ease;
  }
  .sidebar-widget > li:hover {
    background: rgba(255,255,255,0.04);
    border-color: rgba(255,255,255,0.08);
  }
  .sidebar-widget li.active {
    background: rgba(0, 210, 255, 0.10);
    border-color: rgba(0, 210, 255, 0.22);
  }
  .sidebar-widget .category-href {
    color: rgba(255,255,255,0.78);
    text-decoration: none;
    font-weight: 650;
    letter-spacing: 0.2px;
    flex: 1 1 auto;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .sidebar-widget > li > .category-href {
    min-height: 30px;
    display: inline-flex;
    align-items: center;
  }
  .sidebar-widget li.active > .category-href {
    color: rgba(255,255,255,0.98);
  }
  .sidebar-widget li.active > .category-href::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 999px;
    background: #00d2ff;
    box-shadow: 0 0 0 4px rgba(0, 210, 255, 0.14), 0 0 20px rgba(0, 210, 255, 0.25);
    margin-right: 10px;
    vertical-align: middle;
  }
  .toggle-icon.btn {
    position: relative;
    width: 30px;
    height: 30px;
    min-width: 30px;
    min-height: 30px;
    flex: 0 0 30px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    box-sizing: border-box;
    border-radius: 8px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.10);
    color: rgba(255,255,255,0.72);
    line-height: 1;
    transform: none !important;
    transition: border-color 180ms ease, background 180ms ease, color 180ms ease;
  }
  .toggle-icon.btn:hover {
    background: rgba(0, 210, 255, 0.10);
    border-color: rgba(0, 210, 255, 0.28);
    color: rgba(255,255,255,0.95);
    transform: none !important;
  }
  .toggle-icon.btn i {
    display: none !important;
  }
  .toggle-icon.btn::before {
    content: "";
    position: absolute;
    left: 50%;
    top: 50%;
    width: 8px;
    height: 8px;
    display: block;
    box-sizing: border-box;
    border-right: 2px solid currentColor;
    border-bottom: 2px solid currentColor;
    transform: translate(-50%, -50%) rotate(45deg);
    transform-origin: 50% 50%;
    transition: transform 180ms ease;
  }
  .toggle-icon.btn:not(.collapsed)::before {
    transform: translate(-50%, -50%) rotate(225deg);
  }
  .sidebar-widget ul.accordion-collapse {
    grid-column: 1 / -1;
    width: auto;
    list-style: none;
    padding-left: 14px;
    margin: 6px 0 0 10px;
    border-left: 1px solid rgba(140,164,220,0.24);
  }
  .sidebar-widget ul.accordion-collapse > li {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    align-items: center;
    gap: 8px;
    padding: 6px 0 6px 12px;
    border-radius: 8px;
  }
  .sidebar-widget ul.accordion-collapse > li .category-href {
    font-weight: 600;
    color: rgba(255,255,255,0.72);
  }
  .sidebar-widget ul.accordion-collapse > li.active .category-href {
    color: #00d2ff;
  }
  .banli-filter-section {
    background: rgba(255,255,255,0.018);
    border: 1px solid rgba(255,255,255,0.055);
    border-radius: 8px;
    padding: 14px;
    box-shadow: none;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    margin-bottom: 14px;
  }
  .banli-filter-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 0.8px;
    text-transform: none;
    color: rgba(255,255,255,0.86);
    margin-bottom: 12px;
  }
  .banli-attr-list {
    list-style: none;
    padding-left: 0;
    margin: 0;
    display: grid;
    gap: 8px;
  }
  .banli-check {
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 44px;
    padding: 9px 11px;
    border-radius: 8px;
    border: 1px solid transparent;
    background: rgba(255,255,255,0.012);
    transition: background 180ms ease, border-color 180ms ease, transform 180ms ease;
    cursor: pointer;
  }
  .banli-check:hover {
    background: rgba(0, 210, 255, 0.08);
    border-color: rgba(0, 210, 255, 0.22);
    transform: translateY(-1px);
  }
  .banli-check .form-check-input {
    width: 18px;
    height: 18px;
    flex: 0 0 18px;
    margin: 0;
    border-radius: 5px;
    background-color: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.18);
  }
  .banli-check .form-check-input:checked {
    background-color: rgba(0, 210, 255, 0.95);
    border-color: rgba(0, 210, 255, 0.95);
  }
  .banli-check .form-check-label {
    color: rgba(255,255,255,0.80);
    font-weight: 650;
    letter-spacing: 0.2px;
    line-height: 1.35;
  }
  .filter-box .form-control {
    background: rgba(255,255,255,0.035);
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.92);
    border-radius: 8px;
    padding: 8px 10px;
  }
  .filter-box .form-control:focus {
    border-color: rgba(0, 210, 255, 0.55);
    box-shadow: 0 0 0 4px rgba(0, 210, 255, 0.12);
  }
  .filter-box .price-range {
    display: grid !important;
    grid-template-columns: 1fr 1fr;
    gap: 12px !important;
    font-size: 13px;
    color: rgba(255,255,255,0.70) !important;
  }
  .filter-box .price-range > div {
    min-width: 0;
    display: grid !important;
    grid-template-columns: auto minmax(0, 1fr);
    gap: 8px;
    align-items: center;
  }
  .filter-box .price-range .min,
  .filter-box .price-range .max {
    min-width: 0;
    margin-left: 0 !important;
  }
  .filter-box .price-range .form-control {
    width: 100%;
    min-width: 0;
    height: 42px;
    text-align: center;
    font-size: 16px;
    font-weight: 650;
  }
  #price-slider {
    height: 8px;
    margin: 18px 10px 22px;
    border-radius: 999px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    position: relative;
  }
  #price-slider .ui-slider-range {
    background: linear-gradient(90deg, rgba(0, 210, 255, 0.85), rgba(156, 64, 255, 0.75));
    border-radius: inherit;
  }
  #price-slider .ui-slider-handle {
    top: -8px;
    width: 22px;
    height: 22px;
    border-radius: 999px;
    background: rgba(8, 11, 33, 0.92);
    border: 1px solid rgba(0, 210, 255, 0.55);
    box-shadow: 0 0 0 5px rgba(0, 210, 255, 0.12);
    margin-left: -11px;
    cursor: grab;
  }
  #price-slider .ui-slider-handle:focus {
    outline: none;
  }

  @media (min-width: 1200px) {
    .banli-category-sidebar.banli-category-filter-offcanvas.offcanvas-start {
      max-height: none !important;
      padding: 18px !important;
      overflow: visible !important;
    }
    .banli-category-sidebar .offcanvas-body {
      max-height: none !important;
      padding: 0 !important;
      overflow: visible !important;
    }
  }

  .banli-category-sidebar .module-category-wrap {
    margin: 0 0 16px !important;
    padding: 0 0 16px;
    border-bottom: 1px solid rgba(255,255,255,.075);
  }
  .banli-category-sidebar .module-category-wrap h4 {
    margin: 0 0 12px !important;
    color: rgba(255,255,255,.88);
    font-size: 13px;
    font-weight: 760;
    letter-spacing: .06em;
    line-height: 1.2;
    text-transform: uppercase;
  }
  .banli-category-sidebar .sidebar-widget > li,
  .banli-category-sidebar .sidebar-widget ul.accordion-collapse > li {
    gap: 4px 6px;
    margin: 1px 0;
    padding: 1px 0;
    border: 0;
    background: transparent;
  }
  .banli-category-sidebar .sidebar-widget > li:hover,
  .banli-category-sidebar .sidebar-widget li.active {
    border-color: transparent;
    background: transparent;
  }
  .banli-category-sidebar .sidebar-widget .category-href {
    min-height: 34px;
    padding: 7px 10px;
    border: 1px solid transparent;
    border-radius: 7px;
    color: rgba(255,255,255,.72);
    font-size: 14px;
    font-weight: 660;
    letter-spacing: 0;
    transition: color 160ms ease, background 160ms ease, border-color 160ms ease;
  }
  .banli-category-sidebar .sidebar-widget .category-href:hover {
    color: rgba(255,255,255,.96);
    background: rgba(255,255,255,.035);
    border-color: rgba(255,255,255,.065);
  }
  .banli-category-sidebar .sidebar-widget li.active > .category-href {
    color: rgba(255,255,255,.96);
    background: rgba(0,210,255,.075);
    border-color: rgba(0,210,255,.20);
    font-weight: 760;
  }
  .banli-category-sidebar .sidebar-widget li.active > .category-href::before {
    width: 6px;
    height: 6px;
    margin-right: 8px;
    background: #16d7ff;
    box-shadow: 0 0 0 3px rgba(0,210,255,.10), 0 0 14px rgba(0,210,255,.24);
  }
  .banli-category-sidebar .sidebar-widget ul.accordion-collapse {
    margin: 4px 0 4px 12px;
    padding: 3px 0 3px 12px;
    border-left: 1px solid rgba(22,215,255,.34);
  }
  .banli-category-sidebar .sidebar-widget ul.accordion-collapse .category-href {
    min-height: 30px;
    padding: 5px 9px;
    color: rgba(255,255,255,.63);
    font-size: 13px;
    font-weight: 620;
  }
  .banli-category-sidebar .sidebar-widget ul.accordion-collapse > li.active .category-href {
    color: #16d7ff;
  }
  .banli-category-sidebar .toggle-icon.btn {
    width: 28px;
    height: 28px;
    min-width: 28px;
    min-height: 28px;
    margin: 4px 0 0 !important;
    border-radius: 7px;
    color: rgba(255,255,255,.58);
    background: rgba(255,255,255,.025);
    border-color: rgba(255,255,255,.08);
  }
  .banli-category-sidebar .toggle-icon.btn:hover {
    color: rgba(255,255,255,.94);
    background: rgba(255,255,255,.05);
    border-color: rgba(255,255,255,.14);
  }
  .banli-category-sidebar .toggle-icon.btn::before {
    width: 7px;
    height: 7px;
    border-width: 1.5px;
  }
  .banli-category-sidebar .toggle-icon.btn:not(.collapsed)::before {
    transform: translate(-50%, -50%) rotate(225deg);
  }
  .banli-category-sidebar .filter-box {
    display: grid;
    gap: 12px;
  }
  .banli-category-sidebar .banli-filter-section {
    margin: 0;
    padding: 14px 0 12px;
    border: 0;
    border-top: 1px solid rgba(255,255,255,.075);
    border-radius: 0;
    background: transparent;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
  }
  .banli-category-sidebar .banli-filter-section:first-child {
    padding-top: 0;
    border-top: 0;
  }
  .banli-category-sidebar .banli-filter-title {
    margin-bottom: 10px;
    color: rgba(255,255,255,.78);
    font-size: 12px;
    font-weight: 760;
    letter-spacing: .055em;
  }
  .banli-category-sidebar .banli-attr-list {
    gap: 0;
  }
  .banli-category-sidebar .banli-check {
    position: relative;
    min-height: 34px;
    padding: 6px 4px 6px 0;
    border: 0 !important;
    border-radius: 0 !important;
    background: transparent !important;
    transform: none !important;
    box-shadow: none !important;
  }
  .banli-category-sidebar .banli-check:hover {
    background: transparent !important;
    border-color: transparent !important;
  }
  .banli-category-sidebar .banli-check .form-check-input {
    width: 14px;
    height: 14px;
    flex-basis: 14px;
    border-radius: 3px;
    background-color: transparent;
    border-color: rgba(255,255,255,.22);
    box-shadow: none;
  }
  .banli-category-sidebar .banli-check:hover .form-check-input {
    border-color: rgba(255,255,255,.42);
  }
  .banli-category-sidebar .banli-check .form-check-label {
    color: rgba(255,255,255,.66);
    font-size: 13px;
    font-weight: 620;
  }
  .banli-category-sidebar .banli-check:has(.form-check-input:checked) {
    background: transparent !important;
    border-color: transparent !important;
    box-shadow: none !important;
  }
  .banli-category-sidebar .banli-check .form-check-input:checked {
    background-color: #16d7ff;
    border-color: #16d7ff;
    box-shadow: 0 0 0 2px rgba(22,215,255,.12);
  }
  .banli-category-sidebar .banli-check:has(.form-check-input:checked) .form-check-label {
    color: rgba(255,255,255,.92);
  }
  .banli-category-sidebar #price-slider {
    height: 5px;
    margin: 14px 8px 18px;
    border-color: rgba(255,255,255,.10);
  }
  .banli-category-sidebar #price-slider .ui-slider-handle {
    top: -7px;
    width: 18px;
    height: 18px;
    margin-left: -9px;
    box-shadow: 0 0 0 4px rgba(0,210,255,.10);
  }
  .banli-category-sidebar .filter-box .price-range {
    gap: 8px !important;
    font-size: 12px;
  }
  .banli-category-sidebar .filter-box .price-range .form-control {
    height: 36px;
    font-size: 14px;
  }
</style>

<div class="mb-4 module-category-wrap">
  <h4 class="mb-3"><span>{{ __('product.category') }}</span></h4>
  <ul class="sidebar-widget mb-0" id="category-one">
    @foreach ($all_categories as $key_a => $category_all)
    @if (!$category_all['active']) @continue @endif
    <li class="{{ $category_all['id'] == $category->id ? 'active' : ''}}">
      <a href="{{ $category_all['url'] }}" title="{{ $category_all['name'] }}" class="category-href">{{ $category_all['name'] }}</a>
      @if ($category_all['children'] ?? false)
        <button class="toggle-icon btn {{ $category_all['id'] == $category->id ? '' : 'collapsed'}}" data-bs-toggle="collapse" href="#category-{{ $key_a }}"><i class="bi bi-chevron-up"></i></button>
        <ul id="category-{{ $key_a }}" class="accordion-collapse collapse {{ $category_all['id'] == $category->id ? 'show' : ''}}" data-bs-parent="#category-one">
          @foreach ($category_all['children'] as $key_b => $child)
          @if (!$child['active']) @continue @endif
          <li class="{{ $child['id'] == $category->id ? 'active' : ''}} child-category">
            <a href="{{ $child['url'] }}" title="{{ $child['name'] }}" class="category-href">{{ $child['name'] }}</a>
            @if ($child['children'] ?? false)
              <button class="toggle-icon btn {{ $child['id'] == $category->id ? '' : 'collapsed'}}" data-bs-toggle="collapse" href="#category-{{ $key_a }}-{{ $key_b }}"><i class="bi bi-chevron-up"></i></button>
              <ul id="category-{{ $key_a }}-{{ $key_b }}" class="accordion-collapse collapse {{ $child['id'] == $category->id ? 'show' : ''}}" data-bs-parent="#category-{{ $key_a }}">
                @foreach ($child['children'] as $key_c => $sub_child)
                <li class="{{ $sub_child['id'] == $category->id ? 'active' : ''}} child-category">
                  <a href="{{ $sub_child['url'] }}" title="{{ $sub_child['name'] }}" class="category-href">{{ $sub_child['name'] }}</a>
                </li>
                @endforeach
              </ul>
            @endif
          </li>
          @endforeach
        </ul>
      @endif
    </li>
    @endforeach
  </ul>
</div>

<div class="filter-box">
  @if ($filter_data['price']['min'] != $filter_data['price']['max'])
    @hookwrapper('category.filter.sidebar.price')
    @push('header')
      <link rel="stylesheet" href="{{ asset('vendor/jquery/jquery-ui/jquery-ui.min.css') }}">
    @endpush

    @if (system_setting('base.multi_filter.price_filter', 1))
      <div class="banli-filter-section">
        <div class="banli-filter-title">{{ __('product.price') }}</div>
        <div id="price-slider" class="mb-3"><div class="slider-bg"></div></div>
        <div class="price-range d-flex justify-content-between gap-3">
          <div class="d-flex align-items-center wp-100">
            {{ __('common.text_form') }}
            <span class="min ms-2 input-group-sm"><input type="text" value="{{ $filter_data['price']['select_min'] }}" class="form-control price-select-min"></span>
          </div>
          <div class="d-flex align-items-center wp-100">
            {{ __('common.text_to') }}
            <span class="max ms-2 input-group-sm"><input type="text" value="{{ $filter_data['price']['select_max'] }}" class="form-control price-select-max"></span>
          </div>
        </div>
        <input value="{{ $filter_data['price']['min'] }}" class="price-min d-none">
        <input value="{{ $filter_data['price']['max'] }}" class="price-max d-none">
      </div>
    @endif
    @endhookwrapper
  @endif

  @hookwrapper('category.filter.sidebar.attr')
  @foreach ($filter_data['attr'] as $index => $attr)
  <div class="banli-filter-section attribute-item" data-attribute-id="{{ $attr['id'] }}">
    <div class="banli-filter-title">{{ $attr['name'] }}</div>
    <ul class="banli-attr-list">
      @foreach ($attr['values'] as $value_index => $value)
      <li>
        <label class="banli-check form-check-label">
          <input class="form-check-input attr-value-check" data-attr="{{ $index }}" data-attrval="{{ $value_index }}" {{ $value['selected'] ? 'checked' : '' }} name="6" type="checkbox" value="{{ $value['id'] }}">
          <span class="form-check-label">{{ $value['name'] }}</span>
        </label>
      </li>
      @endforeach
    </ul>
  </div>
  @endforeach
  @endhookwrapper
</div>

@push('add-scripts')
<script>
  $(document).ready(function() {
    if (!$('#price-slider').length) {
      return;
    }

    function initPriceSlider() {
      if (!$.fn.slider || $('#price-slider').hasClass('ui-slider')) {
        return;
      }

      $("#price-slider").slider({
        range: true,
        step: 0.01,
        min: {{ $filter_data['price']['min'] ?? 0 }},
        max: {{ $filter_data['price']['max'] ?? 0 }},
        values: [{{ $filter_data['price']['select_min'] }}, {{ $filter_data['price']['select_max'] }}],
        change: function(event, ui) {
          if (event.originalEvent) {
            filterProductData();
          }
        },
        slide: function(event, ui) {
          $('.price-select-min').val((ui.values[0]).toFixed(2));
          $('.price-select-max').val((ui.values[1]).toFixed(2));
        }
      });
    }

    if ($.fn.slider) {
      initPriceSlider();
    } else {
      $.getScript('{{ asset('vendor/jquery/jquery-ui/jquery-ui.min.js') }}', initPriceSlider);
    }

    $('.price-select-min, .price-select-max').change(function(event) {
      filterProductData()
    });

    $('.price-select-min, .price-select-max').on('input', function() {
      this.value = this.value.replace(/[^0-9.]/g, '');
    });
  })

  $('.child-category').each(function(index, el) {
    if ($(this).hasClass('active')) {
      $(this).parents('ul').addClass('show').siblings('button').removeClass('collapsed')
      $(this).parents('li').addClass('active')
    }
  });
</script>
@endpush
