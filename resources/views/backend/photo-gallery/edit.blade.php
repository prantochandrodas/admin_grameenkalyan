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
                            <h3 class="card-title"><i class="fa fa-edit"></i> Photo Gallery Update Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/photo-gallery')}}">Photo Gallery List</a>
                                </span>
                            </h3>

                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="/admin/photo-gallery/{{$row->id}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ method_field('PUT') }}

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="title">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="" name="title" value="{{ old('title',$row->title) }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="category_id">Photo Album <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="category_id" required id="category_id" required>
                                            <option value=''>Select photo album</option>
                                            @foreach($albums as $key=>$value)
                                            <option value='{{$value->id}}' @if($row->category_id==$value->id) selected @endif>{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="thumb_image">Thumb Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="thumb_image"  id="thumb_image" accept="image/*" @if(!$row->thumb_image) required @endif />
                                        <small class="form-text text-muted">Size should be max:50KB</small>
                                        @error('thumb_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @if($row->thumb_image)
                                         <img width="150px" src="{{$row->thumb_image}}">
                                        @endif
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
