{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}
    @parent
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @include('common.msg')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Photo Gallery</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <i class="fa fa-list"></i> Photo Gallery List </h3>
                                <div class="float-right">
                                    {{-- <form action="" method="get">
                                        search করলেও album/sub album filter ধরে রাখবে
                                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                                        <input type="hidden" name="sub_album_id" value="{{ request('sub_album_id') }}">
                                        <div class="input-group">
                                            <input name="q" type="text" class="form-control search_field"
                                                value="{{ request()->input('q') ?? '' }}" placeholder="Search...">
                                            <button onclick="emptySearchField()" type="button" class="btn bg-transparent"
                                                style="margin-left: -40px; z-index: 100;">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary" type="submit">Find</button>
                                            </div>
                                        </div>
                                    </form> --}}
                                </div>
                                <div class="pr-2 float-right">
                                    <a class="btn btn-sm btn-primary" href="{{ url('/admin/photo-gallery/create') }}">Create
                                        New</a>
                                </div>
                                <div class="pr-2 float-right">
                                    <button type="submit" form="bulk-delete-form" id="bulk-delete-btn"
                                        class="btn btn-sm btn-danger" disabled
                                        onclick="return confirm('Do you want to delete the selected items?')">
                                        <i class="fa fa-trash"></i> Delete Selected (<span id="selected-count">0</span>)
                                    </button>
                                </div>
                                <div class="pr-2 float-right">
                                    <button type="button" id="bulk-assign-btn" class="btn btn-sm btn-success" disabled
                                        data-toggle="modal" data-target="#bulkAssignModal">
                                        <i class="fa fa-folder-open"></i> Assign Album (<span id="assign-count">0</span>)
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                {{-- ================= Filter (Album + Sub Album) ================= --}}
                                <form action="" method="get" class="mb-3">
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                    <div class="form-row align-items-end">
                                        <div class="col-md-3 mb-2">
                                            <label class="mb-1">Album</label>
                                            <select name="category_id" id="filterAlbum" class="form-control">
                                                <option value="">All Albums</option>
                                                @foreach ($albums as $album)
                                                    <option value="{{ $album->id }}"
                                                        {{ request('category_id') == $album->id ? 'selected' : '' }}>
                                                        {{ $album->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="mb-1">Sub Album</label>
                                            <select name="sub_album_id" id="filterSubAlbum" class="form-control">
                                                <option value="">All Sub Albums</option>
                                                @foreach ($subAlbums as $sub)
                                                    <option value="{{ $sub->id }}"
                                                        {{ request('sub_album_id') == $sub->id ? 'selected' : '' }}>
                                                        {{ $sub->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-filter"></i> Filter
                                            </button>
                                            <a href="{{ url('/admin/photo-gallery') }}" class="btn btn-secondary">
                                                <i class="fa fa-times"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>

                                {{-- Bulk delete form (table er bahire, karon row te already delete form ache; checkbox gulo form="" attribute diye link kora) --}}
                                <form id="bulk-delete-form" action="{{ route('photo-gallery.bulk-destroy') }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                </form>

                                <div class="modal fade" id="bulkAssignModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <form id="bulk-assign-form" action="{{ route('photo-gallery.bulk-assign') }}"
                                            method="POST" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Assign Album to Selected Photos</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- selected id gulo JS diye ekhane hidden input hishebe boshbe --}}
                                                <div id="assign-ids"></div>

                                                <div class="form-group">
                                                    <label>Photo Album <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="bulkAlbumSelect" name="category_id"
                                                        required>
                                                        <option value="">Select Photo Album</option>
                                                        @foreach ($albums as $album)
                                                            <option value="{{ $album->id }}">{{ $album->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Sub Album</label>
                                                    <select class="form-control" id="bulkSubAlbumSelect"
                                                        name="sub_album_id">
                                                        <option value="">Select Sub Album (optional)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:30px"><input type="checkbox" id="select-all"></th>
                                            <th>#</th>
                                            <th>Serial</th>
                                            <th>Thumb Image</th>
                                            <th>Title</th>
                                            <th>Album</th>
                                            <th>Sub Album</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="row-checkbox" name="ids[]"
                                                        value="{{ $r->id }}" form="bulk-delete-form">
                                                </td>
                                                <td>{{ $rows->firstItem() + $loop->index }}.</td>
                                                <td>{{ $r->serial_no ?? '--' }}</td>
                                                <td><img width="50px" src="{{ $r->thumb_image ?? '' }}"></td>
                                                <td>{{ $r->title ?? '' }}</td>
                                                <td>{{ $r->getPhotoAlbum->title ?? '' }}</td>
                                                <td>{{ $r->getPhotoSubAlbum->title ?? '--' }}</td>
                                                <td>
                                                    <form action="/admin/photo-gallery/{{ $r->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/admin/photo-gallery/{{ $r->id }}/edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No data found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>{!! $rows->appends(request()->query())->links('pagination::bootstrap-4') !!}</div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    {{-- bulk delete + bulk assign --}}
    <script>
        (function() {
            var selectAll = document.getElementById('select-all');
            var btn = document.getElementById('bulk-delete-btn');
            var assignBtn = document.getElementById('bulk-assign-btn');
            var counter = document.getElementById('selected-count');
            var assignCounter = document.getElementById('assign-count');
            var boxes = document.querySelectorAll('.row-checkbox');

            function refresh() {
                var checked = document.querySelectorAll('.row-checkbox:checked').length;
                counter.textContent = checked;
                assignCounter.textContent = checked;
                btn.disabled = checked === 0;
                assignBtn.disabled = checked === 0;
                selectAll.checked = boxes.length > 0 && checked === boxes.length;
                selectAll.indeterminate = checked > 0 && checked < boxes.length;
            }

            selectAll.addEventListener('change', function() {
                boxes.forEach(function(b) {
                    b.checked = selectAll.checked;
                });
                refresh();
            });
            boxes.forEach(function(b) {
                b.addEventListener('change', refresh);
            });
            refresh();

            // modal khulle selected id gulo hidden input e boshao
            $('#bulkAssignModal').on('show.bs.modal', function() {
                var html = '';
                document.querySelectorAll('.row-checkbox:checked').forEach(function(b) {
                    html += '<input type="hidden" name="ids[]" value="' + b.value + '">';
                });
                $('#assign-ids').html(html);
                $('#bulkAlbumSelect').val('');
                $('#bulkSubAlbumSelect').html('<option value="">Select Sub Album (optional)</option>');
            });

            // album change hole sub album load (create page er moto same endpoint)
            $('#bulkAlbumSelect').on('change', function() {
                var albumId = $(this).val();
                var $sub = $('#bulkSubAlbumSelect');
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
        })();
    </script>

    {{-- list filter: album change hole sub album load --}}
    <script>
        $('#filterAlbum').on('change', function() {
            var albumId = $(this).val();
            var $sub = $('#filterSubAlbum');
            $sub.html('<option value="">All Sub Albums</option>');
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
    </script>
@endsection
