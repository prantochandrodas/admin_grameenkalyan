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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Test Name Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/test-name') }}">Test Name
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST"
                                    action="/admin/test-name/{{ $row->id }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="name">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name', $row->name) }}" required>
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="rate">Rate <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                name="rate" id="rate" value="{{ old('rate', $row->rate) }}"
                                                required>
                                            @error('rate')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="discount_type">Discount Type <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="discount_type" id="discount_type" required>
                                                <option value="1"
                                                    {{ old('discount_type', $row->discount_type) == 1 ? 'selected' : '' }}>
                                                    Flat</option>
                                                <option value="2"
                                                    {{ old('discount_type', $row->discount_type) == 2 ? 'selected' : '' }}>
                                                    Percentage</option>
                                            </select>
                                            @error('discount_type')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="discount_percent">Discount Percent
                                            (%)</label>
                                        <div class="col-md-10">
                                            <input type="number" step="0.01" min="0" max="100"
                                                class="form-control" name="discount_percent" id="discount_percent"
                                                value="{{ old('discount_percent', $row->discount_percent) }}">
                                            @error('discount_percent')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="discount">Discount</label>
                                        <div class="col-md-10">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                name="discount" id="discount"
                                                value="{{ old('discount', $row->discount) }}">
                                            @error('discount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="net_price">Net Price</label>
                                        <div class="col-md-10">
                                            <input type="number" step="0.01" class="form-control" id="net_price"
                                                value="{{ old('net_price', $row->net_price) }}" readonly>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rate = document.getElementById('rate');
            var type = document.getElementById('discount_type');
            var percent = document.getElementById('discount_percent');
            var discount = document.getElementById('discount');
            var net = document.getElementById('net_price');

            function calculate() {
                var r = parseFloat(rate.value) || 0;
                var d = 0;

                if (type.value === '2') {
                    // Percentage
                    discount.readOnly = true;
                    percent.readOnly = false;
                    var p = parseFloat(percent.value) || 0;
                    d = r * p / 100;
                    discount.value = d.toFixed(2);
                } else {
                    // Flat
                    percent.readOnly = true;
                    discount.readOnly = false;
                    percent.value = 0;
                    d = parseFloat(discount.value) || 0;
                }

                var n = r - d;
                net.value = (n < 0 ? 0 : n).toFixed(2);
            }

            [rate, type, percent, discount].forEach(function(el) {
                el.addEventListener('input', calculate);
                el.addEventListener('change', calculate);
            });

            calculate();
        });
    </script>
@endsection
