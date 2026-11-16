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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Gallery Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/photo-album') }}">Gallery
                                            List</a>
                                    </span>
                                </h3>

                            </div>

                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/photo-album/{{ $row->id }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ method_field('PUT') }}
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Serial No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="serial_no"
                                                value="{{ old('serial_no', $row->serial_no) }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('serial_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Title <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title', $row->title) }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="album_photo">Album Photo<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="album_photo" id="album_photo" accept="image/*" />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('album_photo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @if ($row->album_photo)
                                                <img src="{{ $row->album_photo }}" width="100px">
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
