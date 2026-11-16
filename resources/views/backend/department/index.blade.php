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
                    <!--                <h1>DataTables</h1>-->
                    @include('common.msg')
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department</li>
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
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-list"></i> Department List </h3>
                            <div class="float-right">
                                <form action="" method="get">
                                    <div class="input-group pr-2 col-sm-12">
                                        <input type="text" name="q" value="{{old('q', request('q'))}}" class="form-control form-control-sm" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="submit">Find</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="pr-2 float-right">
                                <a class="btn btn-sm btn-primary" href="{{url('/admin/department/create')}}">Create New</a>
                            </div>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="data" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <!--                                    <th>Status</th>-->
                                    <th style="width:184px">Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1;

                                ?>
                                @forelse($rows as $r)
                                <tr>
                                    <td>{{$index++}}.</td>
                                    <td>{{ $r->name??'' }}</td>
                                    <td >
                                        <form action="/admin/department/{{$r->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            @if($r->is_active)
                                                <a class="btn-sm btn-success" href="/admin/department/{{$r->id}}?active=false">Deactivate</a>
                                            @else
                                                <a class="btn-sm btn-warning" href="/admin/department/{{$r->id}}?active=true">Activate</a>
                                            @endif
                                            <a class="btn btn-sm btn-primary" href="/admin/department/{{$r->id}}/edit"><i class="fa fa-edit "></i></a>
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
        audiojs.events.ready(function () {
            var as = audiojs.createAll();
        });
    });
    $(document).ready(function () {
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false
        });
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });
        $("#search_reset").on('click', function () {
            $("input[type=text]").val(' ');
            $("input[type=select]").val(' ');
            window.location.href='/incoming';
        });
    });
</script>

@endsection

