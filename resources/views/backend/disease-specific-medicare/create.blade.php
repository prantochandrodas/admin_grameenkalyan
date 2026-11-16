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
                            <h3 class="card-title"><i class="fa fa-plus"></i> Disease Specific Medicare Create Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/disease-specific-medicare')}}">Disease Specific Medicare List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/disease-specific-medicare') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="thumb_image">Thumb Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="thumb_image"  id="thumb_image" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @error('homepage_thumb_image')
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
                                    <label class="col-md-2 control-label" for="body_image">Body Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="body_image"  id="body_image" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @error('body_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Sub-title<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('sub_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="description">Description</label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="description" >{{ old('description') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('description')
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
