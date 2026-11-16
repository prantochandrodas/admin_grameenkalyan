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
                                <h3 class="card-title"><i class="fa fa-eye"></i> News & Event Details
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/news-event') }}">News & Event
                                            List</a>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('/admin/news-event/' . $row->id . '/edit') }}">Edit</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Title</th>
                                        <td>{{ $row->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ optional($row->date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ optional($row->created_at)->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{!! $row->description !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($row->image)
                                                <a href="{{ $row->image }}" target="_blank">
                                                    <img src="{{ $row->image }}" class="img-thumbnail"
                                                        style="width:150px; height:150px; object-fit:cover;">
                                                </a>
                                            @else
                                                <span class="text-muted">No image uploaded</span>
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
