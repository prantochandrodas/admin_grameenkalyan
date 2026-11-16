@extends('frontend.layouts._layout')
@section('content')
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
        <div class="vision-box-container">
            <div>
                <h2>people & culture</h2>
                <p>Human resource management is the strategic approach to the effective and efficient management of people in a company or organization such that they help their business gain a competitive advantage.
                </p>
                <p>The culture at Grameen Kalyan provides a strategic competitive advantage, beliefs and values widely shared and firmly upheld.</p>
                <p>With more effective implementation of quality improvement efforts and information systems development day by day, Kalyan provides better service and community-based primary healthcare across the country.</p>
                <p>We promote enhanced trust and cooperation, more efficient decisions, fewer disagreements, and focus on the organisation and its goals.</p>
                <p>With a strong sense of identification and a shared understanding of essential in Kalyan's goal, we want to serve people in the rural areas effectively and efficiently.</p>
            </div>
        </div>
    </section>

    <!-- management leadership -->
    <section class="management-leadership">
        <div class="management-leadership-image">
            <img src="./assets/people/leadership.png" alt="">
        </div>
    </section>

    <!-- account and finance -->
    <section class="account-finance-members">
        <!-- account finance image -->
        <div class="account-finance-image">
            <img src="./assets/people/account-finance.png" alt="">
        </div>
        <!-- main content -->
        <div class="account-finance-body">

            <div class="member-container member-container-two">
            @foreach($managements as $key1=>$value)
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
                            <h6>{{$value->designation??''}}</h6>
                        </a>
                        </div>
                    </div>
                @endforeach
                <span id="management-dots"></span>
                </div>
                @foreach($managements as $key=>$value)
                   @if($key==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
                   @if($managements && count($managements)>5)

                    <div class="member-container member-container-two">

                            @foreach($managements as $key3=>$value)
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
                                    <h6>{{$value->designation??''}}</h6>
                                </a>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    @endif
                    @foreach($managements as $key4=>$value)
                    @if($key4 == 5)
                    <div class="divider">
                    <div class="green-box_2">
                        <div class="green-box-middle"></div>
                    </div>
                    </div>
                    @endif
                    @endforeach
                   <div id="management-more">

                        @if($managements && count($managements) >10)
                            <div class="member-container member-container-two">
                            @foreach($managements as $key5=>$value)
                                @if($key5 < 8 || $key5 > 12)
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
                                        <h6>{{$value->designation??''}}</h6>
                                    </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif

                        @foreach($managements as $key6=>$value)
                        @if($key6 == 10)

                        <div class="divider">
                        <div class="green-box_3">
                            <div class="green-box-middle"></div>
                        </div>
                        </div>
                        @endif
                        @endforeach

                        </div>

                    </div>
                    @if($managements && count($managements)>10)
                    <button class="btn-readmore" onclick="managementReadmore()" id="managementReadmore">Read more</button>
                    @endif
    </section>

    <!-- account-finance -->
    <section class="account-finance"></section>

    <!-- about board members -->
    <section class="account-finance-members">
        <div class="account-finance-body">
        <div class="member-container member-container-two">
            @foreach($financeAccording as $fKey1=>$value)
                   @if($fKey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($fKey1==0){
                        $border_curve1='border-curve-left';
                      }else if($fKey1==4){
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
                            <h6>{{$value->designation??''}}</h6>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($financeAccording as $fKey2=>$value)
                   @if($fKey2==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach

            @if($financeAccording && count($managements)>4)

           <div class="member-container member-container-two">

            @foreach($financeAccording as $fKey3=>$value)
            @if($fKey3 < 5 || $fKey3 > 9)
                    @continue;
                @endif
                @php
                    if($fKey3==5){
                        $border_curve2='border-curve-left';
                    }else if($fKey3==9){
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
                    <h6>{{$value->designation??''}}</h6>
                </a>
                </div>
            </div>
            @endforeach
            </div>
            @endif
            @foreach($financeAccording as $fKey4=>$value)
            @if($fKey4 == 5)
            <div class="divider">
            <div class="green-box_2">
                <div class="green-box-middle"></div>
            </div>
            </div>
            @endif
            @endforeach
                @if($financeAccording && count($financeAccording) >9)
                    <div class="member-container member-container-two">
                    @foreach($financeAccording as $fKey5=>$value)
                        @if($fKey5 < 9 || $fKey5 > 14)
                            @continue;
                        @endif
                        @php
                                if($fKey5==10){
                                    $border_curve3='border-curve-left';
                                }else if($fKey5==14){
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
                                <h6>{{$value->designation??''}}</h6>
                            </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                @foreach($financeAccording as $fKey5=>$value)
                @if($fKey5 == 10)

                <div class="divider">
                <div class="green-box_3">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
        </div>
    </section>

    <!-- management leadership -->
    <section class="human-resource">
        <div class="human-resource-image">
            <img src="/assets/people/human-resource.png" alt="">
        </div>
    </section>

    <!-- about board members -->
    <section class="human-resource-members">
        <!-- account finance image -->
        <div class="procurement-image">
            <img src="/assets/people/procurement.png" alt="">
        </div>
        <div class="human-resource-body">
        <div class="member-container member-container-two">
            @foreach($humanResources as $hkey1=>$value)
                   @if($hkey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($hkey1==0){
                        $border_curve1='border-curve-left';
                      }else if($hkey1==4){
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
                            <h6>{{$value->designation??''}}</h6>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($humanResources as $key=>$value)
                   @if($key==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach

            @if($humanResources && count($managements)>4)

           <div class="member-container member-container-two">

            @foreach($humanResources as $hkey3=>$value)
            @if($hkey3 < 5 || $hkey3 > 9)
                    @continue;
                @endif
                @php
                    if($hkey3==5){
                        $border_curve2='border-curve-left';
                    }else if($hkey3==9){
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
                    <h6>{{$value->designation??''}}</h6>
                </a>
                </div>
            </div>
            @endforeach
            </div>
                @endif
                @foreach($humanResources as $hkey4=>$value)
                @if($hkey4 == 5)
                <div class="divider">
                <div class="green-box_2">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
                @if($humanResources && count($humanResources) >10)
                    <div class="member-container member-container-two">
                    @foreach($humanResources as $hkey5=>$value)
                        @if($hkey5 < 10 || $hkey5 > 14)
                            @continue;
                        @endif
                        @php
                                if($hkey5==10){
                                    $border_curve3='border-curve-left';
                                }else if($hkey5==14){
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
                                <h6>{{$value->designation??''}}</h6>
                            </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                @foreach($humanResources as $hkey6=>$value)
                @if($hkey6 == 10)

                <div class="divider">
                <div class="green-box_3">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
        </div>
    </section>






     <!-- management leadership -->
     <section class="procurement-resource">

        <div class="procurement-resource-image">
            <!-- <img src="/assets/people/procurement.webp" alt=""> -->
        </div>
    </section>

    <!-- about board members -->
    <section class="human-resource-members">
    <div class="grid-leaf-left">
            <img src="./assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <!-- account finance image -->
        <div class="procurement-image">
            <img src="/assets/people/audit.png" alt="">
        </div>
        <div class="human-resource-body">
        <div class="member-container member-container-two">
            @foreach($serviceProcurement as $skey1=>$value)
                   @if($skey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($skey1==0){
                        $border_curve1='border-curve-left';
                      }else if($skey1==4){
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
                            <h6>{{$value->designation??''}}</h6>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($serviceProcurement as $skey2=>$value)
                   @if($skey2==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach

            @if($serviceProcurement && count($serviceProcurement)>5)

           <div class="member-container member-container-two">

            @foreach($financeAccording as $skey3=>$value)
            @if($skey3 < 5 || $skey3 > 9)
                    @continue;
                @endif
                @php
                    if($skey3==5){
                        $border_curve2='border-curve-left';
                    }else if($skey3==9){
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
                    <h6>{{$value->designation??''}}</h6>
                </a>
                </div>
            </div>
            @endforeach
            </div>
                @endif
                @foreach($serviceProcurement as $skey4=>$value)
                @if($skey4 == 5)
                <div class="divider">
                <div class="green-box_2">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
                @if($serviceProcurement && count($serviceProcurement) >10)
                    <div class="member-container member-container-two">
                    @foreach($serviceProcurement as $skey5=>$value)
                        @if($skey5 < 10 || $skey5 > 14)
                            @continue;
                        @endif
                        @php
                                if($skey5==10){
                                    $border_curve3='border-curve-left';
                                }else if($skey5==14){
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
                                <h6>{{$value->designation??''}}</h6>
                            </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                @foreach($serviceProcurement as $skey6=>$value)
                @if($skey6 == 10)

                <div class="divider">
                <div class="green-box_3">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
        </div>
    </section>
    <!-- account-finance -->
    <section class="audit-internal"></section>
    <!-- about board members -->
    <section class="human-resource-members">
       <div class="grid-leaf-left">
            <img src="./assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="./assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
        <!-- account finance image -->
        <div class="procurement-image">
            <img src="/assets/people/branding-new.png" alt="">
        </div>



        <!-- <div class="audit-image">
            <img src="./assets/people/branding.png" alt="">
        </div> -->
        <div class="human-resource-body">
        <div class="member-container member-container-two">
            @foreach($audit as $aickey1=>$value)
                   @if($aickey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($aickey1==0){
                        $border_curve1='border-curve-left';
                      }else if($aickey1==4){
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
                            <h6>{{$value->designation??''}}</h6>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>

                @foreach($audit as $aickey=>$value)
                   @if($aickey==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach
            @if($audit && count($audit)>5)

           <div class="member-container member-container-two">
            @foreach($audit as $aickey3=>$value)
               @if($aickey3 < 5 || $aickey3 > 9)
                    @continue;
                @endif
                @php
                    if($aickey3==5){
                        $border_curve2='border-curve-left';
                    }else if($aickey3==9){
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
                    <h6>{{$value->designation??''}}</h6>
                </a>
                </div>
            </div>
            @endforeach
            </div>
                @endif
                @foreach($audit as $aickey4=>$value)
                @if($aickey4 == 5)
                <div class="divider">
                <div class="green-box_2">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
                @if($audit && count($audit)>10)
                    <div class="member-container member-container-two">
                    @foreach($audit as $aickey5=>$value)
                        @if($aickey5 < 9 || $aickey5 > 14)
                            @continue;
                        @endif
                        @php
                                if($aickey5==10){
                                    $border_curve3='border-curve-left';
                                }else if($aickey5==14){
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
                                <h6>{{$value->designation??''}}</h6>
                            </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                @foreach($audit as $aickey6=>$value)
                @if($aickey6 == 10)

                <div class="divider">
                <div class="green-box_3">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
        </div>
    </section>
    <!-- account-finance -->
    <section class="brand-secretariat"></section>
    <section class="human-resource-members">
       <div class="grid-leaf-left">
            <img src="./assets/about/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="grid-leaf-right">
            <img src="./assets/about/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>

        <!-- <div class="audit-image">
            <img src="./assets/people/branding.png" alt="">
        </div> -->
        <div class="human-resource-body">
        <div class="member-container member-container-two">
            @foreach($branding as $bmsKey1=>$value)
                   @if($bmsKey1 > 4)
                     @continue;
                   @endif
                   @php
                      if($bmsKey1==0){
                        $border_curve1='border-curve-left';
                      }else if($bmsKey1==4){
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
                            <h6>{{$value->designation??''}}</h6>
                        </a>
                        </div>
                    </div>
                @endforeach
                </div>
                @foreach($branding as $bmsKey=>$value)
                   @if($bmsKey==1)
                   <div class="divider">
                   <div class="green-box_1">
                       <div class="green-box-middle"></div>
                   </div>
                   </div>
                   @endif
                   @endforeach

            @if($audit && count($audit)>5)

           <div class="member-container member-container-two">

            @foreach($branding as $bmsKey3=>$value)
            @if($bmsKey3 < 5 || $bmsKey3 > 9)
                    @continue;
                @endif
                @php
                    if($bmsKey3==5){
                        $border_curve2='border-curve-left';
                    }else if($bmsKey3==9){
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
                    <h6>{{$value->designation??''}}</h6>
                </a>
                </div>
            </div>
            @endforeach
            </div>
                @endif
                @foreach($branding as $bmsKey4=>$value)
                @if($bmsKey4 == 5)
                <div class="divider">
                <div class="green-box_2">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
                @if($branding && count($branding) >10)
                    <div class="member-container member-container-two">
                    @foreach($audit as $bmskey5=>$value)
                        @if($bmskey5 < 10 || $bmskey5 > 14)
                            @continue;
                        @endif
                        @php
                                if($bmskey5==10){
                                    $border_curve3='border-curve-left';
                                }else if($bmskey5==14){
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
                                <h6>{{$value->designation??''}}</h6>
                            </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                @foreach($branding as $bmskey6=>$value)
                @if($bmskey6 == 10)

                <div class="divider">
                <div class="green-box_3">
                    <div class="green-box-middle"></div>
                </div>
                </div>
                @endif
                @endforeach
        </div>
    </section>
    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/corporate.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script> -->
    <!-- <script src="/js/counter.js"></script> -->
    <!-- <script src="/js/index-image-hover.js"></script> -->
    <!-- <script src="/js/dropdown.js"></script> -->
        <script>
            function managementReadmore() {
                var dots = document.getElementById("management-dots");
                var moreText = document.getElementById("management-more");
                var btnText = document.getElementById("managementReadmore");

                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Read more";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Read less";
                    moreText.style.display = "grid";
                }
        }
        </script>
        <style>
            #management-more{display: none;}
            .btn-readmore{
                background-color: #0c612d;
                color: #fff;
                border: 2px solid #279552;
                border-radius: 5px;
                padding: 2px 8px;
            }
        </style>
@endsection
