{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    @parent
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        @include('common.msg')
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus"></i> Photo Sub Album Create Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/photo-sub-album') }}">Photo
                                            Sub Album List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="{{ url('/admin/photo-sub-album') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Photo Album <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select name="photo_album_id" class="form-control" required>
                                                <option value="">-- Select Album --</option>
                                                @foreach ($albums as $album)
                                                    <option value="{{ $album->id }}"
                                                        {{ old('photo_album_id') == $album->id ? 'selected' : '' }}>
                                                        {{ $album->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('photo_album_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Serial No</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="serial_no"
                                                value="{{ old('serial_no') }}">
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
                                                value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="sub_album_photo">Photo <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="sub_album_photo" id="sub_album_photo"
                                                accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('sub_album_photo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">Create</button>
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
