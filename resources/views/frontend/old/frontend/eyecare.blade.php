@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container');
    <!-- info boxes -->
@include('frontend.partials.info-box-container');

    <section class="main-blog-content">
        <p>Grameen Kalyan has become widespread in providing primary Eye Care services to ensure healthy eyesight for patients of all ages. Following the rules and regulations of WHO (World Health Organization), our extensive Primary eye care service has changed the state of eye care services in rural and urban areas.

Grameen Kalyan's Eyecare program is focused on diagnosing primary vision complications, prevention and treatment of symptoms that may lead to loss of sight. Currently, the country-wide program is annually serving over 22,254 recipients at its community health centers.

What began as the 'Prevention of Cataract Blindness Program' during the organisation's inception; has evolved into a layer of quality services under one program. Primary eye care, otherwise known as optometry, is now a vital component of Grameen Kalyan's health care service.

From 2011 to 2021, Grameen Kalyan has given care to over 96,675 people through its Eyecare program. Emphasizing primary eye care, the optical team also provides several affordable surgical cares at many of our health centers.

At Grameen Kalyan, every optometrist or ophthalmic assistant is trained in treating and handling common eye diseases namely, Chalazion, Conjunctivitis, Eyelid diseases and others. They are also trained in a range of surgical procedures including removal of foreign bodies from the eye and facilitating sight correction procedures by prescribing glasses for astigmatism, refraction, presbyopia, near-sightedness and far-sightedness.

Our expert optical team, along with visiting eye surgeons, schedule days of surgery to make the most of their time and solve sight problems for patients at our health center. Through the outpatient procedure, each year, Grameen Kalyan has performed thousands of eye surgeries to restore patients' 20/20 vision.

Since 2011, more than 9,596 affordable Cataract surgeries (through SICS / Phacoemulsification) have occurred at Kalyan’s premises. Under three convenient packages: Indian lens, USA lens (without Biometry) and Alcon lens (with Biometry) the Cataract surgeries take place at Kalyan. Other eye surgeries in Kalyan include Lacrimal Surgery, Pterygium Surgery, Eyelid Surgery, and Chalazion Surgery.

Our trained health personnel have become the go-to eye care provider for routine eye exams and post-surgical care for many patients living in marginalised communities. Patients with potentially blinding diseases are, however, immediately referred to the specialist for more advanced treatment.</p>
    </section>

    <!-- blog content report section -->
    <section class="proud-report-section">
        <div class="proud-bottom" style="background-image: url('./assets/healthcare/health-story/special-image.JPG')">
            <div class="proud-reports">
                <div class="proud-reports-grid">
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100" class="text-center"></div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100" class="text-center">
                        <p>2011 to 2021</p>
                        <h3><span class="counter-count">22254</span>+</h3>
                        <p>1,14,690</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="200" class="text-center">
                        <p>Annually</p>
                        <h3><span class="counter-count">22254</span>+</h3>
                        <p>1,14,690</p>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="100" class="text-center"></div>
                </div>
            </div>
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
