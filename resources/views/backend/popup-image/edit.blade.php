{{-- Extends layout --}}
@extends('layout.default')

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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Popup Image Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/popup-image') }}">Popup
                                            Image List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/popup-image/{{ $row->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Serial No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="number" min="0" class="form-control" name="serial_no"
                                                value="{{ old('serial_no', $row->serial_no) }}" required>
                                            @error('serial_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="image">Image</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" id="image" accept="image/*" />
                                            <small class="form-text text-muted">Jpeg/jpg/png, auto compress hobe. Notun
                                                image na dile purono ta thakbe</small>
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @if ($row->image)
                                                <img src="{{ $row->image }}" width="150px" class="mt-2">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
