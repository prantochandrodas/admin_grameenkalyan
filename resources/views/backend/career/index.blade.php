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
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Applicants</li>
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
                                <h3 class="card-title"> <i class="fa fa-list"></i> Applicants List </h3>
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
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                {{-- Bulk delete form (outside the table; checkboxes connect via form="bulkDeleteForm") --}}
                                <form id="bulkDeleteForm" action="{{ route('career.bulk-delete') }}" method="POST"
                                    onsubmit="return confirm('Do you want to delete the selected items?')">
                                    @csrf
                                </form>

                                <button type="submit" form="bulkDeleteForm" id="bulkDeleteBtn"
                                    class="btn btn-sm btn-danger mb-2" disabled>
                                    <i class="fa fa-trash"></i> Delete Selected
                                    (<span id="selectedCount">0</span>)
                                </button>

                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:30px"><input type="checkbox" id="selectAll"></th>
                                            <th>#</th>
                                            <th>Name of Applicant</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Department</th>
                                            <th>CV</th>
                                            <th>Applied Date</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 1; ?>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="row-checkbox" name="ids[]"
                                                        value="{{ $r->id }}" form="bulkDeleteForm">
                                                </td>
                                                <td>{{ $index++ }}.</td>
                                                <td>{{ $r->name ?? '' }}</td>
                                                <td>{{ $r->email ?? '' }}</td>
                                                <td>{{ $r->phone ?? '' }}</td>
                                                <td>{{ $r->department ?? '' }}</td>
                                                <td>
                                                    @if ($r->cv ?? '')
                                                        <a href="{{ $r->cv }}" download>Download CV</a>
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $r->created_at ? $r->created_at->format('d M Y') : '--' }}
                                                </td>
                                                <td>
                                                    <form action="/admin/career/{{ $r->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"><i
                                                                class="fa fa-trash "></i></button>
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

    {{-- bulk delete --}}
    <script>
        (function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const bulkBtn = document.getElementById('bulkDeleteBtn');
            const countEl = document.getElementById('selectedCount');

            function refresh() {
                const checked = document.querySelectorAll('.row-checkbox:checked').length;
                countEl.textContent = checked;
                bulkBtn.disabled = checked === 0;
                selectAll.checked = checkboxes.length > 0 && checked === checkboxes.length;
            }

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
                refresh();
            });

            checkboxes.forEach(cb => cb.addEventListener('change', refresh));
        })();
    </script>
@endsection
