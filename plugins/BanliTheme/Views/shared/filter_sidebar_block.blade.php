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
    width: 30px;
    height: 30px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.10);
    color: rgba(255,255,255,0.72);
    line-height: 1;
    transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, color 180ms ease;
  }
  .toggle-icon.btn:hover {
    background: rgba(0, 210, 255, 0.10);
    border-color: rgba(0, 210, 255, 0.28);
    color: rgba(255,255,255,0.95);
    transform: translateY(-1px);
  }
  .toggle-icon.btn i {
    display: none;
  }
  .toggle-icon.btn::before {
    content: "";
    width: 7px;
    height: 7px;
    display: inline-block;
    border-right: 2px solid currentColor;
    border-bottom: 2px solid currentColor;
    transform: rotate(45deg) translate(-1px, -1px);
    transition: transform 180ms ease;
  }
  .toggle-icon.btn:not(.collapsed)::before {
    transform: rotate(225deg) translate(-1px, -1px);
  }
  .sidebar-widget ul.accordion-collapse {
    grid-column: 1 / -1;
    list-style: none;
    padding-left: 12px;
    margin: 6px 0 0 0;
    border-left: 1px solid rgba(255,255,255,0.08);
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
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 8px;
    padding: 14px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.035);
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
    border: 1px solid rgba(255,255,255,0.09);
    background: rgba(255,255,255,0.018);
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
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.14);
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
