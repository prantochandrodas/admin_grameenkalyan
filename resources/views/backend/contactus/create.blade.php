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
                            <h3 class="card-title"><i class="fa fa-plus"></i> Gallery Create Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/gallery')}}">Gallery List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/gallery') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="type" required id="type" required>                                            
                                            <option value='horizontal' selected>Horizontal</option>
                                            <option value='vertical'>Vertical</option>
                                        </select>
                                        @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
                                        <small class="form-text text-muted">Size should be max:50KB</small>
                                        @error('thumb_image')
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
                                    <label class="col-md-2 control-label" for="desc">Description </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control" name="desc" value="{{ old('desc') }}"></textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('desc')
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
