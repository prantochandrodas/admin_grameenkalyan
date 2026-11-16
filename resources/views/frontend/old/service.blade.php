@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <!-- we serve -->
    <section class="we-serve-container">
        <div class="we-serve-header d-flex align-items-center justify-content-center">
            <div>
                <h3 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Enabling and empowering people <br> to elevate themselves out of poverty</h3>
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="800">Areas We Serve</h2>
            </div>
        </div>
        <div class="we-serve-footer">
            <div class="we-serve-grid-collection">
                <div class="we-serve-grid we-serve-grid-first d-flex align-items-center justify-content-center" id="healthCare">
                    <a href="/service#healthCare-scroll">
                        <h2>healthcare</h2>
                        <img src="/assets/service-page/area-icon-1.svg" alt="">
                    </a>
                </div>
                <div class="we-serve-grid d-flex align-items-center justify-content-center" id="wellBeing">
                    <a href="/service#wellbeing-scroll">
                        <h2>wellbeing</h2>
                        <img src="/assets/service-page/area-icon-2.svg" alt="">
                </a>
                </div>
                <div class="we-serve-grid d-flex align-items-center justify-content-center" id="emergencyResponse">
                <a href="/service#emergency-scroll">
                        <h2>emergency response</h2>
                        <img src="/assets/service-page/area-icon-3.svg" alt="">
                </a>
                </div>
                <div class="we-serve-grid we-serve-grid-last d-flex align-items-center justify-content-center" id="socialBusiness">
                    <a href="/service#social-scroll">
                        <h2>social <br> business</h2>
                        <img src="/assets/service-page/area-icon-4.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- service healthcare -->
    <section class="service-healthcare">
        <div class="service-healthcare-header">
            <div class="service-right-leaf">
                <img src="/assets/service-page/right-leaf-line.png" alt="">
            </div>
            <div class="healthcare-tagline" id="healthCare-scroll">
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">healthcare</h2>
            </div>
        </div>
        <div class="service-healthcare-footer">
            <div>
                <img src="/assets/service-page/health-care.webp" alt="">
            </div>
            <div class="service-healthcare-footer-content">
                <div>
                    <h4 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Healthy and happy communities <br> thrive to prosper eventually</h4>
                    <h2>Healthcare at <br> Doorsteps</h2>
                    <p data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">Grameen Kalyan has become known for delivering affordable primary healthcare through community-based health centres and outreach health programs among rural communities to reduce health inequalities in urban and rural areas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- service wellbeing -->
    <section class="service-wellbeing">
        <div class="service-wellbeing-header">
            <div class="wellbeing-tagline" id="wellbeing-scroll">
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">wellbeing</h2>
            </div>
        </div>
        <div class="service-wellbeing-footer">
            <div class="service-wellbeing-footer-content">
                <div>
                    <h4 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Achieving dreams <br> to make bigger difference</h4>
                    <h2>Wellbeing for a Better Future</h2>
                    <p data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Through offering scholarships and higher education loans to the children of Grameen Bank borrowers and welfare loans to Grameen bank employees, Grameen Kalyan is significantly contributing to achieving the dreams of Grameen Bank families.</p>
                </div>
            </div>
            <div>
                <img src="/assets/service-page/wellbeing.webp" alt="">
            </div>
        </div>
    </section>

    <!-- service Emergency Response -->
    <section class="service-healthcare">
        <div class="service-healthcare-header">
            <div class="service-right-leaf">
                <img src="/assets/service-page/line-leaf-small.png" alt="">
            </div>
            <div class="healthcare-tagline" id="emergency-scroll">
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Emergency <br> Response</h2>
            </div>
        </div>
        <div class="service-healthcare-footer">
            <div>
                <img src="/assets/service-page/emergency.webp" alt="">
            </div>
            <div class="service-healthcare-footer-content">
                <div>
                    <h4 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Bridging the gap between <br> medical care and emergency crisis</h4>
                    <h2>Emergency Assistance <br> to Communities</h2>
                    <p data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Grameen Kalyan provides free primary medical care and food support as a part of its disaster management program to affected communities across the country through reducing response times and empowering local networks.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- service social business -->
    <section class="service-wellbeing">
        <div class="service-wellbeing-header">
            <div class="wellbeing-tagline social-tagline" id="social-scroll">
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">social<br> business</h2>
            </div>
        </div>
        <div class="service-wellbeing-footer">
            <div class="service-wellbeing-footer-content">
                <div>
                    <h4 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Achieving social goals through  <br> entrepreneurial practices</h4>
                    <h2>Designing Social</h2>
                    <h2>Solutions</h2>
                    <p data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Being inspired by social business principles, Grameen Kalyan has empowered unemployed youths by uplifting their entrepreneurial capabilities and improving their livelihood to create a world of three zeros.</p>
                </div>
            </div>
            <div>
                <img src="/assets/service-page/social.webp" alt="">
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/services.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script>
    <script src="/js/counter.js"></script>
    <script src="/js/index-image-hover.js"></script>
    <script src="/js/dropdown.js"></script> -->
@endsection
