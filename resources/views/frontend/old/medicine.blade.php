@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
@include('frontend.partials.info-container');
    <!-- info boxes -->
@include('frontend.partials.info-box-container');

    <section class="main-blog-content">
        <p>By providing an affordable and better healthcare experience to every individual under our care, we are determined to provide the best experience to every visitor of our health centers. Maintaining the trust and expectation of our patients, we aspire to give the best service that a healthcare center could offer. Doing so, Grameen Kalyan never compromises to maintain the legal, ethical and professional standards and government-approved guidelines for conducting Primary Healthcare Services across the country. Each of our health centers undergoes a rigorous process of evaluations and safety checks to be an established institute that abides by the health and safety protocols. At Kalyan, we pay strict and close attention to retaining license coverage, maintaining uniform Health Center infrastructure and interior. Alongside, we follow systematic hygiene & cleanliness, waste management, preserving pathological instruments, reagents, medicines and overall treatment protocols to ensure quality care and maintain patient satisfaction.</p>
    </section>

    <!-- blog content report section -->
    <section class="proud-report-section">
        <div class="proud-bottom" style="background-image: url('./assets/healthcare/health-story/special-image.JPG')">
            <div class="proud-reports">
                <div class="proud-reports-grid">
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100" class="text-center"></div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100" class="text-center">
                        <p>2011 to 2021</p>
                        <h3><span class="counter-count">22254</span>+</h3>
                        <p>1,14,690</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="200" class="text-center">
                        <p>Annually</p>
                        <h3><span class="counter-count">22254</span>+</h3>
                        <p>1,14,690</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100" class="text-center"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-blog-content-footer">
        <a href="/healthcare">back</a>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/service-special.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script>
    <script src="/js/counter.js"></script>
    <script src="/js/index-image-hover.js"></script>
    <script src="/js/dropdown.js"></script> -->
    <script src="/js/slick.min.js"></script>
    <script src="/js/custom-slick.js"></script>

@endsection
