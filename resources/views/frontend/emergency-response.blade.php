@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>Based on our years of experience responding to health emergencies caused by natural or man-made disasters, Grameen Kalyan has become a renowned, on-the-ground, emergency response organization in Bangladesh. Through reducing response times and empowering local networks, GK tries to assist areas impacted by providing free primary medical care and food support as a part of its emergency response initiative and Disaster Management Program.</p>
        <p>For the last 25 years, the country has faced severe annual floods and various natural catastrophes, for example, the deadly cyclone of 2007, Sidr, and other such calamities. Kalyan always tries its best to reach the affected rural areas adjacent to its health centers and arrange free medical camps and food support programs.</p>
        <p>In 2013, Bangladesh witnessed the fatal Rana Plaza tragedy, a Ready-made Garments building that crashed down taking numerous lives and injuring hundreds. As the number of injured during the incident spiked along with deaths, Grameen Kalyan set up a week-long medical booth and rendered urgent primary treatment to the wounded. Moreover, when half a million Rohingya entered Bangladesh seeking refuge and shelter from Rakhine State, Myanmar, on 25 August 2017, Kalyan stepped in to support during the crisis. Along with local Bangladeshi communities, Kalyan also took part in the multinational aid effort led by the Government of Bangladesh to overcome the crisis and sustain the refugees.</p>
        <p>Kalyan’s efforts to serve people during emergency crises set a model of empathy. It has been improving, strengthening and transforming its current health program in a sustainable, impartial and regulated way, aiming to respond to future disasters as well.</p>
        {{-- Well Being Section GB Members --}}
        <table class="emergency-response-table">
            <tr>
                <th>S.I</th>
                <th>Particulars</th>
                <th>People Served</th>
                <th>Relief Amount (BDT)</th>
            </tr>
            <tr>
                <td>1.</td>
                <th>Flood, 2017</th>
                <td>15,299</td>
                <td>4,21,065</td>
            </tr>
            <tr>
                <td>2.</td>
                <th>Flood, 2020</th>
                <td>2,030</td>
                <td>2,03,799</td>
            </tr>
            <tr>
                <td>3.</td>
                <th>Rana Plaza incident</th>
                <td>1,300</td>
                <td>2,60,000</td>
            </tr>
            <tr>
                <td>4.</td>
                <th>Rohingya crisis, 2017</th>
                <td>7,209</td>
                <td>3,45,557</td>
            </tr>
        </table>
        
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
