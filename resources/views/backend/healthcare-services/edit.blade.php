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
                            <h3 class="card-title"><i class="fa fa-edit"></i> Healthcare Services Content Update Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/healthcare-services')}}">Healthcare Services Content List</a>
                                </span>
                            </h3>

                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="/admin/healthcare-services/{{$row->id}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="title">Title </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title" value="{{ old('title', $row->title??'') }}" />
                                        <small class="form-text text-muted"></small>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="healthcare_services_page_title">Healthcare Services Page Title </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="healthcare_services_page_title" value="{{ old('healthcare_services_page_title', $row->healthcare_services_page_title??'') }}" />
                                        <small class="form-text text-muted"></small>
                                        @error('healthcare_services_page_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Sub-title<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title', $row->sub_title??'') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('sub_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="thumb_image">Thumb Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="thumb_image"  id="thumb_image" accept="image/*" />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @if( $row->thumb_image??'')
                                            <img width="80px" src="{{ $row->thumb_image??'' }}">
                                        @endif
                                        @error('thumb_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="banner_image">Banner Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="banner_image"  id="banner_image" accept="image/*" />
                                        <small class="form-text text-muted">Size should be max:100KB</small>
                                        @if( $row->banner_image??'')
                                            <img width="80px" src="{{ $row->banner_image??'' }}">
                                        @endif
                                        @error('banner_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="description">Description </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="description" >{{ old('description', $row->description??'') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            Update
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
