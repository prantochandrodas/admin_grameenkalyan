{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    @parent
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @include('common.msg')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Photo Sub Album</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-list"></i> Photo Sub Album List</h3>
                                <div class="float-right">
                                    <form action="" method="get" class="form-inline">
                                        <select name="photo_album_id" class="form-control form-control-sm mr-2">
                                            <option value="">All Albums</option>
                                            @foreach ($albums as $album)
                                                <option value="{{ $album->id }}"
                                                    {{ request('photo_album_id') == $album->id ? 'selected' : '' }}>
                                                    {{ $album->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group">
                                            <input name="q" type="text" class="form-control search_field"
                                                value="{{ request()->input('q') ?? '' }}" placeholder="Search...">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary" type="submit">Find</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="pr-2 float-right">
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ url('/admin/photo-sub-album/create') }}">Create New</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Serial No</th>
                                            <th>Photo Album</th>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>{{ $rows->firstItem() + $loop->index }}.</td>
                                                <td>{{ $r->serial_no ?? '' }}</td>
                                                <td>{{ $r->album->title ?? '--' }}</td>
                                                <td><img src="{{ $r->sub_album_photo ?? '' }}" width="50px"></td>
                                                <td>{{ $r->title ?? '' }}</td>
                                                <td>
                                                    @if ($r->is_active)
                                                        <a class="btn-sm btn-success"
                                                            href="/admin/photo-sub-album/{{ $r->id }}?active=false">Deactivate</a>
                                                    @else
                                                        <a class="btn-sm btn-warning"
                                                            href="/admin/photo-sub-album/{{ $r->id }}?active=true">Activate</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="/admin/photo-sub-album/{{ $r->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/admin/photo-sub-album/{{ $r->id }}/edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No data found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>{!! $rows->appends(request()->query())->links('pagination::bootstrap-4') !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
