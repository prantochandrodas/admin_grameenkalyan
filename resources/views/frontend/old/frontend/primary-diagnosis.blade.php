@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>In our 25 years of dedicated healthcare experience in rural/semi-urban areas, we understand that communication is vital in diagnosing the patient. Therefore, in the sequence of gathering information, integration, and interpretation, we aim to build trust through communication among health professionals, patients, and patients' family members. Whether during home calls or the visits at our health center, we always listen carefully to our patients to understand their health conditions. Later through our professional observation, interviews, and discussions, we gather further information on medical history to determine the patient’s health problem. Apart from these, Grameen Kalyan regularly arranges Satellite (outdoor) Camps & School camps in the locality and oversees disease & diagnosis-specific health drives where people can get expert opinions, consultation, and other health services affordably. </p>
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
