@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <!-- effort behind -->

    <section class="effort-behind">
        <div class="effort-leaf-left">
            <img src="/assets/stories/grid-leaf/grid-top-leaf.png" alt="">
        </div>
        <div class="effort-leaf-right">
            <img src="/assets/stories/grid-leaf/grid-bottom-leaf.png" alt="">
        </div>
        <div class="effort-behind-content">
            <h1>Effort Behind</h1>
            <h1>Thousand Real Stories</h1>
            <p>Since 1996, Grameen Kalyan has delivered affordable and quality primary healthcare to minimize health inequalities and economic setbacks. Our effort touched millions of people across the country and became a part of their journey of well-being.</p>
        </div>
    </section>

    <section class="millions-smile-section">
        <div class="millions-smile-header">

            <!-- people leaf -->
            <div class="people-leaf-bottom">
                <img src="/assets/people-leaf-bottom.png" alt="people-leaf">
            </div>
        </div>
        <div class="million-smile-body">
            <div class="smile-body-listings">
                <div class="woman-child">
                    <div class="smile-body-circle" id="smileCircle"></div>
                </div>
                <!-- smile-body-listings-left -->
                <div class="smile-body-listings-left">
                            <!-- <div class="smile-list-item smile-list-item-1 smile-list-item-hover-effect" image="/assets/healthcare/grid/grid-1.webp" id="smileList1">
                                <a href="/micro-health-insurance">Micror Health Insurance</p>
                            </div> -->
                        @foreach($storyCategories as $key1=>$v1)
                            @if($key1>2)
                               @continue
                            @endif
                            <div class="smile-list-item smile-list-item-{{$key1+2}} smile-list-item-hover-effect" image="{{$v1->banner_image}}" id="smileList{{$key1+1}}">
                                <a href="/story/{{$v1->id}}">{{$v1->name??''}}</p>
                            </div>
                        @endforeach

                </div>
                <!-- smile-body-listings-right -->
                <div class="smile-body-listings-right">
                           @foreach($storyCategories as $key2=>$v2)
                            @if($key2 < 3)
                               @continue
                            @endif
                            <div class="smile-list-item smile-list-item-{{$key2+2}} smile-list-item-hover-effect" image="{{$v2->banner_image}}" id="smileList{{$key2+3}}">
                                <a href="/story/{{$v2->id}}">{{$v2->name??''}}</p>
                            </div>
                        @endforeach

                </div>
                <div class="more-stories-btn" >
                    <a href="/story/9" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="700">
                        <button>More Stories</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="million-smile-body-mobile">
            <div class="women-child-container">
                <div class="women-child-container-circle" id="smileCircle"></div>
            </div>
            <div class="stories-header mt-3">
                <img src="/assets/Stories.png" alt="">
            </div>
            <div class="stories-list">
                <ul>
                @foreach($storyCategories as $key=>$v)
                    <li data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="400"><a href="/story/{{$v->id}}"><img width="80px" src="{{$v->banner_image}}"> <span>{{$v->name}}</span>
                    </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </section>

    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/stories.css">
    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/index-image-hover.js"></script>
@endsection
