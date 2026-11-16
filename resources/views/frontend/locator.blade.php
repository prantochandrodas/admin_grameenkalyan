@extends('frontend.layouts._layout')
@section('content')
   <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="about-grid-section">
        <div class="top-left-leaf">
            <img src="/assets/healthcare/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="about-grid-container">
            <div class="about-grid-container-header">
                <h2>Regional Office across Bangladesh</h2>
            </div>
            <div class="about-grid-container-body">
                <div class="row">
                     @foreach($locators as $locKey=>$locator)
                     @php
                        $grid='right';
                         if(isEven($locKey)){
                            $grid='left';
                        }
                     @endphp
                     <div class="col-lg-6 col-md-6 col-12 px-0">
                        <div class="about-grid-item grid-border-{{$grid}}">
                            <div class="grid-content grid-content-{{$grid}} grid-content-text d-flex justify-content-center">
                                <div>
                                    <h3>{{$locator->title??''}}</h3>
                                    <p>
                                        <a style="text-decoration:none; color:inherit;" href="{{$locator->map_location??'#'}}">{{$locator->address??''}}</a>
                                    </p>
                                    <p>{{$locator->contact_info??''}}</p>
                                </div>
                            </div>
                            <div class="green-box">
                                <div class="green-box-middle"></div>
                            </div>
                        </div>
                    </div>
                     @endforeach
            </div>
        </div>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/locator.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script>
    <script src="/js/counter.js"></script>
    <script src="/js/index-image-hover.js"></script>
    <script src="/js/dropdown.js"></script> -->

@endsection
