@if ($products)
  @foreach ($products as $product)
  <div class="{{ $class ?: 'col-6 col-sm-4 col-md-3 col-lg-2' }}">
    @include('shared.product', ['mode' => is_mobile() ? 'list' : 'grid', 'show_actions' => true])
  </div>
  @endforeach

  <div class="col-12 mt-3">
    <div class="search-pop-products-show-all d-flex justify-content-center">
      <button class="btn btn-outline-light rounded-pill px-4 py-2" style="font-size: 14px; border-color: rgba(255,255,255,0.2); transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#00d2ff'; this.style.color='#000'; this.style.borderColor='#00d2ff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#fff'; this.style.borderColor='rgba(255,255,255,0.2)';">{{ __('common.show_all') }}</button>
    </div>
  </div>
@else
<div style="margin-bottom: -28px"><x-shop-no-data /></div>
@endif
