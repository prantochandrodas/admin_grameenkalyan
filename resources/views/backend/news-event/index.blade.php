{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
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
                            <li class="breadcrumb-item active">News & Event</li>
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
                                <h3 class="card-title"> <i class="fa fa-list"></i> News & Event List </h3>
                                <div class="float-right">
                                    <form action="" method="get">
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
                                    </form>
                                </div>
                                <div class="pr-2 float-right">
                                    <a class="btn btn-sm btn-primary" href="{{ url('/admin/news-event/create') }}">Create
                                        New</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">#</th>
                                            <th style="width:80px">Image</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = ($rows->currentPage() - 1) * $rows->perPage() + 1; ?>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>{{ $index++ }}.</td>
                                                <td>
                                                    @if ($r->image)
                                                        <img src="{{ $r->image }}"
                                                            style="width:50px; height:50px; object-fit:cover;">
                                                    @endif
                                                </td>
                                                <td>{{ $r->title ?? '' }}</td>
                                                <td>{{ optional($r->date)->format('d M Y') }}</td>
                                                <td>
                                                    @if ($r->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="/admin/news-event/{{ $r->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-sm btn-info"
                                                            href="/admin/news-event/{{ $r->id }}"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/admin/news-event/{{ $r->id }}/edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">No data found!</td>
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

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
