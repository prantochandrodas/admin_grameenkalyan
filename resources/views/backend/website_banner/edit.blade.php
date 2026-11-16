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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Website Banner Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/website-banner') }}">Banner
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/website-banner/{{ $row->id }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ method_field('PUT') }}

                                    {{-- ===================== ABOUT ===================== --}}
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">About</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">About Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="about_title"
                                                        value="{{ old('about_title', $row->about_title) }}">
                                                    @error('about_title')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">About Subtitle</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="about_subtitle"
                                                        value="{{ old('about_subtitle', $row->about_subtitle) }}">
                                                    @error('about_subtitle')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">About Banner</label>
                                                <div class="col-md-10">
                                                    @if ($row->about_banner)
                                                        <div class="mb-2">
                                                            <img style="max-width:250px" src="{{ $row->about_banner }}">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="about_banner" accept="image/*" />
                                                    <small class="form-text text-muted">Notun image dile purono ta replace
                                                        hobe. jpeg, jpg, png, webp. Auto compress hoye WebP hobe</small>
                                                    @error('about_banner')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ===================== HEALTHCARE ===================== --}}
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Healthcare</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Healthcare Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="healthcare_title"
                                                        value="{{ old('healthcare_title', $row->healthcare_title) }}">
                                                    @error('healthcare_title')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Healthcare Subtitle</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="healthcare_subtitle"
                                                        value="{{ old('healthcare_subtitle', $row->healthcare_subtitle) }}">
                                                    @error('healthcare_subtitle')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Healthcare Banner</label>
                                                <div class="col-md-10">
                                                    @if ($row->healthcare_banner)
                                                        <div class="mb-2">
                                                            <img style="max-width:250px"
                                                                src="{{ $row->healthcare_banner }}">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="healthcare_banner" accept="image/*" />
                                                    <small class="form-text text-muted">Notun image dile purono ta replace
                                                        hobe. jpeg, jpg, png, webp. Auto compress hoye WebP hobe</small>
                                                    @error('healthcare_banner')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ===================== CORPORATE ===================== --}}
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Corporate</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Corporate Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="corporate_title"
                                                        value="{{ old('corporate_title', $row->corporate_title) }}">
                                                    @error('corporate_title')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Corporate Subtitle</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="corporate_subtitle"
                                                        value="{{ old('corporate_subtitle', $row->corporate_subtitle) }}">
                                                    @error('corporate_subtitle')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Corporate Banner</label>
                                                <div class="col-md-10">
                                                    @if ($row->corporate_banner)
                                                        <div class="mb-2">
                                                            <img style="max-width:250px"
                                                                src="{{ $row->corporate_banner }}">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="corporate_banner" accept="image/*" />
                                                    <small class="form-text text-muted">Notun image dile purono ta replace
                                                        hobe. jpeg, jpg, png, webp. Auto compress hoye WebP hobe</small>
                                                    @error('corporate_banner')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ===================== HEALTH FORCE ===================== --}}
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Health Force</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Health Force Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="health_force_title"
                                                        value="{{ old('health_force_title', $row->health_force_title) }}">
                                                    @error('health_force_title')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Health Force Subtitle</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"
                                                        name="health_force_subtitle"
                                                        value="{{ old('health_force_subtitle', $row->health_force_subtitle) }}">
                                                    @error('health_force_subtitle')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Health Force Banner</label>
                                                <div class="col-md-10">
                                                    @if ($row->health_force_banner)
                                                        <div class="mb-2">
                                                            <img style="max-width:250px"
                                                                src="{{ $row->health_force_banner }}">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="health_force_banner" accept="image/*" />
                                                    <small class="form-text text-muted">Notun image dile purono ta replace
                                                        hobe. jpeg, jpg, png, webp. Auto compress hoye WebP hobe</small>
                                                    @error('health_force_banner')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ===================== JOIN US ===================== --}}
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Join Us</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Join Us Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="join_us_title"
                                                        value="{{ old('join_us_title', $row->join_us_title) }}">
                                                    @error('join_us_title')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Join Us Subtitle</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="join_us_subtitle"
                                                        value="{{ old('join_us_subtitle', $row->join_us_subtitle) }}">
                                                    @error('join_us_subtitle')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Join Us Banner</label>
                                                <div class="col-md-10">
                                                    @if ($row->join_us_banner)
                                                        <div class="mb-2">
                                                            <img style="max-width:250px"
                                                                src="{{ $row->join_us_banner }}">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="join_us_banner" accept="image/*" />
                                                    <small class="form-text text-muted">Notun image dile purono ta replace
                                                        hobe. jpeg, jpg, png, webp. Auto compress hoye WebP hobe</small>
                                                    @error('join_us_banner')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ===================== STORIES ===================== --}}
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Stories</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Stories Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="stories_title"
                                                        value="{{ old('stories_title', $row->stories_title) }}">
                                                    @error('stories_title')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Stories Subtitle</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="stories_subtitle"
                                                        value="{{ old('stories_subtitle', $row->stories_subtitle) }}">
                                                    @error('stories_subtitle')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label">Stories Banner</label>
                                                <div class="col-md-10">
                                                    @if ($row->stories_banner)
                                                        <div class="mb-2">
                                                            <img style="max-width:250px"
                                                                src="{{ $row->stories_banner }}">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="stories_banner" accept="image/*" />
                                                    <small class="form-text text-muted">Notun image dile purono ta replace
                                                        hobe. jpeg, jpg, png, webp. Auto compress hoye WebP hobe</small>
                                                    @error('stories_banner')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
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
