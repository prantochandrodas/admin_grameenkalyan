{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    @parent

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
            (float) $row->total_rate > 0
                ? round(((float) $row->total_discount / (float) $row->total_rate) * 100, 1)
                : 0;
    @endphp

    <div class="content-wrapper">
        <section class="content-header no-print">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @include('common.msg')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/package">Package</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        {{-- Top actions --}}
                        <div class="pkg-toolbar no-print">
                            <a class="btn btn-sm btn-default" href="{{ url('/admin/package') }}">
                                <i class="fa fa-arrow-left"></i> Package List
                            </a>
                            <div>
                                <a class="btn btn-sm btn-default" href="{{ url('/admin/package/' . $row->id . '/print') }}"
                                    target="_blank">
                                    <i class="fa fa-print"></i> Print
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ url('/admin/package/' . $row->id . '/edit') }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>

                        <div class="pkg-wrap" id="print-area">

                            {{-- Header --}}
                            <div class="pkg-head">
                                <div class="pkg-head-left">
                                    @if ($row->thumbnail_image)
                                        <img class="pkg-thumb" src="{{ $row->thumbnail_image }}" alt="{{ $row->name }}">
                                    @endif
                                    <div class="pkg-head-text">
                                        <div class="pkg-eyebrow">Healthcare Package</div>
                                        <h2 class="pkg-title">{{ $row->name }}</h2>
                                        <div class="pkg-badges">
                                            @if ($row->is_active)
                                                <span class="pkg-badge pkg-badge-active"><i class="pkg-dot"></i>
                                                    Active</span>
                                            @else
                                                <span class="pkg-badge pkg-badge-inactive"><i class="pkg-dot"></i>
                                                    Inactive</span>
                                            @endif
                                            <span class="pkg-badge pkg-badge-neutral">{{ $count }}
                                                {{ $count > 1 ? 'Tests' : 'Test' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="pkg-price">
                                    <div class="pkg-price-label">Package Price</div>
                                    <div class="pkg-price-value">{{ $money($row->total_amount) }}</div>
                                    @if ((float) $row->total_discount > 0)
                                        <div class="pkg-price-sub">
                                            <span class="pkg-strike">{{ $money($row->total_rate) }}</span>
                                            <span class="pkg-save">Save {{ $savePercent }}%</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Summary bar --}}
                            <div class="pkg-summary">
                                <div class="pkg-summary-item">
                                    <span class="pkg-summary-label">Total Tests</span>
                                    <span class="pkg-summary-value">{{ $count }}</span>
                                </div>
                                <div class="pkg-summary-item">
                                    <span class="pkg-summary-label">Total Rate</span>
                                    <span class="pkg-summary-value">{{ $money($row->total_rate) }}</span>
                                </div>
                                <div class="pkg-summary-item">
                                    <span class="pkg-summary-label">Package Discount</span>
                                    <span class="pkg-summary-value pkg-green">- {{ $money($row->total_discount) }}</span>
                                </div>
                                <div class="pkg-summary-item">
                                    <span class="pkg-summary-label">Net Amount</span>
                                    <span class="pkg-summary-value pkg-strong">{{ $money($row->total_amount) }}</span>
                                </div>
                            </div>

                            @if ($row->description)
                                <div class="pkg-section">
                                    <h6 class="pkg-section-title">About this package</h6>
                                    <p class="pkg-desc">{!! nl2br(e($row->description)) !!}</p>
                                </div>
                            @endif

                            {{-- Tests table --}}
                            <div class="pkg-section">
                                <h6 class="pkg-section-title">Included Tests</h6>

                                <div class="pkg-table-wrap">
                                    <table class="pkg-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:64px">SL</th>
                                                <th>Name of Test</th>
                                                <th class="text-right" style="width:130px">Rate</th>
                                                <th class="text-center" style="width:170px">Package Discount</th>
                                                <th class="text-right" style="width:130px">CH at present</th>
                                                <th class="text-right" style="width:160px">At present discount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($row->details as $d)
                                                <tr>
                                                    <td class="text-center pkg-sl">{{ $loop->iteration }}</td>
                                                    <td class="pkg-name">{{ optional($d->test)->name ?? 'N/A' }}</td>
                                                    <td class="text-right pkg-num">{{ $money($d->rate) }}</td>

                                                    @if ($loop->first)
                                                        <td class="pkg-merged" rowspan="{{ $count }}">
                                                            <div class="pkg-merged-inner">
                                                                <span class="pkg-merged-label">Total Saving</span>
                                                                <span
                                                                    class="pkg-merged-value">{{ $money($row->total_discount) }}</span>
                                                                @if ($savePercent > 0)
                                                                    <span class="pkg-merged-pill">{{ $savePercent }}%
                                                                        OFF</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    @endif

                                                    <td class="text-right pkg-num">{{ $money($d->net_price) }}</td>
                                                    <td
                                                        class="text-right pkg-num {{ (float) $d->discount > 0 ? 'pkg-green-text' : 'pkg-muted' }}">
                                                        {{ $discountText($d->discount) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center pkg-muted" style="padding:32px">No
                                                        tests found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right">Total</td>
                                                <td class="text-right pkg-num">{{ $money($row->total_rate) }}</td>
                                                <td class="text-center pkg-num">{{ $money($row->total_discount) }}</td>
                                                <td class="text-right pkg-num">{{ $money($row->total_amount) }}</td>
                                                <td class="text-right pkg-num">{{ $money($totalDetailDiscount) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Styles Section --}}
@section('styles')
    <style>
        .pkg-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .pkg-wrap {
            --pkg-text: #111827;
            --pkg-text-2: #4b5563;
            --pkg-muted: #9ca3af;
            --pkg-border: #e5e7eb;
            --pkg-bg-soft: #f9fafb;
            --pkg-green: #047857;
            --pkg-green-bg: #ecfdf5;
            --pkg-green-border: #a7f3d0;

            background: #fff;
            border: 1px solid var(--pkg-border);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(16, 24, 40, .06), 0 1px 2px rgba(16, 24, 40, .04);
            overflow: hidden;
            color: var(--pkg-text);
        }

        /* ---------- Header ---------- */
        .pkg-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            padding: 28px 32px;
            border-bottom: 1px solid var(--pkg-border);
        }

        .pkg-head-left {
            display: flex;
            align-items: center;
            gap: 20px;
            min-width: 0;
        }

        .pkg-thumb {
            width: 76px;
            height: 76px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--pkg-border);
        }

        .pkg-head-text {
            min-width: 0;
        }

        .pkg-eyebrow {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--pkg-muted);
            margin-bottom: 4px;
        }

        .pkg-title {
            margin: 0 0 10px;
            font-size: 21px;
            font-weight: 600;
            line-height: 1.35;
            color: var(--pkg-text);
        }

        .pkg-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pkg-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 999px;
            border: 1px solid transparent;
        }

        .pkg-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
            background: currentColor;
        }

        .pkg-badge-active {
            color: var(--pkg-green);
            background: var(--pkg-green-bg);
            border-color: var(--pkg-green-border);
        }

        .pkg-badge-inactive {
            color: #6b7280;
            background: #f3f4f6;
            border-color: #e5e7eb;
        }

        .pkg-badge-neutral {
            color: var(--pkg-text-2);
            background: #fff;
            border-color: var(--pkg-border);
        }

        /* Price block */
        .pkg-price {
            text-align: right;
            flex-shrink: 0;
        }

        .pkg-price-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--pkg-muted);
        }

        .pkg-price-value {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            color: var(--pkg-text);
        }

        .pkg-price-sub {
            margin-top: 4px;
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
        }

        .pkg-strike {
            color: var(--pkg-muted);
            text-decoration: line-through;
            font-size: 14px;
        }

        .pkg-save {
            font-size: 12px;
            font-weight: 600;
            color: var(--pkg-green);
            background: var(--pkg-green-bg);
            border: 1px solid var(--pkg-green-border);
            padding: 2px 8px;
            border-radius: 6px;
        }

        /* ---------- Summary bar ---------- */
        .pkg-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            background: var(--pkg-bg-soft);
            border-bottom: 1px solid var(--pkg-border);
        }

        .pkg-summary-item {
            padding: 16px 32px;
            border-right: 1px solid var(--pkg-border);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .pkg-summary-item:last-child {
            border-right: 0;
        }

        .pkg-summary-label {
            font-size: 12px;
            color: var(--pkg-text-2);
        }

        .pkg-summary-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--pkg-text);
            font-variant-numeric: tabular-nums;
        }

        .pkg-summary-value.pkg-strong {
            font-weight: 700;
        }

        .pkg-green {
            color: var(--pkg-green) !important;
        }

        /* ---------- Sections ---------- */
        .pkg-section {
            padding: 24px 32px 0;
        }

        .pkg-section:last-child {
            padding-bottom: 32px;
        }

        .pkg-section-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--pkg-text);
            margin: 0 0 12px;
            text-transform: none;
        }

        .pkg-desc {
            margin: 0;
            color: var(--pkg-text-2);
            font-size: 14px;
            line-height: 1.7;
        }

        /* ---------- Table ---------- */
        .pkg-table-wrap {
            overflow-x: auto;
            border: 1px solid var(--pkg-border);
            border-radius: 10px;
        }

        .pkg-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 760px;
        }

        .pkg-table thead th {
            background: var(--pkg-bg-soft);
            color: var(--pkg-text-2);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 12px 16px;
            border-bottom: 1px solid var(--pkg-border);
            white-space: nowrap;
            vertical-align: middle;
        }

        .pkg-table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f2f4;
            vertical-align: middle;
            color: var(--pkg-text-2);
        }

        .pkg-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .pkg-table tbody tr:hover td:not(.pkg-merged) {
            background: #fafafa;
        }

        .pkg-sl {
            color: var(--pkg-muted);
            font-weight: 500;
        }

        .pkg-name {
            color: var(--pkg-text);
            font-weight: 500;
        }

        .pkg-num {
            font-variant-numeric: tabular-nums;
        }

        .pkg-muted {
            color: var(--pkg-muted);
        }

        .pkg-green-text {
            color: var(--pkg-green);
            font-weight: 600;
        }

        /* Merged package discount cell */
        .pkg-table tbody td.pkg-merged {
            background: var(--pkg-green-bg);
            border-left: 1px solid var(--pkg-green-border);
            border-right: 1px solid var(--pkg-green-border);
            text-align: center;
        }

        .pkg-merged-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .pkg-merged-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--pkg-green);
        }

        .pkg-merged-value {
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
            color: var(--pkg-green);
            font-variant-numeric: tabular-nums;
        }

        .pkg-merged-pill {
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            background: var(--pkg-green);
            padding: 3px 10px;
            border-radius: 999px;
        }

        /* Total row */
        .pkg-table tfoot td {
            background: var(--pkg-bg-soft);
            border-top: 1px solid var(--pkg-border);
            padding: 14px 16px;
            font-weight: 700;
            color: var(--pkg-text);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 992px) {
            .pkg-summary {
                grid-template-columns: repeat(2, 1fr);
            }

            .pkg-summary-item:nth-child(2) {
                border-right: 0;
            }

            .pkg-summary-item:nth-child(-n+2) {
                border-bottom: 1px solid var(--pkg-border);
            }
        }

        @media (max-width: 768px) {
            .pkg-head {
                flex-direction: column;
                align-items: flex-start;
                padding: 20px 18px;
            }

            .pkg-price {
                text-align: left;
            }

            .pkg-price-sub {
                justify-content: flex-start;
            }

            .pkg-summary-item {
                padding: 14px 18px;
            }

            .pkg-section {
                padding: 20px 18px 0;
            }

            .pkg-section:last-child {
                padding-bottom: 22px;
            }

            .pkg-title {
                font-size: 18px;
            }

            .pkg-head-left {
                align-items: flex-start;
            }

            .pkg-thumb {
                width: 60px;
                height: 60px;
            }
        }

        /* ---------- Print ---------- */
        @media print {

            .no-print,
            .main-header,
            .main-sidebar,
            .main-footer,
            .content-header {
                display: none !important;
            }

            .content-wrapper {
                margin: 0 !important;
                padding: 0 !important;
            }

            .pkg-wrap {
                border: 0;
                box-shadow: none;
                border-radius: 0;
            }

            .pkg-table-wrap {
                overflow: visible;
            }

            .pkg-wrap,
            .pkg-wrap * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
@endsection
