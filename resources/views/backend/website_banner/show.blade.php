{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @parent

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-eye"></i> Website Banner Details
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/website-banner') }}">Banner
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">

                                <h5 class="mt-3">About</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->about_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $row->about_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Banner</th>
                                        <td>
                                            @if ($row->about_banner)
                                                <img style="max-width:100%" src="{{ $row->about_banner }}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <h5 class="mt-3">Healthcare</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->healthcare_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $row->healthcare_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Banner</th>
                                        <td>
                                            @if ($row->healthcare_banner)
                                                <img style="max-width:100%" src="{{ $row->healthcare_banner }}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <h5 class="mt-3">Corporate</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->corporate_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $row->corporate_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Banner</th>
                                        <td>
                                            @if ($row->corporate_banner)
                                                <img style="max-width:100%" src="{{ $row->corporate_banner }}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <h5 class="mt-3">Health Force</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->health_force_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $row->health_force_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Banner</th>
                                        <td>
                                            @if ($row->health_force_banner)
                                                <img style="max-width:100%" src="{{ $row->health_force_banner }}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <h5 class="mt-3">Join Us</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->join_us_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $row->join_us_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Banner</th>
                                        <td>
                                            @if ($row->join_us_banner)
                                                <img style="max-width:100%" src="{{ $row->join_us_banner }}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <h5 class="mt-3">Stories</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->stories_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $row->stories_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Banner</th>
                                        <td>
                                            @if ($row->stories_banner)
                                                <img style="max-width:100%" src="{{ $row->stories_banner }}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
