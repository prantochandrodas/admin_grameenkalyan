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
                            <li class="breadcrumb-item active">Package</li>
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
                                <h3 class="card-title"><i class="fa fa-list"></i> Package List</h3>
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
                                    <a class="btn btn-sm btn-primary" href="{{ url('/admin/package/create') }}">Create
                                        New</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Tests</th>
                                            <th>Total Rate</th>
                                            <th>Total Discount</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th style="width:160px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>{{ $rows->firstItem() + $loop->index }}.</td>
                                                <td>
                                                    @if ($r->category)
                                                        <span class="badge badge-info">{{ $r->category->name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td><img width="50px" src="{{ $r->thumbnail_image ?? '' }}"></td>
                                                <td>{{ $r->name }}</td>

                                                <td>{{ $r->details_count }}</td>
                                                <td>{{ number_format($r->total_rate, 2) }}</td>
                                                <td>{{ number_format($r->total_discount, 2) }}</td>
                                                <td>{{ number_format($r->total_amount, 2) }}</td>
                                                <td>
                                                    @if ($r->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="/admin/package/{{ $r->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-sm btn-info"
                                                            href="/admin/package/{{ $r->id }}" title="View"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/admin/package/{{ $r->id }}/edit"
                                                            title="Edit"><i class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"
                                                            title="Delete"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">No data found!</td>
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
