@extends('frontend.layouts._layout')
@section('content')
<!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

    <!-- vision and mission -->
    <section class="photo-container align-items-center justify-content-center">
        <h2>{{$latestPhotoes[0]->getPhotoAlbum->title??''}}</h2>
        <ul class="image-gallery">
            @foreach($latestPhotoes as $key=>$latestPhoto)
            <li class="gallery-item" imageItem="{{$latestPhoto->thumb_image}}">
                <img src="{{$latestPhoto->thumb_image}}" alt="" />
                <div class="overlay"><span>{{$latestPhoto->title}}</span></div>
            </li>
            @endforeach

        </ul>
        <div class="row">
            <div class="col-1"><a href="/photo-album">Back</a></div>
            <div class="col-11 d-flex">
                <div class="mx-auto">
                    {!! $latestPhotoes->appends(request()->query())->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>

<!--        <img id="myImg" src="/uploads/gallery/thumb_image/1658305317_yunus.jpg" alt="Snow" style="width:100%;max-width:300px">-->
    </section>
<div id="photo-gallery-modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImageItem">
    <div id="caption"></div>
</div>
@endsection
@section('scripts')
@parent
<link rel="stylesheet" href="/css/scss/photo-gallery.css">
<script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    $('.gallery-item').on('click',function (){
        var modal = document.getElementById("photo-gallery-modal");
        var modalImg = document.getElementById("modalImageItem");
        modalImg.src=$(this).attr('imageItem');
        modal.style.display = "block";
        $('#photo-gallery-modal').modal('show');
    });

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        $('#photo-gallery-modal').modal('hide');
    }
</script>
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
    .photo-container{
        margin-bottom: 12rem;
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
    .photo-container a{
        color: #0e6662;
        text-decoration: none;
    }
    .photo-container a:hover{
        color: #0e6662;
        text-decoration: none;
    }
    .photo-container h2{
        color: #0b612d;
        font-weight: 900;
        font-size: 6vmin;
    }



    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }

</style>

