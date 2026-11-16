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
                                <h3 class="card-title"><i class="fa fa-eye"></i> Donate Details
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/donate') }}">Donate List</a>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('/admin/donate/' . $row->id . '/edit') }}">Edit</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:200px">Name</th>
                                        <td>{{ $row->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $row->title }}</td>
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
                                        <th>Images ({{ $row->images->count() }})</th>
                                        <td>
                                            @forelse($row->images as $img)
                                                <a href="{{ $img->image }}" target="_blank">
                                                    <img src="{{ $img->image }}" class="img-thumbnail mr-2 mb-2"
                                                        style="width:150px; height:150px; object-fit:cover;">
                                                </a>
                                            @empty
                                                <span class="text-muted">No image uploaded</span>
                                            @endforelse
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
