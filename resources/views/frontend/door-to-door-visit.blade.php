@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>Grameen Kalyan understands that often due to income constraints, women in low incomes families are sidelined and cannot afford necessary transportation costs if health facilities are located in distance from their homes. Consequently, to deal with the problem, Grameen Kalyan has started building health centers and arranging satellite health programs in peripheral rural areas near the homes of disadvantaged women ensuring access to healthcare. Grameen Kalyan adequately trains and monitors its community-based health workers. They play a vital role in educating & motivating rural women about the danger signs of health problems, common issues of illness, careful usage of medications, and self-care by various kinds of preventive health measures. Like Sumi Akter, they are locally recruited and are acquainted with locals in their assignments. They also play a significant role in increasing equity in healthcare utilization from Grameen health facilities following the local households’ needs. </p>
        <p>Community Health Workers are the nucleus of the Grameen Kalyan health program. Each health center has 5-6 female Community Health Assistants (CHA). They conduct regular household visits within the catchment area and refer the sick person to Grameen Kalyan health center & specialized medical camps. The CHA also partakes in outreach initiatives like school health programs and satellite health programs. Their door-to-door service includes counselling on health, hygiene, nutrition, antenatal care, vaccination of children, and supply of products like saline, sanitary napkins, contraceptives, etc., and follow-up of old patients. They carry essential medical equipment such as a BP machine, stethoscope, thermometer, glucometer, and weight machine for spot check-ups.  </p>
        <p>Grameen Kalyan Health Assistants publicize their services through routine home visits and other means such as public mike announcements, spreading leaflets, and posters. These outreach and educational efforts are aimed at empowering poor women to take control of their health relating to hygiene and gynaecology and other diseases and urge them to seek appropriate healthcare for their problems from the Kalyan Health centers without any shame or hesitation. </p>
        <div class="main-blog-content-grid">
            <div>
                <p class="headline">1996 to 2020</p>
                <p>55,744,189+ People </p>
            </div>
            <div>
                <p class="headline">Annually </p>
                <p>7,028,923 + People </p>
            </div>
        </div>
    </section>
    <section class="main-blog-content-footer">
        <a href="/healthcare">back</a>
    </section>

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
