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
                            <h3 class="card-title"><i class="fa fa-edit"></i> Story Update Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/story')}}">Story List</a>
                                </span>
                            </h3>

                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="/admin/story/{{$row->id}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ method_field('PUT') }}

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title" value="{{ old('title',$row->title) }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="category_id">Story Category <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option>Select Story Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id??''}}" @if(old('category_id',$row->category_id)== $category->id) selected @endif>{{$category->name??''}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted"></small>
                                        @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="thumb_image">Thumb Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="thumb_image"  id="thumb_image" accept="image/*" />
                                        <small class="form-text text-muted">Size should be max:50KB</small>
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
                                    <label class="col-md-2 control-label" for="desc">Description </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="desc" value="{{ old('desc') }}">{{old('desc',$row->desc)}}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('desc')
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
