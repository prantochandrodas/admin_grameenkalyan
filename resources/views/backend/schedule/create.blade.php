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
                                <h3 class="card-title"><i class="fa fa-plus"></i> Schedule Create Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/schedule') }}">Schedule
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="{{ url('/admin/schedule') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="tabLabel">Tab Label <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tabLabel" id="tabLabel"
                                                value="{{ old('tabLabel') }}" required>
                                            @error('tabLabel')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="title">Title <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="title" id="title"
                                                value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="days">Days <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="days" id="days"
                                                value="{{ old('days') }}" required>
                                            @error('days')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="time">Time <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="time" id="time"
                                                value="{{ old('time') }}" required>
                                            @error('time')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">Create</button>
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
