@extends('frontend.layouts._layout')
@section('content')
    <!-- info buttons -->
@include('frontend.partials.info-container')
    <!-- info boxes -->
@include('frontend.partials.info-box-container')

     <!-- join us body -->

     <section class="join-us-body">
        <div class="join-us-tagline">
            <img src="./assets/people/join-us.png" alt="">
        </div>
        <div class="join-us-body-header">
            <h1>Grammen Kalyan goes out of its way to harmonize cultural priorities & values to the employees and health
                force</h1>
        </div>
        <div class="join-us-body-main">
            <div class="main-content-list">
                <div class="row h-100">
                    <div class="col-10 px-0">
                        <div class="content-list-text">
                            <p>We want to provide better service, primary health care and relief assistance (affected by various Natural calamities and Disasters) at rural doorsteps by implementing quality improvement efforts and information systems development.</p>
                        </div>
                    </div>
                    <div class="col-2 px-0">
                        <div class="number-container">
                            <h2>1</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content-list">
                <div class="row h-100">
                    <div class="col-2 px-0">
                        <div class="number-container">
                            <h2>2</h2>
                        </div>
                    </div>
                    <div class="col-10 px-0">
                        <div class="content-list-text">
                            <p>A general understanding of different cultures makes a good place for people to let them know that they can be comfortable and ask what they need. We are providing that safe and healthy place that benefits workers, patients, families, businesses, and the community.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content-list">
                <div class="row h-100">
                    <div class="col-10 px-0">
                        <div class="content-list-text">
                            <p>We want to help to establish & promoting Social Business entities operating in diverse sectors like Agriculture, Nutrition, Healthcare, Value Chain, RMG, Finance, and Information Technology.</p>
                        </div>
                    </div>
                    <div class="col-2 px-0">
                        <div class="number-container">
                            <h2>3</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content-list">
                <div class="row h-100">
                    <div class="col-2 px-0">
                        <div class="number-container">
                            <h2>4</h2>
                        </div>
                    </div>
                    <div class="col-10 px-0">
                        <div class="content-list-text">
                            <p>With a strong sense of identification with the organisation and a shared understanding of essential, we want to serve people in the rural areas effectively and efficiently.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- join us form -->
    <section class="join-us-form" >
        <div class="form-container" id="join-us-form">
            <form method="post" action="/post-application" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(session('success'))
                <div class="form-group row mt-4 text-center">
                 <div class="text-success alert">
                      <strong>{{session('success')}}</strong>
                 </div>
                </div>
                @endif
             <div class="form-group row mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label>Departments:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <select name="department"  id="department">
                        <option value="">Select Department</option>
                        <option value="HR & Admin"  @if(old('department')=='HR & Admin') selected @endif>HR & Admin</option>
                        <option value="Finance and Accounting" @if(old('department')=='Finance and Accounting & Admin') selected @endif>Finance and Accounting</option>
                        <option value="Project & Infrastructure" @if(old('department')=='Project & Infrastructure & Admin') selected @endif>Project & Infrastructure</option>
                        <option value="Internal Audit" @if(old('department')=='Internal Audit & Admin') selected @endif>Internal Audit</option>
                        <option value="Supply Chain" @if(old('department')=='Supply Chain & Admin') selected @endif>Supply Chain</option>
                        <option value="IT" @if(old('department')=='IT & Admin') selected @endif>IT</option>
                        <option value="Customer Relations / Customer Care" @if(old('department')=='Customer Relations / Customer Care') selected @endif>Customer Relations / Customer Care</option>
                    </select>
                    @error('department')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row  mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label>Name:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" name="name" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row  mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label>Email:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="email" name="email" value="{{old('name')}}">
                        @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row  mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label>Contact No:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" name="phone" value="{{old('phone')}}">
                        @error('phone')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row  mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label>Upload Resume:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="file" name="upload_cv" value="{{old('upload_cv')}}">
                        @error('upload_cv')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row  mt-4">
                    <div class="col-12 text-center">
                        <button type="submit">Send</button>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <!-- stories -->
    @include('frontend.partials.stories-section')
@endsection
@section('scripts')
<link rel="stylesheet" href="/css/scss/joinus.css">

    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- <script src="/js/index.js"></script>
    <script src="/js/counter.js"></script>
    <script src="/js/index-image-hover.js"></script>
    <script src="/js/dropdown.js"></script> -->

@endsection
