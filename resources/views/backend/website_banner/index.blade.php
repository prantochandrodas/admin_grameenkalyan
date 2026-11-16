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
                            <li class="breadcrumb-item active">Website Banner</li>
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
                                <h3 class="card-title"> <i class="fa fa-list"></i> Website Banner List </h3>
                                @if ($rows->count() == 0)
                                    <div class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('/admin/website-banner/create') }}">Create New</a>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">#</th>
                                            <th>About</th>
                                            <th>Healthcare</th>
                                            <th>Corporate</th>
                                            <th>Health Force</th>
                                            <th>Join Us</th>
                                            <th>Stories</th>
                                            <th style="width:184px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = ($rows->currentPage() - 1) * $rows->perPage() + 1; ?>
                                        @forelse($rows as $r)
                                            <tr>
                                                <td>{{ $index++ }}.</td>
                                                <td>
                                                    @if ($r->about_banner)
                                                        <img width="100px" src="{{ $r->about_banner }}"><br>
                                                    @endif
                                                    {{ $r->about_title }}
                                                </td>
                                                <td>
                                                    @if ($r->healthcare_banner)
                                                        <img width="100px" src="{{ $r->healthcare_banner }}"><br>
                                                    @endif
                                                    {{ $r->healthcare_title }}
                                                </td>
                                                <td>
                                                    @if ($r->corporate_banner)
                                                        <img width="100px" src="{{ $r->corporate_banner }}"><br>
                                                    @endif
                                                    {{ $r->corporate_title }}
                                                </td>
                                                <td>
                                                    @if ($r->health_force_banner)
                                                        <img width="100px" src="{{ $r->health_force_banner }}"><br>
                                                    @endif
                                                    {{ $r->health_force_title }}
                                                </td>
                                                <td>
                                                    @if ($r->join_us_banner)
                                                        <img width="100px" src="{{ $r->join_us_banner }}"><br>
                                                    @endif
                                                    {{ $r->join_us_title }}
                                                </td>
                                                <td>
                                                    @if ($r->stories_banner)
                                                        <img width="100px" src="{{ $r->stories_banner }}"><br>
                                                    @endif
                                                    {{ $r->stories_title }}
                                                </td>
                                                <td>
                                                    <form action="/admin/website-banner/{{ $r->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-sm btn-info"
                                                            href="/admin/website-banner/{{ $r->id }}"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/admin/website-banner/{{ $r->id }}/edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to delete the item?')"><i
                                                                class="fa fa-trash"></i></button>
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
                </div>
            </div>
        </section>
    </div>
@endsection
