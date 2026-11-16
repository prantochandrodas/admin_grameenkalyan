@extends('frontend.layouts._layout')
@section('content')

    <!-- vision and mission -->
    <section class="video-container align-items-center justify-content-center">
        <div class="container">
            <div class="main-video">
                <iframe id="youtubePlayer" src="https://www.youtube.com/embed/{{$latestVideos[0]->video_link??''}}" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="videos">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="border-right nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><span>Lasted</span></button>
                         <button class="border-right nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span>Most Viewed</span></button>
                        <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><span>Recommended</span></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade  show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div id="latest-video" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @foreach($latestVideos as $key2=>$latestVideo)
                                <div class="carousel-item @if($key2==0) active @endif">
                                    <div class="video_item col-md-3 col-sm-6" content_id="{{$latestVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$latestVideo->video_link}}">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="{{$latestVideo->thumb_image}}" class="img-fluid">
                                            </div>
                                            <div class="card-img-overlay">{{$latestVideo->title}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev bg-transparent w-aut" href="#latest-video" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next bg-transparent w-aut" href="#latest-video" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div id="most-visited" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @foreach($mostViewedVideos as $key2=>$mostViewedVideo)
                                <div class="carousel-item @if($key2==0) active @endif">
                                    <div class="video_item col-md-3 col-sm-6" content_id="{{$mostViewedVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$mostViewedVideo->video_link}}">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="{{$mostViewedVideo->thumb_image}}" class="img-fluid">
                                            </div>
                                            <div class="card-img-overlay">{{$mostViewedVideo->title}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev bg-transparent w-aut" href="#most-visited" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next bg-transparent w-aut" href="#most-visited" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="recommended" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @foreach($recommendedVideos as $key=>$recommendedVideo)

                                <div class="carousel-item @if($key==0) active @endif">
                                    <div class="video_item col-md-3 col-sm-6" content_id="{{$recommendedVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$recommendedVideo->video_link}}">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="{{$recommendedVideo->thumb_image}}" class="img-fluid">
                                            </div>
                                            <div class="card-img-overlay">{{$recommendedVideo->title}}LLL</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev bg-transparent w-aut" href="#recommended" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next bg-transparent w-aut" href="#recommended" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- jquery cdn link -->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    </section>
    <section class="video-list-container align-items-center justify-content-center">
        <div class="container">
            <div class="video-list">
                <div class="row">
                    @foreach($allVideos as $key3=>$allVideo)
                    <div class="video-list-item col-md-3" content_id="{{$allVideo->id}}" youtubeLink="https://www.youtube.com/embed/{{$allVideo->video_link}}">
                        <div class="card">
                            <img src="{{$allVideo->thumb_image}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">{{$allVideo->title}}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal fade" id="videoPlayerModal" tabindex="-1" aria-labelledby="videoPlayerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
<!--                    <div class="modal-header">-->
<!--                        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>-->
<!--                    </div>-->
                    <div class="modal-body">
                        <a type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </a>
                        <iframe id="youtubeListPlayer" src="https://www.youtube.com/embed/l70UhhNalqA" frameborder="0" allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>

<!-- Modal -->

@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/video-gallery.css">
<script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    let items = document.querySelectorAll('.carousel .carousel-item')

    items.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    });
    $(document).ready(function (){
        $('.video_item').click(function (){
            $("#youtubePlayer").attr('src',$(this).attr('youtubeLink'));

            var content_id = $(this).attr('content_id');
            $.ajax({
                type:"GET",
                dataType: "json",
                data:{content_id: content_id},
                url:"/video-view-count",
                success:function(data){}
            });
        });
        $(".video-list-item").click(function (){
            $("#youtubeListPlayer").attr('src',$(this).attr('youtubeLink'));
            $('#videoPlayerModal').modal('show');

            var content_id = $(this).attr('content_id');
            $.ajax({
                type:"GET",
                dataType: "json",
                data:{content_id: content_id},
                url:"/video-view-count",
                success:function(data){}
            });
        });
    });
