@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>With a vision of bringing equity in marginalised communities in Bangladesh, Grameen Kalyan not only encased its activity within healthcare services but also aims to bring a change in other sectors. </p>
        <p>Extending its backing for the well-being of Grameen Bank borrowers, employees and their family members, Kalyan provides financial support to Grameen Bank (GB) to undertake several programs for the welfare of the GB stakeholders. By offering scholarships and higher education loans to the children of GB borrowers and welfare loans to GB employees, Kalyan is significantly contributing to achieving the dreams of GB families.</p>
        {{-- Well Being Section GB Members --}}
        <h4><u>FOR GB MEMBERS:</u></h4>
        <table class="well-being-table">
            <thead>
                <th>Higher Education Loan</th>
                <th>Higher Education Loan</th>
                <th>Higher Education Loan</th>
            </thead>
            <tbody>
                <td>BDT 2,685 million</td>
                <td>BDT 2,685 million</td>
                <td>BDT 2,685 million</td>
            </tbody>
        </table>
        
        <p class="headline">Higher Education Loan:</p>
        <p class="content">As Grameen Bank strengthens its borrowers' ability to support themselves and their families through microloans, Grameen Kalyan aims to support their children's achievement and other forms of academic success. Kalyan encourages children aspiring to pursue higher education with any means of financial support, for example paying an interest subsidy for higher education loans taken by GB borrowers. Up till the end of <strong>December 2021</strong>, Kalyan has provided a sum of over <strong>BDT 2,685 million (USD 33.70 million)</strong> as a subsidy for higher education loans. GB initially calculates 12% interest for this loan, of which the students pay only 5% applicable after the completion of their study. Meanwhile, Kalyan pays the entire 12% interest subsidy to GB during their education period and pays 7% interest subsidy after the end of their study till the loan payback is completed.</p>
       
        <p class="headline">Scholarship program:</p>
        <p class="content">Focused on incentivising the education of Grameen Bank borrowers’ and members’ children; Grameen Kalyan started its scholarship program back then in 1996. Kalyan awards scholarships in the following categories to the children for their outstanding performances in - </p>
            <ul class="list-items">
                <li>Primary School Scholarship </li>
                <li>SSC Scholarship </li>
                <li>HSC Scholarship </li>
                <li>Sports & Cultural Activities </li>
            </ul>
        <p class="content">From 1996 to <strong>December 2021</strong>, Kalyan has contributed <strong>BDT 654 million (USD 7.69 million)</strong> for this program.</p>

        <p class="headline">Support to Grameen Bank Emergency Fund: </p>
        <p class="content">Grameen Bank maintains a central emergency fund to extend support to the GB borrowers' families for funeral costs and other related costs after the death of its borrower. When there is any shortfall in the GB fund, Kalyan covers the rest. Up till December 2021, Kalyan supported and donated BDT 217.7 million (USD 2.56 million) to GB's central emergency fund.</p>
            
        {{-- Well Being Section GB Employees --}}
        <h4><u>FOR GB EMPLOYEES:</u></h4>
        <table class="well-being-table">
            <thead>
                <th>Medical loan (For GB Employees):</th>
                <th>Home appliance loan(For GB Employees) :</th>
            </thead>
            <tbody>
                <td>BDT 18.50 million</td>
                <td>BDT 1,257.60 million</td>
            </tbody>
        </table>
        
        <p class="headline">Medical loan:</p>
        <p class="content">Grameen Kalyan provides interest subsidies for medical loans borrowed by GB employees for themselves and their family members. Out of 12% imposed interest on the loan, a GB employee has to pay only 5% interest while Kalyan covers the rest 7% as a subsidy on behalf of the GB employees. Till December 2021, Kalyan has contributed BDT 18.50 million (USD 0.22 million) against this loan.</p>
       
        <p class="headline">Home appliance loan:</p>
        <p class="content">Grameen Kalyan also pays interest subsidies for home appliance loans. For this loan, a GB employee pays 5% interest, and on behalf of the employee, Kalyan pays the remaining 7% interest as a subsidy to GB until the loan is paid back. As of December 2021, Kalyan has paid <strong>BDT 1257.60 million (USD 14.79 million)</strong> for home appliance loans.</p>
        <p class="content">Apart from these, Kalyan undertakes different well-being programs which impact GB borrowers and members in the long run. <br><br> </p>
        {{-- Well Bein Section Loan Guarantee --}}
        <h4><u>LOAN GUARANTEE FOR NURSING COLLEGE STUDENTS:</u></h4>
        <p class="content">Grameen Kalyan provides a loan guarantee to the children of Grameen Bank borrowers who enrol in Grameen Caledonian College of Nursing (GCCN) thru GB education loan. The education loan is available to the students who can demonstrate their financial necessity and whose mothers have been GB Borrowers for at least two years. </p>
        <p class="content">Students who get GB Education Loan are responsible for all accrued interest and the loan principles; but they must have a loan guarantor. Here’s where Grameen Kalyan comes into play. As a guarantor of these loans, Kalyan ensures their smooth and uninterrupted nursing education. Up till now, Grameen Kalyan has provided more than 950 loan guarantee letters to the GCCN students; among them 595 students have completed their Diploma & B.Sc. graduation and the rest are enrolling.</p>
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
