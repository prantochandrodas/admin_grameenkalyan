@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
@include('frontend.partials.info-container');
    <!-- info boxes -->
@include('frontend.partials.info-box-container');

    <section class="main-blog-content">
        <p>General Medicine health camps are conducted by MBBS doctors of Grameen Kalyan at its health centers. Diversified patients are treated and get referred for higher facilities from these medicine camps. Among them hypertension, arthritis, gastritis, peptic ulcer, anemia, fungal infection, allergy, skin diseases like eczema, scabies and acne vulgaris, cold fever, bronchial asthma and cardiovascular disease are common. Most of them are non-communicable diseases those are preventable by modifying the lifestyles and risk factors. According to Statistics, around 65% deaths are occurred due to non-communicable diseases across the world. However, Grameen Kalyan refers the complicated cases to reliable tertiary care providers.</p>
    </section>

    <!-- blog content report section -->
    <section class="proud-report-section">
        <div class="proud-bottom" style="background-image: url('./assets/healthcare/special/special-post/Medicine-2.jpg')">
            
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
