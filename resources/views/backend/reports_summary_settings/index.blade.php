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
                        <li class="breadcrumb-item active">Summary Report Settings</li>
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
                            <h3 class="card-title"> <i class="fa fa-list"></i> Summary Report Settings List </h3>
                            <div class="float-right">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input name="q" type="text" class="form-control search_field" value="{{request()->input('q')??''}}" placeholder="Search...">
                                        <button onclick="emptySearchField()" type="button" class="btn bg-transparent" style="margin-left: -40px; z-index: 100;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="submit">Find</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="pr-2 float-right">
                                <a class="btn btn-sm btn-primary" href="{{url('/admin/project-category/create')}}">Create New</a>
                            </div> -->

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- for showing ajax msg -->
                            <div class="alert alert-success" role="alert" id="ajaxMsgSuccess" style="display: none;"></div>
                            <div class="alert alert-danger" role="alert" id="ajaxMsgError" style="display: none;"></div>
                            <!-- end for showing ajax msg -->
                            <table id="data" class="table table-bordered table-striped table-responsive-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th style="width:184px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1; ?>
                                @forelse($rows as $r)
                                <tr>
                                    <td>{{$index++}}.</td>
                                    <td>{{$r->key??''}}</td>
                                    <td><input type="number" class="form-control rss_value" sid="{{$r->id}}" value="{{$r->value}}"></td>
                                    <td>
                                        <form action="/admin/reports-summary-settings/{{$r->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            @if($r->is_active)
                                        <a class="btn btn-sm btn-success" href="/admin/reports-summary-settings/{{$r->id}}?is_active=1">Active</a>
                                        @else
                                            <a class="btn btn-sm btn-warning" href="/admin/reports-summary-settings/{{$r->id}}?is_active=2">Inactive</a>
                                        @endif
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete the item?')"><i class="fa fa-trash "></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5">No data found!</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>{!! $rows->appends(request()->query())->links('pagination::bootstrap-4') !!}</div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/reports-summary-settings') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="key">Key <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="key" value="{{ old('key') }}" id="key" required>
                                        <small class="form-text text-muted"></small>
                                        @error('key')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="value">Value <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="value" value="{{ old('value') }}" id="key" required>
                                        <small class="form-text text-muted"></small>
                                        @error('value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus"> Add New</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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

   $(".rss_value").on("change",function(){
     var settingsID = $(this).attr("sid");
     var settingsValue = $(this).val();
      onChangeSettingValue(settingsID,settingsValue);
   });
   $(".rss_value").on("input",function(){
     var settingsID = $(this).attr("sid");
     var settingsValue = $(this).val();
     onChangeSettingValue(settingsID,settingsValue);
   });


    function onChangeSettingValue(settingsID,settingsValue){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
        var baseURL = '<?= url('/'); ?>';
        $.ajax({
            url: baseURL+'/update-summary-report-settings',
            type: 'POST',
            data: {
                settings_id: settingsID,
                settings_value: settingsValue,
            },
            success: function (response) {
                $("#ajaxMsgSuccess").show("slow", function() {
                    $(this).html(response.message)
                });
            },
            error: function (xhr, status, error) {
                $("#ajaxMsgError").show("slow", function() {
                    $(this).html(error);
                });
            }
        });
   }    
</script>

@endsection

