{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}
    @parent

    3<div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus"></i> Photo Gallery Create Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/photo-gallery') }}">Photo
                                            Gallery List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('/admin/photo-gallery') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div id="gallery-wrapper">

                                        <div class="gallery-item border p-3 mb-3">

                                            <div class="form-group row">
                                                <label class="col-md-2">Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="title[]" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2">Photo Album</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="category_id[]" required>
                                                        <option value="">Select Photo Album</option>
                                                        @foreach ($albums as $value)
                                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2">Thumb Image</label>
                                                <div class="col-md-10">
                                                    <input type="file" name="thumb_image[]" accept="image/*" required>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="addMore" class="btn btn-success">
                                            Add More
                                        </button>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>

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

            $('#addMore').click(function() {

                let html = `
        <div class="gallery-item border p-3 mb-3">

            <div class="form-group row">
                <label class="col-md-2">Title</label>
                <div class="col-md-10">
                    <input type="text" name="title[]" class="form-control" >
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2">Photo Album</label>
                <div class="col-md-10">
                    <select class="form-control" name="category_id[]" required>
                        <option value="">Select Photo Album</option>
                        @foreach ($albums as $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2">Thumb Image</label>
                <div class="col-md-10">
                    <input type="file" name="thumb_image[]" accept="image/*" required>
                </div>
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-danger removeRow">
                    Remove
                </button>
            </div>

        </div>
        `;

                $('#gallery-wrapper').append(html);
            });

            $(document).on('click', '.removeRow', function() {
                $(this).closest('.gallery-item').remove();
            });

        });
    </script>
@endsection
