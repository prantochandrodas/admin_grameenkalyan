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
                        <a href="/service#healthCare-scroll"><img src="/assets/service-1.png" alt=""></a>
                    </div>
                    <div class="service-item service-2" data-aos="fade-down" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="700">
                        <a href="/service#wellbeing-scroll"><img src="/assets/service-2.png" alt=""></a>
                    </div>
                    <div class="service-item service-3" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                        data-aos-duration="700">
                        <a href="/service#emergency-scroll"><img src="/assets/service-3.png" alt=""></a>
                    </div>
                    <div class="service-item service-4" data-aos="fade-right" data-aos-anchor-placement="right-right"
                        data-aos-duration="700">
                        <a href="/service#social-scroll"><img src="/assets/service-4.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="services-content">
                    <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">Millions of
                        People at Bottom of the Pyramid are Served with Empathy and Care</h2>
                    <a  href="/service"><button data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">read more</button></a>
                    <!-- /*style="border:2px solid #0b612d !important;"*/ -->
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
                        class="counter-count">{{getSummaryReportItem('Annually we serve')}}</span>+</h2>
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
                        <h3><span class="counter-count">{{getSummaryReportItem('Primary Diagnosis')}}</span>+</h3>
                        <p>Primary Diagnosis</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="200">
                        <h3><span class="counter-count">{{getSummaryReportItem('Doctor Consultation')}}</span>+</h3>
                        <p>Doctor Consultation</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="300">
                        <h3><span class="counter-count">{{getSummaryReportItem('Access to Medicine')}}</span>+</h3>
                        <p>Access to Medicine</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="400">
                        <h3><span class="counter-count">{{getSummaryReportItem('Door to Door Visit')}}</span>+</h3>
                        <p>Door to Door Visit</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="500">
                        <h3><span class="counter-count">{{getSummaryReportItem('Health Camps')}}</span>+</h3>
                        <p>Health Camps</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="600">
                        <h3><span class="counter-count">{{getSummaryReportItem('Digital Healthcare')}}</span>+</h3>
                        <p>Digital Healthcare</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">
                        <h3><span class="counter-count">{{getSummaryReportItem('Vaccination & Immunisation')}}</span>+</h3>
                        <p>Vaccination & Immunisation</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="800">
                        <h3><span class="counter-count">{{getSummaryReportItem('Micro Health Insurance')??0}}</span>+</h3>
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

<!-- Video Gallery section -->
<section class="video-container align-items-center justify-content-center">
    <div class="container"  id="video-section">
        <div class="main-video">
            <iframe id="youtubePlayer" src="https://www.youtube.com/embed/{{$recommendedVideos[0]->video_link??''}}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="videos">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="border-right nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><span>Latest</span></button>
                    <button class="border-right nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span>Most Viewed</span></button>
                    <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><span>Recommended</span></button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade  show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div id="latest-video" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($latestVideos as $key2=>$latestVideo)
                            <div class="carousel-item @if($key2==0) active @endif">
                                <div class="video_item col-md-3 col-sm-6" content_id="{{$latestVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$latestVideo->video_link}}">
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{$latestVideo->thumb_image}}" class="img-fluid">
                                        </div>
                                        <div class="card-img-overlay">{{$latestVideo->title}}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev bg-transparent w-aut" href="#latest-video" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut" href="#latest-video" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div id="most-visited" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($mostViewedVideos as $key2=>$mostViewedVideo)
                            <div class="carousel-item @if($key2==0) active @endif">
                                <div class="video_item col-md-3 col-sm-6" content_id="{{$mostViewedVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$mostViewedVideo->video_link}}">
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{$mostViewedVideo->thumb_image}}" class="img-fluid">
                                        </div>
                                        <div class="card-img-overlay">{{$mostViewedVideo->title}}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev bg-transparent w-aut" href="#most-visited" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut" href="#most-visited" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div id="recommended" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($recommendedVideos as $key=>$recommendedVideo)
                            <div class="carousel-item @if($key==0) active @endif">
                                <div class="video_item col-md-3 col-sm-6" content_id="{{$recommendedVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$recommendedVideo->video_link}}">
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{$recommendedVideo->thumb_image}}" class="img-fluid">
                                        </div>
                                        <div class="card-img-overlay">{{$recommendedVideo->title}}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev bg-transparent w-aut" href="#recommended" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut" href="#recommended" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>

            </div>

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
<script>
    let items = document.querySelectorAll('.carousel .carousel-item')

    items.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    });
    $(document).ready(function (){
        $('.video_item').click(function (){
            $("#youtubePlayer").attr('src',$(this).attr('youtubeLink'));

            var content_id = $(this).attr('content_id');
            $.ajax({
                type:"GET",
                dataType: "json",
                data:{content_id: content_id},
                url:"/video-view-count",
                success:function(data)
                {
                    alert('Get Success');
                    console.log(data);
                }
            });
        });
    });
