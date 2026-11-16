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
                                <h3 class="card-title"><i class="fa fa-edit"></i> People Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/people') }}">People List</a>
                                    </span>
                                </h3>

                            </div>

                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/people/{{ $row->id }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ method_field('PUT') }}

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="serial_no">Serial No </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="serial_no" name="serial_no"
                                                value="{{ old('serial_no', $row->serial_no) }}">
                                            <small class="form-text text-muted"></small>
                                            @error('serial_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="name">Full Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $row->name) }}" required>
                                            <small class="form-text text-muted"></small>
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="designation">Designation <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="designation" name="designation">
                                                @foreach ($designations as $r)
                                                    <option <?php if (old('designation', $row->designation) == $r->id) {
                                                        echo 'selected';
                                                    } ?> value="{{ $r->id }}">
                                                        {{ ucwords($r->name) }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted"></small>
                                            @error('designation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="team">Team <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="team" name="team">
                                                @foreach ($departments as $rr)
                                                    <option <?php if (old('team', $row->team) == $rr->id) {
                                                        echo 'selected';
                                                    } ?> value="{{ $rr->id }}">
                                                        {{ ucwords($rr->name) }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted"></small>
                                            @error('team')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="profile_photo">Profile Image <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="file" name="profile_photo" id="profile_photo"
                                                accept="image/*" />
                                            <small class="form-text text-muted">Size should be max:50KB</small>
                                            @if ($row->profile_photo ?? '')
                                                <img width="80px" src="{{ $row->profile_photo ?? '' }}">
                                            @endif
                                            @error('profile_photo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="desc">Description </label>
                                        <div class="col-md-10">
                                            <textarea type="text" class="form-control rich_editor" name="desc">{{ old('desc', $row->desc) }}</textarea>
                                            <small class="form-text text-muted"></small>
                                            @error('desc')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                Update
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
