@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>Over the past few decades, Bangladesh has seen a rapid improvement in its healthcare system. With reduced maternal and infant mortality rates along with an increased life expectancy at birth, the country's healthcare system has overcome major milestones. However, the shortage of doctors has become a considerable obstacle in the country's healthcare system. As such, people living in distant areas across the country have limited access to healthcare. In an attempt to counter this situation, Grameen Kalyan has developed a Digital Healthcare system to serve hard-to-reach patients and provide primary healthcare affordably. </p>
        <p>With the evolution of Information & Communication technology and thus the transformation of the healthcare landscape, Grameen Kalyan is working on promoting health equity by bridging the doctor-patient gap with the help of digitalization. Telehealth Program, consisting of 'Video Tele-camp' and 'Telemedicine' services, Kalyan makes healthcare accessible to remote patients.  </p>
        <p>Working methodically, Kalyan serves over 7% of its patients through the Digital Healthcare/Telehealth program utilizing Video Tele-camp.  By paying only BDT 100 (USD 1.2), a patient can consult a specialized doctor through our Video Tele-camp service in the health center at a pre-scheduled time. The DMF (Diploma in Medical Faculty) takes the patient's medical history upon the patient’s arrival and connects them with an MBBS certified doctor over a video call. The patient conveys all of their complications and symptoms to the doctor. The DMF then, according to the doctor's instruction, prescribes medicine and treatment to the patients.      </p>
        <p>Telemedicine service, unlike the Video Tele-camp procedure, does not have any pre-arranged time slot. Any center in charge (DMF or Paramedics) can call an MBBS Doctor whenever they need to consult, especially in an emergency. Besides that, any patient of a health center can take counselling from an MBBS Doctor via the presence of DMF if needed. </p>
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