</script>
<style>
    .video-container{
        padding: 0% 16.2%;
        background: #d3e0d6;
        margin-top: 7rem;
    }
    .video-container .container .main-video iframe{
        width:100%;
        height:43rem;
    }
    .video-container .container{
        width: 100%;
        height: auto;
        /*display: flex;*/
        background: rgb(9 97 46);
        max-width: 100%;
    }

    .video-container .container .videos{
        width: 100%;
        padding: 10px 0 10px 10px;
        display: contents;
        flex-direction: inherit;
        justify-content: space-between;
    }
    .video-container .container .videos .card{
        border: 1px solid #09612e;
    }
    .video-container .container .videos .nav-tabs{
        border: 1px solid #09612e;
        margin-bottom: 13px;
    }
    .video-container .container .videos #nav-tab .border-right{
        border-right: 2px solid #fff !important;
    }
    .video-container .container .videos #nav-tab .active span{
        border-bottom: 2px solid #fff !important;
        padding: 6px 0px;
        color: #fff;
    }
    .video-container .container .videos #nav-tab button{
        margin-left: 3px;
        color: #cc9b2a;
    }
    .video-container .container .videos #nav-tab button:hover{
        border: unset;
        /*background: #006e2e;*/
    }
    .video-container .container .videos #nav-tab button:after{
        border: unset;
        /*background: #006e2e;*/
    }
    .video-container .container .videos #nav-tabContent{
        min-height: 253px;
    }

    .videos .nav-tabs .nav-link{
        color: #fff;
    }
    .videos .nav-tabs .nav-link.active{
        color: #fff;
        background-color: rgb(9 97 46)!important;
        border-color: unset!important;
    }
    .videos .nav-tabs .nav-link:focus{
        color: #fff;
        background-color: rgb(9 97 46)!important;
        border-color: unset!important;
    }
    .video-container .container .videos .active{
        border: unset!important;
        padding: 0 1.7%;
        transform: scale(1.03) !important;

    }

    .video-container .container .videos video{
        width: 95%;
        height: 100px;
        margin: 10px;
        object-fit: cover;
        cursor: pointer;
        transition: 0.2s;
    }

    .video-container .container .videos video:nth-child(1){
        /*margin-top: 0;*/
    }

    .video-container .container .videos video:hover,
    .video-container .container .videos .active{
        transform: scale(1.06);
        /*border: 3px solid blue;*/
    }

    .video-container .container .main-video{
        width: 100%;
        padding: 10px;
    }

    .video-container .container .main-video video{
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 3px solid blue;
    }
    .video-container .container .card-img-overlay{
        color: #fff;
        background: #09612e;
        top:unset;
        font-size: 13px;
        opacity: .9;
    }
    .video-container .millions-smile-header {
        padding: 10% 5% 1% 5%;
        position: relative;
    }
    .video-container .millions-smile-header .millions-smile-header-content h3{
        color: #CC9B2B;
        font-weight: 900;
        font-size: 6vmin;
        margin-bottom: 0;
    }
    .video-container .millions-smile-header .millions-smile-header-content h2 {
        color: #CC9B2B;
        font-weight: 900;
        font-size: 10vmin;
        margin-bottom: 0;
    }
    .video-container .millions-smile-header .people-leaf-bottom {
        position: absolute;
        bottom: 0;
        right: 0;
        z-index: -1;
    }

    .video-container .millions-smile-header .people-leaf-bottom img {
        height: 60vmin;
    }
    @media (max-width: 767px) {
        .carousel-inner .carousel-item > div {
            display: none;
        }
        .carousel-inner .carousel-item > div:first-child {
            display: block;
        }
    }

    .carousel-inner .carousel-item.active,
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
        display: flex;
    }

    /* medium and up screens */
    @media (min-width: 768px) {
        .carousel-inner .carousel-item-end.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(25%);
        }

        .carousel-inner .carousel-item-start.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-25%);
        }
    }

    .carousel-inner .carousel-item-end,
    .carousel-inner .carousel-item-start {
        transform: translateX(0);
    }
    .video-list-container{
        padding: 4% 0;
    }
    .video-list-container .card{
        margin-bottom:1rem ;
        border: unset;
    }
    @media screen and (max-width: 1300px) and (min-width: 600px) {
        #videoPlayerModal .modal-content{
            height:72% !important;
        }
        #videoPlayerModal .modal-dialog{
            width: 60%!important;
            margin-top:8% !important;
        }
        .video-container {
            padding: 0% 14.3%;
        }
        .video-container .container .main-video iframe {
            height: 30rem;
        }
        .video-container .container .card-img-overlay{
            font-size: 10px;
        }
        .video-list h6{
            font-size: 12px;
        }
        .video-container .container .videos #nav-tabContent{
            min-height: 178px;
        }
    }
    @media (max-width: 600px){
        .video-container .container{
            padding-bottom: 20px;
        }
        .video-container .container .main-video iframe{
            height: 12rem;
        }
        .video-list-container .video-list{
            padding: 3% !important;
        }
        .video-container .container .videos #nav-tab button{
            font-size: 14px;
        }
        .video-container{
            padding: 0% 0%;
            margin-top: 0rem;
        }
    }
</style>
@endsection
