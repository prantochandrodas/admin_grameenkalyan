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
                            <li class="breadcrumb-item active">Story Comments</li>
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
                                <h3 class="card-title"><i class="fa fa-comments"></i> Story Comment List</h3>
                                <div class="float-right">
                                    <form action="" method="get">
                                        <div class="input-group">
                                            <input name="q" type="text" class="form-control search_field"
                                                value="{{ request()->input('q') ?? '' }}" placeholder="Search...">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary" type="submit">Find</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                {{-- একটাই form, পুরো table এর ভেতরে --}}
                                <form id="bulkDeleteForm" action="{{ route('story-comments.bulk-destroy') }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="mb-2">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="bulkDeleteSubmit()">
                                            <i class="fa fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)
                                        </button>
                                    </div>

                                    <table class="table table-bordered table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:30px">
                                                    <input type="checkbox" id="checkAll" onclick="toggleAll(this)">
                                                </th>
                                                <th>#</th>
                                                <th>Story</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Comment</th>
                                                <th>Date</th>
                                                <th style="width:80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($rows as $r)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="row-check" name="ids[]"
                                                            value="{{ $r->id }}" onclick="updateCount()">
                                                    </td>
                                                    <td>{{ $rows->firstItem() + $loop->index }}.</td>
                                                    <td>{{ $r->story->title ?? 'Deleted Story' }}</td>
                                                    <td>{{ $r->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $r->user->email ?? 'N/A' }}</td>
                                                    <td style="max-width:350px; white-space:normal; word-break:break-word;">
                                                        {{ $r->comment }}
                                                    </td>
                                                    <td>{{ optional($r->created_at)->format('d M Y h:i A') }}</td>
                                                    <td>
                                                        {{-- formaction দিয়ে একই form অন্য route এ যাবে, nested form লাগবে না --}}
                                                        <button type="submit"
                                                            formaction="{{ route('story-comments.destroy', $r->id) }}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete this comment?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">No data found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div>{!! $rows->appends(request()->query())->links('pagination::bootstrap-4') !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function updateCount() {
            var checks = document.querySelectorAll('.row-check');
            var selected = document.querySelectorAll('.row-check:checked').length;
            document.getElementById('selectedCount').textContent = selected;

            var all = document.getElementById('checkAll');
            all.checked = checks.length > 0 && selected === checks.length;
            all.indeterminate = selected > 0 && selected < checks.length;
        }

        function toggleAll(source) {
            document.querySelectorAll('.row-check').forEach(function(c) {
                c.checked = source.checked;
            });
            updateCount();
        }

        function bulkDeleteSubmit() {
            var selected = document.querySelectorAll('.row-check:checked').length;
            if (selected === 0) {
                alert('Please select at least one comment.');
                return;
            }
            if (confirm('Do you want to delete ' + selected + ' selected comment(s)?')) {
                document.getElementById('bulkDeleteForm').submit();
            }
        }
    </script>
@endsection
