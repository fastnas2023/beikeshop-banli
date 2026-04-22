@extends('layout.master')

@section('body-class', 'page-account-order-info')

@section('content')
<div class="bg-dark section-dark text-light pb-5" style="padding-top: 100px; min-height: 100vh;">
  <x-shop-breadcrumb type="order" value="{{ $order->number }}" />

  <div class="container">
    <div class="row">
      <x-shop-sidebar />

      <div class="col-12 col-md-9">
        @include('shared.order_info')
      </div>
    </div>
  </div>
</div>
@endsection
