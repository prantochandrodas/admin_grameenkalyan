@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
   <!-- info buttons -->
@include('frontend.partials.info-container');
    <!-- info boxes -->
@include('frontend.partials.info-box-container');

    <section class="main-blog-content">
        <p>Each month, over 15 ENT camps are hosted in each of our health centers. Annually we serve over 22,423 patients through our health centers. Our primary health care service for the ear includes Acute Otitis Media, Chronic Otitis Media, removal of foreign body or boil in the external ear, impacted wax, Presbycusis, and deafness. While for the throat, we offer treatment for Adenoid, Tonsillitis, Pharyngitis, removal of Foreign Body in the throat, and others. For the nose, the treatment area includes Rhinitis, Nasal Polyp, removal of Foreign Body, Deviated Nasal Septum, Acute, and Chronic sinusitis, among others. </p>
    </section>

    <!-- blog content report section -->
    <section class="proud-report-section">
        <div class="proud-bottom" style="background-image: url('./assets/healthcare/special/special-post/ent-2.webp')">
            <div class="proud-reports">
                <!-- <div class="proud-reports-grid">
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
                </div> -->
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
