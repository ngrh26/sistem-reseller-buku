<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Laporan Pesanan</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #344054;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .header {
            background: #1A2B5C;
            color: #ffffff;
            padding: 20px 22px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header-subtitle {
            font-size: 10px;
            color: #dbe5f5;
        }

        .meta {
            width: 100%;
            margin-bottom: 18px;
            border-collapse: collapse;
        }

        .meta td {
            padding: 5px 0;
            vertical-align: top;
        }

        .meta-label {
            width: 130px;
            font-weight: bold;
            color: #526071;
        }

        .summary {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px;
            margin: 0 -8px 18px;
        }

        .summary td {
            width: 33.33%;
            border: 1px solid #e2e7ef;
            padding: 12px;
            vertical-align: top;
        }

        .summary-label {
            color: #687587;
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-value {
            color: #1A2B5C;
            font-size: 14px;
            font-weight: bold;
        }

        .summary-note {
            color: #8a94a3;
            font-size: 8px;
            margin-top: 4px;
        }

        .section-title {
            color: #1A2B5C;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
        }

        table.report th {
            background: #f1f5fa;
            color: #526071;
            border: 1px solid #dfe5ed;
            padding: 8px 6px;
            font-size: 8px;
            font-weight: bold;
            text-align: left;
        }

        table.report td {
            border: 1px solid #e2e7ef;
            padding: 7px 6px;
            font-size: 8px;
            vertical-align: middle;
        }

        table.report tr:nth-child(even) td {
            background: #fafcff;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .order-id {
            color: #1A2B5C;
            font-weight: bold;
        }

        .reseller-name {
            font-weight: bold;
            color: #344054;
        }

        .reseller-email {
            color: #8a94a3;
            font-size: 7px;
            margin-top: 2px;
        }

        .total {
            color: #1A2B5C;
            font-weight: bold;
        }

        .discount {
            color: #18794e;
            font-size: 7px;
            margin-top: 2px;
        }

        .badge {
            display: inline-block;
            padding: 3px 5px;
            border-radius: 8px;
            font-size: 7px;
            font-weight: bold;
        }

        .badge-paid {
            background: #e8f7ee;
            color: #18794e;
        }

        .badge-pending {
            background: #fff4d6;
            color: #8a6800;
        }

        .badge-failed {
            background: #fdeaea;
            color: #b42318;
        }

        .badge-processed {
            background: #edf3fb;
            color: #2E5B9C;
        }

        .badge-shipped {
            background: #e8f0ff;
            color: #2856a6;
        }

        .badge-completed {
            background: #e8f7ee;
            color: #18794e;
        }

        .badge-cancelled {
            background: #fdeaea;
            color: #b42318;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e2e7ef;
            color: #8a94a3;
            font-size: 8px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="header">

        <div class="header-title">
            Laporan Pesanan
        </div>

        <div class="header-subtitle">
            Sistem Reseller Buku PT Cyber Media Teknologi
        </div>

    </div>


    {{-- =========================
         INFORMASI LAPORAN
    ========================== --}}

    <table class="meta">

        <tr>
            <td class="meta-label">
                Periode
            </td>

            <td>
                {{ $startDate ?: 'Semua tanggal' }}
                -
                {{ $endDate ?: 'Sekarang' }}
            </td>
        </tr>

        <tr>
            <td class="meta-label">
                Status Pesanan
            </td>

            <td>
                {{ $statusLabel }}
            </td>
        </tr>

        <tr>
            <td class="meta-label">
                Status Pembayaran
            </td>

            <td>
                {{ $paymentStatusLabel }}
            </td>
        </tr>

        <tr>
            <td class="meta-label">
                Dicetak Pada
            </td>

            <td>
                {{ now()->format('d/m/Y H:i') }}
            </td>
        </tr>

    </table>


    {{-- =========================
         RINGKASAN
    ========================== --}}

    <table class="summary">

        <tr>

            <td>

                <div class="summary-label">
                    TOTAL PESANAN
                </div>

                <div class="summary-value">
                    {{ number_format($totalPesanan, 0, ',', '.') }}
                </div>

                <div class="summary-note">
                    Sesuai filter laporan
                </div>

            </td>

            <td>

                <div class="summary-label">
                    TOTAL PENDAPATAN
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>

                <div class="summary-note">
                    Dari pembayaran terverifikasi
                </div>

            </td>

            <td>

                <div class="summary-label">
                    TOTAL DISKON
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalDiskon, 0, ',', '.') }}
                </div>

                <div class="summary-note">
                    Dari pesanan yang sudah dibayar
                </div>

            </td>

        </tr>

    </table>


    {{-- =========================
         DAFTAR PESANAN
    ========================== --}}

    <div class="section-title">
        Daftar Pesanan
    </div>

    <table class="report">

        <thead>

            <tr>

                <th width="7%">
                    ID
                </th>

                <th width="20%">
                    RESELLER
                </th>

                <th width="14%">
                    TANGGAL
                </th>

                <th width="9%">
                    BUKU
                </th>

                <th width="15%">
                    TOTAL
                </th>

                <th width="13%">
                    PEMBAYARAN
                </th>

                <th width="12%">
                    STATUS
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($orders as $order)

                @php

                    $paymentClass = match ($order->payment_status) {
                        'paid' => 'badge-paid',
                        'pending' => 'badge-pending',
                        'failed' => 'badge-failed',
                        default => 'badge-pending',
                    };

                    $paymentLabel = match ($order->payment_status) {
                        'paid' => 'Sudah Dibayar',
                        'pending' => 'Belum Dibayar',
                        'failed' => 'Gagal',
                        default => ucfirst($order->payment_status),
                    };

                    $statusClass = match ($order->status) {
                        'processed' => 'badge-processed',
                        'shipped' => 'badge-shipped',
                        'completed' => 'badge-completed',
                        'cancelled' => 'badge-cancelled',
                        'pending' => 'badge-pending',
                        default => 'badge-pending',
                    };

                @endphp

                <tr>

                    {{-- ID --}}
                    <td class="text-center">

                        <span class="order-id">
                            #{{ $order->id }}
                        </span>

                    </td>


                    {{-- RESELLER --}}
                    <td>

                        <div class="reseller-name">
                            {{ $order->reseller?->name ?? '-' }}
                        </div>

                        <div class="reseller-email">
                            {{ $order->reseller?->email ?? '-' }}
                        </div>

                    </td>


                    {{-- TANGGAL --}}
                    <td>

                        {{ $order->order_date?->format('d/m/Y') ?? '-' }}

                        <br>

                        <span class="reseller-email">
                            {{ $order->order_date?->format('H:i') ?? '-' }}
                        </span>

                    </td>


                    {{-- JUMLAH BUKU --}}
                    <td class="text-center">

                        {{ $order->items->sum('quantity') }}

                    </td>


                    {{-- TOTAL --}}
                    <td>

                        <div class="total">
                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                        </div>

                        @if($order->discount_amount > 0)

                            <div class="discount">
                                Diskon:
                                Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                            </div>

                        @endif

                    </td>


                    {{-- PEMBAYARAN --}}
                    <td class="text-center">

                        <span class="badge {{ $paymentClass }}">
                            {{ $paymentLabel }}
                        </span>

                    </td>


                    {{-- STATUS --}}
                    <td class="text-center">

                        <span class="badge {{ $statusClass }}">
                            {{ $order->statusLabel() }}
                        </span>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        class="text-center"
                        style="padding: 30px;"
                    >
                        Tidak ada data pesanan yang sesuai dengan filter.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- =========================
         FOOTER
    ========================== --}}

    <div class="footer">

        Laporan ini dibuat secara otomatis oleh
        Sistem Reseller Buku PT Cyber Media Teknologi.

    </div>

</body>

</html>