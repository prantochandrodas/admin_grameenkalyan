@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>In Amkhola, under Galachipa Upazila of Patuakhali District, Hasna Banu and her 5 family members live in a small house. Her house is in a remote rural area, located three miles away from the main road. Most people’s livelihoods like hers come through agriculture and animal rearing. Today, she is worried about her 5-month-pregnant daughter who will see a doctor at Grameen Kalyan health center. The son-in-law left her daughter after two years of marriage for reasons of unsatisfactory dowry forcing her with her mother, Hasna Banu. Finding some complications in her daughter, the Community Health Assistant in the area suggested that she should see the doctor coming that week at their health center.</p>
        <p>Upon her visit to the health center, Hasna Banu found the service was fast-moving with her daughter being cared for by the health staff. However, the DMF at the center asked them to come back again for routine check-ups along with some procedural tests. Hearing that, Hasna Banu became hesitant at the thought of bearing extra expenses while considering the risk of expenses for other family members in case they fall sick too. How will she then bear all the costs?</p>
        <p>After disclosing her concern to the DMF, she first came to know of Grameen Kalyan’s Micro Health Insurance. The DMF suggested, “Why don’t you take our Micro Health insurance? It will decrease the overall medical cost even more, and make treatment affordable for your daughter and family in the long run.”    </p>
        <p>To enable marginalized and low-income populations to afford the best primary health care, Grameen Kalyan introduced Micro Health Insurance (MHI) scheme. Since the inception of the project, the goal of it has been to focus and work based on people’s best interests     </p>
        <p>By paying only BDT 200 (USD 2.4) for Grameen Bank (GB) borrowers and BDT 300 (USD 3.5) for Non-GB households, one can take an annual health insurance policy. 
Each health insurance policy covers up to 6 members of a family. According to our data from 2011 to 2020, Kalyan has insured 2,73,574 people under its Micro Health Insurance policy, and the number continues to grow.</p>
        <p class="headline">The Micro Health Insurance (MHI) cardholders can avail of the following benefits: </p>
        <ul>
            <li>25% discount on consultation fees; </li>
            <li>25% discount on pathological tests available in Grameen Kalyan Health Center; </li>
            <li>10% discount on medicine;  </li>
            <li>20% discount on regular blood sugar tests for diabetic patients; </li>
            <li>Quarterly free health check-up at home for six members in the family;</li>
            <li>Compensation of up to BDT 2,000 (USD 24) for hospitalization.  </li>
        </ul>
        <p>With MHI cardholders increasing to over 45,855 people annually Grameen Kalyan introduced an option for half-yearly coverage, which has become famous among the rural people due to its cost-friendly package.</p>
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
