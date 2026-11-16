{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    @parent

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-edit"></i> Photo Gallery Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/photo-gallery') }}">Photo
                                            Gallery List</a>
                                    </span>
                                </h3>
                            </div>

                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/photo-gallery/{{ $row->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="serial_no">Serial No</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="serial_no" id="serial_no"
                                                min="0" value="{{ old('serial_no', $row->serial_no) }}">
                                            @error('serial_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="title">Title </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title', $row->title) }}">
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="category_id">Photo Album <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">Select photo album</option>
                                                @foreach ($albums as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('category_id', $row->category_id) == $value->id ? 'selected' : '' }}>
                                                        {{ $value->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="sub_album_id">Sub Album</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="sub_album_id" id="sub_album_id"
                                                data-selected="{{ old('sub_album_id', $row->sub_album_id) }}">
                                                <option value="">Select Sub Album (optional)</option>
                                            </select>
                                            @error('sub_album_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="thumb_image">Thumb Image <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="thumb_image" id="thumb_image" accept="image/*"
                                                @if (!$row->thumb_image) required @endif />
                                            <small class="form-text text-muted">Size should be max:50KB</small>
                                            @error('thumb_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @if ($row->thumb_image)
                                                <img width="150px" src="{{ $row->thumb_image }}" class="mt-2">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let $album = $('#category_id');
            let $sub = $('#sub_album_id');

            function loadSubAlbums(albumId, selectedId) {
                $sub.html('<option value="">Select Sub Album (optional)</option>');

                if (!albumId) {
                    return;
                }

                $.get('/admin/photo-gallery/sub-albums/' + albumId, function(data) {
                    $.each(data, function(i, item) {
                        $sub.append($('<option>', {
                            value: item.id,
                            text: item.title,
                            selected: String(item.id) === String(selectedId)
                        }));
                    });
                });
            }

            // page load e current album er sub album load + selected
            loadSubAlbums($album.val(), $sub.data('selected'));

            // album change korle sub album reset
            $album.on('change', function() {
                loadSubAlbums($(this).val(), null);
            });
        });
    </script>
@endsection
