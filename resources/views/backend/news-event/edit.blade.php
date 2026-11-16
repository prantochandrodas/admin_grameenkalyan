{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @parent

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-edit"></i> News & Event Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/news-event') }}">News & Event
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/news-event/{{ $row->id }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ method_field('PUT') }}

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
                                        <label class="col-md-2 control-label">Date <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" name="date"
                                                value="{{ old('date', optional($row->date)->format('Y-m-d')) }}" required>
                                            @error('date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="status">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" @if (old('status', $row->status) == 1) selected @endif>
                                                    Active</option>
                                                <option value="0" @if (old('status', $row->status) == 0) selected @endif>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($row->image)
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Current Image</label>
                                            <div class="col-md-10">
                                                <div class="mr-3 mb-2">
                                                    <img width="100px" src="{{ $row->image }}"><br>
                                                    <label class="text-danger mb-0">
                                                        <input type="checkbox" name="remove_image" value="1"> Remove
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Notun image upload korle purono ta auto
                                                    replace hoye jabe.</small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label"
                                            for="image">{{ $row->image ? 'Change Image' : 'Image' }}</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" id="image" accept="image/*" />
                                            <small class="form-text text-muted">jpeg, jpg, png. Joto MB er hok, auto
                                                compress hoye WebP hobe</small>
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="description">Description</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description" id="description">{{ old('description', $row->description) }}</textarea>
                                            @error('description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
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

{{-- Styles Section --}}
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Write description here...',
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                        'subscript', 'clear'
                    ]],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
