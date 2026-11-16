{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@parent

<div class="content-wrapper">
<!--    <section class="content-header">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row mb-2">-->
<!--                <div class="col-sm-12">-->
<!--                    @include('common.msg')-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-plus"></i> About Us Content Create Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/about-us')}}">About Us Content List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/about-us') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-md-2 control-label">Title <span class="text-danger">*</span></label>--}}
{{--                                    <div class="col-md-10">--}}
{{--                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>--}}
{{--                                        <small class="form-text text-muted"></small>--}}
{{--                                        @error('title')--}}
{{--                                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="title">Title </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="title" >{{ old('title') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="banner_image">Banner Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="banner_image"  id="banner_image" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @error('banner_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Mission<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="mission" value="{{ old('mission') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('mission')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Vision<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="vision" value="{{ old('vision') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('vision')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Company Intro Title<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="company_intro_title" value="{{ old('company_intro_title') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('company_intro_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="company_intro_description">Company Intro Description </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="company_intro_description" >{{ old('company_intro_description') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('company_intro_description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="inception_banner_image">Inception Banner Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="inception_banner_image"  id="inception_banner_image" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @error('inception_banner_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Inception Title <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="inception_title" value="{{ old('inception_title') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('inception_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="inception_details">Inception Details </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="inception_details" >{{ old('inception_details') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('inception_details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Presence Title <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="presence_title" value="{{ old('presence_title') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('presence_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Presence Sub-Title <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="presence_sub_title" value="{{ old('presence_sub_title') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('presence_sub_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="presence_banner_image">Presence Banner Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="presence_banner_image"  id="presence_banner_image" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @error('presence_banner_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="presence_details">Presence Details </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="presence_details" >{{ old('presence_details') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('presence_details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
