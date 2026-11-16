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
                            <h3 class="card-title"><i class="fa fa-edit"></i> Video Gallery Update Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/video-gallery')}}">Video Gallery List</a>
                                </span>
                            </h3>

                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="/admin/video-gallery/{{$row->id}}" enctype="multipart/form-data">
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
                                    @php
                                        $youtubeLink="";
                                        if($row->video_link){
                                            $youtubeLink="https://www.youtube.com/watch?v=".$row->video_link;
                                        }
                                    @endphp
                                    <label class="col-md-2 control-label" for="video_link">Video Link(Youtube) <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="video_link" name="video_link" value="{{old('video_link',$youtubeLink)}}" required >
                                        <small class="form-text text-muted"></small>
                                        @error('video_link')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @if(session('invalidVideoLink'))
                                        <div class="alert alert-danger">{{ session('invalidVideoLink') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="is_recommended">Is Recommended?</label>
                                    <div class="col-md-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"  id="is_recommended" name="is_recommended" @if($row->is_recommended) echo checked @endif>
                                            <label class="form-check-label" for="is_recommended">
                                                Checked checkbox
                                            </label>
                                        </div>
                                        <small class="form-text text-muted"></small>
                                        @error('is_recommended')
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
