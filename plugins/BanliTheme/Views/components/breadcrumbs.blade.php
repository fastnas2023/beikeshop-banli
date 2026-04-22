@hook('components.breadcrumbs.before')
@unless ($breadcrumbs->isEmpty())
@if (request('_from') != 'app')
<div class="breadcrumb-wrap py-2 mb-4" style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.05);">
  <div class="container{{ $isFull ?? false ? '-fluid' : '' }}">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        @foreach ($breadcrumbs as $breadcrumb)
          @if (isset($breadcrumb['url']) && $breadcrumb['url'])
          <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}" class="text-white-50 text-decoration-none hover-text-light">{{ $breadcrumb['title'] }}</a></li>
          @else
          <li class="breadcrumb-item active text-light fw-bold" aria-current="page">{{ $breadcrumb['title'] }}</li>
          @endif
        @endforeach
      </ol>
    </nav>
  </div>
</div>
<style>
.breadcrumb-item + .breadcrumb-item::before {
  content: "/";
  color: rgba(255,255,255,0.5);
}
.hover-text-light:hover {
  color: #fff !important;
}
</style>
@else
<br>
@endif
@endunless
@hook('components.breadcrumbs.after')
