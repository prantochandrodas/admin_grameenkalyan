@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
   <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>Grameen Kalyan emphasizes the health of women & children while rendering care. Kalyan has a team of gynecology expertise. Each community health assistant enlists pregnant women during her domiciliary visits. And once an expecting mother gets registered, the health center provides her Antenatal care throughout her entire pregnancy and ensures a regular follow-up. Kalyan has qualified and experienced paramedics on-call at all times who ensure safe normal delivery in uncomplicated cases. For the complicated pregnancy, Kalyan’s health professionals refer the patients to reliable higher facilities.   </p>
    </section>

    <!-- blog content report section -->
    <section class="proud-report-section">
        <div class="proud-bottom" style="background-image: url('./assets/healthcare/special/special-post/gynae-obs-2.jpg')">
            <!-- <div class="proud-reports">
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
            </div> -->
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
