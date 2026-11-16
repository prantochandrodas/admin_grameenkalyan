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
                            <li class="breadcrumb-item active">Contact</li>
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
                                <h3 class="card-title"> <i class="fa fa-list"></i> Contact List </h3>

                                <div class="float-right d-flex">
                                    {{-- Bulk delete button --}}
                                    <button type="submit" form="bulkDeleteForm" id="bulkDeleteBtn"
                                        class="btn btn-sm btn-danger mr-2" disabled>
                                        <i class="fa fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)
                                    </button>

                                    {{-- Search form --}}
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
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                {{-- Bulk delete form (checkboxes link to this via form="bulkDeleteForm") --}}
                                <form id="bulkDeleteForm" action="{{ route('contact.bulk-delete') }}" method="POST"
                                    onsubmit="return confirm('Do you want to delete the selected items?')">
                                    @csrf
                                    @method('delete')
                                </form>

                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:30px"><input type="checkbox" id="checkAll"></th>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 1; ?>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="row-check" name="ids[]"
                                                        value="{{ $r->id }}" form="bulkDeleteForm">
                                                </td>
                                                <td>{{ $index++ }}.</td>
                                                <td>{{ $r->name ?? '' }}</td>
                                                <td>{{ $r->email ?? '' }}</td>
                                                <td>{{ $r->phone ?? '' }}</td>
                                                <td>{{ !empty($r->created_at) ? \Carbon\Carbon::parse($r->created_at)->format('d M Y') : '' }}
                                                </td>
                                                <td>{{ $r->subject ?? '' }}</td>
                                                <td>{{ $r->message ?? '' }}</td>
                                                <td>
                                                    <form action="/admin/contact/{{ $r->id }}" method="POST"
                                                        onsubmit="return confirm('Do you want to delete the item?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fa fa-trash"></i></button>
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

    {{-- Bulk delete checkbox logic --}}
    <script>
        (function() {
            const checkAll = document.getElementById('checkAll');
            const btn = document.getElementById('bulkDeleteBtn');
            const countEl = document.getElementById('selectedCount');
            const checks = () => document.querySelectorAll('.row-check');

            function refresh() {
                const total = checks().length;
                const selected = document.querySelectorAll('.row-check:checked').length;
                countEl.textContent = selected;
                btn.disabled = selected === 0;
                checkAll.checked = total > 0 && selected === total;
                checkAll.indeterminate = selected > 0 && selected < total;
            }

            checkAll.addEventListener('change', function() {
                checks().forEach(c => c.checked = checkAll.checked);
                refresh();
            });

            checks().forEach(c => c.addEventListener('change', refresh));
        })();
    </script>
@endsection
