@extends('frontend.layouts._layout')
@section('content')
   <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

<section class="bio-header-content">
        <div class="header-content-image">
            <img src="{{$row->profile_photo}}" alt="bio">
        </div>
        <div class="header-content-text">
            <div class="text-body">
                <p>{!!$row->desc!!}</p>
            </div>
            <div class="text-footer">
                <h5>{{$row->name??''}}</h5>
                <h6>{{$row->designation??''}}</h6>
            </div>
        </div>
    </section>

    <section class="back-button">
        <a href="{{ url()->previous() }}">back</a>
    </section>
    <!-- stories -->
@include('frontend.partials.stories-section')

@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/bio.css">

<script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<!-- <script src="/js/index.js"></script> -->
<script src="/js/health-image-hover.js"></script>
<!-- <script src="/js/dropdown.js"></script> -->
@endsection

