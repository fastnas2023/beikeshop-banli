@extends('layout.master')
@section('body-class', 'page-home')
@section('content')

<div id="content" class="no-top no-bottom">
  <div class="modules-box no-bottom no-top" id="home-modules-box">

  @hook('home.modules.before')

  @foreach($modules as $module)

    @include($module['view_path'], $module)
  @endforeach

  @hook('home.modules.after')

  </div>
</div>

@endsection
