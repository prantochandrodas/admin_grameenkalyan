<!doctype html>
<html>
<head>
   @include('frontend.layouts.includes.head')
</head>
<body>
@include('frontend.layouts.includes._header')
   <!-- <div id="main" class="row">

   </div> -->
   @yield('content')
   @include('frontend.layouts.includes._footer')
   <button  type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
  <i class="fas fa-arrow-up"></i>
</button>
{{-- Includable JS --}}
 @yield('scripts')
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="/js/common.js"></script>
<style>
    #btn-back-to-top {
    position: fixed;
    bottom: 20px;
    left: 20px;
    display: none;
    background-color: #0b612d;
    color: #fff;
    }
    .dropdown:hover .dropdown-menu{
        display: block;
        background-color:#0b612d;
        border: 1px solid #0b612d;
        margin-left: -1%;
    }
    .dropdown:hover .dropdown-menu .corporate,.dropdown:hover .dropdown-menu .health-force{
        padding: 10px 17px;
        text-align: center;
        border-bottom: 1px solid #CC9B2B;
    }
    .dropdown:hover .dropdown-menu .join-us{
        padding: 10px 17px;
        text-align: center;
    }
    .dropdown-menu{
        margin-top: 0;
    }
    .dropdown-toggle::after{
        vertical-align: 0.01em;
        font-size:32px;
    }
</style>
</body>
</html>
