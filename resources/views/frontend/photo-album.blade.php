@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')
    <!-- vision and mission -->
    <section class="photo-container align-items-center justify-content-center">
<!--        <ul class="image-gallery">-->
<!--            @foreach($albums as $key=>$album)-->
<!--            <li>-->
<!--                <img src="{{$album->album_photo}}" alt="" />-->
<!--                <a href="/photo-gallery/{{$album->id}}"><div class="overlay"><span>{{$album->title}}</span></div></a>-->
<!--            </li>-->
<!--            @endforeach-->
<!--        </ul>-->
        <div class="row">
            @foreach($albums as $key=>$album)
            <div class="col-12 col-sm-8 col-md-4 col-lg-3">
                <div class="card">
                    <div class="album_photo">
                        <a href="/photo-gallery/{{$album->id}}"><img class="card-img" src="{{$album->album_photo}}" alt="" /></a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="/photo-gallery/{{$album->id}}"><span>{{$album->title}}</span></a>
                        </h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </section>
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/photo-album.css">
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
    .card{
        overflow: hidden;
        background-color: #09612e !important;
        margin-bottom: 10px;
        border-radius:.25rem .25rem 30px 30px !important;
    }
    .album_photo{
        height: 250px;
    }
    .album_photo img{
        object-fit: cover;
        width: 100%;
        height: 100%;
        vertical-align: middle;
        border-radius: 5px 5px 40px 40px;;

        -webkit-transition: 0.4s ease;
        transition: 0.4s ease;
    }
    .photo-container .card-title{
        margin: .5rem  1rem;
    }
    .photo-container .card-title a{
        text-decoration: none;
        color: #fff;
        font-size: 17px;
    }
    .photo-container .card-title a:hover{
        color: #dee2e6;
        font-size: 18px;
    }

    .image-card img {
        -webkit-transition: 0.4s ease;
        transition: 0.4s ease;
    }

    .card:hover .album_photo img {
        -webkit-transform: scale(1.08);
        transform: scale(1.08);
    }
    .photo-container.card-title{
        min-height: 48px;
    }



    .photo-container{
        margin-bottom: 12rem;
    }
    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-left: 0;
    }
    .image-gallery > li {
        flex: 1 1 auto; /* or flex: auto; */
        max-width: 300px;
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
    .card-body{
        background-color: #09612e;
        min-height: 80px;
    }
</style>
