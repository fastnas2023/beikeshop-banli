@extends('layout.master')
@section('body-class', 'page-categories bg-dark text-light')
@section('title', $category->description->meta_title ?: system_setting('base.meta_title', 'BeikeShop开源好用的跨境电商系统') .' - '. $category->description->name)
@section('keywords', $category->description->meta_keywords ?: system_setting('base.meta_keyword'))
@section('description', $category->description->meta_description ?: system_setting('base.meta_description'))

@push('header')
  <script src="{{ asset('vendor/scrolltofixed/jquery-scrolltofixed-min.js') }}"></script>
@endpush

@section('content')
  <x-shop-breadcrumb type="category" :value="$category" :is-full="true" />

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-lg-3 pe-lg-4 left-column">
        <div class="x-fixed-top glass-card">@include('shared.filter_sidebar_block')</div>
      </div>

      <div class="col-12 col-lg-9 right-column">
        @if($category->image || $category->description->content)
          <div class="category-intro mb-4 p-4 border rounded-3 border-light-subtle" style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.05) !important;">
            <div class="row g-4 align-items-center">
              @if($category->image)
                <div class="col-auto">
                  <div class="category-avatar d-flex align-items-center justify-content-center rounded overflow-hidden" style="width: 150px; height: 150px; background: rgba(255,255,255,0.05);">
                    <img src="{{ image_origin($category->image) }}" alt="{{ $category->description->name }}" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                  </div>
                </div>
              @endif
              @if($category->description->content)
                <div class="col">
                  <div class="category-desc">
                    <h1 class="h3 fw-bold text-white mb-3">{{ $category->description->name }}</h1>
                    <div class="text-white-50" style="font-size: 15px; line-height: 1.6;">
                      {!! $category->description->content !!}
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endif
        @hook('category.products.before')
        <div class="filter-value-wrap mb-2 d-none">
          <ul class="list-group list-group-horizontal">
            @foreach ($filter_data['attr'] as $index => $attr)
              @foreach ($attr['values'] as $value_index => $value)
                @if ($value['selected'])
                <li class="list-group-item me-1 mb-1" data-attr="{{ $index }}" data-attrval="{{ $value_index }}">
                  {{ $attr['name'] }}: {{ $value['name'] }} <i class="bi bi-x-lg ms-1"></i>
                </li>
                @endif
              @endforeach
            @endforeach
            <li class="list-group-item me-1 mb-1 delete-all">{{ __('common.delete_all') }}</li>
          </ul>
        </div>

        @if ($children)
          <div class="children-wrap mb-4 d-flex flex-wrap align-items-center gap-2">
            <span class="text-white-50 me-2" style="font-size: 14px;">{{ __('category.children') }}:</span>
            @foreach ($children as $item)
              <a href="{{ $item['url'] }}" class="cyber-tag-sm">{{ $item['name'] }}</a>
            @endforeach
          </div>
          <style>
            .cyber-tag-sm {
              background-color: rgba(255, 255, 255, 0.05);
              border: 1px solid rgba(255, 255, 255, 0.1);
              color: rgba(255, 255, 255, 0.8);
              padding: 4px 16px;
              font-size: 13px;
              border-radius: 50px;
              text-decoration: none;
              transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
              display: inline-block;
              font-weight: 500;
              letter-spacing: 0.5px;
            }
            .cyber-tag-sm:hover,
            .cyber-tag-sm:focus {
              background-color: rgba(0, 210, 255, 0.1);
              border-color: #00d2ff;
              color: #00d2ff;
              transform: translateY(-2px);
              outline: none;
              box-shadow: 0 4px 12px rgba(0, 210, 255, 0.2);
            }
            .cyber-tag-sm:active {
              transform: translateY(0);
              box-shadow: 0 2px 6px rgba(0, 210, 255, 0.2);
            }
          </style>
        @endif

        <div class="d-lg-none d-flex justify-content-between align-items-center mb-4">
          <h2 class="h5 fw-bold text-white mb-0">{{ $category->description->name }}</h2>
          <div class="mb-filter border border-light-subtle rounded px-3 py-2 text-white-50" style="cursor: pointer;"><i class="bi bi-funnel me-2"></i>Filter</div>
        </div>

        <div class="product-list-container">
          @if(count($products_format))
            @include('shared.filter_bar_block')
            <div class="row g-3 g-lg-4 {{ request('style_list') == 'list' ? 'product-list-wrap' : ''}}">
              @foreach ($products_format as $product)
                <div class="{{ !request('style_list') || request('style_list') == 'grid' ? 'col-6 col-sm-4 col-md-3 col-lg-4' : 'col-12'}}">
                  <div class="glass-card h-100">
                    @include('shared.product')
                  </div>
                </div>
              @endforeach
            </div>
          @else
          <x-shop-no-data />
        @endif

        {{ $products->links('shared/pagination/bootstrap-4') }}

        @hook('category.products.after')
      </div>
    </div>
  </div>

