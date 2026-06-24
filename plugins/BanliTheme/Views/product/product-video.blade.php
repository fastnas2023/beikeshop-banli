@if ($product['video'])
  <div class="video-wrap">
    @php
      $productVideoUrl = (string) $product['video'];
      $isYouTube = preg_match('~(?:youtube\.com/(?:watch|embed|shorts)|youtu\.be/)~i', $productVideoUrl);
    @endphp

    @if ($isYouTube)
      <div id="product-video"></div>
    @else
      <video
        id="product-video"
        class="video-js vjs-big-play-centered vjs-fluid vjs-16-9"
        controls loop muted
      >
        <source src="{{ image_origin($product['video']) }}" type="video/mp4"/>
      </video>
    @endif

    <div class="close-video d-none"><i class="bi bi-x-circle"></i></div>
    <div class="open-video"><i class="bi bi-play-circle"></i></div>
  </div>
@endif


@push('add-scripts')
  <script>
    const videoUrl = @json($product['video']);
    const videoId = (function(url) {
      try {
        const parsed = new URL(url, window.location.origin);
        const hostname = parsed.hostname.replace(/^www\./i, '').toLowerCase();
        let id = null;

        if (hostname === 'youtu.be') {
          id = parsed.pathname.split('/').filter(Boolean)[0] || null;
        } else if (hostname === 'youtube.com' || hostname.endsWith('.youtube.com')) {
          if (parsed.searchParams.has('v')) {
            id = parsed.searchParams.get('v');
          } else {
            const parts = parsed.pathname.split('/').filter(Boolean);
            if (['embed', 'shorts'].includes(parts[0])) {
              id = parts[1] || null;
            }
          }
        }

        return id && /^[A-Za-z0-9_-]{6,}$/.test(id) ? id : null;
      } catch (e) { return null; }

      return null;
    })(videoUrl);

    const isYouTube = !!videoId;
    let pVideo = null;

    $(function () {
      // 点击播放
      if ($('#product-video').length && !isYouTube) {
        pVideo = videojs("product-video");
      }

      $(document).on('click', '.open-video', function () {
        if (isYouTube) {
          $('#product-video').html(`
            <iframe width="100%" height="100%"
              src="https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
          `);
        } else if ($('#product-video').length) {
          pVideo.play();
          pVideo.currentTime(0);
        }

        $(this).addClass('d-none');
        $('#product-video').fadeIn();
        $('.close-video').removeClass('d-none');
      });

      // 点击关闭
      $(document).on('click', '.close-video', function () {
        if (isYouTube) {
          $('#product-video').fadeOut();
        } else if (pVideo) {
          pVideo.pause();
          $('#product-video').fadeOut();
        }

        $('.close-video').addClass('d-none');
        $('.open-video').removeClass('d-none');
      });
    });

    function closeVideo() {
      if (pVideo) {
        pVideo.pause();
      }

      $('.close-video').addClass('d-none');
      $('.open-video').removeClass('d-none');
      $('#product-video').fadeOut();
    }
  </script>
@endpush
