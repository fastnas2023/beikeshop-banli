<div class="module-item {{ $design ? 'module-item-design' : ''}}" id="module-{{ $module_id }}">
        <section id="section-schedule" class="bg-dark section-dark text-light" style="{{ !empty($content['bg_color']) ? 'background-color: '.$content['bg_color'].'!important;' : '' }}">
            <div class="container">
              <div class="row g-4 gx-5 justify-content-center">
                <div class="col-lg-6 text-center">
                    @if(!empty($content['sub_title']))
                    <div class="subtitle s2 mb-3 wow fadeInUp" data-wow-delay=".0s" style="{{ !empty($content['text_color']) ? 'color: '.$content['text_color'].';' : '' }}">{{ is_array($content['sub_title']) ? ($content['sub_title'][locale()] ?? $content['sub_title']['en'] ?? '') : $content['sub_title'] }}</div>
                    @else
                    <div class="subtitle s2 mb-3 wow fadeInUp" data-wow-delay=".0s">Event Schedule</div>
                    @endif
                    <h2 class="wow fadeInUp" data-wow-delay=".2s" style="{{ !empty($content['text_color']) ? 'color: '.$content['text_color'].';' : '' }}">
                        {{ !empty($content['title']) ? (is_array($content['title']) ? $content['title'][locale()] ?? '' : $content['title']) : '5 Days of AI Excellence' }}
                    </h2>
                </div>
              </div>
              <div class="row g-4 gx-5 justify-content-center wow fadeInUp">
                <div class="col-lg-12">
                    @if(isset($content['products']) && count($content['products']) > 0)
                        <!-- Render Real Products -->
                        @php
                            $products = $content['products'];
                        @endphp
                        <div class="row g-4">
                        @foreach($products as $product)
                        @php
                            $productId = $product['id'] ?? $product['product_id'] ?? 0;
                            $productName = $product['name_format'] ?? $product['name'] ?? '';
                            $productPrice = $product['price_format'] ?? format_price($product['price'] ?? 0);
                            $productImage = $product['images'][0] ?? $product['image'] ?? '';
                            $productUrl = $product['url'] ?? route('product.show', ['id' => $productId]);
                        @endphp
                            <div class="col-lg-4 col-md-6">
                                <div class="product-wrap hover bg-dark-2 rounded-1 overflow-hidden h-100 wow fadeIn position-relative">
                                    <div class="image position-relative overflow-hidden">
                                        <a href="{{ $productUrl }}" class="d-block overflow-hidden position-relative" style="aspect-ratio: 1/1;">
                                            <img src="{{ image_origin($productImage) }}" class="w-100 h-100 transition-transform hover-scale-1-1" style="object-fit: cover;" alt="{{ $productName }}">
                                            @if(isset($product['images']) && count($product['images']) > 1)
                                                <img src="{{ image_origin($product['images'][1]) }}" class="image-after" alt="{{ $productName }}">
                                            @endif
                                        </a>
                                        
                                        <div class="button-wrap d-flex justify-content-center gap-2 px-2">
                                            <button
                                              class="btn btn-dark text-light btn-add-cart rounded-pill px-3 py-2 flex-grow-1 d-flex align-items-center justify-content-center gap-2"
                                              style="height: 40px;"
                                              product-id="{{ $product['sku_id'] ?? $product['id'] ?? $productId }}"
                                              onclick="bk.addCart({sku_id: '{{ $product['sku_id'] ?? $product['id'] ?? $productId }}'}, this)">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                              </svg>
                                              <span class="d-none d-sm-inline" style="font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ __('shop/products.add_to_cart') }}</span>
                                            </button>
                                            <button
                                              class="btn btn-dark text-light btn-quick-view rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center p-0"
                                              style="width: 40px; height: 40px;"
                                              data-bs-toggle="tooltip"
                                              data-bs-placement="top"
                                              title="{{ __('common.quick_view') }}"
                                              onclick="bk.productQuickView({{ $product['product_id'] ?? $product['id'] ?? $productId }})">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                              </svg>
                                            </button>
                                            <button
                                              class="btn btn-dark text-light btn-wishlist rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center p-0"
                                              style="width: 40px; height: 40px;"
                                              data-bs-toggle="tooltip"
                                              data-bs-placement="top"
                                              title="{{ __('shop/products.add_to_favorites') }}"
                                              data-in-wishlist="{{ !empty($product['in_wishlist']) ? 1 : 0 }}"
                                              onclick="bk.addWishlist('{{ $product['product_id'] ?? $product['id'] ?? $productId }}', this)">
                                              <i class="bi {{ !empty($product['in_wishlist']) ? 'bi-heart-fill text-danger' : 'bi-heart' }} d-flex align-items-center justify-content-center" style="font-style: normal;">
                                                <svg class="icon-empty" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                                <svg class="icon-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                </svg>
                                              </i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="p-4 text-center product-bottom-info">
                                        <h4 class="mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 1.4; height: 2.8em;">
                                            <a href="{{ $productUrl }}" class="text-light">{{ $productName }}</a>
                                        </h4>
                                        <div class="fs-18 text-gradient fw-bold product-price" product-id="{{ $product['sku_id'] ?? '' }}">
                                            <span class="price-new text-gradient fw-bold fs-18">{{ $productPrice }}</span>
                                            @if(isset($product['origin_price']) && $product['price'] != $product['origin_price'] && $product['origin_price'] > 0)
                                                <span class="price-old text-decoration-line-through text-white-50 ms-2 small">{{ $product['origin_price_format'] ?? format_price($product['origin_price']) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                    <div class="de-tab plain">
                        <ul class="d-tab-nav mb-4 pb-4 d-flex justify-content-between">
                            <li class="active-tab">
                                <h3>Day 1</h3>
                                Oct 1, 2026
                            </li>
                            <li>
                                <h3>Day 2</h3>
                                Oct 2, 2026
                            </li>
                            <li>
                                <h3>Day 3</h3>
                                Oct 3, 2026
                            </li>
                            <li>
                                <h3>Day 4</h3>
                                Oct 5, 2026
                            </li>
                            <li>
                                <h3>Day 5</h3>
                                Oct 5, 2026
                            </li>
                        </ul>
                        <ul class="d-tab-content pt-3 wow fadeInUp">   
                            <!-- day 1 -->                        
                            <li>
                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            08:00 – 10:00 AM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/1.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Joshua Henry</h5>
                                                    AI Research Lead, DeepTech Labs
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Opening Keynote – The State of AI 2026</h3>
                                            <p class="fs-15 mb-0">Kick off the event with an insightful overview of where artificial intelligence is headed. Ava will explore breakthroughs, global shifts, and what’s next in deep learning, generative models, and AI ethics.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            12:00 – 14:00 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/2.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Leila Zhang</h5>
                                                    VP of Machine Learning, Google
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Building Human-Centered AI Products</h3>
                                            <p class="fs-15 mb-0">This session covers how to design AI solutions that prioritize usability, fairness, and real-world impact. Bring your laptop—hands-on UX exercises included.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            16:00 – 18:00 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/3.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Carlos Rivera</h5>
                                                    Founder & CEO, NeuralCore
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: AI Policy & Regulation – A Global Overview</h3>
                                            <p class="fs-15 mb-0">Learn how nations and organizations are approaching AI governance, including frameworks for data privacy, bias mitigation, and accountability in model deployment.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            20:00 – 22:00 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/4.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Maria Gonzalez</h5>
                                                    Founder & CEO, SynthCore AI
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Building a Startup with AI at the Core</h3>
                                            <p class="fs-15 mb-0">Marco shares his journey launching an AI-first startup. Discover tips on tech stacks, team-building, funding, and scaling responsibly.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->
                            </li>

                            <!-- day 2 -->
                            <li>
                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            09:00 – 10:30 AM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/5.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Leila Zhang</h5>
                                                    Head of AI Strategy, VisionFlow
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Ethical AI — From Theory to Practice</h3>
                                            <p class="fs-15 mb-0">Explore how leading companies are implementing fairness, accountability, and transparency in real-world AI systems across healthcare and finance.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            11:00 – 12:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/6.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Lisa Zhang</h5>
                                                    AI Ethics Researcher, FairAI Group
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Bias in Data — Hidden Dangers in AI Pipelines</h3>
                                            <p class="fs-15 mb-0">Lisa dives deep into the causes of bias in training data and showcases methods to detect and mitigate harm before deployment.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            14:00 – 15:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/7.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Markus Blom</h5>
                                                    CTO, SynthMind AI
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Generative Models Beyond Text</h3>
                                            <p class="fs-15 mb-0">A practical tour of the next generation of multimodal models generating images, video, and even 3D environments with AI.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            16:00 – 17:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/8.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Priya Natarajan</h5>
                                                    Lead Engineer, CogniWare
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Workshop: Building AI-Powered Interfaces</h3>
                                            <p class="fs-15 mb-0">Learn how to embed conversational AI into web and mobile apps using modern open-source frameworks and API-first design.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                            </li>

                            <!-- day 3 -->
                            <li>
                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            09:00 – 10:30 AM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/9.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Sofia Romero</h5>
                                                    ML Engineer, NeuronEdge
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Transformers in 2026 — What's Next?</h3>
                                            <p class="fs-15 mb-0">A technical session diving into the future of transformer architectures, memory optimization, and scaling challenges.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            11:00 – 12:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/10.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Tomás Eriksson</h5>
                                                    Founder, RealSim AI
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Synthetic Data Generation for Training</h3>
                                            <p class="fs-15 mb-0">Tomás shares tools and techniques for creating high-quality synthetic datasets that speed up training and reduce risk.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            14:00 – 15:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/11.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Aisha Mensah</h5>
                                                    Senior AI Strategist, Datavine
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Panel: AI Regulation & Global Policy Outlook</h3>
                                            <p class="fs-15 mb-0">Top voices discuss the global AI policy landscape, upcoming legislation, and how it will shape the future of AI deployment.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            16:00 – 17:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/12.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Leo Tanaka</h5>
                                                    Robotics Engineer, MetaForm
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Embodied AI in Robotics</h3>
                                            <p class="fs-15 mb-0">Discover how AI is powering next-gen robotics for manufacturing, logistics, and autonomous mobility through real-time interaction models.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                            </li>

                            <!-- day 4 -->
                            <li>
                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            09:00 – 10:30 AM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/13.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Nina Köhler</h5>
                                                    Chief Product Officer, SynthOS
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: AI in Product Design — From Concept to Launch</h3>
                                            <p class="fs-15 mb-0">Nina shares how AI is revolutionizing product development, from ideation to real-time user feedback integration.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            11:00 – 12:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/14.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Emmanuel Ruiz</h5>
                                                    CEO, NextCore Analytics
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Scaling AI Infrastructure for Enterprise</h3>
                                            <p class="fs-15 mb-0">Explore key considerations when deploying and managing scalable, secure, and cost-effective AI systems in the enterprise space.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            14:00 – 15:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/15.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Isabelle Chen</h5>
                                                    Head of Language Models, LumoAI
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Multilingual AI — Global Challenges & Innovations</h3>
                                            <p class="fs-15 mb-0">How modern LLMs are overcoming linguistic bias, translation errors, and dialect diversity in global applications.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            16:00 – 17:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/16.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Connor Walsh</h5>
                                                    Cloud AI Architect, SkyStack
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Workshop: Building AI Pipelines in the Cloud</h3>
                                            <p class="fs-15 mb-0">Hands-on session building a full AI workflow using serverless tech, vector databases, and model deployment strategies.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->
                                
                            </li>

                            <!-- day 5 -->
                            <li>
                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            09:00 – 10:30 AM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/17.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Elena Greco</h5>
                                                    Ethics Advisor, Global AI Forum
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Ethical Design in AI — A Human-Centered Approach</h3>
                                            <p class="fs-15 mb-0">A deep dive into responsible AI, highlighting bias mitigation, fairness, transparency, and global implications of autonomous systems.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            11:00 – 12:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/18.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Marcus Dlamini</h5>
                                                    Founder, EduAI Labs
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Personalized Learning with AI</h3>
                                            <p class="fs-15 mb-0">Explore how AI-driven platforms are transforming education with adaptive learning paths and dynamic content delivery.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="border-white-bottom-op-2 pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            14:00 – 15:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/19.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Lara Nguyen</h5>
                                                    GenAI Director, NovaSynth
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Session: Creative AI — From Text to Video</h3>
                                            <p class="fs-15 mb-0">Lara demonstrates how generative AI is transforming content creation, with real-time demos in video, audio, and image generation.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                                <!-- schedule item begin -->
                                <div class="pb-5 mb-5">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2">
                                            16:00 – 17:30 PM
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://madebydesignesia.com/themes/cyber/images/team/20.webp" class="w-100px rounded-1 me-4" alt="">
                                                <div>
                                                    <h5 class="mb-0">Dr. Hassan Al-Mansour</h5>
                                                    Lead Data Scientist, FutureVision
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Closing Keynote: AI & Humanity — Co-Evolution or Collapse?</h3>
                                            <p class="fs-15 mb-0">A visionary closing on AI’s long-term trajectory, human-AI collaboration, and the existential questions we must answer now.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- schedule item end -->

                            </li>

                        </ul>
                    </div>
                    @endif
                </div>
              </div>
            </div>
        </section>
</div>