</script>
@endsection
<style>
    /*.video-container{*/
    /*    padding: 0% 16.2%;*/
    /*    background: #d3e0d6;*/
    /*}*/
    /*.video-container .container .main-video iframe{*/
    /*    width:100%;*/
    /*    height:70%;*/
    /*}*/
    /*.video-container .container{*/
    /*    width: 100%;*/
    /*    height: auto;*/
    /*    !*display: flex;*!*/
    /*    background: rgb(9 97 46);*/
    /*    max-width: 100%;*/
    /*}*/

    /*.video-container .container .videos{*/
    /*    width: 100%;*/
    /*    padding: 10px 0 10px 10px;*/
    /*    display: contents;*/
    /*    flex-direction: inherit;*/
    /*    justify-content: space-between;*/
    /*}*/
    /*.video-container .container .videos .card{*/
    /*    border: 1px solid #09612e;*/
    /*}*/
    /*.video-container .container .videos .nav-tabs{*/
    /*    border: 1px solid #09612e;*/
    /*    margin-bottom: 13px;*/
    /*}*/
    /*.video-container .container .videos #nav-tab .border-right{*/
    /*    border-right: 2px solid #fff !important;*/
    /*}*/
    /*.video-container .container .videos #nav-tab .active span{*/
    /*    border-bottom: 2px solid #fff !important;*/
    /*    padding: 6px 0px;*/
    /*    color: #fff;*/
    /*}*/
    /*.video-container .container .videos #nav-tab button{*/
    /*    margin-left: 3px;*/
    /*    color: #cc9b2a;*/
    /*}*/
    /*.video-container .container .videos #nav-tab button:hover{*/
    /*    border: unset;*/
    /*    !*background: #006e2e;*!*/
    /*}*/
    /*.video-container .container .videos #nav-tab button:after{*/
    /*    border: unset;*/
    /*    !*background: #006e2e;*!*/
    /*}*/
    /*.video-container .container .videos #nav-tabContent{*/
    /*    min-height: 253px;*/
    /*}*/

    /*.videos .nav-tabs .nav-link{*/
    /*    color: #fff;*/
    /*}*/
    /*.videos .nav-tabs .nav-link.active{*/
    /*    color: #fff;*/
    /*    background-color: rgb(9 97 46)!important;*/
    /*    border-color: unset!important;*/
    /*}*/
    /*.videos .nav-tabs .nav-link:focus{*/
    /*    color: #fff;*/
    /*    background-color: rgb(9 97 46)!important;*/
    /*    border-color: unset!important;*/
    /*}*/
    /*.video-container .container .videos .active{*/
    /*    border: unset!important;*/
    /*    padding: 0 1.7%;*/
    /*    transform: scale(1.03) !important;*/

    /*}*/

    /*.video-container .container .videos video{*/
    /*    width: 95%;*/
    /*    height: 100px;*/
    /*    margin: 10px;*/
    /*    object-fit: cover;*/
    /*    cursor: pointer;*/
    /*    transition: 0.2s;*/
    /*}*/

    /*.video-container .container .videos video:nth-child(1){*/
    /*    !*margin-top: 0;*!*/
    /*}*/

    /*.video-container .container .videos video:hover,*/
    /*.video-container .container .videos .active{*/
    /*    transform: scale(1.06);*/
    /*    !*border: 3px solid blue;*!*/
    /*}*/

    /*.video-container .container .main-video{*/
    /*    width: 100%;*/
    /*    padding: 10px;*/
    /*}*/

    /*.video-container .container .main-video video{*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*    object-fit: cover;*/
    /*    border: 3px solid blue;*/
    /*}*/
    /*.video-container .container .card-img-overlay{*/
    /*    color: #fff;*/
    /*    background: #09612e;*/
    /*    top:unset;*/
    /*    font-size: 13px;*/
    /*    opacity: .9;*/
    /*}*/

    /*@media (max-width: 767px) {*/
    /*    .carousel-inner .carousel-item > div {*/
    /*        display: none;*/
    /*    }*/
    /*    .carousel-inner .carousel-item > div:first-child {*/
    /*        display: block;*/
    /*    }*/
    /*}*/

    /*.carousel-inner .carousel-item.active,*/
    /*.carousel-inner .carousel-item-next,*/
    /*.carousel-inner .carousel-item-prev {*/
    /*    display: flex;*/
    /*}*/

    /*!* medium and up screens *!*/
    /*@media (min-width: 768px) {*/

    /*    .carousel-inner .carousel-item-end.active,*/
    /*    .carousel-inner .carousel-item-next {*/
    /*        transform: translateX(25%);*/
    /*    }*/

    /*    .carousel-inner .carousel-item-start.active,*/
    /*    .carousel-inner .carousel-item-prev {*/
    /*        transform: translateX(-25%);*/
    /*    }*/


    /*}*/

    /*.carousel-inner .carousel-item-end,*/
    /*.carousel-inner .carousel-item-start {*/
    /*    transform: translateX(0);*/
    /*}*/
    /*.video-list-container{*/
    /*    padding: 4% 0;*/
    /*}*/
    /*.video-list-container .card{*/
    /*    margin-bottom:1rem ;*/
    /*    border: unset;*/
    /*}*/
    /*@media screen and (max-width: 1300px) and (min-width: 600px) {*/
    /*    #videoPlayerModal .modal-content{*/
    /*        height:72% !important;*/
    /*    }*/
    /*    #videoPlayerModal .modal-dialog{*/
    /*        width: 60%!important;*/
    /*        margin-top:8% !important;*/
    /*    }*/
    /*    .video-container {*/
    /*        padding: 0% 14.3%;*/
    /*    }*/
    /*    .video-container .container .main-video iframe {*/
    /*        height: 80%;*/
    /*    }*/
    /*    .video-container .container .card-img-overlay{*/
    /*        font-size: 10px;*/
    /*    }*/
    /*    .video-list h6{*/
    /*        font-size: 12px;*/
    /*    }*/
    /*}*/

    /*@media (max-width: 600px){*/
    /*    .video-container .container .main-video iframe{*/
    /*        height: 30%;*/
    /*    }*/
    /*    .video-list-container .video-list{*/
    /*        padding: 3% !important;*/
    /*    }*/
    /*   .video-container .container .videos #nav-tab button{*/
    /*       font-size: 14px;*/
    /*   }*/
    /*   .video-container{*/
    /*       padding: 0% 0% !important;*/
    /*   }*/
    /*}*/
    /*#videoPlayerModal .modal-dialog{*/
    /*    padding: 0%;*/
    /*    width: 100%;*/
    /*}*/
    /*#videoPlayerModal .modal-content{*/
    /*    height: 60%;*/
    /*    border: unset;*/
    /*}*/
    /*#videoPlayerModal .modal-content .modal-body{*/
    /*    padding: 0;*/
    /*}*/
    /*#videoPlayerModal .modal-content .modal-body a{*/
    /*    float: right;*/
    /*    margin-top: 0;*/
    /*    margin-bottom: -33px;*/
    /*    z-index: 99;*/
    /*    position: inherit;*/
    /*}*/
    /*#videoPlayerModal .modal-content .modal-body a i{*/
    /*    color: #fff;*/
    /*}*/
    /*#videoPlayerModal .modal-content .modal-body iframe{*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*}*/
</style>
