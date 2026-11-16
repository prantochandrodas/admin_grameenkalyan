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
                            <h3 class="card-title"><i class="fa fa-edit"></i> Locator Update Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/locator')}}">Locator List</a>
                                </span>
                            </h3>

                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="/admin/locator/{{$row->id}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ method_field('PUT') }}
                                <!-- <div class="form-group row">
                                    <label class="col-md-3 control-label" for="district_id">Division <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="district_id" id="district_id">
                                            <option>Select District</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->id??''}}" @if(old('district_id',$row->district_id)== $district->id) selected @endif>{{$district->name??''}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted"></small>
                                        @error('district_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-md-3 control-label" for="title">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="title" value="{{ old('title',$row->title) }}" id="title" required>
                                        <small class="form-text text-muted"></small>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 control-label" for="contact_info">Contact Info <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="contact_info" value="{{ old('contact_info',$row->contact_info) }}" id="contact_info" required>
                                        <small class="form-text text-muted"></small>
                                        @error('contact_info')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label" for="address">Address <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="address" value="{{ old('address',$row->address) }}" id="address" required>
                                        <small class="form-text text-muted"></small>
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label" for="map_location">Map Location <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="map_location" value="{{ old('map_location',$row->map_location) }}" id="map_location" required>
                                        <small class="form-text text-muted"></small>
                                        @error('map_location')
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

