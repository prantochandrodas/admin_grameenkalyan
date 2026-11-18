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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Health Center Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/health-center') }}">Health
                                            Center List</a>
                                    </span>
                                </h3>

                            </div>

                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/health-center/{{ $row->id }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ method_field('PUT') }}
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="titnamele">Health Center Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', $row->name) }}" id="name" required>
                                            <small class="form-text text-muted"></small>
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="title">Division <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="division_id" id="division_id">
                                                <option>Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id ?? '' }}"
                                                        @if (old('division_id', $row->division_id) == $division->id) selected @endif>
                                                        {{ $division->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted"></small>
                                            @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="title">District <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="district_id"
                                                district_id="{{ old('district_id', $row->district_id) }}" id="district_id">
                                                <option>Select District</option>
                                            </select>
                                            <small class="form-text text-muted"></small>
                                            @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="title">Upazilla <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="upazilla_id" id="upazilla_id"
                                                upazilla_id="{{ old('upazilla_id', $row->upazilla_id) }}">
                                                <option>Select Upazilla</option>
                                            </select>
                                            <small class="form-text text-muted"></small>
                                            @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="banner_image">Banner Image Upload
                                        </label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="banner_image"
                                                value="{{ old('banner_image') }}" id="banner_image">
                                            <small class="form-text text-muted"></small>
                                            @if ($row->banner_image)
                                                <img width="100px" src="{{ $row->banner_image }}">
                                            @endif
                                            @error('banner_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="contact_info">Contact Info <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="contact_info"
                                                value="{{ old('contact_info', $row->contact_info) }}" id="contact_info"
                                                required>
                                            <small class="form-text text-muted"></small>
                                            @error('contact_info')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="address">Address <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address', $row->address) }}" id="address" required>
                                            <small class="form-text text-muted"></small>
                                            @error('address')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="map_location">Map Location <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="map_location"
                                                value="{{ old('map_location', $row->map_location) }}" id="map_location"
                                                required>
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
@section('scripts')
    @parent
    <script>
        $('#division_id').change(function() {
            getDistrictByDivision();
        });

        $('#district_id').change(function() {
            var district_id = $('#district_id').val();
            getUpazillaByDistrict('', district_id);
        });

        function getDistrictByDivision(district = '') {
            var division_id = $('#division_id').val();
            $.ajax({
                url: "/get-district",
                type: "get", //send it through get method
                data: {
                    division: division_id,
                    district: district
                },
                success: function(response) {
                    $('#district_id').html(response);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        };

        function getUpazillaByDistrict(upazilla = '', district = '') {
            $.ajax({
                url: "/get-upazilla",
                type: "get", //send it through get method
                data: {
                    district: district,
                    upazilla: upazilla
                },
                success: function(response) {
                    $('#upazilla_id').html(response);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }

        $(document).ready(function() {
            var district = $('#district_id').attr('district_id');
            var upazilla = $('#upazilla_id').attr('upazilla_id');
            getDistrictByDivision(district);
            getUpazillaByDistrict(upazilla, district);
        });
    </script>
@endsection
