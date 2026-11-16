@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')
    <!-- about container -->
    <section class="about-section">
        <div class="about-content">
            <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">25 Years</h2>
            <p data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">of Delivering
                Affordable Healthcare <br /> to Rural Doorsteps Across Bangladesh</p>
        </div>
        <div class="about-leaf">
            <img src="/assets/about-leaf-right.webp" alt="">
        </div>
    </section>
    <!-- services container -->
    <section class="services">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="services-item-container">
                    <div class="service-item service-1" data-aos="fade-right" data-aos-anchor-placement="left-left"
                        data-aos-duration="700">
                        <a href="/service#healthCare-scroll"><img src="/assets/service-1.webp" alt=""></a>
                    </div>
                    <div class="service-item service-2" data-aos="fade-down" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="700">
                        <a href="/service#wellbeing-scroll"><img src="/assets/service-2.webp" alt=""></a>
                    </div>
                    <div class="service-item service-3" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                        data-aos-duration="700">
                        <a href="/service#emergency-scroll"><img src="/assets/service-3.webp" alt=""></a>
                    </div>
                    <div class="service-item service-4" data-aos="fade-right" data-aos-anchor-placement="right-right"
                        data-aos-duration="700">
                        <a href="/service#social-scroll"><img src="/assets/service-4.webp" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="services-content">
                    <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">Millions of
                        People at Bottom of the Pyramid are Served with Empathy and Care</h2>
                    <a href="/service"><button data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">read more</button></a>
                </div>
            </div>
        </div>
    </section>

    <!-- video section -->
    <!-- <section class="kalyan-video">
        <div class="kalyan-video-container">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/_xch3Ui_RIw?rel=0" title="GRAMEEN Kalyan Healthcare" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </section> -->

    <!-- people -->
    <section class="people-section">
        <!-- people leaf -->
        <div class="people-leaf">
            <img src="/assets/people-leaf.png" alt="people-leaf">
        </div>
        <!-- people yunus -->
        <div class="people-yunus-container">
            <div class="row flex-lg-row flex-column-reverse">
                <div class="col-lg-6">
                    <div class="yunus-content">
                        <!-- <div>
                            <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">The Vision for Healthier Tomorrow</h2>
                        </div> -->
                        <div class="yunus-content-details speech-triangle" data-aos="fade-up"
                            data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">
                            <!-- <p>We are on a mission to serve the low-income population with better quality and maximum convenience.
                                Grameen Kalyan provides a one-of-a-kind solution that operates in community-based health centres in hard
                                to access rural areas. Currently, 140 health centres are active in 30 districts across Bangladesh and
                                serving more than 7.8 million people annually. We proudly celebrate 25 years of our glorious journey and
                                aim to expand with improved quality of services and grow exponentially.</p> -->
                            <p>গ্রামীণ অঞ্চলের প্রান্তিক জনগোষ্ঠীর প্রাথমিক স্বাস্থ্যসেবায় সুদূরপ্রসারী পরিবর্তন আনতে
                                রোগ নির্ণয়, চিকিৎসা ব্যবস্থাপনা, তথ্য প্রযুক্তির যথাযথ প্রয়োগ এবং সারা দেশে সাশ্রয়ী
                                মূল্যে মানসম্পন্ন সেবা প্রদান করাই গ্রামীণ কল্যাণ-এর অঙ্গীকার।</p>
                        </div>
                        <div class="yunus-designation" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                            data-aos-duration="900">
                            <h6>প্রফেসর মুহাম্মদ ইউনূস</h6>
                            <small>চেয়ারম্যান, গ্রামীণ কল্যাণ</small>
                        </div>
                        <!-- <div class="yunus-btn" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">
                            <button>read more</button>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <img src="/assets/people-yunus.webp" alt="yunus">
                    </div>
                </div>
            </div>
        </div>
        <!-- people moin -->
        <div class="people-moin-container">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <img src="/assets/people-moin.webp" alt="moin">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="moin-content">
                        <!-- <div>
                            <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Thriving for Inclusive & Innovative Healthcare</h2>
                        </div> -->
                        <div class="moin-content-details" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                            data-aos-duration="500">
                            <p>Grameen Kalyan believes in trust, quality and innovation in delivering services. We are
                                on a mission to transform healthcare in Bangladesh at primary, secondary, and tertiary
                                levels. We exist to provide affordable and quality healthcare and well-being services in
                                unreached communities at the bottom of the pyramid, empowering them to get out of the
                                poverty cycle.</p>
                        </div>
                        <div class="moin-designation" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                            data-aos-duration="900">
                            <h6>A K M Moinuddin Chowdhury</h6>
                            <small>Managing Director, Grameen Kalyan</small>
                        </div>
                        <!-- <div class="yunus-btn" class="yunus-designation" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">
                            <button>read more</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- line leaf -->
        <div class="line-leaf">
            <img src="/assets/line-leaf.png" alt="">
        </div>
    </section>
    <!-- annual report section -->
    <section class="annual-report-section">
        <div class="annual-top">
            <div>
                <h4 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">Annually we
                    Serve</h4>
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700"><span
                        class="counter-count">{{getSummeryReportItem('Annually we serve')}}</span>+</h2>
                <h5 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">People Across
                    30 Districts in Bangladesh</h5>
            </div>
        </div>
        <div class="annual-bottom">
            <div class="annual-stroke">
                <img src="/assets/Annual.png" alt="annual">
            </div>
            <div class="annual-reports">
                <div class="annual-reports-grid">
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100">
                        <h3><span class="counter-count">{{getSummeryReportItem('Primary Diagnosis')}}</span>+</h3>
                        <p>Primary Diagnosis</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="200">
                        <h3><span class="counter-count">{{getSummeryReportItem('Doctor Consultation')}}</span>+</h3>
                        <p>Doctor Consultation</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="300">
                        <h3><span class="counter-count">{{getSummeryReportItem('Access to Medicine')}}</span>+</h3>
                        <p>Access to Medicine</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="400">
                        <h3><span class="counter-count">{{getSummeryReportItem('Door to Door Visit')}}</span>+</h3>
                        <p>Door to Door Visit</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">
                        <h3><span class="counter-count">{{getSummeryReportItem('Health Camps')}}</span>+</h3>
                        <p>Health Camps</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="600">
                        <h3><span class="counter-count">{{getSummeryReportItem('Digital Healthcare')}}</span>+</h3>
                        <p>Digital Healthcare</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">
                        <h3><span class="counter-count">{{getSummeryReportItem('Vaccination & Immunisation')}}</span>+</h3>
                        <p>Vaccination & Immunisation</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="800">
                        <h3><span class="counter-count">{{getSummeryReportItem('Micro Health Insurance')??0}}</span>+</h3>
                        <p>Micro Health Insurance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- micro health -->
    <section class="micro-health">
        <div>
            <img src="/assets/micro-health-banner.webp" alt="micro-health">
        </div>
        <div class="micro-health-btn">
            <a href="/micro-health-insurance" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">
                <button>Read More</button>
            </a>
        </div>
    </section>

    <!-- millions smile section -->
    <section class="millions-smile-section">
        <div class="millions-smile-header">
            <div class="millions-smile-header-content">
                <h3 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">Making Millions
                </h3>
                <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">Smile</h2>
            </div>
            <!-- people leaf -->
            <div class="people-leaf-bottom">
                <img src="/assets/people-leaf-bottom.png" alt="people-leaf">
            </div>
        </div>
        <div class="million-smile-body">
            <div class="smile-body-listings">
                <div class="woman-child">
                    <div class="smile-body-circle" id="smileCircle"></div>
                </div>
                <!-- smile-body-listings-left -->
                <div class="smile-body-listings-left">
                        @foreach($storyCategories as $key1=>$v1)
                            @if($key1>2)
                               @continue
                            @endif
                            <div class="smile-list-item smile-list-item-{{$key1+1}} smile-list-item-hover-effect" image="{{$v1->banner_image}}" id="smileList{{$key1+1}}">
                                <a href="/story/{{$v1->id}}">{{$v1->name??''}}</p>
                            </div>
                        @endforeach
                </div>
                <!-- smile-body-listings-right -->
                <div class="smile-body-listings-right">

                         @foreach($storyCategories as $key2=>$v2)
                            @if($key2 < 3)
                               @continue
                            @endif
                            <div class="smile-list-item smile-list-item-{{$key2+3}} smile-list-item-hover-effect" image="{{$v2->banner_image}}" id="smileList{{$key2+3}}">
                                <a href="/story/{{$v2->id}}">{{$v2->name??''}}</p>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
        <div class="million-smile-body-mobile">
            <div class="women-child-container">
                <div class="women-child-container-circle" id="smileCircle"></div>
            </div>
            <div class="stories-header mt-3">
                <img src="/assets/Stories.png" alt="">
            </div>
            <div class="stories-list">
                <ul>
                @foreach($storyCategories as $key=>$v)
                    <li data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="400"><a href="/story/{{$v->id}}"><img width="80px" src="{{$v->banner_image}}"> <span>{{$v->name}}</span>
                    </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
    <link rel="stylesheet" href="/css/scss/index.css">
    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/counter.js"></script>
    <script src="/js/index-image-hover.js"></script>

@endsection
