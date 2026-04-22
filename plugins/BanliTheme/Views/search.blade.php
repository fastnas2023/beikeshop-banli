@extends('layout.master')
@section('body-class', 'page-categories bg-dark text-light')

@section('content')
  <x-shop-breadcrumb type="static" value="products.search" :is-full="true" />

  <div class="container-fluid pb-5">
    @if (count($items))
      <div class="row g-3 g-lg-4 mb-4">
        @foreach ($items as $product)
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="glass-card h-100">
              @include('shared.product')
            </div>
          </div>
        @endforeach
      </div>
      
      <div class="d-flex justify-content-center mt-5">
        {{ $products->links('shared/pagination/bootstrap-4') }}
      </div>
    @else
      <div class="py-5">
        <x-shop-no-data />
      </div>
    @endif
  </div>
@endsection
