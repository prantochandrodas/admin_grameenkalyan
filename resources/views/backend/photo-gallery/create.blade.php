{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    @parent

    <style>
        .preview-card {
            position: relative;
        }

        .preview-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .preview-card .btn-remove {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 28px;
            height: 28px;
            line-height: 1;
            padding: 0;
            border-radius: 50%;
        }

        .preview-card .file-name {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

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

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ url('/admin/photo-gallery') }}"
                                    enctype="multipart/form-data" id="galleryForm">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-2">Serial No</label>
                                        <div class="col-md-10">
                                            <input type="number" name="serial_no" class="form-control" min="0"
                                                value="{{ old('serial_no') }}"
                                                placeholder="Ei serial shob image-er jonno save hobe (optional)">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">Title</label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') }}"
                                                placeholder="Ei title shob image-er jonno save hobe (optional)">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">Photo Album <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="albumSelect" name="category_id" required>
                                                <option value="">Select Photo Album</option>
                                                @foreach ($albums as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('category_id') == $value->id ? 'selected' : '' }}>
                                                        {{ $value->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">Sub Album</label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="subAlbumSelect" name="sub_album_id">
                                                <option value="">Select Sub Album (optional)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">Images <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" id="thumbInput" name="thumb_image[]" accept="image/*"
                                                multiple style="display:none">
                                            <button type="button" id="pickBtn" class="btn btn-success">
                                                <i class="fa fa-images"></i> Select Images
                                            </button>
                                            <small class="text-muted ml-2">
                                                Ekbar-e onek image select korte parben (jpeg, jpg, png). Abar select korle
                                                aro add hobe.
                                            </small>
                                            <div class="mt-2"><strong id="countText">0 image selected</strong></div>
                                        </div>
                                    </div>

                                    <div class="row" id="previewWrapper"></div>

                                    <button type="submit" class="btn btn-primary mt-3">
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

            // ---------- Sub album load ----------
            $('#albumSelect').on('change', function() {
                let albumId = $(this).val();
                let $sub = $('#subAlbumSelect');

                $sub.html('<option value="">Select Sub Album (optional)</option>');
                if (!albumId) return;

                $.get('/admin/photo-gallery/sub-albums/' + albumId, function(data) {
                    $.each(data, function(i, item) {
                        $sub.append($('<option>', {
                            value: item.id,
                            text: item.title
                        }));
                    });
                });
            });

            // ---------- Multiple image + preview ----------
            let items = []; // { file, url }
            const input = document.getElementById('thumbInput');

            // items er file gulo input e sync kora (jate form submit e shob jay)
            function syncInput() {
                const dt = new DataTransfer();
                items.forEach(function(it) {
                    dt.items.add(it.file);
                });
                input.files = dt.files;
            }

            function render() {
                const $wrap = $('#previewWrapper').empty();

                items.forEach(function(it, index) {
                    const $col = $('<div class="col-md-3 col-sm-4 col-6 mb-3"></div>');
                    const $card = $('<div class="card preview-card h-100"></div>');

                    const $img = $('<img>').attr('src', it.url);
                    const $remove = $(
                            '<button type="button" class="btn btn-danger btn-sm btn-remove" title="Remove">&times;</button>'
                        )
                        .attr('data-index', index);

                    const $body = $('<div class="p-2"></div>');
                    const $name = $('<div class="file-name text-muted"></div>').text(it.file.name);

                    $body.append($name);
                    $card.append($img, $remove, $body);
                    $col.append($card);
                    $wrap.append($col);
                });

                $('#countText').text(items.length + ' image selected');
            }

            $('#pickBtn').on('click', function() {
                input.click();
            });

            $(input).on('change', function() {
                Array.from(input.files).forEach(function(file) {
                    if (!file.type.match(/^image\/(jpeg|png)$/)) {
                        return; // shudhu jpeg/png
                    }

                    // same file duplicate hole skip
                    const exists = items.some(function(it) {
                        return it.file.name === file.name &&
                            it.file.size === file.size &&
                            it.file.lastModified === file.lastModified;
                    });
                    if (exists) return;

                    items.push({
                        file: file,
                        url: URL.createObjectURL(file)
                    });
                });

                syncInput();
                render();
            });

            // preview theke remove
            $(document).on('click', '.btn-remove', function() {
                const i = $(this).data('index');
                if (items[i]) {
                    URL.revokeObjectURL(items[i].url);
                    items.splice(i, 1);
                }
                syncInput();
                render();
            });

            $('#galleryForm').on('submit', function(e) {
                if (items.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one image.');
                }
            });

            // Validation fail hoye back ashle old album er sub album load
            @if (old('category_id'))
                $.get('/admin/photo-gallery/sub-albums/{{ old('category_id') }}', function(data) {
                    $.each(data, function(i, item) {
                        $('#subAlbumSelect').append($('<option>', {
                            value: item.id,
                            text: item.title,
                            selected: item.id == '{{ old('sub_album_id') }}'
                        }));
                    });
                });
            @endif
        });
    </script>
@endsection
