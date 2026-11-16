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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Donate Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/donate') }}">Donate List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/donate/{{ $row->id }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ method_field('PUT') }}

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', $row->name) }}" required>
                                            @error('name')
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

                                    @if ($row->images->count())
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Current Images</label>
                                            <div class="col-md-10">
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($row->images as $img)
                                                        <div class="text-center mr-3 mb-2">
                                                            <img width="100px" src="{{ $img->image }}"><br>
                                                            <label class="text-danger mb-0">
                                                                <input type="checkbox" name="remove_images[]"
                                                                    value="{{ $img->id }}"> Remove
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <small class="form-text text-muted">Jeta delete korte chao setar Remove e
                                                    tick dao, tarpor Update chapo.</small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="images">Add More Images</label>
                                        <div class="col-md-10">
                                            <input type="file" name="images[]" id="images" accept="image/*"
                                                multiple />
                                            <small class="form-text text-muted">Multiple images select kora jabe. jpeg, jpg,
                                                png. Joto MB er hok, auto compress hoye WebP hobe</small>
                                            @error('images')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @foreach ($errors->get('images.*') as $messages)
                                                @foreach ($messages as $message)
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @endforeach
                                            @endforeach
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
