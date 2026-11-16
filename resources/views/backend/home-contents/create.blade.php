{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}
    @parent

    <div class="content-wrapper">
        <!--    <section class="content-header">-->
        <!--        <div class="container-fluid">-->
        <!--            <div class="row mb-2">-->
        <!--                <div class="col-sm-12">-->
        <!--                    @include('common.msg')-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </section>-->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus"></i> Home Content Create Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/home-contents') }}">Home
                                            Content List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="{{ url('/admin/home-contents') }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="navbar_logo">Logo <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="navbar_logo" id="navbar_logo" accept="image/*" />
                                            <small class="form-text text-muted">Size should be max:100KB</small>

                                            @error('navbar_logo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="badge_image">Badge Image <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="badge_image" id="badge_image" accept="image/*"
                                                required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('badge_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Intro Title <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="intro_title"
                                                value="{{ old('intro_title') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('intro_title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Intro Sub Title One<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="intro_sub_title_one"
                                                value="{{ old('intro_sub_title_one') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('intro_sub_title_one')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Intro Sub Title Two<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="intro_sub_title_two"
                                                value="{{ old('intro_sub_title_two') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('intro_sub_title_two')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="chairman_thumb_image">Chairman Thumb
                                            Image <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="chairman_thumb_image" id="chairman_thumb_image"
                                                accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('chairman_thumb_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="chairman_speech">Chairman Speech </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="chairman_speech"
                                                value="{{ old('chairman_speech') }}" />
                                            <small class="form-text text-muted"></small>
                                            @error('chairman_speech')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Chairman Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="chairman_name"
                                                value="{{ old('chairman_name') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('chairman_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Chairman Designation <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="chairman_designation"
                                                value="{{ old('chairman_designation') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('chairman_designation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="md_thumb_image">MD Thumb Image <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="md_thumb_image" id="md_thumb_image"
                                                accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('md_thumb_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="md_speech">MD Speech </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="md_speech"
                                                value="{{ old('md_speech') }}" />
                                            <small class="form-text text-muted"></small>
                                            @error('md_speech')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">MD Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="md_name"
                                                value="{{ old('md_name') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('md_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">MD Designation <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="md_designation"
                                                value="{{ old('md_designation') }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('md_designation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="annual_report_banner_image">Annual
                                            Report Banner Image <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="annual_report_banner_image"
                                                id="annual_report_banner_image" accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('annual_report_banner_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="mhi_banner_image">Micro Health
                                            Insuarance Banner Image <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="mhi_banner_image" id="mhi_banner_image"
                                                accept="image/*" required />
                                            <small class="form-text text-muted">Size should be max:100KB</small>
                                            @error('mhi_banner_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="work_together_image">Work Together
                                            Image <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="work_together_image" id="work_together_image"
                                                accept="image/*" required />
                                            {{-- <small class="form-text text-muted">Size should be max:100KB</small> --}}
                                            @error('work_together_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                Create
                                            </button>
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
