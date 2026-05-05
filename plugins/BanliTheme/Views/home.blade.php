@extends('layout.master')
@section('body-class', 'page-home')
@section('content')

<div id="content" class="no-top no-bottom">
  <div class="modules-box no-bottom no-top" id="home-modules-box">

  @hook('home.modules.before')

  @foreach($modules as $module)

    @include($module['view_path'], $module)
  @endforeach

  <section id="section-ai-marquee" class="section-dark p-0" aria-label="AI innovation marquee">
    <div class="marquee-viewport">
      <div class="marquee-band bg-color text-light d-flex py-4 lh-1 rot-2">
        <div class="de-marquee-list-1">
          <span class="fs-60 mx-3">Next Intelligence</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Future Now</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Empowering Innovation</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Smarter Tomorrow</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Think Forward</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Cognitive Shift</span>
          <span class="fs-60 mx-3 op-2">/</span>
        </div>
      </div>

      <div class="marquee-band bg-color-2 text-light d-flex py-4 lh-1 rot-min-1 mt-min-20">
        <div class="de-marquee-list-2">
          <span class="fs-60 mx-3">Next Intelligence</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Future Now</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Empowering Innovation</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Smarter Tomorrow</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Think Forward</span>
          <span class="fs-60 mx-3 op-2">/</span>
          <span class="fs-60 mx-3">Cognitive Shift</span>
          <span class="fs-60 mx-3 op-2">/</span>
        </div>
      </div>
    </div>
  </section>

  @hook('home.modules.after')

  </div>
</div>

@endsection
