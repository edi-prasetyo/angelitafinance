<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Data Orders</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        table th {
            background: #f1f1f1;
            font-weight: bold;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
        }

        .total-row {
            font-weight: bold;
            background: #f8f8f8;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()">🖨 Print Sekarang</button>
        <a href="{{ url()->previous() }}">⬅ Kembali</a>
    </div>

    <h2 class="title">Laporan Order Sudah Dibayar</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Rental</th>
                <th>Partner</th>
                <th>Order Date</th>
                <th>Start Date</th>
                <th>Order Code</th>
                <th>Bill</th>
                <th>Ammount</th>
                <th>Payment Status</th>
            </tr>
        </thead>

        <tbody>

            @php $total = 0; @endphp

            @foreach ($orders as $o)
                @php
                    $total += $o->amount_sum;
                @endphp

                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->customer->full_name ?? '-' }}</td>
                    <td>{{ $o->rental->name }}</td>
                    <td>{{ $o->partner->name }}</td>

                    {{-- Format tanggal 2 Maret 2025 --}}
                    <td>
                        {{ $o->order_date ? \Carbon\Carbon::parse($o->order_date)->translatedFormat('j F Y') : '-' }}
                    </td>

                    <td>
                        {{ $o->start_date ? \Carbon\Carbon::parse($o->start_date)->translatedFormat('j F Y') : '-' }}
                    </td>

                    <td>{{ $o->order_code }}</td>

                    {{-- Format angka ribuan --}}
                    <td>{{ number_format($o->bill, 0, ',', '.') }}</td>
                    <td>{{ number_format($o->amount_sum) }}</td>

                    <td>{{ $o->payment_status == 1 ? 'success' : 'pending' }}</td>
                </tr>
            @endforeach

            {{-- TOTAL --}}
            <tr class="total-row">
                <td colspan="8" style="text-align:right;">TOTAL</td>
                <td>{{ number_format($total, 0, ',', '.') }}</td>
                <td></td>
            </tr>

        </tbody>
    </table>

    {{-- Auto print --}}
    <script>
        window.onload = () => window.print();
    </script>

</body>

</html>
