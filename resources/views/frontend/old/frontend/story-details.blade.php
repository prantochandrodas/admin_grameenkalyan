@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <section class="main-blog-content">
        <p>{!!$story->desc??''!!}</p>
    </section>

    <section class="main-blog-content-footer">
        <a href="/story/{{$story->category_id}}">back</a>
    </section>

    <!-- recent post slider -->
    <section class="comment-container">
        <div class="comment-post-header">
            <h2>Comments</h2>
            <div class="white-box">
                <div class="green-box"></div>
            </div>
        </div>
        <div class="comment-post-form">
            <form action="/post-comment" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="content_id" value="{{ $story->id }}">
             <div class="form-group row g-3 align-items-center mt-3">
                <div class="col-md-2">
                    <label for="name" class="col-form-label">Full Name <span class="text-danger">*</span> : </label>
                </div>
                <div class="col-md-6">
                    <input required type="text" id="name" name="name" min="3" max="20" class="form-control" aria-describedby="nameHelpLine" value="{{old('name')}}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <span id="nameHelpLine" class="form-text">
                      Must be 3-20 characters long.
                    </span>
                </div>
            </div>
             <div class="form-group row align-items-center mt-3">
                <div class="col-md-2">
                    <label for="email" class="col-form-label">Email ID <span class="text-danger">*</span> : </label>
                </div>
                <div class="col-md-6">
                    <input required type="email" id="email" name="email" min="3" max="20" class="form-control" aria-describedby="emailHelpLine" value="{{old('email')}}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <span id="emailHelpLine" class="form-text">
                      Email should be valid email.
                    </span>
                </div>
                </div>
             <div class="form-group row g-3 align-items-center mt-3">
                <div class="col-md-2">
                    <label for="comment" class="col-form-label">Comment <span class="text-danger">*</span> : </label>
                </div>
                <div class="col-md-6">
                    <textarea required rows="4" cols="8" id="comment" name="comment" min="3" max="100" class="form-control" aria-describedby="commentHelpLine">{{old('comment')}}</textarea>
                    @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <span id="commentHelpLine" class="form-text">
                      Must be 3-100 characters long.
                    </span>
                </div>
                </div>
                <div class="form-group row g-3 align-items-center mt-3">
                <div class="col-md-6 text-center">
                    <button type="submit">Post Comment</button>
                </div>
                </div>
            </form>
        </div>
        <div class="comment-show mt-4" id="comment-show">
            @foreach($comments as $comment)
            <div class="single-comment">
                <h6>{{$comment->getUser->name??''}}  <span class="time-track">{{$comment->created_at??''}}</span></h6>
                <p>{{$comment->comment??''}}</p>
            </div>
            @endforeach
        </div>
    </section>
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
                    <a href="#">
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
    <link rel="stylesheet" href="/css/scss/singleBlog.css">
    <link rel="stylesheet" href="/css/scss/slick.css">
    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/custom-slick.js"></script>

@endsection
