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
                                <h3 class="card-title"><i class="fa fa-plus"></i> Service Content Create Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('/admin/service-contents') }}">Service Content List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="{{ url('/admin/service-contents') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="title">Service Title </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title') }}"></input>
                                            <small class="form-text text-muted"></small>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="homepage_thumb_image">Homepage Thumb
                                            Image <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="homepage_thumb_image" id="homepage_thumb_image"
                                                accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('homepage_thumb_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="servicepage_thumb_image">Servicepage
                                            Thumb Image <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="servicepage_thumb_image"
                                                id="servicepage_thumb_image" accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('servicepage_thumb_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Sub-title One<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="sub_title_one"
                                                value="{{ old('sub_title_one') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('sub_title_one')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Sub-title Two<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="sub_title_two"
                                                value="{{ old('sub_title_two') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('sub_title_two')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Short Description<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="short_description"
                                                value="{{ old('short_description') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('short_description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                    <label class="col-md-2 control-label" for="service_detail_banner_image">Service Detail Banner Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="service_detail_banner_image"  id="service_detail_banner_image" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @error('service_detail_banner_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="service_detail_banner_images">Service
                                            Detail Banner Images <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="service_detail_banner_images[]"
                                                id="service_detail_banner_images" accept="image/*" multiple required />
                                            <small class="form-text text-muted">Multiple image select korte paren (jpeg,
                                                jpg, png). Upload er somoy auto compress hobe.</small>
                                            @error('service_detail_banner_images')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @error('service_detail_banner_images.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="service_detail_slogan">Service Detail
                                            Title </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="service_detail_slogan"
                                                value="{{ old('service_detail_slogan') }}" />
                                            <small class="form-text text-muted"></small>
                                            @error('service_detail_slogan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="service_detail_sub_title">Service
                                            Detail Sub-title </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="service_detail_sub_title"
                                                value="{{ old('service_detail_sub_title') }}" />
                                            <small class="form-text text-muted"></small>
                                            @error('service_detail_sub_title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="long_description">Long
                                            Description</label>
                                        <div class="col-md-10">
                                            <textarea type="text" class="form-control rich_editor" name="long_description">{{ old('long_description') }}</textarea>
                                            <small class="form-text text-muted"></small>
                                            @error('long_description')
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
