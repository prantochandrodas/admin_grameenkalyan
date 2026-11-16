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
                        <li class="breadcrumb-item active">Visitors</li>
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
                            <h3 class="card-title"> <i class="fa fa-list"></i> Visitors List </h3>
                            <div class="float-right">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input name="q" type="text" class="form-control search_field" placeholder="Search...">
                                        <button onclick="emptySearchField()" type="button" class="btn bg-transparent" style="margin-left: -40px; z-index: 100;">
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
                            <table id="kt_datatable" class="table table-bordered table-striped table-responsive-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email From</th>
                                    <th>Subject</th>
                                    <th>Message</th>
{{--                                    <th style="width:184px">Operation</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1;

                                ?>
                                @forelse($rows as $r)
                                <tr>
                                    <td>{{$index++}}.</td>
                                    <td>{{ $r->name??'' }}</td>
                                    <td>{{ $r->email??'' }}</td>
                                    <td>{{$r->subject??''}}</td>
                                    <td>{{$r->message}}</td>

{{--                                    <td>--}}
{{--                                        <form action="/admin/categories/{{$r->id}}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            @if($r->status)--}}
{{--                                            <a class="btn-sm btn-success" href="/{{app()->getLocale()}}/admin/categories/{{$r->id}}?active=false">Active</a>--}}
{{--                                            @else--}}
{{--                                            <a class="btn-sm btn-warning" href="/{{app()->getLocale()}}/admin/categories/{{$r->id}}?active=true">Inactive</a>--}}
{{--                                            @endif--}}
{{--                                            <a class="btn btn-sm btn-primary" href="/{{app()->getLocale()}}/admin/categories/{{$r->id}}/edit"><i class="fa fa-edit "></i></a>--}}
{{--                                            <button type="submit" class="btn btn-sm btn-danger" onclick="confirm('Do you want to delete the item?')"><i class="fa fa-trash "></i></button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
                                </tr>
                                @empty
                                <tr><td colspan="5">No data found!</td></tr>
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
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

@endsection

