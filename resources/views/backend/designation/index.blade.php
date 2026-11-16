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
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Designation</li>
                    </ol>
                </div>
                <div class="col-sm-12">
                    @include('common.msg')
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="mb-15">
                                <a class="card-title font-size-h3 text-secondary"><i class="fa fa-list mr-2"></i> Designation List </a>
                                <a class="btn btn-sm btn-outline-primary float-right" href="{{url('/admin/designation/create')}}"><i class="fa fa-plus-circle"></i> Create</a>

                            </div>
                            <div class="float-right">
                                <form action="" method="get">
                                    <div class="input-group pr-2 col-sm-12">
                                        <input type="text" name="q" value="{{old('q', request('q'))}}" class="form-control form-control-sm" placeholder="Search..." aria-label="Search by name..." aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="submit">Find</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="float-right">
                                <a href="{{url('admin/designation')}}" class="btn btn-outline-primary btn-sm">Refresh</a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="data" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center" style="width:184px">Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rows as $key=>$r)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $r->name??'' }}</td>
                                    <td class="text-center">
                                        <form action="/admin/designation/{{$r->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            @if($r->is_active)
                                                <a class="btn-sm btn-success" href="/admin/designation/{{$r->id}}?active=false">Deactivate</a>
                                            @else
                                                <a class="btn-sm btn-warning" href="/admin/designation/{{$r->id}}?active=true">Activate</a>
                                            @endif
                                            <a class="btn btn-sm btn-primary" href="/admin/designation/{{$r->id}}/edit"><i class="fa fa-edit "></i></a>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete the item?')"><i class="fa fa-trash "></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5">No data found!</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div>{!! $rows->appends(request()->query())->links('pagination::bootstrap-4') !!}</div>
                        </div>
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
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>

<style>
    .flex-wrap {
        float: right;
        margin-bottom: 5px;
    }
</style>
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#data').DataTable({
            dom: "<'row'<'col-sm-12'B>>" +
                "<'row'<'col-md-6'l><'col-md-6'f>r>" +
                "t" +
                "<'row'<'col-md-6'i><'col-md-6'p>>",
            buttons: ['pdf', 'csv', 'excel', 'print'],
            "scrollX": true
        });
    });
    $(document).ready(function () {
        $("#search_reset").on('click', function () {
            $("input[type=text]").val(' ');
            $("input[type=select]").val(' ');
            window.location.href='/incoming';
        });
    });
</script>

@endsection

