{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@parent

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-plus"></i> Member Create Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/members')}}">Member List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/members') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="name">Full Name <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        <small class="form-text text-muted"></small>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="designation">Designation <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                       <select class="form-control" id="designation" name="designation">
                                            <option value="Chairman" @if(old('designation')=='Chairman') selected @endif>Chairman</option>
                                            <option value="Managing Director" @if(old('designation')=='Managing Director') selected @endif>Managing Director</option>
                                            <option value="Director" @if(old('designation')=='Director') selected @endif>Director</option>
                                        </select>
                                        <small class="form-text text-muted"></small>
                                        @error('designation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="company">Company <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                       <select class="form-control" id="company" name="company">
                                            <option value="Grameen Kalyan" @if(old('company')=='Grameen Kalyan') selected @endif>Grameen Kalyan</option>
                                        </select>
                                        <small class="form-text text-muted"></small>
                                        @error('company')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="profile_photo">Profile Image <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="file" name="profile_photo"  id="profile_photo" accept="image/*" required />
                                        <small class="form-text text-muted">Size should be max:50KB</small>
                                        @error('profile_photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="desc">Description </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control rich_editor" name="desc" >{{ old('desc') }}</textarea>
                                        <small class="form-text text-muted"></small>
                                        @error('desc')
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
