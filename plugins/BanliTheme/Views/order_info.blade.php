@extends('layout.master')
@section('title', trans('account.order.title'))

@section('content')
<div class="bg-dark section-dark text-light pb-5" style="padding-top: 100px; min-height: 100vh;">
  <div class="container">
    <div class="w-max-1000 mx-auto text-light">
      @include('shared.order_info')
    </div>
  </div>
</div>
@endsection
