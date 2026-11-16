@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container');
    <!-- info boxes -->
@include('frontend.partials.info-box-container');

<section class="post-collection-container">
        <!-- single post -->
        @forelse ($stories as $key=>$story)
        <div class="single-post-row">
            <div class="row h-100">
                <div class="col-lg-6 col-md-6 col-12 post-img">
                    <div class="border-white-box">
                        <div class="border-green-box"></div>
                    </div>
                    <img src="{{$story->thumb_image??''}}" alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-12 h-100 post-details">
                    <div class="post-details-header">
                        <h5>{{$story->short_desc??''}}</h5>
                        <h2>{{$story->title??''}}</h2>
                    </div>
                    <div class="post-details-body">
                        <p>{!! wordSummary($story->desc??'', 250)!!}...</p>
                    </div>
                    <div class="post-details-footer">
                        <a href="/story-details/{{$story->id}}">read more</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        No Data Available!
        @endforelse
    </section>

    <!-- recent post slider -->

    <section class="recent-post-container">
        <div class="recent-post-header">
            <h2>recent posts</h2>
            <div class="white-box">
                <div class="green-box"></div>
            </div>
        </div>
        <div class="recent-post-body">
            <div class="row recent-slider">
            @forelse ($relatedStories as $key1=>$relatedStory)
            <div class="col-lg-12 recent-post-space">
                <a href="/story-details/{{$relatedStory->id}}">
                    <div class="recent-post-card">
                        <div class="post-card-image">
                            <img src="{{$relatedStory->banner_image}}" alt="">
                        </div>
                        <div class="post-card-body">
                            <h2>{{$relatedStory->title??''}}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            No Data Found!
            @endforelse
            </div>
        </div>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/blogCollection.css">
<link rel="stylesheet" href="/css/scss/slick.css">
    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script>
    <script src="/js/dropdown.js"></script> -->
    <script src="/js/slick.min.js"></script>
    <script src="/js/custom-slick.js"></script>

@endsection
