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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Photo Sub Album Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/photo-sub-album') }}">Photo
                                            Sub Album List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/photo-sub-album/{{ $row->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Photo Album <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select name="photo_album_id" class="form-control" required>
                                                <option value="">-- Select Album --</option>
                                                @foreach ($albums as $album)
                                                    <option value="{{ $album->id }}"
                                                        {{ old('photo_album_id', $row->photo_album_id) == $album->id ? 'selected' : '' }}>
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
                                                value="{{ old('serial_no', $row->serial_no) }}">
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
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="sub_album_photo">Photo</label>
                                        <div class="col-md-10">
                                            <input type="file" name="sub_album_photo" id="sub_album_photo"
                                                accept="image/*" />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('sub_album_photo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @if ($row->sub_album_photo)
                                                <img src="{{ $row->sub_album_photo }}" width="100px" class="mt-2">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
