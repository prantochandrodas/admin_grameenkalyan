{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    @parent

    @php
        // Validation fail hole old data, na hole database er details
        $initialDetails = old('details')
            ? array_values(old('details'))
            : $row->details
                ->map(function ($d) {
                    return [
                        'test_id' => $d->test_id,
                        'rate' => $d->rate,
                        'discount_type' => $d->discount_type,
                        'discount_percent' => $d->discount_percent,
                        'discount' => $d->discount,
                    ];
                })
                ->values()
                ->all();
    @endphp

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        @include('common.msg')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                                <h3 class="card-title"><i class="fa fa-edit"></i> Package Update Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/package') }}">Package
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <form class="form-horizontal" method="POST" action="/admin/package/{{ $row->id }}"
                                enctype="multipart/form-data" id="package-form">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="category_id">Category</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">-- No Category --</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ old('category_id', $row->category_id) == $c->id ? 'selected' : '' }}>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Optional</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="name">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name', $row->name) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="thumbnail_image">Thumbnail Image</label>
                                        <div class="col-md-10">
                                            <input type="file" name="thumbnail_image" id="thumbnail_image"
                                                accept="image/*" />
                                            <small class="form-text text-muted">Notun image na dile purano image
                                                thakbe</small>
                                            @if ($row->thumbnail_image ?? '')
                                                <img width="80px" src="{{ $row->thumbnail_image }}">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="description">Description</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $row->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="long_description">Long
                                            Description</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="long_description" id="long_description" rows="10">{{ old('long_description', $row->long_description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 control-label" for="is_active">Status</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="is_active" id="is_active">
                                                <option value="1"
                                                    {{ old('is_active', (int) $row->is_active) == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ old('is_active', (int) $row->is_active) == 0 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5>Package Tests</h5>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px">#</th>
                                                    <th style="min-width:220px">Test <span class="text-danger">*</span></th>
                                                    <th style="min-width:110px">Rate</th>
                                                    <th style="min-width:130px">Discount Type</th>
                                                    <th style="min-width:110px">Discount %</th>
                                                    <th style="min-width:110px">Discount</th>
                                                    <th style="min-width:110px">Net Price</th>
                                                    <th style="width:50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="detail-body"></tbody>
                                            <tfoot>
                                                <tr class="bg-light font-weight-bold">
                                                    <td colspan="2" class="text-right">Total</td>
                                                    <td><input type="text" class="form-control" id="total-rate" readonly>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input type="text" class="form-control" id="total-discount"
                                                            readonly></td>
                                                    <td><input type="text" class="form-control" id="total-amount"
                                                            readonly></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-success" id="add-row">
                                        <i class="fa fa-plus"></i> Add Test
                                    </button>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ url('/admin/package') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Notun row er template --}}
    <template id="row-template">
        <tr class="detail-row">
            <td class="serial align-middle"></td>
            <td>
                <select class="form-control test-select" name="details[__INDEX__][test_id]" required>
                    <option value="">-- Select Test --</option>
                    @foreach ($tests as $t)
                        <option value="{{ $t->id }}" data-rate="{{ $t->rate }}"
                            data-discount-type="{{ $t->discount_type }}"
                            data-discount-percent="{{ $t->discount_percent }}" data-discount="{{ $t->discount }}">
                            {{ $t->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" step="0.01" min="0" class="form-control rate"
                    name="details[__INDEX__][rate]" value="0" required></td>
            <td>
                <select class="form-control discount-type" name="details[__INDEX__][discount_type]">
                    <option value="1" selected>Flat</option>
                    <option value="2">Percentage</option>
                </select>
            </td>
            <td><input type="number" step="0.01" min="0" max="100"
                    class="form-control discount-percent" name="details[__INDEX__][discount_percent]" value="0">
            </td>
            <td><input type="number" step="0.01" min="0" class="form-control discount"
                    name="details[__INDEX__][discount]" value="0"></td>
            <td><input type="number" step="0.01" class="form-control net-price" value="0" readonly></td>
            <td class="align-middle text-center">
                <button type="button" class="btn btn-sm btn-danger remove-row" title="Remove"><i
                        class="fa fa-times"></i></button>
            </td>
        </tr>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('package-form');
            var body = document.getElementById('detail-body');
            var template = document.getElementById('row-template').innerHTML;
            var addBtn = document.getElementById('add-row');
            var index = 0;
            var initial = @json($initialDetails);

            function calculateRow(row) {
                var rate = row.querySelector('.rate');
                var type = row.querySelector('.discount-type');
                var percent = row.querySelector('.discount-percent');
                var discount = row.querySelector('.discount');
                var net = row.querySelector('.net-price');

                var r = parseFloat(rate.value) || 0;
                var d = 0;

                if (type.value === '2') {
                    discount.readOnly = true;
                    percent.readOnly = false;
                    d = r * (parseFloat(percent.value) || 0) / 100;
                    discount.value = d.toFixed(2);
                } else {
                    percent.readOnly = true;
                    discount.readOnly = false;
                    percent.value = 0;
                    d = parseFloat(discount.value) || 0;
                }

                var n = r - d;
                net.value = (n < 0 ? 0 : n).toFixed(2);
            }

            function calculateTotals() {
                var tr = 0,
                    td = 0,
                    ta = 0;
                body.querySelectorAll('.detail-row').forEach(function(row) {
                    tr += parseFloat(row.querySelector('.rate').value) || 0;
                    td += parseFloat(row.querySelector('.discount').value) || 0;
                    ta += parseFloat(row.querySelector('.net-price').value) || 0;
                });
                document.getElementById('total-rate').value = tr.toFixed(2);
                document.getElementById('total-discount').value = td.toFixed(2);
                document.getElementById('total-amount').value = ta.toFixed(2);
            }

            function renumber() {
                body.querySelectorAll('.detail-row').forEach(function(row, i) {
                    row.querySelector('.serial').textContent = i + 1;
                });
            }

            function clearErrors(row) {
                row.querySelectorAll('.js-error').forEach(function(el) {
                    el.remove();
                });
                row.querySelector('.test-select').classList.remove('is-invalid');
            }

            function setError(row, message) {
                clearErrors(row);
                var select = row.querySelector('.test-select');
                select.classList.add('is-invalid');
                var small = document.createElement('small');
                small.className = 'text-danger js-error d-block';
                small.textContent = message;
                select.parentNode.appendChild(small);
            }

            function addRow(data) {
                body.insertAdjacentHTML('beforeend', template.replace(/__INDEX__/g, index++));
                var row = body.lastElementChild;

                if (data) {
                    row.querySelector('.test-select').value = data.test_id || '';
                    row.querySelector('.rate').value = data.rate || 0;
                    row.querySelector('.discount-type').value = data.discount_type || 1;
                    row.querySelector('.discount-percent').value = data.discount_percent || 0;
                    row.querySelector('.discount').value = data.discount || 0;
                }

                calculateRow(row);
                renumber();
                calculateTotals();
            }

            // Test select korle test_names table er shob data auto boshe
            body.addEventListener('change', function(e) {
                var row = e.target.closest('.detail-row');
                if (!row) return;

                if (e.target.classList.contains('test-select')) {
                    clearErrors(row);
                    var opt = e.target.options[e.target.selectedIndex];

                    if (e.target.value) {
                        row.querySelector('.rate').value = opt.getAttribute('data-rate') || 0;
                        row.querySelector('.discount-type').value = opt.getAttribute(
                            'data-discount-type') || 1;
                        row.querySelector('.discount-percent').value = opt.getAttribute(
                            'data-discount-percent') || 0;
                        row.querySelector('.discount').value = opt.getAttribute('data-discount') || 0;
                    } else {
                        // "-- Select Test --" select korle reset
                        row.querySelector('.rate').value = 0;
                        row.querySelector('.discount-type').value = 1;
                        row.querySelector('.discount-percent').value = 0;
                        row.querySelector('.discount').value = 0;
                    }
                }

                calculateRow(row);
                calculateTotals();
            });

            body.addEventListener('input', function(e) {
                var row = e.target.closest('.detail-row');
                if (!row) return;
                calculateRow(row);
                calculateTotals();
            });

            body.addEventListener('click', function(e) {
                var btn = e.target.closest('.remove-row');
                if (!btn) return;

                if (body.querySelectorAll('.detail-row').length <= 1) {
                    alert('At least one test is required');
                    return;
                }
                btn.closest('.detail-row').remove();
                renumber();
                calculateTotals();
            });

            addBtn.addEventListener('click', function() {
                addRow(null);
            });

            // Submit e same test duibar select kora ache kina check
            form.addEventListener('submit', function(e) {
                var rows = body.querySelectorAll('.detail-row');
                var seen = {};
                var hasError = false;

                rows.forEach(function(row) {
                    clearErrors(row);
                    var val = row.querySelector('.test-select').value;
                    if (!val) return;

                    if (seen[val]) {
                        setError(row, 'Same test can not be added twice');
                        hasError = true;
                    } else {
                        seen[val] = true;
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    var first = body.querySelector('.is-invalid');
                    if (first) first.focus();
                }
            });

            initial.forEach(function(d) {
                addRow(d);
            });
        });
    </script>

    {{-- Summernote (Bootstrap 4) - shudhu Long Description er jonno --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadScript(src, cb) {
                var el = document.createElement('script');
                el.src = src;
                el.onload = cb;
                document.body.appendChild(el);
            }

            function initSummernote() {
                window.jQuery('#long_description').summernote({
                    placeholder: 'Long description likhun...',
                    height: 350,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'hr']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }

            function loadSummernote() {
                if (window.jQuery.fn.summernote) {
                    initSummernote();
                } else {
                    loadScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js',
                        initSummernote);
                }
            }

            if (window.jQuery) {
                loadSummernote();
            } else {
                loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', loadSummernote);
            }
        });
    </script>

@endsection
