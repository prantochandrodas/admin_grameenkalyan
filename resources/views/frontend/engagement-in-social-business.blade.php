@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        {{-- Social Business Social Goals Section --}}
        <h4>Achieving Social Goals by Promoting Entrepreneurship: </h4>
        <p class="headline">Designing Social Solutions</p>
        <p class="content">Being inspired by social business principles, Grameen Kalyan has empowered unemployed youths by uplifting their Entrepreneurial capability and improving their livelihood to create A World of Three Zeros: Zero Poverty, Zero Unemployment, and Zero Net Carbon Emissions.</p>
        <p class="content">In 2014, Kalyan initiated the "Nobin Udyokta (young entrepreneur) Investment Program" to create self-employment opportunities for the educated and uneducated youths of Grameen Bank (GB) borrower’s families who are motivated by the motto of "not to be a job seeker, but to be a job giver" and funded them to utilize their skills and capabilities to become successful micro entrepreneurs.</p>   
        <p class="content">This program is a Social Business initiative by Grameen Kalyan. Under this program, Kalyan invests equity for the business projects submitted by the Nobin Udyoktas (young entrepreneurs). Kalyan takes back only its investment amount after a certain period of time as per the agreement with the entrepreneur. Kalyan does not make any profit out of it (only involved as a beneficiary). The Nobin Udyokta (young entrepreneur) operates their business in its traditional way & making profit through their business.  As per records, Kalyan has invested an amount of <strong>BDT 1245.26 million (USD 14.65 million)</strong> up till February 2022 to around 13,000 Nobin Udyoktas for their businesses, which includes fisheries, grocery shops, mechanical workshops, dairy farms, cow fattening, poultry, medicine shops, and more.</p>   
        <p><strong>BDT 1245.26 million invested <br><br> 13,000 <br> Young Micro Entrepreneurs supported <br></strong><br></p>

        {{-- Social Business Other Programs Section --}}
        <h4>Other Programs: </h4>
        <p class="headline">Promoting Social Business Enterprises:</p>
        <p class="content">Kalyan is actively involved in promoting social businesses in many ways through its various investments. Since 2006, Kalyan has been taking part in establishing social business enterprises. Other than the Nobin Udyokta program, it has invested BDT 306.1 million (USD 3.60 million) to several social business enterprises up till December 2021.</p>
        
        <p class="headline">Investment in Other Grameen Companies:</p>   
        <p class="content">Other than social business, Grameen Kalyan was also involved in the establishment of Grameen family companies. Grameen Kalyan is the shareholder & investor of several Grameen companies, and till the end of 2021, has invested BDT 1324.1 million (USD 15.58 million).</p>   
        
        <p class="sb-investment"><strong>Invested in other social business companies <span>BDT 306.1 million</span></strong></p>
        <p class="sb-investment"><strong>Equity-Based Investment in other Grameen Companies <span>BDT 1324.1 million</span></strong></p>
        


    </section>

    <section class="main-blog-content-footer">
        <a href="/service">back</a>
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
