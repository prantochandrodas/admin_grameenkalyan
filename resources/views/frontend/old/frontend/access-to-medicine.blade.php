@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>People living in rural and semi-urban areas often find themselves at an impasse with healthcare, limiting their capacity for receiving proper treatment and access to Medicare. To bridge this gap, Grameen Kalyan has been working diligently to make primary health care services available at the right time, even at remote locations. However, disparities in healthcare services need to be addressed to deliver proper healthcare in different marginalised communities.</p>
        <p>As a leading primary health care provider in Bangladesh, Kalyan always tries its best to ensure access to the right health products for people across the nation through its Community Health Workers and health centers. In many aspects, Kalyan’s ability to deliver primary health care depends on the quality and availability of these products. So, to ensure quality primary care, Kalyan is always determined to provide the best life-saving generic medicines and other Medicare products, affordably.  </p>
        <div class="main-blog-content-grid">
            <div>
                <p class="headline">Annual Medicine Sales BDT </p>
                <p>914,88500  </p>
            </div>
        </div>
        <p>To access medicine at Kalyan health center, patients need to come to the health center and see the physician in charge. Following proper diagnosis and in-depth assessment, the physician prescribes the necessary medicine required by the patient. The patient can then go to Kalyan’s pharmacy with the prescription and receive the appropriate medication at an affordable cost. However, individuals cannot buy excess medicine or medicines outside the prescription at Kalyan’s pharmacy. </p>
        <p>The ability for patients to get needed medicines at a reasonable rate to sustain proper health is always maintained at Kalyan. Medicine is a critical necessity for people, to retain health and cure illness. At Kalyan, patients have easy access to life-saving medicine in rural communities whenever they visit the health center for consultation. However, since the wrong usage of medicines can harm people, Kalyan takes preventive measures to reduce its misuse and provide only the medication that each patient needs. The dosages and prescriptions are changed accordingly based on follow-ups and revaluation of the patient's condition.  </p>
    </section>

    <section class="main-blog-content-footer">
        <a href="/healthcare">back</a>
    </section>

@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/service-special.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script> -->
    <!-- <script src="/js/counter.js"></script> -->
    <!-- <script src="/js/index-image-hover.js"></script> -->
    <!-- <script src="/js/dropdown.js"></script> -->
    <script src="/js/slick.min.js"></script>
    <script src="/js/custom-slick.js"></script>

@endsection
