@php
    $count = $row->details->count();

    $money = function ($v) {
        return number_format((float) $v, 2);
    };
    // 0 hole "-" dekhabe
    $discountText = function ($v) {
        return (float) $v > 0 ? number_format((float) $v, 2) : '-';
    };

    $totalDetailDiscount = $row->details->sum('discount');
    $savePercent =
        (float) $row->total_rate > 0 ? round(((float) $row->total_discount / (float) $row->total_rate) * 100, 1) : 0;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $row->name }} - Package</title>

    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 14mm;
        }

        body {
            margin: 0;
            background: #f3f4f6;
            font-family: -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #111827;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Screen toolbar (print e hide hoy) */
        .toolbar {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 24px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .toolbar .title {
            font-weight: 600;
            color: #374151;
        }

        .btn {
            display: inline-block;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #374151;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }

        /* Paper */
        .paper {
            width: 210mm;
            max-width: 100%;
            margin: 24px auto;
            background: #fff;
            padding: 14mm;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
        }

        /* Header */
        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding-bottom: 18px;
            border-bottom: 2px solid #111827;
        }

        .head-left {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }

        .thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            flex-shrink: 0;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .title-main {
            margin: 2px 0 0;
            font-size: 19px;
            font-weight: 700;
            line-height: 1.35;
        }

        .price {
            text-align: right;
            flex-shrink: 0;
        }

        .price-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .price-value {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.2;
        }

        .price-sub {
            margin-top: 2px;
            font-size: 12px;
            color: #6b7280;
        }

        .price-sub .strike {
            text-decoration: line-through;
            margin-right: 6px;
        }

        .price-sub .save {
            color: #047857;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            padding: 1px 7px;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Summary */
        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            margin-top: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            background: #f9fafb;
        }

        .summary div {
            padding: 10px 14px;
            border-right: 1px solid #e5e7eb;
        }

        .summary div:last-child {
            border-right: 0;
        }

        .summary span {
            display: block;
        }

        .summary .l {
            font-size: 11px;
            color: #6b7280;
        }

        .summary .v {
            font-size: 16px;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        .green {
            color: #047857;
        }

        .section-title {
            margin: 20px 0 8px;
            font-size: 13px;
            font-weight: 700;
        }

        .desc {
            margin: 0;
            color: #4b5563;
            line-height: 1.7;
            font-size: 13px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .tbl-wrap {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        thead th {
            background: #f3f4f6;
            color: #4b5563;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        tbody td {
            padding: 9px 12px;
            border-bottom: 1px solid #eef0f2;
            vertical-align: middle;
            color: #374151;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tr {
            page-break-inside: avoid;
        }

        .c {
            text-align: center;
        }

        .r {
            text-align: right;
        }

        .num {
            font-variant-numeric: tabular-nums;
        }

        .sl {
            color: #9ca3af;
        }

        .name {
            color: #111827;
            font-weight: 500;
        }

        .muted {
            color: #9ca3af;
        }

        .gtext {
            color: #047857;
            font-weight: 600;
        }

        td.merged {
            background: #ecfdf5;
            text-align: center;
            border-left: 1px solid #a7f3d0;
            border-right: 1px solid #a7f3d0;
        }

        .merged-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #047857;
        }

        .merged-value {
            display: block;
            margin: 6px 0;
            font-size: 24px;
            font-weight: 700;
            color: #047857;
        }

        .merged-pill {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            color: #fff;
            background: #047857;
            padding: 2px 9px;
            border-radius: 999px;
        }

        tfoot td {
            background: #f3f4f6;
            border-top: 1px solid #e5e7eb;
            padding: 11px 12px;
            font-weight: 700;
            color: #111827;
        }

        .footer {
            margin-top: 18px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #9ca3af;
        }

        /* Print */
        @media print {
            body {
                background: #fff;
            }

            .toolbar {
                display: none !important;
            }

            .paper {
                width: auto;
                margin: 0;
                padding: 0;
                border: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <div class="toolbar">
        <span class="title">Print Preview</span>
        <div>
            <button type="button" class="btn" onclick="window.close()">Close</button>
            <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>

    <div class="paper">

        {{-- Header --}}
        <div class="head">
            <div class="head-left">
                @if ($row->thumbnail_image)
                    <img class="thumb" src="{{ $row->thumbnail_image }}" alt="{{ $row->name }}">
                @endif
                <div>
                    <div class="eyebrow">Healthcare Package</div>
                    <h1 class="title-main">{{ $row->name }}</h1>
                </div>
            </div>

            <div class="price">
                <div class="price-label">Package Price</div>
                <div class="price-value">{{ $money($row->total_amount) }}</div>
                @if ((float) $row->total_discount > 0)
                    <div class="price-sub">
                        <span class="strike">{{ $money($row->total_rate) }}</span>
                        <span class="save">Save {{ $savePercent }}%</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Summary --}}
        <div class="summary">
            <div>
                <span class="l">Total Tests</span>
                <span class="v">{{ $count }}</span>
            </div>
            <div>
                <span class="l">Total Rate</span>
                <span class="v">{{ $money($row->total_rate) }}</span>
            </div>
            <div>
                <span class="l">Package Discount</span>
                <span class="v green">- {{ $money($row->total_discount) }}</span>
            </div>
            <div>
                <span class="l">Net Amount</span>
                <span class="v">{{ $money($row->total_amount) }}</span>
            </div>
        </div>

        @if ($row->description)
            <div class="section-title">About this package</div>
            <p class="desc">{!! nl2br(e($row->description)) !!}</p>
        @endif

        {{-- Tests --}}
        <div class="section-title">Included Tests</div>
        <div class="tbl-wrap">
            <table>
                <thead>
                    <tr>
                        <th class="c" style="width:50px">SL</th>
                        <th style="text-align:left">Name of Test</th>
                        <th class="r" style="width:90px">Rate</th>
                        <th class="c" style="width:120px">Package Discount</th>
                        <th class="r" style="width:90px">CH at present</th>
                        <th class="r" style="width:100px">At present discount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($row->details as $d)
                        <tr>
                            <td class="c sl">{{ $loop->iteration }}</td>
                            <td class="name">{{ optional($d->test)->name ?? 'N/A' }}</td>
                            <td class="r num">{{ $money($d->rate) }}</td>

                            @if ($loop->first)
                                <td class="merged" rowspan="{{ $count }}">
                                    <span class="merged-label">Total Saving</span>
                                    <span class="merged-value">{{ $money($row->total_discount) }}</span>
                                    @if ($savePercent > 0)
                                        <span class="merged-pill">{{ $savePercent }}% OFF</span>
                                    @endif
                                </td>
                            @endif

                            <td class="r num">{{ $money($d->net_price) }}</td>
                            <td class="r num {{ (float) $d->discount > 0 ? 'gtext' : 'muted' }}">
                                {{ $discountText($d->discount) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="c muted" style="padding:24px">No tests found!</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="r">Total</td>
                        <td class="r num">{{ $money($row->total_rate) }}</td>
                        <td class="c num">{{ $money($row->total_discount) }}</td>
                        <td class="r num">{{ $money($row->total_amount) }}</td>
                        <td class="r num">{{ $money($totalDetailDiscount) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="footer">
            <span>Grameen Kalyan</span>
            <span>Printed on {{ now()->format('d M Y, h:i A') }}</span>
        </div>
    </div>

    <script>
        // Page load hole automatic print dialog khulbe
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 400);
        });
    </script>
</body>

</html>
