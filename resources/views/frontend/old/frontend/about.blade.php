@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <!-- vision and mission -->
    <section class="vision-container d-flex align-items-center justify-content-center">
        <!-- leafs -->
        <div class="grid-leaf-left">
            <img src="/assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="/assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
        <div class="vision-box-container">
            <div class="vision-box vision-left d-flex align-items-center justify-content-center">
                <div class="vision-box-content">
                    <h2>vision</h2>
                    <p>An inclusive world-class healthcare ecosystem across Bangladesh.</p>
                </div>
            </div>
            <div class="vision-box vision-right d-flex align-items-center justify-content-center">
                <div class="vision-box-content">
                    <h2>mission</h2>
                    <p>Delivering quality Primary Healthcare and minimize health inequalities and economic setbacks.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- services container -->
    <section class="services">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="services-item-container">
                    <!-- <div class="service-item service-1" data-aos="fade-right" data-aos-anchor-placement="left-left"
                        data-aos-duration="700">
                        <img src="/assets/service-1.webp" alt="">
                    </div>
                    <div class="service-item service-2" data-aos="fade-down" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="700">
                        <img src="/assets/service-2.webp" alt="">
                    </div>
                    <div class="service-item service-3" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                        data-aos-duration="700">
                        <img src="/assets/service-3.webp" alt="">
                    </div>
                    <div class="service-item service-4" data-aos="fade-right" data-aos-anchor-placement="right-right"
                        data-aos-duration="700">
                        <img src="/assets/service-4.webp" alt="">
                    </div> -->
                    <div class="service-item service-1" data-aos="fade-right" data-aos-anchor-placement="left-left"
                        data-aos-duration="700">
                        <a href="/service#healthCare-scroll"><img src="./assets/service-1.png" alt=""></a>
                    </div>
                    <div class="service-item service-2" data-aos="fade-down" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="700">
                        <a href="/service#wellbeing-scroll"><img src="./assets/service-2.png" alt=""></a>
                    </div>
                    <div class="service-item service-3" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                        data-aos-duration="700">
                        <a href="/service#emergency-scroll"><img src="./assets/service-3.png" alt=""></a>
                    </div>
                    <div class="service-item service-4" data-aos="fade-right" data-aos-anchor-placement="right-right"
                        data-aos-duration="700">
                        <a href="/service#social-scroll"><img src="./assets/service-4.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="services-content">
                    <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">Millions of
                        People at Bottom of the Pyramid are Served with Empathy and Care</h2>
                    <a href="/service" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="900">
                        <button>read more</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- inception -->
    <section class="inception-container">
        <!-- leafs -->
        <div class="grid-leaf-left">
            <img src="/assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="/assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
        <!-- inception container -->
        <div class="inception-content">
            <div class="inception-header">
                <h2>A Social Business Company <br> Since 1996</h2>
            </div>
            <div class="inception-body">
                <div>
                    <p>GRAMEEN KALYAN is a not-for-profit, Social Business Company in the Grameen family of companies; established in 1996, registered with RJSC under the Companies Act (C-388(08)/96) on 06 November 1996 and with NGO Affairs Bureau (No - 1725) on 02 July 2002. Nobel Peace Laureate and Olympic Laurel Professor Muhammad Yunus is the Founder and Chairman of Grameen Kalyan.
                    </p>
                    <p>Grameen Kalyan’s 25 years of experience reveals that, SOCIAL BUSINESS is not only a feasible, effective & financially sustainable model for providing Primary Healthcare in developing countries but also potentially capable of achieving scale maintaining the affordability.</p>
                </div>
            </div>
            <!-- inception footer -->
            <div class="inception-footer">
                <img src="/assets/about/inception-headline.png" alt="">
            </div>
        </div>
    </section>

    <!-- annual report section -->
    <section class="annual-report-section">
        <div class="annual-bottom">
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
                        <h3><span class="counter-count">{{getSummeryReportItem('Micro Health Insurance')}}</span>+</h3>
                        <p>Micro Health Insurance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- proud presence -->
    <section class="proud-container">
        <!-- leafs -->
        <div class="grid-leaf-left">
            <img src="/assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="/assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
        <!-- inception container -->
        <div class="proud-content">
            <div class="proud-header">
                <h2>Enabling and Empowering <br> People to Elevate Themselves <br> Out of Poverty Cycle Since 1996</h2>
            </div>
            <div class="proud-body">
                <div>
                    <p>Currently, Grameen Kalyan is operating through 140 Community Based Health Centers located in 30 districts of Bangladesh. Each year Grameen Kalyan provides healthcare services to around 500,000 (five hundred thousand) people through its health centers and satellite programs. Besides that, additional 7 million people in rural communities receive free basic healthcare check-up under Grameen Kalyan’s domiciliary and school health programs.
                    </p>
                    <p>In the late nineties, a study revealed that without improvement in healthcare, the poor cannot stay out of poverty for long time. Microcredit could bring them out of poverty but to keep them out of poverty permanently, healthcare inequalities for the poor must be addressed. Observing the reality, Nobel Laureate Prof. Muhammad Yunus, Chairman of Grameen Kalyan undertook an experimental project named “Rural Health Program (RHP)” in 1993 through Grameen Trust. Upon its success, RHP was handed over to Grameen Kalyan (GK) in 1997 immediately after its inception and since then it has been operating as a core program of Grameen Kalyan. </p>
                    <p>Over the time, GK has evolved a cost-effective, equitable, self-sustainable and extended rural health program for the indigent people by implementing the concept of community-based health centers, bringing the health outreach services to the doorsteps of the villagers and mobilizing beneficiaries through Micro Health Insurance (MHI) scheme. Along with providing primary healthcare directly, Kalyan has been promoting secondary & tertiary healthcare indirectly through functional referral services.</p>
                </div>
            </div>
        </div>
        <!-- inception footer -->
        <div class="proud-footer">
            <h3>Our Proud Presence</h3>
            <h4>Across the Country</h4>
        </div>
    </section>

    <!-- proud report section -->
    <section class="proud-report-section">
        <div class="proud-bottom">
            <div class="proud-reports">
                <div class="proud-reports-grid">
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100">
                        <h3><span class="counter-count">{{getSummeryReportItem('Health Centers')}}</span></h3>
                        <p>Health Centers</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="200">
                        <h3><span class="counter-count">{{getSummeryReportItem('Districts')}}</span></h3>
                        <p>Districts</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="300">
                        <h3><span class="counter-count">{{getSummeryReportItem('Divisions')}}</span></h3>
                        <p>Divisions</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="400">
                        <h3><span class="counter-count">{{getSummeryReportItem('Villages')}}</span></h3>
                        <p>Villages</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="proud-report-text">
        <div class="proud-text-container">
            <p>Grameen Kalyan Health Program has successfully initiated a set of grassroots level health infrastructure and health delivery system in which quality, sustainability and coverage of the underprivileged are the central preoccupations. Through its curative & preventive health services, Grameen Kalyan promotes accurate identification of common illness in outpatient settings, strengthens the counselling of healthcare during outreach activities, and performs timely referral services for acutely ill individuals. </p>
        </div>
        <div class="proud-text-container">
            <p>Grameen Kalyan continues to extend its support for the wellbeing of Grameen Bank (GB) borrowers, employees and their family members thru providing higher education loan & scholarship to the children of GB Borrowers and rendering medical, household loan and emergency financial assistance to the GB Employees. </p>
        </div>
        <div class="proud-text-container">
            <p>Grameen Kalyan has always been responsive to facilitate Food, Healthcare services and Relief assistance to the people affected by various Natural calamities and Disasters whenever the country is in need. Combating with Covid-19 Pandemic is also not an exception in this regard. </p>
        </div>
        <div class="proud-text-container">
            <p>Ever since the inception of Grameen Bank in 1976, Professor Muhammad Yunus was concern of the fact that, health improvement is an indispensable integral part of poverty alleviation. Consequently, Grameen Kalyan’s all efforts and initiatives were focused on solving Social Issues like rural healthcare, elevating livelihood, job creation, and other specific social causes. </p>
        </div>
        <div class="proud-text-container">
            <p>Since 2006, Grameen Kalyan has been actively involved in establishing & promoting Social Business entities operating diverse sectors like Agriculture, Nutrition, Healthcare, Value Chain, RMG, Finance, and Information Technology. Another massive success of Grameen Kalyan was creating around 6000 micro entrepreneurs in the rural economies, namely “Nobin Udyokta” - Young Entrepreneur Investment Program which was managed from 2014-2020. </p>
        </div>
    </section>

    <!-- about us grid -->
    <section class="about-grid-section">
        <div class="about-grid-container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item grid-border-left">
                        <div class="grid-content grid-content-left grid-content-image">
                            <img src="/assets/about/grid/grid-1.jpg" alt="">
                        </div>
                        <div class="green-box">
                            <div class="green-box-middle"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item">
                        <div class="grid-content grid-content-right grid-content-text">
                            <h3>1996 - 2000</h3>
                            <ul>
                                <li><a>08 Health centers were Installed</a></li>
                                <li><a>Community based Primary Health Care program launched</a></li>
                                <li><a>Domiciliary Service began to operate</a></li>
                                <li><a>Satellite Health Program was introduced</a></li>
                                <li><a>Introduced Micro Health Insurance</a></li>
                                <li><a>30,000+ patients were served in the year of inception</a></li>
                                <li><a>Wellbeing Program was launched</a></li>
                                <li><a>Initiated Emergency Response Program</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-lg-row flex-md-row flex-column-reverse">
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item grid-border-left">
                        <div class="grid-content grid-content-left grid-content-text">
                            <h3>2001 - 2005</h3>
                            <ul>
                                <li><a>14 Health centers were installed</a></li>
                                <li><a>Mega Camp (Eye & Medicine) were introduced</a></li>
                                <li><a>Dental Service was launched</a></li>
                                <li><a>General Medicine was launched</a></li>
                                <li><a>School Health Program launched</a></li>
                                <li><a>1,35,000+ patients were served</a></li>
                            </ul>
                        </div>
                        <div class="green-box">
                            <div class="green-box-middle"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item">
                        <div class="grid-content grid-content-right grid-content-image">
                            <img src="/assets/about/grid/grid-2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item grid-border-left">
                        <div class="grid-content grid-content-left grid-content-image">
                            <img src="/assets/about/grid/grid-3.jpg" alt="">
                        </div>
                        <div class="green-box">
                            <div class="green-box-middle"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item">
                        <div class="grid-content grid-content-right grid-content-text">
                            <h3>2006 - 2010</h3>
                            <ul>
                                <li><a>32 Health Centers was installed</a></li>
                                <li><a>Safe Maternity Program was introduced</a></li>
                                <li><a>USG (Imaging) Program was introduced</a></li>
                                <li><a>EPI Program was introduced</a></li>
                                <li><a>Vaccination Program was introduced</a></li>
                                <li><a>International Training Program for Health Professionals began</a></li>
                                <li><a>2,75,750+ patients were served in 2006</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-lg-row flex-md-row flex-column-reverse">
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item grid-border-left">
                        <div class="grid-content grid-content-left grid-content-text">
                            <h3>2011 - 2015</h3>
                            <ul>
                                <li><a>54 Health Center were installed</a></li>
                                <li><a>Diabetes & HTN Program launched</a></li>
                                <li><a>ECG Service launched</a></li>
                                <li><a>Safety Net Program launched</a></li>
                                <li><a>3,30,560+ patients were served</a></li>
                                <li><a>Launched Nobin Udyokta Program</a></li>
                            </ul>
                        </div>
                        <div class="green-box">
                            <div class="green-box-middle"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item">
                        <div class="grid-content grid-content-right grid-content-image">
                            <img src="/assets/about/grid/grid-4.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item grid-border-left">
                        <div class="grid-content grid-content-left grid-content-image">
                            <img src="/assets/about/grid/grid-5.jpg" alt="">
                        </div>
                        <div class="green-box">
                            <div class="green-box-middle"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item">
                        <div class="grid-content grid-content-right grid-content-text">
                            <h3>2016 - 2020</h3>
                            <ul>
                                <li><a>96 Health centers were installed</a></li>
                                <li><a>Gynae & Obs Program launched</a></li>
                                <li><a>Eye Care program launched</a></li>
                                <li><a>MBBS Doctors' camp introduced</a></li>
                                <li><a>ENT Care program launched</a></li>
                                <li><a>Telemedicine Program launched</a></li>
                                <li><a>In-House Training Program for Health Professionals</a></li>
                                <li><a>4,50,480+ patients were served</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-lg-row flex-md-row flex-column-reverse">
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item grid-border-left" id="grid-border-last">
                        <div class="grid-content grid-content-left grid-content-text">
                            <h3>2021</h3>
                            <ul>
                                <li><a>139 Health Center is in operation</a></li>
                                <li><a>X-Ray Program launched</a></li>
                                <li><a>Emergency Response during COVID-19 Pandemic</a></li>
                                <li><a>COVID-19 Public Awareness Program</a></li>
                                <li><a>Food Support/ Relief Program</a></li>
                                <li><a>Digital Healthcare Introduced</a></li>
                                <li><a>5,10,500+ patients were served</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-0">
                    <div class="about-grid-item" id="grid-border-last">
                        <div class="grid-content grid-content-right grid-content-image">
                            <img src="/assets/about/grid/grid-6.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about board members -->
    <section class="about-board-members">
        <div class="board-members-header">
            <div class="board-member-header-image">
                <img src="/assets/about/border-member-header.png" alt="">
            </div>
        </div>
        <div class="board-member-body">
            <div class="member-container member-container-one">

                <div class="member-container-one-container">
                    <div class="member-image">
                    <a href="/bio/{{$chairman->id}}"><img src="{{$chairman->profile_photo??'/assets/about/board-members/pic-yunus.jpg'}}" alt=""> </a>
                    </div>
                    <div class="member-details">
                        <a href="/bio/{{$chairman->id}}">
                        <h4>{{$chairman->name??''}}</h4>
                        <h6>{{$chairman->designation??''}}</h6>
                      </a>
                    </div>
                </div>

                <!-- green box -->
                <div class="green-box">
                    <div class="green-box-middle"></div>
                </div>
            </div>
            <div class="member-container member-container-two">
                @foreach($members as $key1=>$mdvalue)
                   @if($key1 > 3)
                     @continue;
                   @endif
                   @php
                      if($key1==0){
                        $border_curve1='border-curve-left';
                      }else if($key1==3){
                        $border_curve1='border-curve-right';
                      }else{
                        $border_curve1='border-curve';
                      }
                   @endphp
                <div class="member-container-two-container">
                    <div class="member-image  {{$border_curve1}}">
                    <a href="/bio/{{$mdvalue->id}}"><img src="{{$mdvalue->profile_photo??'#'}}" alt=""></a>
                    </div>
                    <div class="member-details">
                    <a href="/bio/{{$mdvalue->id}}">
                        <h4>{{$mdvalue->name??''}}</h4>
                        <h6>{{$mdvalue->designation??''}}</h6>
                      </a>
                    </div>
                </div>

                @endforeach
                </div>
                @foreach($members as $key=>$mdvalue1)
                   @if($key==3)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
                   @if($members && count($members) >8)

                   <div class="member-container member-container-two">

                              @foreach($members as $key3=>$mdvalue2)
                              @if($key3 < 4 || $key3 > 7)
                                   @continue;
                                 @endif
                                 @php
                                    if($key3==4){
                                        $border_curve2='border-curve-left';
                                    }else if($key3==7){
                                        $border_curve2='border-curve-right';
                                    }else{
                                        $border_curve2='border-curve';
                                    }
                                @endphp
                              <div class="member-container-two-container">
                                  <div class="member-image {{$border_curve2}}">
                                  <a href="/bio/{{$mdvalue2->id}}"><img src="{{$mdvalue2->profile_photo??'#'}}" alt=""></a>
                                  </div>
                                  <div class="member-details">
                                  <a href="/bio/{{$mdvalue2->id}}">
                                    <h4>{{$mdvalue2->name??''}}</h4>
                                    <h6>{{$mdvalue2->designation??''}}</h6>
                                </a>
                                  </div>
                              </div>

                              @endforeach
                              </div>

                   @endif
                  @foreach($members as $key4=>$value)
                   @if($key4==7)
                   <div class="divider">
                   <div class="green-box_2">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach


                   @if($members && count($members) >8)
                        <div class="member-container member-container-two">
                        @foreach($members as $key5=>$value)
                            @if($key5 < 8 || $key5 > 12)
                                @continue;
                            @endif
                            @php
                                    if($key5==8){
                                        $border_curve3='border-curve-left';
                                    }else if($key5==11){
                                        $border_curve3='border-curve-right';
                                    }else{
                                        $border_curve3='border-curve';
                                    }
                                @endphp
                            <div class="member-container-two-container">
                                <div class="member-image {{$border_curve3}}">
                                <a href="/bio/{{$value->id}}"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                </div>
                                <div class="member-details">
                                <a href="/bio/{{$value->id}}">
                                    <h4>{{$value->name??''}}</h4>
                                    <h6>{{$value->designation??''}}</h6>
                                </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                   @endif

                @foreach($members as $key6=>$value)
                   @if($key6 >= 8)

                   <div class="divider">
                   <div class="green-box_3">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach

        </div>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/about.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/counter.js"></script>

    <!-- <script src="/js/index.js"></script>
    <script src="/js/counter.js"></script> -->
    <!-- <script src="/js/index-image-hover.js"></script> -->
    <!-- <script src="/js/dropdown.js"></script> -->

@endsection
