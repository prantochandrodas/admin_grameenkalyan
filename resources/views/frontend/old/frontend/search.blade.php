@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

     <!-- join us body -->

     <section class="search-page-body" id="search_content">
        <div class="search-page-body-main">
        <form method="get" class="form-inline" action="/search">
        <div class="row g-3 align-items-center">

        <div class="col-auto">
            <input type="text" name="search" class="form-control" value="{{request()->input('search')}}">
        </div>
        <div class="col-auto">
            <button type="submit">Search</button>
        </div>
        </div>

        </form>
        @if($rowsH && count($rowsH)>0)
        @foreach($rowsH as $keyH=>$rowH)
            <div class="row mt-2">
               <div class="col-md-2"><img src="{{$rowH->banner_image}}"></div>
               <div class="col-md-8">
                   <div class="row search_container">
                        <div class="col-md-12">{{$rowH->name??''}}</div>
                        <div class="col-md-12"> {{$rowH->address??''}}, {{$rowH->getDistrict->name??''}}, {{$rowH->getDivision->name??''}}</div>
                   </div>

               </div>
           </div>
        @endforeach
        @endif
        @if($rowsS && count($rowsS)>0)
        @foreach($rowsS as $keyS=>$rowS)

            <div class="row search-result-container">
               <div class="col-md-2 p-0">
                    <div class="thumbnail-container">
                        <a href="/story-details/{{$rowS->id}}"><img src="{{$rowS->thumb_image}}"></a>
                    </div>
                </div>
               <div class="col-md-8 search-data-container">
               <a href="/story-details/{{$rowS->id}}">
                   <div class="row search_container">
                        <div class="col-md-12"><h5>{{$rowS->title??''}}</h5></div>
                        <div class="col-md-12"> <p>{!! wordSummery($rowS->desc??'', 250)!!}...</p></div>
                   </div>
                   </a>
               </div>

           </div>

        @endforeach
        @endif
        <div>
            @if($rowsH && $rowsS && count($rowsH) > count($rowsS))
                {!! $rowsH->appends(request()->query())->links('pagination::bootstrap-4') !!}
            @else
                {!! $rowsS->appends(request()->query())->links('pagination::bootstrap-4') !!}
            @endif

        </div>
        </div>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
    <link rel="stylesheet" href="/css/scss/search.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script>
    <script src="/js/counter.js"></script>
    <script src="/js/index-image-hover.js"></script>
    <script src="/js/dropdown.js"></script> -->
<style>

@endsection
