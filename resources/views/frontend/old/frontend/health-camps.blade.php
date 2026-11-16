@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>Grameen Kalyan has come a long way since the beginning of its journey, from small scale informational meetings in  Uthan Baithak - backyard meetings in rural areas to provide necessary information about nutrition, health, family planning services etc. Through its 140 health centers, Kalyan's countrywide community-based primary health care has evolved and met the previously deprived communities' need for primary healthcare. </p>
        <p>Aiming to bring awareness and promote health equality, Grameen Kalyan has never bound itself by only setting up health centers and waiting for patients to visit those. With the help of Community Health Assistants (CHAs) and dedicated health workers, Kalyan regularly arranges Satellite (outdoor) Camps & School camps in the locality. Occasionally, disease & diagnosis-specific medical camps are set up at the health centers where people can get expert's opinions, consultation, and other health services affordably.  </p>
        <p>A basic check-up and screening at the early stages of an ailment can help detect and cure people faster, saving precious lives in the process. By providing various health care services across the nation, Kalyan has become a trusted healthcare provider. Now people living below the poverty line can afford the health care service, which earlier could not be afforded due to the cutthroat expense. As such, people can live longer, happier and healthier when proper screening, health check-ups, tests and treatments are available conveniently.    </p>
        <div class="main-blog-content-grid">
            <div>
                <p class="headline">29,410+ </p>
                <p>Annual Heath Camps</p>
            </div>
        </div>
        <p>Since its inception, Kalyan has been organising numerous health camps at its centers and hard-to-reach areas to bring healthcare closer to people. Currently, there are 36 doctors but each year, Kalyan welcomes and recruits more doctors from different fields to bring affordability and accessibility of healthcare across the country. Through these efforts, Kalyan wants to ensure people in low and middle-income communities are getting the right healthcare at the right time with early detection.  </p>
        <p>Every year, Grameen Kalyan attempts to organize six types of disease-specific health camps to handle chronic illnesses, prevent contagious diseases and provide a remedy for curable diseases. Each of those camps serves mass people quality services with varieties of specialised and comprehensive medical care.  </p>
        <p>A brief specification of the medical camps is following: </p>
        <p class="headline">Gynaecology & Obstetric Camp: </p>
        <ul>
            <li>Treating gynaecological & obs issues; </li>
            <li>Counselling and following up on pre-identified gynae & obs patients; </li>
            <li>Treating pregnant patients' on various pregnancy-related complications diseases; </li>
            <li>Referring the complicated cases to higher health facilities.</li>
        </ul>

        <p class="headline">Eye Care Camp: </p>
        <ul>
            <li>Screening refraction and prescribing spectacles if needed;</li>
            <li>Screening for cataract and other eye complications;  </li>
            <li>Performing cataract and other minor eye surgeries at a minimum cost; </li>
            <li>Referring the complicated cases to higher health facilities.</li>
        </ul>

        <p class="headline">ENT (Ear, Nose & Throat) Camp:  </p>
        <ul>
            <li>Screening for ENT problems,</li>
            <li>Providing primary treatment to ENT patients with no intervention;  </li>
            <li>Referring the complicated/surgical cases to advanced health facilities.</li>
        </ul>

        <p class="headline">Tele-Camp:  </p>
        <ul>
            <li>Camps for patients at health centers to communicate issues and complications to specialized doctors, virtually, through video and audio calls;</li>
            <li>Smartphones, Tabloid devices, PCs etc. are provided as means of communication;  </li>
            <li>Each camp is attended by 15-25 patients at a pre-fixed time;</li>
            <li>Patients' chief health complaints and medical history are recorded by DMF/ Paramedics at the health center before the doctor consultation;</li>
            <li>On receiving a call, the Doctor attends to the patients, listens to the complaint, advises on appropriate examination/tests, and suggests medicine, follow-up, or recommends referral to higher health facilities (if needed).</li>
        </ul>

        <p class="headline">Diabetes Awareness Camp:   </p>
        <ul>
            <li>Blood Glucose tests and monitoring, </li>
            <li>Raising awareness about diabetes & associated complications;  </li>
            <li>Following up of diabetic patients,</li>
            <li>Referring the complicated cases to the higher health facilities.</li>
        </ul>
        <p class="headline">Outreach Health Camps:    </p>
        <ul>
            <li>Organising and operating regular satellite camps by DMF, Paramedics, and Community Health Assistants at the vicinity of health centers;</li>
            <li>Organising and conducting free school camps; </li>
            <li>Raising awareness among the teachers and students during school camps;</li>
            <li>Encouraging rural communities to take treatment from their nearby Grameen Kalyan health centers </li>
        </ul>
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
