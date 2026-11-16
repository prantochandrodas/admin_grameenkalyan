@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

<!-- vision and mission -->
<section class="vision-container d-flex align-items-center justify-content-center">
    <!-- leafs -->
    <div class="grid-leaf-left">
        <img src="/assets/about/grid-leaf/grid-top-leaf.png" alt="">
    </div>
    <div class="grid-leaf-right">
        <img src="/assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
    </div>
    <div class="our-doctors">
        <img src="/assets/people/our-doctors.png" alt="">
    </div>
    <div class="vision-box-container">
        <div>
            <p>Making a cost-effective, equitable, self-sustainable and extended rural health program for the low-income population by implementing the concept of community-based health centres, bringing the affordable Primary Healthcare to the doorsteps of the villagers and mobilizing beneficiaries through Micro Health Insurance scheme.
            </p>
        </div>
    </div>
</section>

<!-- management leadership -->
<section class="management-leadership">

</section>

<!-- account and finance -->
<section class="account-finance-members">
    <!-- account finance image -->
    <div class="grid-leaf-left">
            <img src="./assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="./assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
    <div class="account-finance-image">
        <img src="/assets/people/dmfs.png" alt="">
    </div>
    <!-- main content -->
    <div class="account-finance-body">
        <!-- layer 1 -->

        <div class="member-container member-container-two">
            @foreach($doctors as $key1=>$value)
                   @if($key1 > 4)
                     @continue;
                   @endif
                   @php
                      if($key1==0){
                        $border_curve1='border-curve-left';
                      }else if($key1==4){
                        $border_curve1='border-curve-right';
                      }else{
                        $border_curve1='border-curve';
                      }
                   @endphp
                    <div class="member-container-two-container">
                        <div class="member-image  {{$border_curve1}}">
                        <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                        </div>
                        <div class="member-details">
                        <a href="#">
                            <h4>{{$value->name??''}}</h4>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($doctors as $key=>$value)
                   @if($key==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   <span id="doctors-dots"></span>
                   @endif
                   @endforeach
                   @if($doctors && count($doctors)>5)

                   <div class="member-container member-container-two">

                              @foreach($doctors as $key3=>$value)
                              @if($key3 < 5 || $key3 > 9)
                                   @continue;
                                 @endif
                                 @php
                                    if($key3==5){
                                        $border_curve2='border-curve-left';
                                    }else if($key3==9){
                                        $border_curve2='border-curve-right';
                                    }else{
                                        $border_curve2='border-curve';
                                    }
                                @endphp
                              <div class="member-container-two-container">
                                  <div class="member-image {{$border_curve2}}">
                                  <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                  </div>
                                  <div class="member-details">
                                  <a href="#">
                                    <h4>{{$value->name??''}}</h4>
                                </a>
                                  </div>
                              </div>
                              @endforeach
                              </div>
                   @endif
                  @foreach($doctors as $key4=>$value)
                   @if($key4 == 5)
                   <div class="divider">
                   <div class="green-box_2">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach

                   <div id="doctors-more">
                   @if($doctors && count($doctors) >10)
                        <div class="member-container member-container-two">
                        @foreach($doctors as $key5=>$value)
                            @if($key5 < 10 || $key5 > 30)
                                @continue;
                            @endif
                            @php
                                    if($key5==10){
                                        $border_curve3='border-curve-left';
                                    }else if($key5==14){
                                        $border_curve3='border-curve-right';
                                    }else{
                                        $border_curve3='border-curve';
                                    }
                                @endphp
                            <div class="member-container-two-container">
                                <div class="member-image {{$border_curve3}}">
                                <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                </div>
                                <div class="member-details">
                                <a href="#">
                                    <h4>{{$value->name??''}}</h4>
                                </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        @foreach($doctors as $dKey6=>$value)
                        @if($dKey6 == 10 ||$dKey6==15)
                        <div class="divider">
                                <div class="green-box_3">
                                    <div class="green-box-middle"></div>
                                </div>
                        </div>
                        @endif
                   @endforeach
                   @endif
                   </div>
           </div>
    </div>
    @if($doctors && count($doctors)>10)
        <button class="btn-readmore" onclick="doctorsReadmore()" id="doctorsReadmore">Read more</button>
    @endif
</section>

<!-- account-finance -->
<section class="account-finance"></section>
<section class="account-finance-members">
    <!-- account finance image -->
    <div class="grid-leaf-left">
            <img src="./assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="./assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
    <div class="account-finance-image">
        <img src="/assets/people/health-assistants.png" alt="">
    </div>
    <!-- main content -->
    <div class="account-finance-body">
        <!-- layer 1 -->

        <div class="member-container member-container-two">
            @foreach($dmfs as $dmfKey1=>$value)
                   @if($dmfKey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($dmfKey1==0){
                        $border_curve1='border-curve-left';
                      }else if($dmfKey1==4){
                        $border_curve1='border-curve-right';
                      }else{
                        $border_curve1='border-curve';
                      }
                   @endphp
                    <div class="member-container-two-container">
                        <div class="member-image  {{$border_curve1}}">
                        <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                        </div>
                        <div class="member-details">
                        <a href="#">
                            <h4>{{$value->name??''}}</h4>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($dmfs as $dmfKey=>$value)
                   @if($dmfKey==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
                   @if($dmfs && count($dmfs)>5)

                   <div class="member-container member-container-two">
                              @foreach($dmfs as $dmfKey3=>$value)
                              @if($dmfKey3 < 5 || $dmfKey3 > 9)
                                   @continue;
                                 @endif
                                 @php
                                    if($dmfKey3==5){
                                        $border_curve2='border-curve-left';
                                    }else if($dmfKey3==9){
                                        $border_curve2='border-curve-right';
                                    }else{
                                        $border_curve2='border-curve';
                                    }
                                @endphp
                              <div class="member-container-two-container">
                                  <div class="member-image {{$border_curve2}}">
                                  <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                  </div>
                                  <div class="member-details">
                                  <a href="#">
                                    <h4>{{$value->name??''}}</h4>
                                </a>
                                  </div>
                              </div>
                              @endforeach
                              </div>
                   @endif
                  @foreach($dmfs as $dmfKey4=>$value)
                   @if($dmfKey4 == 5)
                   <div class="divider">
                   <div class="green-box_2">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
                   @if($dmfs && count($dmfs) >10)
                        <div class="member-container member-container-two">
                        @foreach($dmfs as $dmfKey5=>$value)
                            @if($dmfKey5 < 9 || $key5 > 14)
                                @continue;
                            @endif
                            @php
                                    if($dmfKey5==10){
                                        $border_curve3='border-curve-left';
                                    }else if($dmfKey5==14){
                                        $border_curve3='border-curve-right';
                                    }else{
                                        $border_curve3='border-curve';
                                    }
                                @endphp
                            <div class="member-container-two-container">
                                <div class="member-image {{$border_curve3}}">
                                <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                </div>
                                <div class="member-details">
                                <a href="#">
                                    <h4>{{$value->name??''}}</h4>
                                </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                   @endif

                @foreach($dmfs as $dmfKey6=>$value)
                   @if($dmfKey6 >= 10)

                   <div class="divider">
                   <div class="green-box_3">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
           </div>


    </div>
</section>
<!-- health assistants group -->
<section class="health-assistants-group"></section>
<section class="account-finance-members doctors-assistant">
    <!-- account finance image -->
    <div class="grid-leaf-left">
            <img src="./assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="./assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
    <!-- main content -->
    <div class="account-finance-body">
        <!-- layer 1 -->

        <div class="member-container member-container-two">
            @foreach($doctorAssistants as $haKey1=>$value)
                   @if($haKey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($haKey1==0){
                        $border_curve1='border-curve-left';
                      }else if($haKey1==4){
                        $border_curve1='border-curve-right';
                      }else{
                        $border_curve1='border-curve';
                      }
                   @endphp
                    <div class="member-container-two-container">
                        <div class="member-image  {{$border_curve1}}">
                        <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                        </div>
                        <div class="member-details">
                        <a href="#">
                            <h4>{{$value->name??''}}</h4>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($doctorAssistants as $haKey=>$value)
                   @if($haKey==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
                   @if($doctorAssistants && count($doctorAssistants)>5)

                   <div class="member-container member-container-two">

                              @foreach($doctorAssistants as $haKey3=>$value)
                              @if($haKey3 < 5 || $key3 > 9)
                                   @continue;
                                 @endif
                                 @php
                                    if($haKey3==5){
                                        $border_curve2='border-curve-left';
                                    }else if($haKey3==9){
                                        $border_curve2='border-curve-right';
                                    }else{
                                        $border_curve2='border-curve';
                                    }
                                @endphp
                              <div class="member-container-two-container">
                                  <div class="member-image {{$border_curve2}}">
                                  <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                  </div>
                                  <div class="member-details">
                                  <a href="#">
                                    <h4>{{$value->name??''}}</h4>
                                </a>
                                  </div>
                              </div>
                              @endforeach
                              </div>
                   @endif
                  @foreach($doctorAssistants as $haKey4=>$value)
                   @if($haKey4 > 5)
                   <div class="divider">
                   <div class="green-box_2">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
                   @if($doctorAssistants && count($doctorAssistants) >8)
                        <div class="member-container member-container-two">
                        @foreach($doctorAssistants as $key5=>$doctorAssistants)
                            @if($haKey4 < 9 || $haKey4 > 14)
                                @continue;
                            @endif
                            @php
                                    if($haKey4==10){
                                        $border_curve3='border-curve-left';
                                    }else if($haKey4==14){
                                        $border_curve3='border-curve-right';
                                    }else{
                                        $border_curve3='border-curve';
                                    }
                                @endphp
                            <div class="member-container-two-container">
                                <div class="member-image {{$border_curve3}}">
                                <a href="#"><img src="{{$value->profile_photo??'#'}}" alt=""></a>
                                </div>
                                <div class="member-details">
                                <a href="#">
                                    <h4>{{$value->name??''}}</h4>
                                </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                   @endif

                @foreach($doctorAssistants as $haKey6=>$value)
                   @if($haKey6 >= 10)

                   <div class="divider">
                   <div class="green-box_3">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
           </div>


    </div>
</section>

<!-- stories -->
@include('frontend.partials.stories-section');
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/healthforce.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script> -->
    <!-- <script src="/js/counter.js"></script> -->
    <script src="/js/index-image-hover.js"></script>
    <!-- <script src="/js/dropdown.js"></script> -->
    <script>
            function doctorsReadmore() {
                var dots = document.getElementById("doctors-dots");
                var moreText = document.getElementById("doctors-more");
                var btnText = document.getElementById("doctorsReadmore");

                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Read More";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Read Less";
                    moreText.style.display = "grid";
                }
        }
        </script>
        <style>
            #doctors-more{display: none;}
            .btn-readmore{
                background-color: #0c612d;
                color: #fff;
                border: 2px solid #279552;
                border-radius: 5px;
                padding: 2px 8px;
            }
        </style>
@endsection
