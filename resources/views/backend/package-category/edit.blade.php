{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @parent

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        @include('common.msg')
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-edit"></i> Package Category Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('/admin/package-category') }}">Package Category List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/package-category/{{ $row->id }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="name">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" value="{{ old('name', $row->name) }}" required
                                                autofocus>
                                            @error('name')
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="details">Details</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control @error('details') is-invalid @enderror" name="details" id="details" rows="4">{{ old('details', $row->details) }}</textarea>
                                            @error('details')
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ url('/admin/package-category') }}"
                                                class="btn btn-default">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
