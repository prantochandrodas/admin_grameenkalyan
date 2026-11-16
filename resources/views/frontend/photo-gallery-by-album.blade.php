@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <!-- vision and mission -->
    <section class="photo-container align-items-center justify-content-center">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                @foreach($albums as $key1=>$album)
                <button class="nav-link @if($key1==0) active @endif" id="photo_album_id{{$key1}}" data-bs-toggle="tab" data-bs-target="#pills-album{{$key1}}" type="button" role="tab" aria-controls="nav-home{{$key1}}" aria-selected="true">{{$album->title}}</button>
                @endforeach

           </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach($albums as $key2=>$albumItems)
            <div class="tab-pane fade @if($key2==0)show active @endif" id="pills-album{{$key2}}" role="tabpanel" aria-labelledby="photo_album_id{{$key2}}">
                <ul class="image-gallery">
                    @foreach($albumItems->getPhotos as $key=>$latestPhoto)
                    <li>
                        <img src="{{$latestPhoto->thumb_image}}" alt="" />
                        <div class="overlay"><span>{{$latestPhoto->title}}</span></div>
                    </li>
                    @endforeach

                </ul>
            </div>
            @endforeach
        </div>

<!--        <div>{!! $latestPhotoes->appends(request()->query())->links('pagination::bootstrap-4') !!}</div>-->
    </section>

@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/photo-gallery.css">
<script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
@endsection
<style>
    /* ======================================
Responsive Image gallery Style rules
======================================*/
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        padding: 40px 5%;
    }

    .heading-text {
        margin-bottom: 2rem;
        font-size: 2rem;
    }

    .heading-text span {
        font-weight: 100;
    }

    ul {
        list-style: none;
    }

    /* Responsive image gallery rules begin*/

    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-left: 0;
    }
    .image-gallery > li {
        flex: 1 1 auto; /* or flex: auto; */
        height: 300px;
        cursor: pointer;
        position: relative;
    }

    .image-gallery::after {
        content: "";
        flex-grow: 999;
    }

    .image-gallery li img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        vertical-align: middle;
        border-radius: 5px;
    }

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(57, 57, 57, 0.502);
        top: 0;
        left: 0;
        transform: scale(0);
        transition: all 0.2s 0.1s ease-in-out;
        color: #fff;
        border-radius: 5px;
        /* center overlay content */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* hover */
    .image-gallery li:hover .overlay {
        transform: scale(1);
    }
    .page-item.active .page-link{
        background-color: #09612e !important;
        border-color: #09612e !important;
        color: #fff !important;
    }
    .pagination .active{

    }
     .pagination a{
        color: #09612e !important;
    }
</style>
