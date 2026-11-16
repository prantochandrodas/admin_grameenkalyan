@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>Immunisations, or vaccines, protect people from severe or contagious diseases while also preventing them from spreading to others by building natural immunity.  It uses a small sample of the weakened virus bits of lab-made protein to imitate the actual virus and is injected into the body to build immunity. When a person receives an immunisation, a weakened form of (or a fragment of) a disease is injected which activates the host’s immune system, causing it to produce antibodies to that specific infection or initiate other immune-boosting processes. </p>
        <p>Preventing disease is far easier and cost-effective than treating it. Furthermore, vaccines have thwarted epidemics of once-common infectious diseases like measles, mumps, and whooping cough over the years. Others, such as polio and smallpox, have been nearly eradicated as a result of immunisations. As such, Grameen Kalyan’s health center offers immunisations for various diseases to look out for the people in the long term.  </p>
        <p>Once a person has built immunity from the vaccine, they are ready to fight the infection if they are ever exposed to the disease -causing organism again. In most cases, a vaccine will either prevent or lessen the severity of the impact of the disease if the person is vaccinated. </p>
        <p class="headline">Currently, among various diseases, Kalyan’s primarily provides vaccinations for  </p>
        <ul>
            <li>HBsAg</li>
            <li>Typhoid</li>
            <li>Rabies</li>
            <li>Cervical</li>
            <li>EPI (Expanded Program on Immunisation) for Children </li>
        </ul>
        <p>Kalyan’s health workers also work relentlessly to raise awareness regarding Immunisations or vaccines through educating and counselling people during home visits and other mediums. </p>
        <div class="main-blog-content-grid">
            <div>
                <p class="headline">18,000+ People </p>
                <p>vaccinated annually  </p>
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
