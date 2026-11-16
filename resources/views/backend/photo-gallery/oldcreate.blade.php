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
                                                    <select class="form-control album-select" name="category_id[]" required>
                                                        <option value="">Select Photo Album</option>
                                                        @foreach ($albums as $value)
                                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2">Sub Album</label>
                                                <div class="col-md-10">
                                                    <select class="form-control sub-album-select" name="sub_album_id[]">
                                                        <option value="">Select Sub Album (optional)</option>
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

            // Album change hole oi row er sub album load
            $(document).on('change', '.album-select', function() {
                let albumId = $(this).val();
                let $sub = $(this).closest('.gallery-item').find('.sub-album-select');

                $sub.html('<option value="">Select Sub Album (optional)</option>');

                if (!albumId) {
                    return;
                }

                $.get('/admin/photo-gallery/sub-albums/' + albumId, function(data) {
                    $.each(data, function(i, item) {
                        $sub.append($('<option>', {
                            value: item.id,
                            text: item.title
                        }));
                    });
                });
            });

            $('#addMore').click(function() {

                let html = `
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
                    <select class="form-control album-select" name="category_id[]" required>
                        <option value="">Select Photo Album</option>
                        @foreach ($albums as $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2">Sub Album</label>
                <div class="col-md-10">
                    <select class="form-control sub-album-select" name="sub_album_id[]">
                        <option value="">Select Sub Album (optional)</option>
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
