@extends('layout.master')

@section('body-class', 'page-account')

@section('content')
<div class="bg-dark section-dark text-light pb-5" style="padding-top: 100px; min-height: 100vh;">
  <x-shop-breadcrumb type="static" value="account.index" />

  <div class="container">
    <div class="row">
      <x-shop-sidebar />
      <div class="col-12 col-md-9">
        @if (\Session::has('success'))
          <div class="alert alert-success">{!! \Session::get('success') !!}</div>
        @endif

        @hook('account.account.card.before')
        <div class="card glass-card shadow-sm mb-4 account-card bg-dark bg-opacity-75 border-secondary text-light">
          <div class="card-header border-secondary d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('shop/account.my_order') }}</h5>
            <a href="{{ shop_route('account.order.index') }}" class="text-white-50 fw-bold">{{ __('shop/account.orders') }}</a>
          </div>
          <div class="card-body">
            <div class="d-flex flex-nowrap card-items mb-4 py-3">
              <a href="{{ shop_route('account.order.index', ['status' => 'unpaid']) }}" class="d-flex flex-column align-items-center text-light"><i class="iconfont text-primary">&#xf12f;</i><span
                  class="text-center mt-2">{{ __('order.unpaid') }}</span></a>
              <a href="{{ shop_route('account.order.index', ['status' => 'paid']) }}" class="d-flex flex-column align-items-center text-light"><i class="iconfont text-primary">&#xf130;</i><span
                  class="text-center mt-2">{{ __('shop/account.pending_send') }}</span></a>
              <a href="{{ shop_route('account.order.index', ['status' => 'shipped']) }}" class="d-flex flex-column align-items-center text-light"><i class="iconfont text-primary">&#xf131;</i><span
                  class="text-center mt-2">{{ __('shop/account.pending_receipt') }}</span></a>
              <a href="{{ shop_route('account.rma.index') }}" class="d-flex flex-column align-items-center text-light"><i class="iconfont text-primary">&#xf132;</i><span
                  class="text-center mt-2">{{ __('shop/account.after_sales') }}</span></a>
            </div>
            <div class="order-wrap rounded-2">
              @if (!count($latest_orders))
                <div class="no-order d-flex flex-column align-items-center">
                  <div class="icon mb-2 text-white-50"><i class="iconfont">&#xe60b;</i></div>
                  <div class="text mb-3 text-white-50">{{ __('shop/account.no_order') }}<a href="" class="text-primary">{{ __('shop/account.to_buy') }}</a></div>
                </div>
              @else
                <ul class="list-unstyled orders-list table-responsive">
                  <table class="table table-dark table-hover bg-transparent border-secondary">
                    <tbody class="border-secondary">
                      @foreach ($latest_orders as $order)
                      <tr class="align-middle">
                        <td style="width: 62px">
                          <div class="img border wh-60 d-flex justify-content-center align-items-center rounded-1 overflow-hidden">
                            <img src="{{ $order->orderProducts[0]->image ?? '' }}" alt="{{ $order->orderProducts[0]->name ?? '' }}" class="img-fluid">
                          </div>
                        </td>
                        <td>
                          <div class="mb-2 text-nowrap">{{ __('shop/account.order_number') }}：<span style="width: 110px;display: inline-block;">{{ $order->number }}</span> <span class="vr lh-1 me-2 bg-secondary"></span> {{ __('shop/account.all') }} {{ count($order->orderProducts) }} {{ __('shop/account.items') }}</div>
                          <div class="text-white-50">{{ __('shop/account.order_time') }}：{{ $order->created_at }}</div>
                        </td>
                        <td>
                          <span class="ms-4 text-nowrap d-inline-block">{{ __('shop/account.state') }}：
                            @if ($order->status == 'unpaid')
                            <span class="text-danger">{{ $order->status_format }}</span>
                            @elseif ($order->status == 'cancelled')
                            <span class="text-secondary">{{ $order->status_format }}</span>
                            @else
                            <span class="text-success">{{ $order->status_format }}</span>
                            @endif
                          </span>
                        </td>
                        <td>
                          <span class="ms-3 text-nowrap d-inline-block">{{ __('shop/account.amount') }}：{{ currency_format($order->total, $order->currency_code, $order->currency_value) }}</span>
                        </td>

                        <td>
                          <a href="{{ shop_route('account.order.show', ['number' => $order->number]) }}"
                            class="btn btn-outline-secondary text-nowrap btn-sm">{{ __('shop/account.check_details') }}</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </ul>
              @endif
            </div>
          </div>
        </div>
        @hook('account.account.card.after')
      </div>
    </div>
  </div>
</div>
@endsection
