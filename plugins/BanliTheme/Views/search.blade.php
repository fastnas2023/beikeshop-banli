@extends('layout.master')
@section('body-class', 'page-search bg-dark text-light')

@push('header')
  <style>
    body.page-search {
      --banli-search-shell-max: 1304px;
      --banli-search-shell-padding: 12px;
    }

    body.page-search #wrapper {
      padding-top: 132px !important;
    }

    body.page-search .breadcrumb-wrap {
      width: min(100%, calc(var(--banli-search-shell-max) + (var(--banli-search-shell-padding) * 2)));
      margin: 0 auto 24px !important;
      padding-right: var(--banli-search-shell-padding);
      padding-left: var(--banli-search-shell-padding);
      box-sizing: border-box;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 8px;
      background: rgba(255,255,255,.025);
    }

    body.page-search .breadcrumb-wrap .breadcrumb {
      margin-bottom: 0;
    }

    body.page-search .breadcrumb-wrap .container {
      max-width: none;
      padding-right: 18px;
      padding-left: 18px;
    }

    body.page-search .banli-search-page {
      padding-bottom: 90px;
    }

    body.page-search .banli-search-products {
      width: min(100%, calc(var(--banli-search-shell-max) + (var(--banli-search-shell-padding) * 2)));
      margin-right: auto;
      margin-left: auto;
      padding-right: var(--banli-search-shell-padding);
      padding-left: var(--banli-search-shell-padding);
      box-sizing: border-box;
    }

    body.page-search .banli-search-products .glass-card {
      height: 100%;
      overflow: hidden;
      padding: 0;
      background: rgba(255,255,255,.035);
      border: 1px solid rgba(255,255,255,.09);
      border-radius: 8px;
      box-shadow: 0 14px 34px rgba(0,0,0,.14);
      transition: border-color .18s ease, transform .18s ease, box-shadow .18s ease, background .18s ease;
    }

    body.page-search .banli-search-products .glass-card:hover {
      background: rgba(255,255,255,.045);
      border-color: rgba(0,210,255,.28);
      box-shadow: 0 18px 42px rgba(0,0,0,.22);
      transform: translateY(-2px);
    }

    body.page-search .banli-search-products .product-wrap {
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    body.page-search .banli-search-products .product-wrap .image {
      width: 100%;
      border-radius: 8px 8px 0 0 !important;
      background: #fff;
      aspect-ratio: 1;
    }

    body.page-search .banli-search-products .product-wrap .image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    body.page-search .banli-search-products .product-bottom-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 16px 16px 18px;
    }

    body.page-search .banli-search-products .product-name {
      color: #fff;
      font-weight: 750;
      line-height: 1.5;
      min-height: 54px;
      display: -webkit-box;
      overflow: hidden;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }

    body.page-search .banli-search-products .product-price {
      margin-top: 12px;
      display: flex;
      align-items: baseline;
      gap: 12px;
      flex-wrap: wrap;
    }

    body.page-search .banli-search-products .price-new {
      font-size: 20px;
      line-height: 1;
    }

    body.page-search .banli-search-products .price-old {
      margin-left: 0 !important;
      font-size: 14px;
    }

    @media (max-width: 991.98px) {
      body.page-search #wrapper {
        padding-top: 176px !important;
      }
    }
  </style>
@endpush

@section('content')
  <x-shop-breadcrumb type="static" value="products.search" />

  <div class="banli-search-page">
    <div class="banli-search-products">
    @if (count($items))
      <div class="row g-3 g-lg-4 mb-4">
        @foreach ($items as $product)
          <div class="col-6 col-sm-4 col-lg-3">
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
  </div>
@endsection
