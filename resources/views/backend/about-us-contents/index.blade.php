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
                        <!--<h1>DataTables</h1>-->
                        @include('common.msg')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">About Us Contents</li>
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
                                <h3 class="card-title"> <i class="fa fa-list"></i> About Us Content List </h3>
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
                                    <a class="btn btn-sm btn-primary" href="{{ url('/admin/about-us/create') }}">Create
                                        New</a>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Banner Image</th>
                                            <th>Mission Vision Title</th>
                                            <th>Mission Vision Sub-Title</th>
                                            <th>Mission</th>
                                            <th>Vision</th>
                                            <th>Company Intro Title</th>
                                            <th>Company Intro Description</th>
                                            <th>Inception Banner Image</th>
                                            <th>Inception Title</th>
                                            <th>Inception Details</th>
                                            <th>Presence Title</th>
                                            <th>Presence Sub-Title</th>
                                            <th>Presence Banner Image</th>
                                            <th>Presence Details</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 1;
                                        
                                        ?>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>{{ $index++ }}.</td>
                                                <td>{!! $r->title ?? '' !!}</td>
                                                <td><img width="50px" src="{{ $r->banner_image ?? '' }}"></td>
                                                <td>{{ $r->mission_vision_title ?? '' }}</td>
                                                <td>{{ $r->mission_vision_subtitle ?? '' }}</td>
                                                <td>{{ $r->mission ?? '' }}</td>
                                                <td>{{ $r->vision ?? '' }}</td>
                                                <td>{{ $r->company_intro_title ?? '' }}</td>
                                                <td>{!! wordSummary($r->company_intro_description ?? '', 100) !!}</td>
                                                <td><img width="50px" src="{{ $r->inception_banner_image ?? '' }}"></td>
                                                <td>{{ $r->inception_title ?? '' }}</td>
                                                <td>{!! wordSummary($r->inception_details ?? '', 100) !!}</td>
                                                <td>{{ $r->presence_title ?? '' }}</td>
                                                <td>{{ $r->presence_sub_title ?? '' }}</td>
                                                <td><img width="50px" src="{{ $r->presence_banner_image ?? '' }}"></td>
                                                <td>{!! wordSummary($r->presence_details ?? '', 100) !!}</td>
                                                <td>
                                                    <form action="/admin/about-us/{{ $r->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/admin/about-us/{{ $r->id }}/edit"><i
                                                                class="fa fa-edit "></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"><i
                                                                class="fa fa-trash "></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="17" class="text-center font-weight-bold text-primary">No data
                                                    found!</td>
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
@endsection
