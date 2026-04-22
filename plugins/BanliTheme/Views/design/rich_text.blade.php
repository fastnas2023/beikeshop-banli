<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
    @php
        $htmlContent = '';
        if (!empty($content['text'])) {
            $htmlContent = is_string($content['text']) ? $content['text'] : ($content['text'][locale()] ?? $content['text']['en'] ?? '');
        } elseif (!empty($content['content'])) {
            $htmlContent = is_string($content['content']) ? $content['content'] : ($content['content'][locale()] ?? $content['content']['en'] ?? '');
        }
    @endphp

    @if($htmlContent)
        {!! $htmlContent !!}
    @else
        <section id="section-faq" class="bg-dark section-dark text-light" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Everything You Need to Know</div>
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Frequently Asked Questions</h2>
                    </div>

                    <div class="col-lg-7">
                        <div class="accordion s2 wow fadeInUp">
                            <div class="accordion-section">
                                <div class="accordion-section-title" data-tab="#accordion-a1">
                                    What is the AI Summit 2026?
                                </div>
                                <div class="accordion-section-content" id="accordion-a1">
                                    The AI Summit 2026 is a premier event gathering leading AI experts, thought leaders, and innovators.
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
