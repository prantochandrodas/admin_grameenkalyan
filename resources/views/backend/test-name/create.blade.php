{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @parent

    @php
        // Validation fail hole old row gula ferot ashbe, na hole ekta khali row
        $oldTests = old('tests', [
            ['name' => '', 'rate' => '', 'discount_type' => 1, 'discount_percent' => 0, 'discount' => 0],
        ]);
    @endphp

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        @include('common.msg')
                        @error('tests')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                                <h3 class="card-title"><i class="fa fa-plus"></i> Test Name Create Form
                                    <span class="pr-2 float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ url('/admin/test-name') }}">Test Name
                                            List</a>
                                    </span>
                                </h3>
                            </div>
                            <form method="POST" action="{{ url('/admin/test-name') }}" id="test-form">
                                @csrf
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="test-table">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px">#</th>
                                                    <th style="min-width:200px">Name <span class="text-danger">*</span></th>
                                                    <th style="min-width:110px">Rate <span class="text-danger">*</span></th>
                                                    <th style="min-width:130px">Discount Type</th>
                                                    <th style="min-width:110px">Discount %</th>
                                                    <th style="min-width:110px">Discount</th>
                                                    <th style="min-width:110px">Net Price</th>
                                                    <th style="width:50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="test-body">
                                                @foreach ($oldTests as $i => $t)
                                                    <tr class="test-row">
                                                        <td class="serial align-middle">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control @error("tests.$i.name") is-invalid @enderror"
                                                                name="tests[{{ $i }}][name]"
                                                                value="{{ $t['name'] ?? '' }}" required>
                                                            @error("tests.$i.name")
                                                                <small class="text-danger d-block">{{ $message }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" min="0"
                                                                class="form-control rate"
                                                                name="tests[{{ $i }}][rate]"
                                                                value="{{ $t['rate'] ?? '' }}" required>
                                                            @error("tests.$i.rate")
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <select class="form-control discount-type"
                                                                name="tests[{{ $i }}][discount_type]">
                                                                <option value="1"
                                                                    {{ ($t['discount_type'] ?? 1) == 1 ? 'selected' : '' }}>
                                                                    Flat</option>
                                                                <option value="2"
                                                                    {{ ($t['discount_type'] ?? 1) == 2 ? 'selected' : '' }}>
                                                                    Percentage</option>
                                                            </select>
                                                            @error("tests.$i.discount_type")
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" min="0"
                                                                max="100" class="form-control discount-percent"
                                                                name="tests[{{ $i }}][discount_percent]"
                                                                value="{{ $t['discount_percent'] ?? 0 }}">
                                                            @error("tests.$i.discount_percent")
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" min="0"
                                                                class="form-control discount"
                                                                name="tests[{{ $i }}][discount]"
                                                                value="{{ $t['discount'] ?? 0 }}">
                                                            @error("tests.$i.discount")
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01"
                                                                class="form-control net-price" value="0" readonly>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <button type="button" class="btn btn-sm btn-danger remove-row"
                                                                title="Remove"><i class="fa fa-times"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-success" id="add-row">
                                        <i class="fa fa-plus"></i> Add Row
                                    </button>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="save-btn">Save All</button>
                                    <a href="{{ url('/admin/test-name') }}" class="btn btn-default">Cancel</a>
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
        <tr class="test-row">
            <td class="serial align-middle"></td>
            <td><input type="text" class="form-control" name="tests[__INDEX__][name]" required></td>
            <td><input type="number" step="0.01" min="0" class="form-control rate" name="tests[__INDEX__][rate]"
                    required></td>
            <td>
                <select class="form-control discount-type" name="tests[__INDEX__][discount_type]">
                    <option value="1" selected>Flat</option>
                    <option value="2">Percentage</option>
                </select>
            </td>
            <td><input type="number" step="0.01" min="0" max="100"
                    class="form-control discount-percent" name="tests[__INDEX__][discount_percent]" value="0"></td>
            <td><input type="number" step="0.01" min="0" class="form-control discount"
                    name="tests[__INDEX__][discount]" value="0"></td>
            <td><input type="number" step="0.01" class="form-control net-price" value="0" readonly></td>
            <td class="align-middle text-center">
                <button type="button" class="btn btn-sm btn-danger remove-row" title="Remove"><i
                        class="fa fa-times"></i></button>
            </td>
        </tr>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('test-form');
            var body = document.getElementById('test-body');
            var template = document.getElementById('row-template').innerHTML;
            var addBtn = document.getElementById('add-row');
            var saveBtn = document.getElementById('save-btn');
            var index = {{ count($oldTests) }}; // next row index

            // ---------- Row calculation ----------
            function calculateRow(row) {
                var rate = row.querySelector('.rate');
                var type = row.querySelector('.discount-type');
                var percent = row.querySelector('.discount-percent');
                var discount = row.querySelector('.discount');
                var net = row.querySelector('.net-price');

                var r = parseFloat(rate.value) || 0;
                var d = 0;

                if (type.value === '2') {
                    // Percentage
                    discount.readOnly = true;
                    percent.readOnly = false;
                    d = r * (parseFloat(percent.value) || 0) / 100;
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

            function renumber() {
                body.querySelectorAll('.test-row').forEach(function(row, i) {
                    row.querySelector('.serial').textContent = i + 1;
                });
            }

            function addRow() {
                body.insertAdjacentHTML('beforeend', template.replace(/__INDEX__/g, index++));
                var row = body.lastElementChild;
                calculateRow(row);
                renumber();
                row.querySelector('input[type="text"]').focus();
            }

            // ---------- Name error helpers ----------
            function setNameError(input, message) {
                clearNameError(input);
                input.classList.add('is-invalid');
                var small = document.createElement('small');
                small.className = 'text-danger js-name-error d-block';
                small.textContent = message;
                input.parentNode.appendChild(small);
            }

            function clearNameError(input) {
                input.classList.remove('is-invalid');
                input.parentNode.querySelectorAll('.js-name-error').forEach(function(el) {
                    el.remove();
                });
            }

            function nameInputs() {
                return body.querySelectorAll('input[name$="[name]"]');
            }

            // ---------- Events ----------
            body.addEventListener('input', function(e) {
                var row = e.target.closest('.test-row');
                if (row) calculateRow(row);

                // Name change korle oi field er error muche dao
                if (e.target.matches('input[name$="[name]"]')) {
                    clearNameError(e.target);
                    // Server side error (Blade) o muche dao
                    e.target.parentNode.querySelectorAll('small.text-danger:not(.js-name-error)').forEach(
                        function(el) {
                            el.remove();
                        });
                }
            });

            body.addEventListener('change', function(e) {
                var row = e.target.closest('.test-row');
                if (row) calculateRow(row);
            });

            // Row remove (kompokkhe 1ta row thakbe)
            body.addEventListener('click', function(e) {
                var btn = e.target.closest('.remove-row');
                if (!btn) return;

                if (body.querySelectorAll('.test-row').length <= 1) {
                    alert('At least one row is required');
                    return;
                }
                btn.closest('.test-row').remove();
                renumber();
            });

            addBtn.addEventListener('click', addRow);

            // ---------- Submit e duplicate check ----------
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // age check, tarpor submit

                var inputs = Array.prototype.slice.call(nameInputs());
                var hasError = false;
                var seen = {};

                inputs.forEach(clearNameError);

                // 1) Form er moddhe duplicate
                inputs.forEach(function(input) {
                    var val = input.value.trim().toLowerCase();
                    if (!val) return;

                    if (seen[val]) {
                        setNameError(input, 'Duplicate name in this form');
                        hasError = true;
                    } else {
                        seen[val] = true;
                    }
                });

                var names = inputs
                    .map(function(i) {
                        return i.value.trim();
                    })
                    .filter(function(v) {
                        return v !== '';
                    });

                // 2) Database e already ache kina
                saveBtn.disabled = true;
                saveBtn.textContent = 'Checking...';

                fetch('{{ url('/admin/test-name/check-names') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            names: names
                        })
                    })
                    .then(function(res) {
                        if (!res.ok) throw new Error('Request failed');
                        return res.json();
                    })
                    .then(function(data) {
                        var existing = data.existing || [];

                        inputs.forEach(function(input) {
                            var val = input.value.trim().toLowerCase();
                            if (val && existing.indexOf(val) !== -1) {
                                setNameError(input, 'This test name already exists');
                                hasError = true;
                            }
                        });

                        if (hasError) {
                            saveBtn.disabled = false;
                            saveBtn.textContent = 'Save All';
                            var firstErr = body.querySelector('.is-invalid');
                            if (firstErr) firstErr.focus();
                            return; // form submit hobe na
                        }

                        form.submit(); // native submit, submit event abar fire hoy na
                    })
                    .catch(function() {
                        // Check request fail hole server-side validation e bhorsha kore submit
                        form.submit();
                    });
            });

            // Prothombar load e shob row calculate
            body.querySelectorAll('.test-row').forEach(calculateRow);
            renumber();
        });
    </script>
@endsection
