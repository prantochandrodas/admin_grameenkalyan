@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container');
    <!-- info boxes -->
@include('frontend.partials.info-box-container');

    <section class="main-blog-content">
        <p>Diabetes can be addressed as the mother of all diseases. Kalyan’s Diabetes awareness program aimed to provide education, detection and prevention of diabetes & its consequences among the mass population. As a part of this, health centers’ Community Health Assistants carry a glucometer (along with other portable medical equipments) with them and check household members’ blood glucose level by strips during their domiciliary visits and satellite camps (Uthan boithok). If someone diagnoses with diabetes then the health assistant refers the patient to health center’s doctor. Based on diagnosing stage such as late or early diagnosed, types of diabetes, uncontrolled diabetes etc. a scheduled routine chart of diet & living habits are provided to patients from health center. Regular blood sugar monitoring is a mandatory practice for diabetic patients. Grameen Kalyan offers a very reasonably priced follow-up package for its diabetic patients.</p>
    </section>

    <!-- blog content report section -->
    <section class="proud-report-section">
        <div class="proud-bottom" style="background-image: url('./assets/healthcare/special/special-post/diabetes-2.jpg')">
            
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