@endsection

@push('add-scripts')
<script>
  let filterAttr = @json($filter_data['attr'] ?? []);

  $('.filter-value-wrap li').click(function(event) {
    let [attr, val] = [$(this).data('attr'),$(this).data('attrval')];
    if ($(this).hasClass('delete-all')) {
      return deleteFilterAll();
    }

    filterAttr[attr].values[val].selected = false;
    filterProductData();
  });

  if ($('.filter-value-wrap li').length > 1) {
    $('.filter-value-wrap').removeClass('d-none')
  }

  $('.attr-value-check').change(function(event) {
    let [attr, val] = [$(this).data('attr'),$(this).data('attrval')];
    filterAttr[attr].values[val].selected = $(this).is(":checked");
    filterProductData();
  });

  $('.form-select, input[name="style_list"]').change(function(event) {
    filterProductData();
  });

  if ($(window).width() < 992) {
    $('.mb-filter').on('click', function() {
      $('.left-column').fadeIn(0).find('.x-fixed-top').addClass('active');
    });
    $(document).on('click', '.left-column', function(e) {
      if ( $(e.target).closest('.x-fixed-top').length === 0 ) {
        $('.left-column .x-fixed-top').removeClass('active');
        setTimeout("$('.left-column').fadeOut(50)", 220);
      }
    });
  }

  function filterProductData() {
    let url = bk.removeURLParameters(window.location.href, 'attr', 'price', 'sort', 'order');
    let [psMin, psMax, pMin, pMax] = [$('.price-select-min').val(), $('.price-select-max').val(), $('.price-min').val(), $('.price-max').val()];
    let order = $('.order-select').val();
    let perpage = $('.perpage-select').val();
    let styleList = $('input[name="style_list"]:checked').val();

    layer.load(2, {shade: [0.3,'#fff'] })

    if (filterAttrChecked(filterAttr)) {
      url = bk.updateQueryStringParameter(url, 'attr', filterAttrChecked(filterAttr));
    }

    if ((psMin != pMin) || (psMax != pMax)) {
      url = bk.updateQueryStringParameter(url, 'price', `${psMin}-${psMax}`);
    }

    if (order) {
      let orderKeys = order.split('|');
      url = bk.updateQueryStringParameter(url, 'sort', orderKeys[0]);
      url = bk.updateQueryStringParameter(url, 'order', orderKeys[1]);
    }

    if (perpage) {
      url = bk.updateQueryStringParameter(url, 'per_page', perpage);
    }

    if (styleList) {
     url = bk.updateQueryStringParameter(url, 'style_list', styleList);
    }

    location = url;
  }

  function filterAttrChecked(data) {
    let filterAtKey = [];
    data.forEach((item) => {
      let checkedAtValues = [];
      item.values.forEach((val) => val.selected ? checkedAtValues.push(val.id) : '')
      if (checkedAtValues.length) {
        filterAtKey.push(`${item.id}:${checkedAtValues.join(',')}`)
      }
    })

    return filterAtKey.join('|')
  }

  function deleteFilterAll() {
    let url = bk.removeURLParameters(window.location.href, 'attr', 'price');
    location = url;
  }
</script>
@endpush