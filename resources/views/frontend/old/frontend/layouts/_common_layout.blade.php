<!doctype html>
<html>
<head>
   @include('frontend.layouts.includes.head')
</head>
<body>
<header class="row">
       @include('frontend.layouts.includes._header')
   </header>
   <!-- <div id="main" class="row">
           
   </div> -->
   @yield('content')
   @include('frontend.layouts.includes._footer')
{{-- Includable JS --}}
 @yield('scripts')
</body>
</html>
